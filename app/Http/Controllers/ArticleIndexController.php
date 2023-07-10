<?php

namespace App\Http\Controllers;

use App\Models\Activity;

class ArticleIndexController
{
    public function __invoke()
    {
        $activities = Activity::with('feedable')
            ->where('feedable_type', 'article')->get();

        return view('activity.index', [
            'activities' => $activities,
        ]);
    }
}
