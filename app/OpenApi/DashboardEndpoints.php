<?php

namespace App\OpenApi;

use OpenApi\Attributes as OA;

#[OA\Get(
    path: '/api/v1/dashboard',
    operationId: 'getDashboardStatistics',
    tags: ['Dashboard'],
    summary: 'Get dashboard statistics',
    description: 'Retrieve comprehensive dashboard statistics including project counts, task counts by status and priority, and overdue tasks for the authenticated user.',
    security: [['bearerAuth' => []]],
    responses: [
        new OA\Response(
            response: 200,
            description: 'Dashboard statistics retrieved successfully',
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'success', type: 'boolean', example: true),
                    new OA\Property(property: 'message', type: 'string', example: 'Dashboard statistics retrieved successfully'),
                    new OA\Property(property: 'data', ref: '#/components/schemas/DashboardStatistics'),
                ]
            )
        ),
        new OA\Response(response: 401, ref: '#/components/responses/Unauthorized'),
        new OA\Response(response: 500, ref: '#/components/responses/ServerError'),
    ]
)]
class DashboardEndpoints
{
    // This class exists solely to hold Dashboard endpoint documentation
}
