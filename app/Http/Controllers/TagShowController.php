<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;

class TagShowController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Tag $tag)
    {
        $activities = Activity::withWhereHas(
            'feedable',
        )
            ->with(['feedable.images', 'tags', 'feedable.syndications'])
            ->whereHas(
                'tags',
                function (Builder $query) use ($tag) {
                    $query->where('slug', $tag->slug);
                }
            )
            ->orderBy('published_at', 'desc')
            ->paginate(10);

        return view('activity.index', [
            'activities' => $activities,
        ]);
    }
}
