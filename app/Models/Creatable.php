<?php

namespace App\Models;

use App\Enums\CreatableRole;
use Illuminate\Database\Eloquent\Relations\MorphPivot;

class Creatable extends MorphPivot
{
    protected $casts = [
        'role' => CreatableRole::class,
    ];
}
