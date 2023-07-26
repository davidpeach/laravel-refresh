<?php

namespace App\Models;

use App\Models\Scopes\PubliclyViewableScope;
use App\Models\Traits\HasActivity;
use App\Models\Traits\HasComments;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Note extends Model
{
    use HasFactory;
    use HasActivity;
    use HasComments;

    protected $fillable = [
        'is_live',
        'body',
    ];

    protected $casts = [
        'is_live' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope(new PubliclyViewableScope);
    }

    public function getPath()
    {
        return 'notes/' . $this->id;
    }

    public function images(): MorphToMany
    {
        return $this->morphToMany(Image::class, 'imageable');
    }

    public function syndications(): MorphMany
    {
        return $this->morphMany(Syndication::class, 'syndicatable');
    }
}
