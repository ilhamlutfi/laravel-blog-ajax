<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Tag;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    public function show(string $slug)
    {
        // eloquent
        $article = Article::with('category:id,name,slug', 'user:id,name', 'tags:id,name,slug')
            ->where('slug', $slug)
            ->first();

        if (!$article) {
            return view('frontend.custom-error.404', [
                'url' => url('/article/' . $slug),
            ]);
        }

        // add view
        $article->increment('views');

        // get category
        $categories = $this->randomCategory();

        return view('frontend.article.show', [
            'article' => $article,
            'categories' => $categories,
            'tags' => $this->randomTag(),
            'popular_articles' => $this->popularArticles(),
            'related_articles' => $this->relatedArticles($article->slug),
        ]);
    }

    public function randomCategory()
    {
        return Category::whereHas('articles', function ($query) {
            $query->where('published', true)
                ->where('is_confirm', true);
        })->withCount('articles as total_articles')->inRandomOrder()->take(6)->get(['id', 'name', 'slug']);
    }

    public function randomTag()
    {
        return Tag::inRandomOrder()->take(6)->get(['id', 'name', 'slug']);
    }

    public function relatedArticles(string $slug)
    {
        // eloquent
        $article = Article::where('slug', $slug)->firstOrFail();

        $related_article = Article::where('published', true)
        ->where('is_confirm', true)
        ->where('id', '!=', $article->id)
        ->where('category_id', $article->category_id)
        ->limit(2)
        ->get(['id', 'title', 'slug', 'image']);

        return $related_article;
    }

    public function popularArticles()
    {
        // artikel terpopuler
        $articles = Article::with('category:id,name')
        ->select('id', 'category_id', 'title', 'slug', 'published', 'is_confirm', 'views', 'image', 'published_at')
        ->orderBy('views', 'desc')
        ->where('published', true)
        ->where('is_confirm', true)
        ->limit(4)
        ->get();

        return $articles;
    }
}
