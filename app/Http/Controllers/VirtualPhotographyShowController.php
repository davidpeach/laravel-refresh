<?php

namespace App\Http\Controllers;

use App\Models\Photo;

class VirtualPhotographyShowController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Photo $photo)
    {
        return view('vp.show', compact('photo'));
    }
}
