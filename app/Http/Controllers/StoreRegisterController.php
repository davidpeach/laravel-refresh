<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreRegisterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required', 'min:2', 'max:255'],
            'username' => ['required', 'min:2', 'max:255', Rule::unique('users', 'username')],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')],
            'password' => ['required'],
        ]);

        $user = User::create($attributes);

        Auth::login($user);

        return redirect('/')->with('success', 'Account created!');
    }
}
