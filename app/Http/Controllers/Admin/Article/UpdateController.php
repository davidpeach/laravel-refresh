<?php

namespace App\Http\Controllers\Admin\Article;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Http\Request;

class UpdateController
{
    public function __invoke(Article $article, Request $request)
    {
        $attributes = $request->validate([
            'title' => [
                'sometimes',
                'string',
            ],
            'excerpt' => [
                'sometimes',
                'string',
            ],
            'body' => [
                'sometimes',
                'string',
            ],
            'tags' => [
                'sometimes',
                'array',
            ],
            'is_live' => [
                'sometimes',
                'boolean',
            ],
        ]);

        if (array_key_exists('tags', $attributes)) {
            $tags = collect($attributes['tags'])
                ->map(function (string $tagSlug) {
                    return Tag::where('slug', $tagSlug)->first();
                })
                ->filter()
                ->pluck('id')
                ->values();
            $article->tags()->sync($tags);

        }


        $article->update($attributes);
    }
}
