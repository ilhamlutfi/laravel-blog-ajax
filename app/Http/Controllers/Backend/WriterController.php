<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Http\Services\Backend\WriterService;

class WriterController extends Controller
{
    public function __construct(private WriterService $writerService) {
        $this->middleware('owner');
    }

    public function index(): View
    {
        return view('backend.writers.index');
    }

    public function serverside(Request $request): JsonResponse
    {
        return $this->writerService->dataTable($request);
    }
}
