<?php

namespace App\Models;

use App\Models\Traits\HasActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Listen extends Model
{
    use HasFactory;
    use HasActivity;

    public function song(): MorphToMany
    {
        return $this->morphedByMany(Song::class, 'listenable');
    }
}
