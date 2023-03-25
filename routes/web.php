<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ContactFormController;

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

Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::get('/admin', function() {
        return view('dashboard');
    });
});

Route::get('/posts/show', [PostsController::class, 'index'])->middleware('ajax');
Route::post('/sendmail', [ContactFormController::class, 'sendEmail']);

Auth::routes();
