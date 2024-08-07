<?php


use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::post('/', [\App\Http\Controllers\AuthController::class, 'do_login'])->name('do_login');


