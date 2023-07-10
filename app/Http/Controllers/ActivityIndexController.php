<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityIndexController extends Controller
{
    public function __invoke(Request $request)
    {
        $activities = Activity::query()
            ->with('feedable')
            ->get();

        return view('activity.index', [
            'activities' => $activities,
        ]);

        /* $post = Post::with('category') */
        /*     ->filter($request->only('q', 'category')) */
        /*     ->orderBy('published_at', 'DESC'); */

        /* return view('post.index', [ */
        /*     'posts' => $post->get(), */
        /* ]); */
    }
}
