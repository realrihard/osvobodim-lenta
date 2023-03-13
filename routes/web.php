<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\AdminPostsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function() {
    return view('index');
});
Route::get('/posts', [PostsController::class, 'index']);

Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::get('/admin', function() {
        return view('dashboard');
    });
});

Auth::routes();
