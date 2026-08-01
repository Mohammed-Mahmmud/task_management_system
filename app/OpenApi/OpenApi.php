<?php

namespace App\OpenApi;

use OpenApi\Attributes as OA;

#[OA\Info(
    version: '1.0.0',
    title: 'Task Management API',
    description: 'A professional RESTful API for managing projects and tasks with authentication, authorization, and notification features. Built with Laravel 13.',
    contact: new OA\Contact(
        name: 'API Support',
        email: 'support@taskmanagement.com'
    ),
    license: new OA\License(
        name: 'MIT',
        url: 'https://opensource.org/licenses/MIT'
    )
)]
#[OA\Server(
    url: 'http://localhost:8000',
    description: 'Local Development Server'
)]
#[OA\Server(
    url: 'https://api.taskmanagement.com',
    description: 'Production Server'
)]
#[OA\SecurityScheme(
    securityScheme: 'bearerAuth',
    type: 'http',
    scheme: 'bearer',
    bearerFormat: 'JWT',
    description: 'Enter your Bearer token obtained from the login endpoint. Format: Bearer {token}'
)]
#[OA\Tag(
    name: 'Authentication',
    description: 'User authentication endpoints (register, login, logout)'
)]
#[OA\Tag(
    name: 'Dashboard',
    description: 'Dashboard statistics and metrics'
)]
#[OA\Tag(
    name: 'Projects',
    description: 'Project management endpoints (CRUD operations)'
)]
#[OA\Tag(
    name: 'Tasks',
    description: 'Task management endpoints (CRUD operations, filtering, search)'
)]
class OpenApi
{
    // This class exists solely to hold global OpenAPI documentation
}
