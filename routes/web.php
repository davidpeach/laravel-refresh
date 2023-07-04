<?php

declare(strict_types=1);

use App\Http\Controllers\CreateLoginController;
use App\Http\Controllers\CreateRegisterController;
use App\Http\Controllers\PostIndexController;
use App\Http\Controllers\PostShowController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoreLoginController;
use App\Http\Controllers\StoreNewsletterSubscriberController;
use App\Http\Controllers\StorePostCommentController;
use App\Http\Controllers\StoreRegisterController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::post('newsletter', StoreNewsletterSubscriberController::class);
Route::get('ping', function () {
    $mailchimp = new \MailchimpMarketing\ApiClient();

    $mailchimp->setConfig([
        'apiKey' => config('services.mailchimp.key'),
        'server' => config('services.mailchimp.server_prefix'),
    ]);

    dd($mailchimp->lists->getAllLists());
});

Route::get('posts/{post:slug}', PostShowController::class);
Route::post('posts/{post:slug}/comments', StorePostCommentController::class);
Route::get('/', PostIndexController::class);

/* Route::get('login', CreateLoginController::class)->middleware(['guest']); */
/* Route::post('login', StoreLoginController::class)->middleware(['guest']); */
/* Route::get('register', CreateRegisterController::class)->middleware(['guest']); */
/* Route::post('register', StoreRegisterController::class)->middleware(['guest']); */
/* Route::post('logout', function () { */
/*     auth()->logout(); */
/*     return redirect('/')->with(['success' => 'You have been logged out.']); */
/* })->middleware(['auth']); */

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

