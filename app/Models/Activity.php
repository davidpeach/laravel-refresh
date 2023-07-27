<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Str;

/**
 * @property MorphTo $feedable
 */
class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'published_at',
    ];

    public function feedable(): MorphTo
    {
        return $this->morphTo();
    }

    public function getTypeAttribute(): string
    {
        return $this->feedable_type;
    }

    public function getPermalinkAttribute(): string
    {
        return Str::finish(config('app.url'), '/').$this->feedable->getPath();
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
}
