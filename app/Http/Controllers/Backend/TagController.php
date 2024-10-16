<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagRequest;
use App\Http\Services\Backend\TagService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function __construct(private TagService $tagService)
    {

    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('backend.tags.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TagRequest $request): JsonResponse
    {
        $data = $request->validated();

        try {

            $this->tagService->create($data);

            return response()->json(['message' => 'Data Tag Berhasil Ditambah!']);
        } catch (\Exception $err) {
            return response()->json(['message' => $err->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid): JsonResponse
    {
        return response()->json(['data' => $this->tagService->getFirstBy('uuid', $uuid)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TagRequest $request, string $uuid): JsonResponse
    {
        $data = $request->validated();

        $getData = $this->tagService->getFirstBy('uuid', $uuid);

        try {
            $this->tagService->update($data, $getData->uuid);

            return response()->json(['message' => 'Data Tag Berhasil Diubah!']);
        } catch (\Exception $err) {
            return response()->json(['message' => $err->getMessage()], 500);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid): JsonResponse
    {
        $getData = $this->tagService->getFirstBy('uuid', $uuid);

        $getData->delete();

        return response()->json(['message' => 'Data Tag Berhasil Dihapus!']);
    }

    public function serverside(Request $request): JsonResponse
    {
        return $this->tagService->dataTable($request);
    }
}
