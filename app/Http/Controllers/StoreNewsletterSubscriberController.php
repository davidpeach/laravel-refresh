<?php

namespace App\Http\Controllers;

use App\Services\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

final class StoreNewsletterSubscriberController extends Controller
{
    public function __construct(private Newsletter $newsletter)
    {
    }
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $attributes = $request->validate([
            'email' => [
                'required',
                'email',
            ]
        ]);

        try {
            $this->newsletter->subscribe($attributes['email']);
        } catch (\Throwable) {
            throw ValidationException::withMessages([
                'email' => 'Email could not be added, sorry.',
            ]);
        }
    }
}
