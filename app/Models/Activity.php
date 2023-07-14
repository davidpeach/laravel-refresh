<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'published_at',
    ];

    public function feedable()
    {
        return $this->morphTo();
    }

    public function getTypeAttribute(): string
    {
        return $this->feedable_type;
    }

    public function getPermalinkAttribute(): string
    {
        return Str::finish(config('app.url'), '/') . $this->feedable->getPath() ;
    }
}
