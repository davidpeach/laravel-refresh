<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Song extends Model
{
    use HasFactory;

    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class);
    }

    public function listen(): MorphToMany
    {
        return $this->morphToMany(Listen::class, 'listenable');
    }
}
