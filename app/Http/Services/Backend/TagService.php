<?php

namespace App\Http\Services\Backend;

use App\Models\Tag;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class TagService
{
    public function dataTable($request)
    {
        // $data = Tag::latest()->get(['uuid', 'name', 'slug']); // cara 1
        // $data = DB::table('categories')->latest()->get(['uuid', 'name', 'slug']); // cara 2

        if ($request->ajax()) {
            $totalData = Tag::count();
            $totalFiltered = $totalData;

            $limit = $request->length;
            $start = $request->start;

            if (empty($request->search['value'])) {
                $data = Tag::orderBy('id', 'DESC')
                    ->offset($start)
                    ->limit($limit)
                    ->get(['id', 'uuid', 'name', 'slug']);
            } else {
                $data = Tag::filter($request->search['value'])
                    ->orderBy('id', 'DESC')
                    ->offset($start)
                    ->limit($limit)
                    ->get(['id', 'uuid', 'name', 'slug']);

                $totalFiltered = $data->count();
            }

            return DataTables::of($data)
                ->addIndexColumn()
                ->setOffset($start)
                ->addColumn('action', function ($data) {
                    $actionBtn = '
                    <div class="text-center" width="10%">
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-success" onclick="editData(this)" data-id="' . $data->uuid . '">
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
                ->with([
                    'recordsTotal' => $totalData,
                    'recordsFiltered' => $totalFiltered,
                    'start' => $start
                ])
                ->make();
        }
    }

    public function getFirstBy(string $column, string $value)
    {
        return Tag::where($column, $value)->firstOrFail();
    }

    public function create(array $data)
    {
        $data['slug'] = Str::slug($data['name']);
        return Tag::create($data);
    }

    public function update(array $data, string $uuid)
    {
        $data['slug'] = Str::slug($data['name']);
        return Tag::where('uuid', $uuid)->update($data);
    }
}
