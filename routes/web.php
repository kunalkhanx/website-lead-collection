<?php


use Illuminate\Support\Facades\Route;

Route::middleware('admin')->group(function(){
    Route::get('/', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::get('/users', [\App\Http\Controllers\UserController::class, 'index'])->name('users');
    Route::get('/users/create', [\App\Http\Controllers\UserController::class, 'create'])->name('users.create');
    Route::post('/users/create', [\App\Http\Controllers\UserController::class, 'do_create'])->name('users.do_create');
    Route::get('/users/{user}', [\App\Http\Controllers\UserController::class, 'update'])->name('users.update');

    Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'do_logout'])->name('do_logout');
    Route::patch('/users/{user}', [\App\Http\Controllers\UserController::class, 'do_update'])->name('users.do_update');
});

Route::get('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'do_login'])->name('do_login');



