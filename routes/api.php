<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->prefix('auth')->group(function () {
    Route::post('/login', 'login');
    Route::post('/register', 'register');
})->name('auth.');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::controller(UserController::class)->prefix('user')->group(function () {
        Route::get('/', 'profile');
    })->name('profile.');
});
