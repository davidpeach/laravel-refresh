<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DesignController extends Controller
{
    public function listen(Request $request)
    {
        return view('design.listen');
    }
    public function jam(Request $request)
    {
        return view('design.jam');
    }
    public function article(Request $request)
    {
        return view('design.article');
    }
    public function note(Request $request)
    {
        return view('design.note');
    }
    public function photo(Request $request)
    {
        return view('design.photo');
    }
}
