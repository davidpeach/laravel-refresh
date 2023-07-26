<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Article;
use App\Models\Note;
use App\Models\Photo;
use Illuminate\Http\Request;

class ActivityIndexController extends Controller
{
    public function __invoke(Request $request)
    {
        $activities = Activity::query()
            ->with(['feedable.images', 'tags'])
            ->orderBy('published_at', 'DESC')
            ->whereMorphRelation('feedable', [Article::class, Note::class, Photo::class], 'is_live', true)
            ->paginate(10);

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
