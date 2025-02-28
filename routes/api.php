<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::group(['middleware' => ['auth']], function () {
    Route::get('/get-me', [AuthController::class, 'getMe'])->name('get-me');
    Route::post('/refresh-token', [AuthController::class, 'refreshToken'])->name('refresh-token');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
        Route::get('/', [UserController::class, 'list'])->name('list');
        Route::post('/', [UserController::class, 'create'])->name('create');
        Route::get('/{userId}', [UserController::class, 'show'])->name('show');
        Route::post('/{userId}', [UserController::class, 'update'])->name('update');
        Route::delete('/{userId}', [UserController::class, 'delete'])->name('delete');
    });
});
