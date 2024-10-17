<?php

namespace App\Http\Controllers\Backend;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Http\Services\Backend\ArticleService;
use App\Http\Services\Backend\ImageService;

class ArticleController extends Controller
{
    public function __construct(
        private ArticleService $articleService,
        private ImageService $imageService
    ) {
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('backend.articles.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('backend.articles.create', [
            'categories' => $this->articleService->getCategory(),
            'tags' => $this->articleService->getTag()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleRequest $request): JsonResponse
    {
        $data = $request->validated();

        $data['image'] = $this->imageService->storeImage($data);

        $this->articleService->create($data);

        return response()->json([
            'message' => 'Data Artikel Berhasil Ditambahkan...'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function serverside(Request $request): JsonResponse
    {
        return $this->articleService->dataTable($request);
    }
}
