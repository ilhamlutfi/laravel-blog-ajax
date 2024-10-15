<?php

namespace App\Http\Services\Backend;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CategoryService
{
    public function dataTable($request)
    {
        // $data = Category::latest()->get(['uuid', 'name', 'slug']); // cara 1
        // $data = DB::table('categories')->latest()->get(['uuid', 'name', 'slug']); // cara 2

        if ($request->ajax()) {
            $totalData = Category::count();
            $totalFiltered = $totalData;

            $limit = $request->length;
            $start = $request->start;

            $data = Category::orderBy('id', 'DESC')
            ->offset($start)
            ->limit($limit)
            ->get(['id', 'uuid', 'name', 'slug']);

            return DataTables::of($data)
            ->addIndexColumn()
            ->setOffset($start)
            ->addColumn('action', function ($data) {
                $actionBtn = '
                    <div class="text-center" width="10%">
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-success" onclick="editData(this)" data-id="'.$data->uuid.'">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-danger" onclick="deleteData(this)" data-id="'.$data->uuid.'">
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
        return Category::where($column, $value)->firstOrFail();
    }

    public function create(array $data)
    {
        $data['slug'] = Str::slug($data['name']);
        return Category::create($data);
    }

    public function update(array $data, string $uuid)
    {
        $data['slug'] = Str::slug($data['name']);
        return Category::where('uuid', $uuid)->update($data);
    }
}
