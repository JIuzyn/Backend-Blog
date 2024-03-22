<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('posts', [PostController::class, 'index']);

    Route::group(['middleware' => 'admin'], function () {
        Route::post('posts/create', [PostController::class, 'store']);
        Route::patch('posts/{post}', [PostController::class, 'update']);
        Route::delete('posts/{post}', [PostController::class, 'delete']);
    });
});

Route::post('/registration', [AuthController::class, 'signUp']);
Route::post('/authorization', [AuthController::class, 'login']);
