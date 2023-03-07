<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::get('/posts/show', [PostController::class, 'show']);
    Route::get('/posts/show/{id}', [PostController::class, 'edit']);
    Route::post('/posts/add', [PostController::class, 'store']);
    Route::post('/posts/edit/{id}', [PostController::class, 'edit']);
    Route::post('/posts/change-post-order', [PostController::class, 'updatePostOrder']);
    Route::delete('/posts/delete/{id}', [PostController::class, 'destroy']);
});
