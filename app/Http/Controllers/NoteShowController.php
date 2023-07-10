<?php

namespace App\Http\Controllers;

use App\Models\Note;

class NoteShowController
{
    public function __invoke(Note $note)
    {
        return view('note.show', compact('note'));
    }
}
