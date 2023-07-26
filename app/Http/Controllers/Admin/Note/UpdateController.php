<?php

namespace App\Http\Controllers\Admin\Note;

use App\Models\Note;
use App\Models\Tag;
use Illuminate\Http\Request;

class UpdateController
{
    public function __invoke(int $note, Request $request)
    {
        $note = Note::withoutGlobalScopes()->find(id: $note);
        $attributes = $request->validate([
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
            $note->activity->tags()->sync($tags);
        }

        $note->update($attributes);
    }
}
