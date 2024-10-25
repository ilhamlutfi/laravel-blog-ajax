<?php

namespace App\Http\Services\Frontend;

use App\Models\Category;

class CategoryService
{
    // get random category
    public function randomCategory()
    {
        return Category::whereHas('articles', function ($query) {
            $query->where('published', true)
                ->where('is_confirm', true);
        })->withCount('articles as total_articles')->inRandomOrder()->take(6)->get(['id', 'name', 'slug']);
    }

    // get all category
    public function all()
    {
        return Category::whereHas('articles', function ($query) {
            $query->where('published', true)
                ->where('is_confirm', true);
        })->withCount('articles as total_articles')->latest()->get(['id', 'name', 'slug']);
    }

    // get category by slug
    public function getFirstBy(string $column, string $value)
    {
        return Category::where($column, $value)->first();
    }
}
