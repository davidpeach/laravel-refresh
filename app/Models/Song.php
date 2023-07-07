<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;

    public function album()
    {
        return $this->belongsTo(Album::class);
    }

    public function listen()
    {
        return $this->morphedByMany(Listen::class, 'listenable');
    }
}