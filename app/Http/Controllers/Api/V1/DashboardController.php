<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponse;
use App\Services\DashboardService;
use Illuminate\Http\JsonResponse;

class DashboardController extends Controller
{
    use ApiResponse;

    public function __construct(private DashboardService $dashboardService) {}

    public function index(): JsonResponse
    {
        $stats = $this->dashboardService->getStats(auth()->id());

        return $this->success($stats, 'Dashboard statistics retrieved successfully');
    }
}
