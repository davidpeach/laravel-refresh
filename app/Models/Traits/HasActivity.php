<?php

namespace App\Models\Traits;

use App\Models\Activity;
use App\Models\Article;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait HasActivity
{
    protected static function booted(): void
    {
        static::created(function ($feedable) {
            $feedable->activity()->create();
        });
    }

    public function activity(): MorphOne
    {
        return $this->morphOne(Activity::class, 'feedable');
    }
}
