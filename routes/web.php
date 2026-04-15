<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
});

Route::post('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

Route::middleware('checkLogin')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    });

    Route::resource('divisions', App\Http\Controllers\DivisionController::class);
    Route::resource('categories', App\Http\Controllers\CategoryController::class);
    Route::resource('users', App\Http\Controllers\UserController::class);
    // Route::resource('divisions', App\Http\Controllers\DivisionController::class);
});
