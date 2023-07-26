<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StoreLoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $attributes = request()->validate([
            'username' => 'required|max:255',
            'password' => 'required',
        ]);

        if (! auth()->attempt($attributes)) {
            return back()
                ->withInput()
                ->withErrors(['username' => 'Log in failed.']);
        }

        session()->regenerate();

        return redirect('/')->with(['success' => 'Logged In.']);
    }
}
