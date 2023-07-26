<?php

namespace App\Http\Controllers\Admin\Article;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Tag;
use Inertia\Inertia;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $articles = Article::withoutGlobalScopes()
            ->orderBy('published_at', 'desc')
            ->paginate(10)
            ->through(function ($article) {
                return $article->toArray();
            });

        return Inertia::render('Articles/Index', [
            'posts' => $articles,
            'tags' => Tag::pluck('slug'),
        ]);
    }
}
