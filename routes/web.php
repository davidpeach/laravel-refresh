<?php

declare(strict_types=1);

use App\Http\Controllers\CreateLoginController;
use App\Http\Controllers\CreateRegisterController;
use App\Http\Controllers\PostIndexController;
use App\Http\Controllers\PostShowController;
use App\Http\Controllers\StoreLoginController;
use App\Http\Controllers\StorePostCommentController;
use App\Http\Controllers\StoreRegisterController;
use Illuminate\Support\Facades\Route;

Route::get('posts/{post:slug}', PostShowController::class);
Route::post('posts/{post:slug}/comments', StorePostCommentController::class);
Route::get('/', PostIndexController::class);

Route::get('login', CreateLoginController::class)->middleware(['guest']);
Route::post('login', StoreLoginController::class)->middleware(['guest']);
Route::get('register', CreateRegisterController::class)->middleware(['guest']);
Route::post('register', StoreRegisterController::class)->middleware(['guest']);
Route::post('logout', function () {
    auth()->logout();
    return redirect('/')->with(['success' => 'You have been logged out.']);
})->middleware(['auth']);
