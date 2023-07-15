<?php

namespace WPImport;

use App\Models\Article;
use App\Models\Image;
use App\Models\Tag;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class Importer
{
    public $file;

    public $xml;

    public function withFile($file)
    {
        $this->file = $file;

        return $this;
    }

    public function import()
    {
        $this->file = storage_path('wp2.xml');
        $contents = file_get_contents($this->file);
        $this->xml = simplexml_load_string($contents);

        $this->importAttachments();
        /* $this->importTags(); */
        $this->importPosts();

        $this->linkPostsToFeaturedImage();
    }

    protected function linkPostsToFeaturedImage()
    {
        Article::cursor()->filter(function ($a) {
            return ! is_null($a->wp_featured_image_id);
        })->each(function ($a) {
            $image = Image::where('wp_postid', $a->wp_featured_image_id)->first();
            if ($image) {
                /* dd($image, $a->wp_featured_image_id); */
                $a->images()->sync($image->id);
            }
        });
    }

    protected function importPost($item)
    {
        $mapping = $this->mapping()['item'];

        $model = new $mapping['model'];
        foreach ($mapping['attributes'] as $wpKey => $newKey) {
            $value = match ($newKey) {
                'excerpt', 'body' => strip_tags((string) $item->xpath($wpKey)[0], [
                    '<h2>',
                    '<p>',
                ]),
                'published_at' => new Carbon((string) $item->xpath($wpKey)[0]),
                default => (string) $item->xpath($wpKey)[0],
            };

            $model->{$newKey} = $value;
        }
        $model->save();

        foreach ($item->xpath('category') as $category) {

            if ((string) $category->attributes()[0] === 'post_tag') {
                $tag = Tag::firstOrCreate([
                    'title' => (string) $category->attributes()[1],
                    'slug' => (string) $category->attributes()[1],
                ]);

                $model->tags()->attach($tag);
            }
        }

        foreach ($item->xpath('wp:postmeta') as $postmeta) {
            if ((string) $postmeta->xpath('wp:meta_key')[0] === '_thumbnail_id') {
                $model->wp_featured_image_id = (string) $postmeta->xpath('wp:meta_value')[0];
                $model->save();
            }
        }
    }

    protected function importAttachment($item)
    {
        $wp_postid = (string) $item->xpath('wp:post_id')[0];
        $wp_guid = (string) $item->xpath('guid')[0];

        $wp_guid = str_replace('blog.', '', $wp_guid);

        $image = Image::firstOrNew([
            'wp_guid' => $wp_guid,
            'wp_postid' => $wp_postid,
        ]);

        try {
            $imagePath = Str::uuid().'.jpg';
            dump($wp_guid);
            copy($wp_guid, storage_path('app/public/'.$imagePath));
            $image->path = $imagePath;
            $image->save();
        } catch (\Throwable $e) {
            dump($e->getMessage());
        }
    }

    protected function importAttachments()
    {
        foreach ($this->xml->channel->xpath('item') as $item) {
            match ((string) $item->xpath('wp:post_type')[0]) {
                'attachment' => $this->importAttachment($item),
                default => null,
            };
        }
    }

    protected function importPosts()
    {
        foreach ($this->xml->channel->xpath('item') as $item) {
            match ((string) $item->xpath('wp:post_type')[0]) {
                'post' => $this->importPost($item),
                default => null,
            };
        }
    }

    protected function importTags()
    {
        $mapping = $this->mapping()['wp:tag'];

        foreach ($this->xml->channel->xpath('wp:tag') as $tag) {

            if (Tag::where('slug', $mapping['attributes']['wp:tag_slug'])->first()) {
                continue;
            }

            $model = new $mapping['model'];
            foreach ($mapping['attributes'] as $wpKey => $newKey) {
                $model->{$newKey} = (string) $tag->xpath($wpKey)[0];
            }
            $model->save();
        }
    }

    protected function mapping()
    {
        return [
            'item' => [
                'model' => Article::class,
                'attributes' => [
                    'title' => 'title',
                    'excerpt:encoded' => 'excerpt',
                    'content:encoded' => 'body',
                    'wp:post_name' => 'slug',
                    'pubDate' => 'published_at',
                ],
            ],
            'wp:tag' => [
                'model' => Tag::class,
                'attributes' => [
                    'wp:tag_name' => 'title',
                    'wp:tag_slug' => 'slug',
                ],
            ],
        ];
    }
}
