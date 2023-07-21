<?php

namespace App\Http\Controllers\Admin\Article;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Tag;
use Illuminate\Http\Request;
use Inertia\Inertia;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $articles = Article::paginate(10)->through(function ($article) {
            return $article->toArray();
        });

        return Inertia::render('Posts/Index', [
            'posts' => $articles,
            'tags' => Tag::pluck('slug'),
        ]);
    }
}
