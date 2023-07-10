<?php

declare(strict_types=1);

use App\Http\Controllers\DesignController;
use App\Http\Controllers\IndexAdminPostsController;
use App\Http\Controllers\ActivityIndexController;
use App\Http\Controllers\ArticleShowController;
use App\Http\Controllers\NoteShowController;
use App\Http\Controllers\PostShowController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoreNewsletterSubscriberController;
use App\Http\Controllers\StorePostCommentController;
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

Route::get('articles/{article:slug}', ArticleShowController::class);
Route::get('notes/{note:id}', NoteShowController::class);

Route::get('posts/{post:slug}', PostShowController::class);
Route::post('posts/{post:slug}/comments', StorePostCommentController::class);
Route::get('/', ActivityIndexController::class);

/* Route::get('/admin/posts',::class); */
/* Route::get('login', CreateLoginController::class)->middleware(['guest']); */
/* Route::post('login', StoreLoginController::class)->middleware(['guest']); */
/* Route::get('register', CreateRegisterController::class)->middleware(['guest']); */
/* Route::post('register', StoreRegisterController::class)->middleware(['guest']); */
/* Route::post('logout', function () { */
/*     auth()->logout(); */
/*     return redirect('/')->with(['success' => 'You have been logged out.']); */
/* })->middleware(['auth']); */

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/posts', IndexAdminPostsController::class)->name('admin.posts');
});

Route::prefix('design')->group(function () {
    Route::get('article', [ DesignController::class, 'article']);
    Route::get('note', [ DesignController::class, 'note']);
    Route::get('photo', [ DesignController::class, 'photo']);
    Route::get('jam', [ DesignController::class, 'jam']);
    Route::get('listen', [ DesignController::class, 'listen']);
});

require __DIR__.'/auth.php';
