<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostIndexController extends Controller
{
    public function __invoke(Request $request)
    {
        $post = Post::with('category')
            ->filter($request->only('q', 'category'))
            ->orderBy('published_at', 'DESC');

        return view('post.index', [
            'posts' => $post->get(),
        ]);

    }
}
