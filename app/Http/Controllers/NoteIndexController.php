<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Note;

class NoteIndexController
{
    public function __invoke()
    {
        $activities = Activity::with(['tags', 'feedable.images', 'feedable.syndications'])
            ->orderBy('published_at', 'desc')
            ->where('feedable_type', 'note')
            ->whereMorphRelation('feedable', [Note::class], 'is_live', true)
            ->paginate(10);

        return view('activity.index', [
            'activities' => $activities,
        ]);
    }
}
