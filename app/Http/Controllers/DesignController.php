<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DesignController extends Controller
{
    public function article(Request $request)
    {
        return view('design.article');
    }
}
