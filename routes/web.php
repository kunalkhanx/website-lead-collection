<?php


use Illuminate\Support\Facades\Route;

Route::middleware('admin')->group(function(){
    Route::get('/', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'do_logout'])->name('do_logout');

    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
    Route::patch('/profile', [\App\Http\Controllers\ProfileController::class, 'do_update'])->name('profile.do_update');

    Route::prefix('/forms')->group(function(){
        Route::get('/', [\App\Http\Controllers\FormController::class, 'index'])->name('forms');
        Route::get('/create', [\App\Http\Controllers\FormController::class, 'create'])->name('forms.create');
        Route::post('/create', [\App\Http\Controllers\FormController::class, 'do_create'])->name('forms.do_create');
        Route::get('/{form}', [\App\Http\Controllers\FormController::class, 'update'])->name('forms.update');
        Route::patch('/{form}', [\App\Http\Controllers\FormController::class, 'do_update'])->name('forms.do_update');
        Route::post('/delete/{form}', [\App\Http\Controllers\FormController::class, 'do_delete'])->name('forms.do_delete');
    });

    Route::prefix('/fields')->group(function(){
        Route::get('/', [\App\Http\Controllers\FieldController::class, 'index'])->name('fields');
        Route::get('/create', [\App\Http\Controllers\FieldController::class, 'create'])->name('fields.create');
        Route::post('/create', [\App\Http\Controllers\FieldController::class, 'do_create'])->name('fields.do_create');
        Route::get('/{field}', [\App\Http\Controllers\FieldController::class, 'update'])->name('fields.update');
        Route::patch('/{field}', [\App\Http\Controllers\FieldController::class, 'do_update'])->name('fields.do_update');
        Route::post('/delete/{field}', [\App\Http\Controllers\FieldController::class, 'do_delete'])->name('fields.do_delete');
    });
});

Route::middleware('super')->group(function(){

    Route::prefix('/users')->group(function(){
        Route::get('/', [\App\Http\Controllers\UserController::class, 'index'])->name('users');
        Route::get('/create', [\App\Http\Controllers\UserController::class, 'create'])->name('users.create');
        Route::post('/create', [\App\Http\Controllers\UserController::class, 'do_create'])->name('users.do_create');
        Route::get('/{user}', [\App\Http\Controllers\UserController::class, 'update'])->name('users.update');
        Route::patch('/{user}', [\App\Http\Controllers\UserController::class, 'do_update'])->name('users.do_update');
        Route::post('/delete/{user}', [\App\Http\Controllers\UserController::class, 'do_delete'])->name('users.do_delete');
    });
    
});

Route::get('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'do_login'])->name('do_login');



