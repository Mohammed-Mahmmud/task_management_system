<?php

namespace App\Http\Traits;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

trait ApiResponse
{
    public function success(
        mixed $data = null,
        string $message = 'Success',
        int $code = 200
    ): JsonResponse {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    public function error(
        string $message = 'Something went wrong',
        int $code = 400,
        mixed $errors = null
    ): JsonResponse {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $errors,
        ], $code);
    }

    public function paginate(
        AnonymousResourceCollection $collection,
        string $message = "Data retrieved successfully",
        array $extra = []
    ): JsonResponse {
        $paginator = $collection->resource;
        $currentPage = $paginator->currentPage();
        $perPage = $paginator->perPage();

        $collectionArray = $collection->toArray(request());
        $items = $collectionArray['data'] ?? $collectionArray;

        $responseData = [
            'data' => $items,
            'links' => [
                'first' => $paginator->url(1),
                'last' => $paginator->url($paginator->lastPage()),
                'prev' => $paginator->previousPageUrl(),
                'next' => $paginator->nextPageUrl(),
            ],
            'meta' => [
                'current_page' => $currentPage,
                'from' => $paginator->total() > 0 ? ($currentPage - 1) * $perPage + 1 : null,
                'last_page' => $paginator->lastPage(),
                'links' => collect(range(1, $paginator->lastPage()))->map(function ($page) use ($paginator) {
                    return [
                        'url' => $paginator->lastPage() > 0 ? $paginator->url($page) : null,
                        'label' => (string)$page,
                        'active' => $paginator->currentPage() === $page,
                    ];
                }),
                'path' => $paginator->path(),
                'per_page' => $perPage,
                'to' => $paginator->total() > 0 ? min($currentPage * $perPage, $paginator->total()) : null,
                'total' => $paginator->total(),
            ],
        ];

        if (!empty($extra)) {
            $responseData = array_merge($responseData, $extra);
        }

        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $responseData,
        ], 200);
    }
}
