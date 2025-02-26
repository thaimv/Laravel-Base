<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/users', [UserController::class, 'list']);
Route::group(['middleware' => []], function () {
    Route::group(['prefix' => 'users'], function () {
        Route::get('/', [UserController::class, 'list']);
        Route::post('/', [UserController::class, 'create']);
        Route::get('/{userId}', [UserController::class, 'show']);
        Route::post('/{userId}', [UserController::class, 'update']);
        Route::delete('/{userId}', [UserController::class, 'delete']);
    });
});
