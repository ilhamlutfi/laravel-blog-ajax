<?php

namespace App\Http\Services\Backend;

use App\Models\Article;
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
                $data = Article::latest()
                    ->with('category:id,name', 'tags:id,name')
                    ->offset($start)
                    ->limit($limit)
                    ->get(['id', 'uuid', 'title', 'category_id', 'views', 'published']);
            } else {
                $data = Article::filter($request->search['value'])
                    ->latest()
                    ->with('category:id,name', 'tags:id,name')
                    ->offset($start)
                    ->limit($limit)
                    ->get(['id', 'uuid', 'title', 'category_id', 'views', 'published']);

                $totalFiltered = $data->count();
            }

            return DataTables::of($data)
                ->addIndexColumn()
                ->setOffset($start)
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
                        <button type="button" class="btn btn-sm btn-secondary">
                                <i class="fas fa-eye"></i>
                            </button>

                            <button type="button" class="btn btn-sm btn-success">
                                <i class="fas fa-edit"></i>
                            </button>

                            <button type="button" class="btn btn-sm btn-danger" onclick="deleteData(this)" data-id="' . $data->uuid . '">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </div>
                ';

                    return $actionBtn;
                })
                ->rawColumns(['category_id', 'tag_id', 'published', 'views', 'action'])
                ->with([
                    'recordsTotal' => $totalData,
                    'recordsFiltered' => $totalFiltered,
                    'start' => $start
                ])
                ->make();
        }
    }
}
