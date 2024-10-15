<?php

use App\Http\Controllers\Backend\CategoryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function () {
    Route::get('dashboard', function() {
        return view('home');
    });

    Route::get('categories/serverside', [CategoryController::class, 'serverside'])->name('admin.categories.serverside');
    Route::resource('categories', CategoryController::class)
    ->except('create', 'edit')
    ->names('admin.categories');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
