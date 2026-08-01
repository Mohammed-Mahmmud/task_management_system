<?php

namespace App\OpenApi;

/**
 * @OA\Get(
 *     path="/api/v1/dashboard",
 *     operationId="getDashboardStatistics",
 *     tags={"Dashboard"},
 *     summary="Get dashboard statistics",
 *     description="Retrieve comprehensive dashboard statistics including project counts, task counts by status and priority, and overdue tasks for the authenticated user.",
 *     security={{"bearerAuth":{}}},
 *     @OA\Response(
 *         response=200,
 *         description="Dashboard statistics retrieved successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Dashboard statistics retrieved successfully"),
 *             @OA\Property(property="data", ref="#/components/schemas/DashboardStatistics")
 *         )
 *     ),
 *     @OA\Response(response=401, ref="#/components/responses/Unauthorized"),
 *     @OA\Response(response=500, ref="#/components/responses/ServerError")
 * )
 */
class DashboardEndpoints{}
