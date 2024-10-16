<?php

use App\Http\Controllers\Backend\ArticleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\TagController;
use App\Http\Controllers\Backend\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function () {
    Route::get('dashboard', function() {
        return view('home');
    });

    // tags
    Route::get('articles/serverside', [ArticleController::class, 'serverside'])->name('admin.articles.serverside');
    Route::resource('articles', ArticleController::class)
    ->names('admin.articles');

    // categories
    Route::get('categories/serverside', [CategoryController::class, 'serverside'])->name('admin.categories.serverside');
    Route::resource('categories', CategoryController::class)
    ->except('create', 'edit')
    ->names('admin.categories');

    // tags
    Route::get('tags/serverside', [TagController::class, 'serverside'])->name('admin.tags.serverside');
    Route::resource('tags', TagController::class)
    ->except('create', 'edit')
    ->names('admin.tags');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
