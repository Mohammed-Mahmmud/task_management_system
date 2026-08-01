<?php

namespace App\OpenApi;

use OpenApi\Attributes as OA;

#[OA\Get(
    path: '/api/v1/projects',
    operationId: 'listProjects',
    tags: ['Projects'],
    summary: 'List all projects',
    description: 'Retrieve a paginated list of all projects owned by the authenticated user.',
    security: [['bearerAuth' => []]],
    parameters: [
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
            description: 'Projects retrieved successfully',
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'success', type: 'boolean', example: true),
                    new OA\Property(property: 'message', type: 'string', example: 'Projects retrieved successfully'),
                    new OA\Property(
                        property: 'data',
                        type: 'object',
                        properties: [
                            new OA\Property(
                                property: 'data',
                                type: 'array',
                                items: new OA\Items(ref: '#/components/schemas/Project')
                            ),
                            new OA\Property(property: 'links', ref: '#/components/schemas/PaginationLinks'),
                            new OA\Property(property: 'meta', ref: '#/components/schemas/PaginationMeta'),
                        ]
                    ),
                ]
            )
        ),
        new OA\Response(response: 401, ref: '#/components/responses/Unauthorized'),
        new OA\Response(response: 500, ref: '#/components/responses/ServerError'),
    ]
)]
#[OA\Get(
    path: '/api/v1/projects/statuses',
    operationId: 'getProjectStatuses',
    tags: ['Projects'],
    summary: 'Get available project statuses',
    description: 'Retrieve all available project status options with their labels and colors.',
    security: [['bearerAuth' => []]],
    responses: [
        new OA\Response(
            response: 200,
            description: 'Project statuses retrieved successfully',
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'success', type: 'boolean', example: true),
                    new OA\Property(property: 'message', type: 'string', example: 'Project statuses retrieved successfully'),
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
    path: '/api/v1/projects',
    operationId: 'createProject',
    tags: ['Projects'],
    summary: 'Create a new project',
    description: 'Create a new project owned by the authenticated user.',
    security: [['bearerAuth' => []]],
    requestBody: new OA\RequestBody(
        required: true,
        description: 'Project data',
        content: new OA\JsonContent(ref: '#/components/schemas/ProjectRequest')
    ),
    responses: [
        new OA\Response(
            response: 201,
            description: 'Project created successfully',
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'success', type: 'boolean', example: true),
                    new OA\Property(property: 'message', type: 'string', example: 'Project created successfully'),
                    new OA\Property(property: 'data', ref: '#/components/schemas/Project'),
                ]
            )
        ),
        new OA\Response(response: 401, ref: '#/components/responses/Unauthorized'),
        new OA\Response(response: 422, ref: '#/components/responses/ValidationError'),
        new OA\Response(response: 500, ref: '#/components/responses/ServerError'),
    ]
)]
#[OA\Get(
    path: '/api/v1/projects/{id}',
    operationId: 'getProject',
    tags: ['Projects'],
    summary: 'Get a single project',
    description: 'Retrieve details of a specific project. User must own the project.',
    security: [['bearerAuth' => []]],
    parameters: [
        new OA\Parameter(
            name: 'id',
            in: 'path',
            description: 'Project ID',
            required: true,
            schema: new OA\Schema(type: 'integer', example: 1)
        ),
    ],
    responses: [
        new OA\Response(
            response: 200,
            description: 'Project retrieved successfully',
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'success', type: 'boolean', example: true),
                    new OA\Property(property: 'message', type: 'string', example: 'Project retrieved successfully'),
                    new OA\Property(property: 'data', ref: '#/components/schemas/Project'),
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
    path: '/api/v1/projects/{id}',
    operationId: 'updateProject',
    tags: ['Projects'],
    summary: 'Update a project',
    description: 'Update an existing project. User must own the project.',
    security: [['bearerAuth' => []]],
    parameters: [
        new OA\Parameter(
            name: 'id',
            in: 'path',
            description: 'Project ID',
            required: true,
            schema: new OA\Schema(type: 'integer', example: 1)
        ),
    ],
    requestBody: new OA\RequestBody(
        required: true,
        description: 'Updated project data',
        content: new OA\JsonContent(ref: '#/components/schemas/ProjectRequest')
    ),
    responses: [
        new OA\Response(
            response: 200,
            description: 'Project updated successfully',
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'success', type: 'boolean', example: true),
                    new OA\Property(property: 'message', type: 'string', example: 'Project updated successfully'),
                    new OA\Property(property: 'data', ref: '#/components/schemas/Project'),
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
    path: '/api/v1/projects/{id}',
    operationId: 'deleteProject',
    tags: ['Projects'],
    summary: 'Delete a project',
    description: 'Soft delete a project and all its associated tasks. User must own the project.',
    security: [['bearerAuth' => []]],
    parameters: [
        new OA\Parameter(
            name: 'id',
            in: 'path',
            description: 'Project ID',
            required: true,
            schema: new OA\Schema(type: 'integer', example: 1)
        ),
    ],
    responses: [
        new OA\Response(
            response: 200,
            description: 'Project deleted successfully',
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'success', type: 'boolean', example: true),
                    new OA\Property(property: 'message', type: 'string', example: 'Project deleted successfully'),
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
class ProjectEndpoints
{
    // This class exists solely to hold Project endpoint documentation
}
