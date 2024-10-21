<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Imports\CategoryImport;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\CategoryRequest;
use App\Http\Services\Backend\CategoryService;

class CategoryController extends Controller
{
    public function __construct(private CategoryService $categoryService)
    {
        $this->middleware('owner');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('backend.categories.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request): JsonResponse
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
    public function show(string $uuid): JsonResponse
    {
        return response()->json(['data' => $this->categoryService->getFirstBy('uuid', $uuid)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $uuid): JsonResponse
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

    public function import(Request $request)
    {
        try {
            $request->validate([
                'file_import' => 'required|mimes:csv,xls,xlsx'
            ]);

            // import class
            Excel::import(new CategoryImport, $request->file('file_import'));

            return redirect()->back()->with('success', 'Import Data Kategori Berhasil!');
        } catch (\Exception $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function serverside(Request $request): JsonResponse
    {
        return $this->categoryService->dataTable($request);
    }
}
