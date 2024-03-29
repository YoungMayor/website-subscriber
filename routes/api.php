<?php

use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->prefix('auth')->group(function () {
    Route::post('/login', 'login');
    Route::post('/register', 'register');
})->name('auth.');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
