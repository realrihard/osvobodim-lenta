<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminPostsController;
use App\Http\Controllers\Auth\LoginController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::get('/posts/show', [AdminPostsController::class, 'show']);
    Route::get('/posts/find/{id}', [AdminPostsController::class, 'findPost']);
    Route::post('/posts/add', [AdminPostsController::class, 'create']);
    Route::post('/posts/edit/{id}', [AdminPostsController::class, 'edit']);
    Route::post('/posts/change-post-order', [AdminPostsController::class, 'updatePostOrder']);
    Route::delete('/posts/delete/{id}', [AdminPostsController::class, 'destroy']);
});
