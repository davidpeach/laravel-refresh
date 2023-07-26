<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property Category $category
 */
class Post extends Model
{
    use HasFactory;

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeFilter($query, array $filter)
    {
        $query->when($filter['q'] ?? false, function ($query, $search) {
            $query
                ->where('title', 'like', '%'.$search.'%')
                ->orWhere('body', 'like', '%'.$search.'%');
        });

        $query->when($filter['category'] ?? false, function ($query, $category) {
            $query->whereHas('category', fn ($query) => $query->where('slug', $category)
            );
        });
    }
}
