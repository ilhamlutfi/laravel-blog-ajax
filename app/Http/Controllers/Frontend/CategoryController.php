<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Frontend\ArticleService;
use App\Http\Services\Frontend\CategoryService;

class CategoryController extends Controller
{
    public function __construct(
        private CategoryService $categoryService,
        private ArticleService $articleService)
    {}

    public function index()
    {
        $categories = $this->categoryService->all();

        return view('frontend.category.index', [
            'categories' => $categories,
        ]);
    }

    public function show(string $slug)
    {
        $category = $this->categoryService->getFirstBy('slug', $slug);

        if ($category == null) {
            return view('frontend.custom-error.404', [
                'url' => url('/category/' . $slug),
            ]);
        }

        $articles = $this->articleService->showByCategory($slug);

        return view('frontend.category.show', [
            'category' => $category,
            'articles' => $articles,
        ]);
    }
}
