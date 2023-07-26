<?php

namespace App\Http\Controllers;

use App\Enums\PhotoType;
use App\Models\Activity;
use App\Models\Photo;

class VirtualPhotographyIndexController extends Controller
{
    public function __invoke()
    {
        $activities = Activity::with(['tags', 'feedable.images'])
            ->orderBy('published_at', 'desc')
            ->where('feedable_type', 'photo')
            ->whereMorphRelation('feedable', [Photo::class], 'type', PhotoType::VIRTUAL->value)
            ->whereMorphRelation('feedable', [Photo::class], 'is_live', true)
            ->paginate(10);

        return view('activity.index', [
            'activities' => $activities,
        ]);
    }
}
