<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Image extends Model
{
    use HasFactory;

    public function notes(): MorphToMany
    {
        return $this->morphedByMany(Note::class, 'imageable');
    }
}
