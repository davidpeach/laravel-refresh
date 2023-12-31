<?php

namespace App\Models\Traits;

use App\Models\Activity;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait HasActivity
{
    protected static function bootHasActivity(): void
    {
        static::created(function ($feedable) {
            $feedable->activity()->create([
                'published_at' => $feedable->published_at ?? now(),
            ]);
        });
    }

    public function activity(): MorphOne
    {
        return $this->morphOne(Activity::class, 'feedable');
    }
}
