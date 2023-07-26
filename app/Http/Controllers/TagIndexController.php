<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagIndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $tags = Tag::with(['articles', 'notes', 'photos'])->all();

        return view('tags.index', [
            'tags' => $tags,
        ]);
    }
}
