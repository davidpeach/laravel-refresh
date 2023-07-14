<?php

namespace WPImport;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Support\Carbon;

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
        $contents = file_get_contents($this->file);
        $this->xml = simplexml_load_string($contents);

        /* $this->importTags(); */
        /* $this->importCategories(); */ // todo
        $this->importContent(); // todo
    }

    protected function importPost($item) {
        $mapping = $this->mapping()['item'];

        $model = new $mapping['model'];
        foreach($mapping['attributes'] as $wpKey => $newKey) {
            $value = match ($newKey) {
                'body' => strip_tags((string) $item->xpath($wpKey)[0], [
                    '<h2>',
                    '<p>',
                ]),
                'published_at' => new Carbon((string) $item->xpath($wpKey)[0]),
                default => (string) $item->xpath($wpKey)[0],
            };

            $model->{$newKey} = $value;
        }
        $model->save();
    }

    protected function importContent()
    {

        foreach($this->xml->channel->xpath('item') as $item) {
            match ((string) $item->xpath('wp:post_type')[0]) {
                'post' => $this->importPost($item),
                default => null,
            };
        }
    }

    protected function importTags()
    {
        $mapping = $this->mapping()['wp:tag'];

        foreach($this->xml->channel->xpath('wp:tag') as $tag) {

            if (Tag::where('slug', $mapping['attributes']['wp:tag_slug'])->first()) {
                continue;
            }

            $model = new $mapping['model'];
            foreach($mapping['attributes'] as $wpKey => $newKey) {
                $model->{$newKey} = (string) $tag->xpath($wpKey)[0];
                $model->save();
            }
        }
    }

    protected function mapping()
    {
        return [
            'item' => [
                'model' => Article::class,
                'attributes' => [
                    'title' => 'title',
                    'content:encoded' => 'body',
                    'wp:post_name' => 'slug',
                    'pubDate' => 'published_at',
                ]
            ],
            'wp:tag' => [
                'model' => Tag::class,
                'attributes' => [
                    'wp:tag_name' => 'title',
                    'wp:tag_slug' => 'slug',
                ]
            ]
        ];
    }
}

