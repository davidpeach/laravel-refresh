<?php

namespace App\Http\Controllers;

use App\Models\Activity;

class NoteIndexController
{
    public function __invoke()
    {
        $activities = Activity::with('feedable')
            ->where('feedable_type', 'note')->get();

        return view('activity.index', [
            'activities' => $activities,
        ]);
    }
}
