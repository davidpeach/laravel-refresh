<?php

declare(strict_types=1);

use App\Http\Controllers\ActivityIndexController;
use App\Http\Controllers\Admin\Article\IndexController as AdminArticleIndexController;
use App\Http\Controllers\Admin\Article\StoreController as AdminArticleStoreController;
use App\Http\Controllers\Admin\Article\ShowController as AdminArticleShowController;
use App\Http\Controllers\Admin\Article\UpdateController as AdminArticleUpdateController;
use App\Http\Controllers\ArticleIndexController;
use App\Http\Controllers\ArticleShowController;
use App\Http\Controllers\DesignController;
use App\Http\Controllers\NoteIndexController;
use App\Http\Controllers\NoteShowController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoreNewsletterSubscriberController;
use App\Http\Controllers\TagIndexController;
use App\Http\Controllers\TagShowController;
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

Route::get('tags', TagIndexController::class);
Route::get('tags/{tag:slug}', TagShowController::class);

Route::get('articles', ArticleIndexController::class);
Route::get('articles/{article:slug}', ArticleShowController::class);

Route::get('notes', NoteIndexController::class);
Route::get('notes/{note:id}', NoteShowController::class);

Route::get('/', ActivityIndexController::class);

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/articles', AdminArticleIndexController::class)->name('dashboard.article.index');
    Route::get('/articles/{article}', AdminArticleShowController::class)->name('dashboard.article.show');
    Route::post('/articles', AdminArticleStoreController::class)->name('dashboard.article.store');
    Route::put('/articles/{article}', AdminArticleUpdateController::class)->name('dashboard.article.update');
});

Route::prefix('design')->group(function () {
    Route::get('article', [DesignController::class, 'article']);
    Route::get('note', [DesignController::class, 'note']);
    Route::get('photo', [DesignController::class, 'photo']);
    Route::get('jam', [DesignController::class, 'jam']);
    Route::get('listen', [DesignController::class, 'listen']);
});

require __DIR__ . '/auth.php';
