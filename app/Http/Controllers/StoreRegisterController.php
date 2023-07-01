<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class StoreRegisterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required', 'min:2', 'max:255'],
            'username' => ['required', 'min:2', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required'],
        ]);

        User::create($attributes);
    }
}
