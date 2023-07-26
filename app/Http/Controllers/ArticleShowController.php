<?php

namespace App\Http\Controllers;

use App\Models\Article;

class ArticleShowController
{
    public function __invoke(Article $article)
    {
        return view('article.show', compact('article'));
    }
}
