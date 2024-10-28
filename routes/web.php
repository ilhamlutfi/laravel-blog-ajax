<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\TagController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Backend\WriterController;
use App\Http\Controllers\Backend\ArticleController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Frontend\SitemapController;
use App\Http\Controllers\Frontend\TagController as FrontendTagController;
use App\Http\Controllers\Frontend\ArticleController as FrontendArticleController;
use App\Http\Controllers\Frontend\CategoryController as FrontendCategoryController;

Route::get('/', [HomeController::class, 'index'])->name('frontend.home');

Route::get('sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

Route::get('article/search', [FrontendArticleController::class, 'index'])->name('frontend.article.search');
Route::resource('article', FrontendArticleController::class)
->only('index', 'show')
->names('articles');

Route::resource('category', FrontendCategoryController::class)
->only('index', 'show')
->names('category');

Route::get('tag/{slug}', [FrontendTagController::class, 'showByTag'])->name('frontend.tag');

Route::prefix('admin')->group(function () {
    Route::get('dashboard', function () {
        return view('home');
    });

    // articles
    Route::get('articles/serverside', [ArticleController::class, 'serverside'])->name('admin.articles.serverside');
    Route::get('restore/{uuid}', [ArticleController::class, 'restore'])->name('admin.articles.restore');
    Route::delete('articles/force-delete/{uuid}', [ArticleController::class, 'forceDelete']);
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
