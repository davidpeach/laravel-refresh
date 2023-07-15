<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Article;
use App\Models\Note;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;

class TagShowController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Tag $tag)
    {
        $activities = Activity::whereHasMorph(
            'feedable',
            [Note::class, Article::class],
            function (Builder $query) use ($tag) {
                $query->whereHas(
                    'tags',
                    function (Builder $query) use ($tag) {
                        $query->where('slug', $tag->slug);
                    }
                );
            }
        )
            ->orderBy('published_at', 'desc')
            ->paginate(10)
            ->loadMorph('feedable', [
                Note::class => [
                    'images',
                    'syndications',
                    'tags',
                ],
                Article::class => [
                    'tags',
                ],
            ]);

        return view('activity.index', [
            'activities' => $activities,
        ]);
    }
}
