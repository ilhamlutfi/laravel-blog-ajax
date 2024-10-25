<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Http\Services\Frontend\TagService;
use App\Http\Services\Frontend\ArticleService;
use App\Http\Services\Frontend\CategoryService;

class SideMenuProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('frontend.article._side-menu', function ($view) {
            $articleService = app(ArticleService::class);
            $view->with('popular_articles', $articleService->popularArticles());

            $categoryService = app(CategoryService::class);
            $view->with('categories', $categoryService->randomCategory());

            $tagService = app(TagService::class);
            $view->with('tags', $tagService->randomTag());
        });
    }
}
