<?php

namespace App\Models;

use App\Models\Traits\HasActivity;
use App\Models\Traits\HasComments;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    use HasActivity;
    use HasComments;

    public function getPath()
    {
        return 'articles/' . $this->slug;
    }
}
