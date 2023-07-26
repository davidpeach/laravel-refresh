<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class StorePostCommentController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Post $post, Request $request)
    {
        $request->validate([
            'body' => ['required'],
        ]);

        $post->comments()->create([
            'user_id' => auth()->id(),
            'body' => request('body'),
        ]);
    }
}
