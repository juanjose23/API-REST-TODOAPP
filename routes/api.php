<?php

use App\Http\Controllers\TwitterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Password;

use Illuminate\Support\Str;
Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::post('/forgot-password', [AuthController::class, 'sendPasswordResetLink']);
    Route::post('/password-reset', [AuthController::class, 'resetPassword'])->name('password.reset');

});

Route::middleware(['web'])->group(function () {
    Route::get('/auth/twitter', [TwitterController::class, 'redirectToTwitter']);
    Route::get('/auth/twitter/callback', [TwitterController::class, 'handleTwitterCallback']);
});
