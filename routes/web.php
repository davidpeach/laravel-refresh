<?php

declare(strict_types=1);

use App\Http\Controllers\CreateRegisterController;
use App\Http\Controllers\PostIndexController;
use App\Http\Controllers\PostShowController;
use App\Http\Controllers\StoreRegisterController;
use Illuminate\Support\Facades\Route;

Route::get('posts/{post:slug}', PostShowController::class);
Route::get('/', PostIndexController::class);

Route::get('register', CreateRegisterController::class);
Route::post('register', StoreRegisterController::class);
