<?php

namespace App\Models;

use App\Models\Traits\HasActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Read extends Model
{
    use HasFactory;
    use HasActivity;
}
