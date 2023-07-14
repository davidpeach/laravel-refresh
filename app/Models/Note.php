<?php

namespace App\Models;

use App\Models\Traits\HasActivity;
use App\Models\Traits\HasComments;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Note extends Model
{
    use HasFactory;
    use HasActivity;
    use HasComments;

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

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
