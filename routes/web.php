<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\LikeController;
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

Route::get('/', function () {
    return view('welcome');
});

// Step1：認証ミドルウェアを適用
Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('messages', MessageController::class);

    // Step6：イイネ登録・解除
    Route::post('/likes', [LikeController::class, 'store'])->name('likes.store');
    Route::delete('/likes', [LikeController::class, 'destroy'])->name('likes.destroy');
});