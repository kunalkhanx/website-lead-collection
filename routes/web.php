<?php


use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::post('/', [\App\Http\Controllers\AuthController::class, 'do_login'])->name('do_login');

Route::middleware('admin')->group(function(){
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::get('/users/create', [\App\Http\Controllers\UserController::class, 'create'])->name('users.create');
    Route::post('/users/create', [\App\Http\Controllers\UserController::class, 'do_create'])->name('users.do_create');
});



