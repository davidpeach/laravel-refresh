<?php

namespace App\Models;

use App\Models\Traits\HasActivity;
use App\Models\Traits\HasComments;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Carbon;

class Article extends Model
{
    use HasFactory;
    use HasActivity;
    use HasComments;

    public function getPath()
    {
        return 'articles/' . $this->slug;
    }

    public function images(): MorphToMany
    {
        return $this->morphToMany(Image::class, 'imageable');
    }

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
