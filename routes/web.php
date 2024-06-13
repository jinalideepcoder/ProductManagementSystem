<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');
Route::post('/logout', [LoginController::class, 'destroy'])->name('login.destroy');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('categories', CategoryController::class)->middleware('auth');
    Route::resource('products', ProductController::class);
    Route::get('dashboard', [LoginController::class, 'dashboard']);
});
