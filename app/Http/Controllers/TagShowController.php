<?php

namespace App\Http\Controllers;

use App\Models\Activity;
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
        $activities = Activity::with([
            'feedable' => [
                'images',
                'syndications',
                'tags',
            ],
        ])->whereHasMorph(
            'feedable',
            [Note::class],
            function (Builder $query) use ($tag) {
                $query->whereHas(
                    'tags',
                    function (Builder $query) use ($tag) {
                        $query->where('slug', $tag->slug);
                    }
                );
            }
        )->paginate(5);

        return view('activity.index', [
            'activities' => $activities,
        ]);
    }
}
