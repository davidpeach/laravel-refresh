<?php

namespace TweetsImporter;

use App\Models\Image;
use App\Models\Note;
use App\Models\Syndication;
use App\Models\Tag;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class TweetsImporter
{
    private $file;

    public function import()
    {
        $tweets = file_get_contents(storage_path('tweets.js'));
        $tweets = json_decode($tweets, true);
        collect($tweets)->map(function ($tweet) {
            $t = $tweet['tweet'];
            $hashtags = $t['entities']['hashtags'];
            $symbols = $t['entities']['symbols'];
            $user_mentions = $t['entities']['user_mentions'];
            $media = [];

            if (array_key_exists('media', $t['entities'])) {
                $media = $t['entities']['media'];
            }

            if (array_key_exists('extended_entities', $t) &&
                array_key_exists('media', $t['extended_entities'])
            ) {
                $media = $t['extended_entities']['media'];
            }

            $likes_count = $t['favorite_count'];
            $tweetId = $t['id'];
            $body = $t['full_text'];
            $published_at = $t['created_at'];

            $note = new Note();
            $note->body = $body;
            $note->published_at = new Carbon($published_at);
            $note->save();

            $syndication = new Syndication();
            $syndication->external_site = 'twitter';
            $syndication->external_url = 'https://twitter.com/chegalabonga/status/'.$tweetId;
            $note->syndications()->save($syndication);

            if (! empty($hashtags)) {
                foreach ($hashtags as $hashtag) {
                    $tag = Tag::firstOrCreate([
                        'title' => $hashtag['text'],
                        'slug' => strtolower($hashtag['text']),
                    ]);

                    $note->tags()->save($tag);
                }
            }

            if (! empty($media)) {
                foreach ($media as $m) {
                    $imagePath = Str::uuid().'.jpg';
                    copy($m['media_url_https'].'?name=4096x4096', storage_path('/app/public/'.$imagePath));
                    $image = new Image();
                    $image->path = $imagePath;
                    $image->save();
                    $note->images()->attach($image->id);
                }
            }

            foreach ($user_mentions as $user) {
                $contact = [];
                $contact['name'] = $user['name'];
                $contact['username'] = $user['screen_name'];
                $contact['twitter_id'] = $user['id'];

                // Create contact.
            }

            dump($tweet);
        });
    }

    public function withFile($file)
    {
        $this->file = $file;

        return $this;
    }
}
