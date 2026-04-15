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
    Route::resource('users', App\Http\Controllers\UserController::class)->except('show');
    Route::get('/users/export', [App\Http\Controllers\UserController::class, 'exportExcel'])->name('users.export');
    Route::get('/users/operator', [App\Http\Controllers\UserController::class, 'index_operator'])->name('users.operator');
    Route::post('/users/{user}/reset-password', [App\Http\Controllers\UserController::class, 'resetPasswordAdmin'])->name('users.reset_password');
    // Route::resource('divisions', App\Http\Controllers\DivisionController::class);
});
