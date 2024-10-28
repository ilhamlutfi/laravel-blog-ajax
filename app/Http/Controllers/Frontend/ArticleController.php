<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Frontend\TagService;
use App\Http\Services\Frontend\ArticleService;
use App\Http\Services\Frontend\CategoryService;

class ArticleController extends Controller
{
    public function __construct(
        private ArticleService $articleService,
        private CategoryService $categoryService,
        private TagService $tagService
    ) {}

    public function index()
    {
        $keyword = request('keyword');

        if ($keyword) {
            $articles = $this->articleService->search($keyword);
        } else {
            $articles = $this->articleService->all();
        }

        return view('frontend.article.index', [
            'articles' => $articles,
            'keyword' => $keyword ?? null
        ]);
    }

    public function show(string $slug)
    {
        // eloquent
        $article = $this->articleService->getFirstBy('slug', $slug, true);

        if ($article == null) {
            return view('frontend.custom-error.404', [
                'url' => url('/article/' . $slug),
            ]);
        }

        // add view
        $article->increment('views');

        // get category
        $categories = $this->categoryService->randomCategory();

        return view('frontend.article.show', [
            'article' => $article,
            'related_articles' => $this->articleService->relatedArticles($article->slug),
        ]);
    }
}
