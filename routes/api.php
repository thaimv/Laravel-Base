<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

// Login
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Forgot password
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/verify-token', [AuthController::class, 'verifyToken']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);

// Auth
Route::group(['middleware' => ['auth']], function () {
    // Get me
    Route::get('/get-me', [AuthController::class, 'getMe'])->name('get-me');

    // Get refresh token
    Route::post('/refresh-token', [AuthController::class, 'refreshToken'])->name('refresh-token');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Users
    Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
        Route::get('/', [UserController::class, 'list'])->name('list');
        //Route::post('/', [UserController::class, 'create'])->name('create');
        //Route::get('/{userId}', [UserController::class, 'show'])->name('show');
        //Route::post('/{userId}', [UserController::class, 'update'])->name('update');
        //Route::delete('/{userId}', [UserController::class, 'delete'])->name('delete');
    });
});
