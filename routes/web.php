<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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

Route::get('/', [PostController::class, 'show'])->name('index');
Route::get('/grid-1', function() {
    return view('grid1');
});
Route::get('/grid-2', [PostController::class, 'index'])->name('grid-2');
Route::get('/waterfall', function() {
    return view('index');
});

Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::get('/admin', [PostController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/create', [PostController::class, 'create'])->name('create');
    Route::post('/admin/store', [PostController::class, 'store'])->name('store');
});

Auth::routes();
