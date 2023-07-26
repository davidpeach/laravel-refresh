<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Article;

class ArticleIndexController
{
    public function __invoke()
    {
        $activities = Activity::with(['tags', 'feedable.images'])
            ->orderBy('published_at', 'desc')
            ->where('feedable_type', 'article')
            ->whereMorphRelation('feedable', [Article::class], 'is_live', true)
            ->paginate(10);

        return view('activity.index', [
            'activities' => $activities,
        ]);
    }
}
