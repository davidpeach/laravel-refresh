<?php

namespace App\Http\Controllers\Admin\Article;

use App\Models\Article;
use Illuminate\Http\Request;

class StoreController
{
    public function __invoke(Article $article, Request $request)
    {
       dd($article, $request->all());
    }
}
