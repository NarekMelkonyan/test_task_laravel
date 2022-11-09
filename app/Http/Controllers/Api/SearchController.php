<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchBookRequest;
use App\Services\SearchService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class SearchController extends Controller
{
    private SearchService $searchService;

    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
    }


    /**
     * @param SearchBookRequest $request
     * @return JsonResponse
     */
    public function search(SearchBookRequest $request): JsonResponse
    {
        try {
            $res = $this->searchService->search($request->search);

            return response()->json($res, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
