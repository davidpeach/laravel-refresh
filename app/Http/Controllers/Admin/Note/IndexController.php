<?php

namespace App\Http\Controllers\Admin\Note;

use App\Http\Controllers\Controller;
use App\Models\Note;
use App\Models\Tag;
use Inertia\Inertia;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $notes = Note::withoutGlobalScopes()
            ->paginate(10)
            ->through(function ($note) {
                return $note->toArray();
            });

        return Inertia::render('Notes/Index', [
            'posts' => $notes,
            'tags' => Tag::pluck('slug'),
        ]);
    }
}

