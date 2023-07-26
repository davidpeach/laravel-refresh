<?php

namespace App\Http\Controllers\Admin\Note;

use App\Http\Controllers\Controller;
use App\Http\Resources\NoteResource;
use App\Models\Note;

class ShowController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($note)
    {
        return new NoteResource(
            Note::withoutGlobalScopes()->with(['activity.tags'])->find($note)
        );
    }
}
