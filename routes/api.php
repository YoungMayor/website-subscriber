<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\WebsiteController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->prefix('auth')->group(function () {
    Route::post('/login', 'login');
    Route::post('/register', 'register');
})->name('auth.');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::controller(UserController::class)->prefix('user')->group(function () {
        Route::get('/', 'profile');
    })->name('profile.');

    Route::controller(PostController::class)->prefix('post')->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::get('/{post}', 'show');
        Route::put('/{post}', 'update');
        Route::delete('/{post}', 'destroy');
    });

    Route::controller(WebsiteController::class)->prefix('website')->group(function () {
        Route::prefix('/{website}')->group(function () {
            Route::post('/subscribe', 'subscribe');
        });
    });
});
