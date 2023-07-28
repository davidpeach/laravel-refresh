<?php

namespace App\Models;

use App\Models\Scopes\PubliclyViewableScope;
use App\Models\Traits\HasActivity;
use App\Models\Traits\HasComments;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Article extends Model
{
    use HasFactory;
    use HasActivity;
    use HasComments;

    protected $fillable = [
        'title',
        'is_live',
        'excerpt',
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
        return 'articles/'.$this->slug;
    }

    public function images(): MorphToMany
    {
        return $this->morphToMany(Image::class, 'imageable');
    }
}
