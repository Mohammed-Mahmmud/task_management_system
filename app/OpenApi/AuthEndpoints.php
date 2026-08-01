<?php

namespace App\OpenApi;

use OpenApi\Attributes as OA;

#[OA\Post(
    path: '/api/v1/register',
    operationId: 'register',
    tags: ['Authentication'],
    summary: 'Register a new user',
    description: 'Create a new user account and receive an authentication token. No authentication required.',
    requestBody: new OA\RequestBody(
        required: true,
        description: 'User registration data',
        content: new OA\JsonContent(ref: '#/components/schemas/RegisterRequest')
    ),
    responses: [
        new OA\Response(
            response: 201,
            description: 'User registered successfully',
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'success', type: 'boolean', example: true),
                    new OA\Property(property: 'message', type: 'string', example: 'User registered successfully'),
                    new OA\Property(property: 'data', ref: '#/components/schemas/AuthResponse'),
                ]
            )
        ),
        new OA\Response(response: 422, ref: '#/components/responses/ValidationError'),
        new OA\Response(response: 500, ref: '#/components/responses/ServerError'),
    ]
)]
#[OA\Post(
    path: '/api/v1/login',
    operationId: 'login',
    tags: ['Authentication'],
    summary: 'Login user',
    description: 'Authenticate user with email and password, returns authentication token. No authentication required.',
    requestBody: new OA\RequestBody(
        required: true,
        description: 'User login credentials',
        content: new OA\JsonContent(ref: '#/components/schemas/LoginRequest')
    ),
    responses: [
        new OA\Response(
            response: 200,
            description: 'Login successful',
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'success', type: 'boolean', example: true),
                    new OA\Property(property: 'message', type: 'string', example: 'Login successful'),
                    new OA\Property(property: 'data', ref: '#/components/schemas/AuthResponse'),
                ]
            )
        ),
        new OA\Response(response: 401, ref: '#/components/responses/InvalidCredentials'),
        new OA\Response(response: 422, ref: '#/components/responses/ValidationError'),
        new OA\Response(response: 500, ref: '#/components/responses/ServerError'),
    ]
)]
#[OA\Post(
    path: '/api/v1/logout',
    operationId: 'logout',
    tags: ['Authentication'],
    summary: 'Logout user',
    description: 'Revoke the current user\'s authentication token. Requires authentication.',
    security: [['bearerAuth' => []]],
    responses: [
        new OA\Response(
            response: 200,
            description: 'Logged out successfully',
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'success', type: 'boolean', example: true),
                    new OA\Property(property: 'message', type: 'string', example: 'Logged out successfully'),
                    new OA\Property(property: 'data', type: 'object', nullable: true, example: null),
                ]
            )
        ),
        new OA\Response(response: 401, ref: '#/components/responses/Unauthorized'),
        new OA\Response(response: 500, ref: '#/components/responses/ServerError'),
    ]
)]
class AuthEndpoints
{
    // This class exists solely to hold Authentication endpoint documentation
}
