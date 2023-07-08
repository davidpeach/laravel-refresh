<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Album extends Model
{
    use HasFactory;

    public function creators(): MorphToMany
    {
        return $this->morphToMany(Creator::class, 'creatable');
    }

    public function songs(): HasMany
    {
        return $this->hasMany(Song::class);
    }
}
