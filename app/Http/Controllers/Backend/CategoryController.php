<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Services\Backend\CategoryService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(private CategoryService $categoryService)
    {

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.categories.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->validated();

        try {

            $this->categoryService->create($data);

            return response()->json(['message' => 'Data Kategori Berhasil Ditambah!']);
        } catch (\Exception $err) {
            return response()->json(['message' => $err->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid)
    {
        return response()->json(['data' => $this->categoryService->getFirstBy('uuid', $uuid)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $uuid)
    {
        $data = $request->validated();

        $getData = $this->categoryService->getFirstBy('uuid', $uuid);

        try {
            $this->categoryService->update($data, $getData->uuid);

            return response()->json(['message' => 'Data Kategori Berhasil Diubah!']);
        } catch (\Exception $err) {
            return response()->json(['message' => $err->getMessage()], 500);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid): JsonResponse
    {
        $getData = $this->categoryService->getFirstBy('uuid', $uuid);

        $getData->delete();

        return response()->json(['message' => 'Data Kategori Berhasil Dihapus!']);
    }

    public function serverside(Request $request): JsonResponse
    {
        return $this->categoryService->dataTable($request);
    }
}
