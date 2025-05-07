<?php

use App\Http\Controllers\TeamsController;
use App\Http\Controllers\TwitterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);


    Route::post('/forgot-password', [AuthController::class, 'sendPasswordResetLink']);
    Route::post('/password-reset', [AuthController::class, 'resetPassword'])->name('password.reset');

});
Route::get('/users', [AuthController::class, 'users'])->name('users');

Route::middleware('jwt')->prefix('teams')->group(function (){
    Route::post('/create',[TeamsController::class,'createTeam'])->name('teams.create');
    Route::get('/teams',[TeamsController::class,'teams'])->name('teams.teams');

});

Route::middleware(['web'])->group(function () {
    Route::get('/auth/twitter', [TwitterController::class, 'redirectToTwitter']);
    Route::get('/auth/twitter/callback', [TwitterController::class, 'handleTwitterCallback']);
});
