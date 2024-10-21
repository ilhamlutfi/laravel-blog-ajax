<?php

use App\Http\Controllers\Backend\ArticleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\TagController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\WriterController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function () {
    Route::get('dashboard', function() {
        return view('home');
    });

    // articles
    Route::get('articles/serverside', [ArticleController::class, 'serverside'])->name('admin.articles.serverside');
    Route::resource('articles', ArticleController::class)
    ->names('admin.articles');

    // categories
    Route::get('categories/serverside', [CategoryController::class, 'serverside'])->name('admin.categories.serverside');
    Route::post('categories/import', [CategoryController::class, 'import'])->name('admin.categories.import');
    Route::resource('categories', CategoryController::class)
    ->except('create', 'edit')
    ->names('admin.categories');

    // tags
    Route::get('tags/serverside', [TagController::class, 'serverside'])->name('admin.tags.serverside');
    Route::resource('tags', TagController::class)
    ->except('create', 'edit')
    ->names('admin.tags');

    // writers
    Route::get('writers/serverside', [WriterController::class, 'serverside'])->name('admin.writers.serverside');
    Route::resource('writers', WriterController::class)
    ->only('index')
    ->names('admin.writers');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
