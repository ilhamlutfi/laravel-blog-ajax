<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Frontend\TagService;
use App\Http\Services\Frontend\ArticleService;

class TagController extends Controller
{
    public function __construct(
        private TagService $tagService,
        private ArticleService $articleService
    ){}

    public function showByTag(string $slug)
    {
        $tag = $this->tagService->getFirstBy('slug', $slug);

        if ($tag == null) {
            return view('frontend.custom-error.404', [
                'url' => url('/tag/' . $slug),
            ]);
        }

        $articles = $this->articleService->showByTag($slug);

        return view('frontend.tag.show', [
            'tag' => $tag,
            'articles' => $articles,
        ]);
    }
}
