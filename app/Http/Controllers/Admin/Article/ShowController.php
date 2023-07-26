<?php

namespace App\Http\Controllers\Admin\Article;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Models\Article;

class ShowController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($article)
    {
        return new ArticleResource(
            Article::withoutGlobalScopes()->with(['activity.tags'])->find($article)
        );
    }
}
