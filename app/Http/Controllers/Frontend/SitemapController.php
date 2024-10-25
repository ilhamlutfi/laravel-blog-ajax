<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function index()
    {
        $articles = Article::latest()
                ->where('published', true)
                ->where('is_confirm', true)
                ->get(['slug', 'updated_at']);

        $categories = Category::latest()->get(['slug', 'updated_at']);
        $tags = Tag::latest()->get(['slug', 'created_at']);

        return response()->view('frontend.sitemap', [
            'articles' => $articles,
            'categories' => $categories,
            'tags' => $tags
        ])->header('Content-Type', 'text/xml');
    }
}
