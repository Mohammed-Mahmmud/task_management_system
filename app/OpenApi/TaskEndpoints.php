<?php

namespace App\OpenApi;

use OpenApi\Attributes as OA;

#[OA\Get(
    path: '/api/v1/projects/{project}/tasks',
    operationId: 'listTasksForProject',
    tags: ['Tasks'],
    summary: 'List tasks for a project',
    description: 'Retrieve a paginated list of tasks for a specific project with optional filtering by status, priority, and search.',
    security: [['bearerAuth' => []]],
    parameters: [
        new OA\Parameter(
            name: 'project',
            in: 'path',
            description: 'Project ID',
            required: true,
            schema: new OA\Schema(type: 'integer', example: 1)
        ),
        new OA\Parameter(
            name: 'status',
            in: 'query',
            description: 'Filter by task status',
            required: false,
            schema: new OA\Schema(type: 'string', enum: ['todo', 'in_progress', 'done'])
        ),
        new OA\Parameter(
            name: 'priority',
            in: 'query',
            description: 'Filter by task priority',
            required: false,
            schema: new OA\Schema(type: 'string', enum: ['low', 'medium', 'high'])
        ),
        new OA\Parameter(
            name: 'search',
            in: 'query',
            description: 'Search tasks by title',
            required: false,
            schema: new OA\Schema(type: 'string', example: 'authentication')
        ),
        new OA\Parameter(
            name: 'page',
            in: 'query',
            description: 'Page number for pagination',
            required: false,
            schema: new OA\Schema(type: 'integer', example: 1, minimum: 1)
        ),
    ],
    responses: [
        new OA\Response(
            response: 200,
            description: 'Tasks retrieved successfully',
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'success', type: 'boolean', example: true),
                    new OA\Property(property: 'message', type: 'string', example: 'Tasks retrieved successfully'),
                    new OA\Property(
                        property: 'data',
                        type: 'object',
                        properties: [
                            new OA\Property(
                                property: 'data',
                                type: 'array',
                                items: new OA\Items(ref: '#/components/schemas/Task')
                            ),
                            new OA\Property(property: 'links', ref: '#/components/schemas/PaginationLinks'),
                            new OA\Property(property: 'meta', ref: '#/components/schemas/PaginationMeta'),
                        ]
                    ),
                ]
            )
        ),
        new OA\Response(response: 401, ref: '#/components/responses/Unauthorized'),
        new OA\Response(response: 403, ref: '#/components/responses/Forbidden'),
        new OA\Response(response: 404, ref: '#/components/responses/NotFound'),
        new OA\Response(response: 500, ref: '#/components/responses/ServerError'),
    ]
)]
#[OA\Get(
    path: '/api/v1/tasks/priorities',
    operationId: 'getTaskPriorities',
    tags: ['Tasks'],
    summary: 'Get available task priorities',
    description: 'Retrieve all available task priority options with their labels and colors.',
    security: [['bearerAuth' => []]],
    responses: [
        new OA\Response(
            response: 200,
            description: 'Task priorities retrieved successfully',
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'success', type: 'boolean', example: true),
                    new OA\Property(property: 'message', type: 'string', example: 'Task priorities retrieved successfully'),
                    new OA\Property(
                        property: 'data',
                        type: 'array',
                        items: new OA\Items(ref: '#/components/schemas/PriorityOption')
                    ),
                ]
            )
        ),
        new OA\Response(response: 401, ref: '#/components/responses/Unauthorized'),
        new OA\Response(response: 500, ref: '#/components/responses/ServerError'),
    ]
)]
#[OA\Get(
    path: '/api/v1/tasks/statuses',
    operationId: 'getTaskStatuses',
    tags: ['Tasks'],
    summary: 'Get available task statuses',
    description: 'Retrieve all available task status options with their labels and colors.',
    security: [['bearerAuth' => []]],
    responses: [
        new OA\Response(
            response: 200,
            description: 'Task statuses retrieved successfully',
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'success', type: 'boolean', example: true),
                    new OA\Property(property: 'message', type: 'string', example: 'Task statuses retrieved successfully'),
                    new OA\Property(
                        property: 'data',
                        type: 'array',
                        items: new OA\Items(ref: '#/components/schemas/StatusOption')
                    ),
                ]
            )
        ),
        new OA\Response(response: 401, ref: '#/components/responses/Unauthorized'),
        new OA\Response(response: 500, ref: '#/components/responses/ServerError'),
    ]
)]
#[OA\Post(
    path: '/api/v1/projects/{project}/tasks',
    operationId: 'createTask',
    tags: ['Tasks'],
    summary: 'Create a new task',
    description: 'Create a new task within a specific project. User must own the project.',
    security: [['bearerAuth' => []]],
    parameters: [
        new OA\Parameter(
            name: 'project',
            in: 'path',
            description: 'Project ID',
            required: true,
            schema: new OA\Schema(type: 'integer', example: 1)
        ),
    ],
    requestBody: new OA\RequestBody(
        required: true,
        description: 'Task data',
        content: new OA\JsonContent(ref: '#/components/schemas/TaskRequest')
    ),
    responses: [
        new OA\Response(
            response: 201,
            description: 'Task created successfully',
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'success', type: 'boolean', example: true),
                    new OA\Property(property: 'message', type: 'string', example: 'Task created successfully'),
                    new OA\Property(property: 'data', ref: '#/components/schemas/Task'),
                ]
            )
        ),
        new OA\Response(response: 401, ref: '#/components/responses/Unauthorized'),
        new OA\Response(response: 403, ref: '#/components/responses/Forbidden'),
        new OA\Response(response: 404, ref: '#/components/responses/NotFound'),
        new OA\Response(response: 422, ref: '#/components/responses/ValidationError'),
        new OA\Response(response: 500, ref: '#/components/responses/ServerError'),
    ]
)]
#[OA\Get(
    path: '/api/v1/tasks/{id}',
    operationId: 'getTask',
    tags: ['Tasks'],
    summary: 'Get a single task',
    description: 'Retrieve details of a specific task. User must own the parent project.',
    security: [['bearerAuth' => []]],
    parameters: [
        new OA\Parameter(
            name: 'id',
            in: 'path',
            description: 'Task ID',
            required: true,
            schema: new OA\Schema(type: 'integer', example: 1)
        ),
    ],
    responses: [
        new OA\Response(
            response: 200,
            description: 'Task retrieved successfully',
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'success', type: 'boolean', example: true),
                    new OA\Property(property: 'message', type: 'string', example: 'Task retrieved successfully'),
                    new OA\Property(property: 'data', ref: '#/components/schemas/Task'),
                ]
            )
        ),
        new OA\Response(response: 401, ref: '#/components/responses/Unauthorized'),
        new OA\Response(response: 403, ref: '#/components/responses/Forbidden'),
        new OA\Response(response: 404, ref: '#/components/responses/NotFound'),
        new OA\Response(response: 500, ref: '#/components/responses/ServerError'),
    ]
)]
#[OA\Put(
    path: '/api/v1/tasks/{id}',
    operationId: 'updateTask',
    tags: ['Tasks'],
    summary: 'Update a task',
    description: 'Update an existing task. User must own the parent project.',
    security: [['bearerAuth' => []]],
    parameters: [
        new OA\Parameter(
            name: 'id',
            in: 'path',
            description: 'Task ID',
            required: true,
            schema: new OA\Schema(type: 'integer', example: 1)
        ),
    ],
    requestBody: new OA\RequestBody(
        required: true,
        description: 'Updated task data',
        content: new OA\JsonContent(ref: '#/components/schemas/TaskRequest')
    ),
    responses: [
        new OA\Response(
            response: 200,
            description: 'Task updated successfully',
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'success', type: 'boolean', example: true),
                    new OA\Property(property: 'message', type: 'string', example: 'Task updated successfully'),
                    new OA\Property(property: 'data', ref: '#/components/schemas/Task'),
                ]
            )
        ),
        new OA\Response(response: 401, ref: '#/components/responses/Unauthorized'),
        new OA\Response(response: 403, ref: '#/components/responses/Forbidden'),
        new OA\Response(response: 404, ref: '#/components/responses/NotFound'),
        new OA\Response(response: 422, ref: '#/components/responses/ValidationError'),
        new OA\Response(response: 500, ref: '#/components/responses/ServerError'),
    ]
)]
#[OA\Delete(
    path: '/api/v1/tasks/{id}',
    operationId: 'deleteTask',
    tags: ['Tasks'],
    summary: 'Delete a task',
    description: 'Soft delete a task. User must own the parent project.',
    security: [['bearerAuth' => []]],
    parameters: [
        new OA\Parameter(
            name: 'id',
            in: 'path',
            description: 'Task ID',
            required: true,
            schema: new OA\Schema(type: 'integer', example: 1)
        ),
    ],
    responses: [
        new OA\Response(
            response: 200,
            description: 'Task deleted successfully',
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'success', type: 'boolean', example: true),
                    new OA\Property(property: 'message', type: 'string', example: 'Task deleted successfully'),
                    new OA\Property(property: 'data', type: 'object', nullable: true, example: null),
                ]
            )
        ),
        new OA\Response(response: 401, ref: '#/components/responses/Unauthorized'),
        new OA\Response(response: 403, ref: '#/components/responses/Forbidden'),
        new OA\Response(response: 404, ref: '#/components/responses/NotFound'),
        new OA\Response(response: 500, ref: '#/components/responses/ServerError'),
    ]
)]
class TaskEndpoints
{
    // This class exists solely to hold Task endpoint documentation
}
