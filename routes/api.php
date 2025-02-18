<?php

use App\Http\Controllers\GetController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostImageController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::group(['middleware'=> 'auth:sanctum'], function (){
    Route::post('/posts', [PostController::class, 'store']);
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{user}/posts', [UserController::class, 'post']);
    Route::get('/users/{user}/toggle_following', [UserController::class, 'toggleFollowing']);

    Route::get('/posts', [PostController::class, 'index']);
    Route::post('/post_images', [PostImageController::class, 'store']);
});

