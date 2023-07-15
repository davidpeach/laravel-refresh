<?php

namespace App\Http\Controllers;

use App\Models\Activity;

class NoteIndexController
{
    public function __invoke()
    {
        $activities = Activity::with(['feedable.tags', 'feedable.syndications', 'feedable.images'])
            ->orderBy('published_at', 'desc')
            ->where('feedable_type', 'note')->paginate(10);

        return view('activity.index', [
            'activities' => $activities,
        ]);
    }
}
