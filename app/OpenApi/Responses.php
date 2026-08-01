<?php

namespace App\OpenApi;

use OpenApi\Attributes as OA;

#[OA\Response(
    response: 'SuccessResponse',
    description: 'Successful operation',
    content: new OA\JsonContent(
        properties: [
            new OA\Property(property: 'success', type: 'boolean', example: true, description: 'Operation success status'),
            new OA\Property(property: 'message', type: 'string', example: 'Operation successful', description: 'Success message'),
            new OA\Property(property: 'data', type: 'object', nullable: true, description: 'Response data'),
        ]
    )
)]
#[OA\Response(
    response: 'CreatedResponse',
    description: 'Resource created successfully',
    content: new OA\JsonContent(
        properties: [
            new OA\Property(property: 'success', type: 'boolean', example: true, description: 'Operation success status'),
            new OA\Property(property: 'message', type: 'string', example: 'Resource created successfully', description: 'Success message'),
            new OA\Property(property: 'data', type: 'object', description: 'Created resource data'),
        ]
    )
)]
#[OA\Response(
    response: 'DeletedResponse',
    description: 'Resource deleted successfully',
    content: new OA\JsonContent(
        properties: [
            new OA\Property(property: 'success', type: 'boolean', example: true, description: 'Operation success status'),
            new OA\Property(property: 'message', type: 'string', example: 'Resource deleted successfully', description: 'Success message'),
            new OA\Property(property: 'data', type: 'object', nullable: true, example: null, description: 'Response data (usually null for deletes)'),
        ]
    )
)]
#[OA\Response(
    response: 'Unauthorized',
    description: 'Unauthenticated - Missing or invalid authentication token',
    content: new OA\JsonContent(
        properties: [
            new OA\Property(property: 'message', type: 'string', example: 'Unauthenticated.', description: 'Error message'),
        ]
    )
)]
#[OA\Response(
    response: 'Forbidden',
    description: 'Forbidden - User lacks permission to perform this action',
    content: new OA\JsonContent(
        properties: [
            new OA\Property(property: 'success', type: 'boolean', example: false, description: 'Operation success status'),
            new OA\Property(property: 'message', type: 'string', example: 'Unauthorized', description: 'Error message'),
            new OA\Property(property: 'errors', type: 'object', nullable: true, description: 'Additional error details'),
        ]
    )
)]
#[OA\Response(
    response: 'NotFound',
    description: 'Resource not found',
    content: new OA\JsonContent(
        properties: [
            new OA\Property(property: 'success', type: 'boolean', example: false, description: 'Operation success status'),
            new OA\Property(property: 'message', type: 'string', example: 'Resource not found', description: 'Error message'),
            new OA\Property(property: 'errors', type: 'object', nullable: true, description: 'Additional error details'),
        ]
    )
)]
#[OA\Response(
    response: 'ValidationError',
    description: 'Validation failed - The given data was invalid',
    content: new OA\JsonContent(
        properties: [
            new OA\Property(property: 'success', type: 'boolean', example: false, description: 'Operation success status'),
            new OA\Property(property: 'message', type: 'string', example: 'The given data was invalid.', description: 'Error message'),
            new OA\Property(
                property: 'errors',
                type: 'object',
                description: 'Field-specific validation errors',
                properties: [
                    new OA\Property(
                        property: 'email',
                        type: 'array',
                        items: new OA\Items(type: 'string', example: 'The email field is required.')
                    ),
                    new OA\Property(
                        property: 'password',
                        type: 'array',
                        items: new OA\Items(type: 'string', example: 'The password must be at least 8 characters.')
                    ),
                ]
            ),
        ]
    )
)]
#[OA\Response(
    response: 'InvalidCredentials',
    description: 'Invalid login credentials',
    content: new OA\JsonContent(
        properties: [
            new OA\Property(property: 'success', type: 'boolean', example: false, description: 'Operation success status'),
            new OA\Property(property: 'message', type: 'string', example: 'Invalid credentials', description: 'Error message'),
            new OA\Property(property: 'errors', type: 'object', nullable: true, description: 'Additional error details'),
        ]
    )
)]
#[OA\Response(
    response: 'ServerError',
    description: 'Internal server error',
    content: new OA\JsonContent(
        properties: [
            new OA\Property(property: 'success', type: 'boolean', example: false, description: 'Operation success status'),
            new OA\Property(property: 'message', type: 'string', example: 'Internal server error', description: 'Error message'),
            new OA\Property(property: 'errors', type: 'object', nullable: true, description: 'Additional error details'),
        ]
    )
)]
#[OA\Response(
    response: 'TooManyRequests',
    description: 'Too many requests - Rate limit exceeded',
    content: new OA\JsonContent(
        properties: [
            new OA\Property(property: 'message', type: 'string', example: 'Too Many Attempts.', description: 'Rate limit message'),
        ]
    )
)]
#[OA\Response(
    response: 'Conflict',
    description: 'Conflict - Resource already exists or operation conflicts with current state',
    content: new OA\JsonContent(
        properties: [
            new OA\Property(property: 'success', type: 'boolean', example: false, description: 'Operation success status'),
            new OA\Property(property: 'message', type: 'string', example: 'Resource already exists', description: 'Error message'),
            new OA\Property(property: 'errors', type: 'object', nullable: true, description: 'Additional error details'),
        ]
    )
)]
class Responses
{
    // This class exists solely to hold OpenAPI response definitions
}
