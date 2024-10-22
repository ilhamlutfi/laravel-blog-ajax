<?php

namespace App\Http\Services\Backend;

use App\Models\Tag;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ArticleService
{
    public function dataTable($request)
    {
        if ($request->ajax()) {
            $totalData = Article::count();
            $totalFiltered = $totalData;

            $limit = $request->length;
            $start = $request->start;

            if (empty($request->search['value'])) {
                if (auth()->user()->hasRole('owner')) {
                    $data = Article::latest()
                        ->with('category:id,name', 'tags:id,name')
                        ->offset($start)
                        ->limit($limit)
                        ->withTrashed()
                        ->get(['id', 'uuid', 'title', 'category_id', 'views', 'published', 'deleted_at']);
                } else {
                    $data = Article::latest()
                        ->with('category:id,name', 'tags:id,name')
                        ->offset($start)
                        ->limit($limit)
                        ->where('user_id', auth()->user()->id)
                        ->get(['id', 'uuid', 'title', 'category_id', 'views', 'published', 'deleted_at']);
                }
            } else {
                if (auth()->user()->hasRole('owner')) {
                    $data = Article::filter($request->search['value'])
                        ->latest()
                        ->with('category:id,name', 'tags:id,name')
                        ->offset($start)
                        ->limit($limit)
                        ->withTrashed()
                        ->get(['id', 'uuid', 'title', 'category_id', 'views', 'published', 'deleted_at']);
                } else {
                    $data = Article::filter($request->search['value'])
                        ->latest()
                        ->with('category:id,name', 'tags:id,name')
                        ->offset($start)
                        ->limit($limit)
                        ->where('user_id', auth()->user()->id)
                        ->get(['id', 'uuid', 'title', 'category_id', 'views', 'published', 'deleted_at']);
                }

                $totalFiltered = $data->count();
            }

            return DataTables::of($data)
                ->addIndexColumn()
                ->setOffset($start)
                ->editColumn('title', function ($data) {
                    if (auth()->user()->hasRole('owner') && $data->deleted_at != null) {
                        return '<span class="text-danger">' . $data->title . '</span>';
                    } else {
                        return $data->title;
                    }
                })
                ->editColumn('category_id', function ($data) {
                    return '<div>
                        <span class="badge bg-secondary">' . $data->category->name . '</span>
                    </div>';
                })
                ->editColumn('published', function ($data) {
                    if ($data->published == 1) {
                        return '<span class="badge bg-success">Published</span>';
                    } else {
                        return '<span class="badge bg-danger">Draft</span>';
                    }
                })
                ->editColumn('views', function ($data) {
                    return '<span class="badge bg-secondary">' . $data->views . 'x</span>';
                })
                ->addColumn('tag_id', function ($data) {
                    $tagsHtml = '';

                    foreach ($data->tags as $tag) {
                        $tagsHtml .= '<span class="badge bg-secondary ms-1">' . $tag->name . '</span>';
                    }

                    return $tagsHtml;
                })
                ->addColumn('action', function ($data) {
                    $actionBtn = '
                    <div class="text-center" width="10%">
                        <div class="btn-group">
                            <a href="' . route('admin.articles.show', $data->uuid) . '"  class="btn btn-sm btn-secondary">
                                <i class="fas fa-eye"></i>
                            </a>

                            <a href="' . route('admin.articles.edit', $data->uuid) . '"  class="btn btn-sm btn-success">
                                <i class="fas fa-edit"></i>
                            </a>

                            <button type="button" class="btn btn-sm btn-danger" onclick="deleteData(this)" data-id="' . $data->uuid . '">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </div>
                ';

                    return $actionBtn;
                })
                ->rawColumns(['title', 'category_id', 'tag_id', 'published', 'views', 'action'])
                ->with([
                    'recordsTotal' => $totalData,
                    'recordsFiltered' => $totalFiltered,
                    'start' => $start
                ])
                ->make();
        }
    }

    public function getCategory()
    {
        return Category::latest()->get(['id', 'name']);
    }

    public function getTag()
    {
        return Tag::latest()->get(['id', 'name']);
    }

    public function getFirstBy(string $column, string $value, bool $relation = false)
    {
        if ($relation == true && auth()->user()->hasRole('owner')) {
            return Article::with('user:id,name', 'category:id,name', 'tags:id,name')->where($column, $value)->withTrashed()->firstOrFail();
        } elseif ($relation == false && auth()->user()->hasRole('owner')) {
            return Article::where($column, $value)->withTrashed()->firstOrFail();
        } else {
            return Article::where($column, $value)->firstOrFail();
        }
    }

    public function create(array $data)
    {
        $data['slug'] = Str::slug($data['title']);

        if ($data['published'] == 1) {
            $data['published_at'] = date('Y-m-d');
        }

        // insert article_tag
        $article = Article::create($data);
        $article->tags()->sync($data['tag_id']);

        return $article;
    }

    public function update(array $data, string $uuid)
    {
        $data['slug'] = Str::slug($data['title']);

        if ($data['published'] == 1) {
            $data['published_at'] = date('Y-m-d');
        }

        // insert article_tag
        $article = Article::where('uuid', $uuid)->firstOrFail();
        $article->update($data);
        $article->tags()->sync($data['tag_id']);

        return $article;
    }

    public function delete(string $uuid)
    {
        $getArticle = $this->getFirstBy('uuid', $uuid);

        // Storage::disk('public')->delete('images/' . $getArticle->image);

        // $getArticle->tags()->detach();
        $getArticle->tags()->updateExistingPivot($getArticle->tags, ['deleted_at' => now()]); // soft delete
        $getArticle->delete(); // soft delete

        return $getArticle;
    }

    public function restore(string $uuid)
    {
        $getArticle = $this->getFirstBy('uuid', $uuid);
        $getArticle->restore();

        return $getArticle;
    }

    public function forceDelete(string $uuid)
    {
        $getArticle = $this->getFirstBy('uuid', $uuid);

        Storage::disk('public')->delete('images/' . $getArticle->image);

        $getArticle->tags()->detach(); // force delete
        $getArticle->forceDelete(); // force delete

        return $getArticle;
    }
}
