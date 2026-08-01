<?php

namespace App\OpenApi;

/**
 * @OA\Get(
 *     path="/api/v1/projects",
 *     operationId="listProjects",
 *     tags={"Projects"},
 *     summary="List all projects",
 *     description="Retrieve a paginated list of all projects owned by the authenticated user.",
 *     security={{"bearerAuth":{}}},
 *     @OA\Parameter(
 *         name="page",
 *         in="query",
 *         description="Page number for pagination",
 *         required=false,
 *         @OA\Schema(type="integer", example=1, minimum=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Projects retrieved successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Projects retrieved successfully"),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Project")),
 *                 @OA\Property(property="links", ref="#/components/schemas/PaginationLinks"),
 *                 @OA\Property(property="meta", ref="#/components/schemas/PaginationMeta")
 *             )
 *         )
 *     ),
 *     @OA\Response(response=401, ref="#/components/responses/Unauthorized"),
 *     @OA\Response(response=500, ref="#/components/responses/ServerError")
 * )
 * 
 * @OA\Get(
 *     path="/api/v1/projects/statuses",
 *     operationId="getProjectStatuses",
 *     tags={"Projects"},
 *     summary="Get available project statuses",
 *     description="Retrieve all available project status options with their labels and colors.",
 *     security={{"bearerAuth":{}}},
 *     @OA\Response(
 *         response=200,
 *         description="Project statuses retrieved successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Project statuses retrieved successfully"),
 *             @OA\Property(
 *                 property="data",
 *                 type="array",
 *                 @OA\Items(ref="#/components/schemas/StatusOption")
 *             )
 *         )
 *     ),
 *     @OA\Response(response=401, ref="#/components/responses/Unauthorized"),
 *     @OA\Response(response=500, ref="#/components/responses/ServerError")
 * )
 * 
 * @OA\Post(
 *     path="/api/v1/projects",
 *     operationId="createProject",
 *     tags={"Projects"},
 *     summary="Create a new project",
 *     description="Create a new project owned by the authenticated user.",
 *     security={{"bearerAuth":{}}},
 *     @OA\RequestBody(
 *         required=true,
 *         description="Project data",
 *         @OA\JsonContent(ref="#/components/schemas/ProjectRequest")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Project created successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Project created successfully"),
 *             @OA\Property(property="data", ref="#/components/schemas/Project")
 *         )
 *     ),
 *     @OA\Response(response=401, ref="#/components/responses/Unauthorized"),
 *     @OA\Response(response=422, ref="#/components/responses/ValidationError"),
 *     @OA\Response(response=500, ref="#/components/responses/ServerError")
 * )
 * 
 * @OA\Get(
 *     path="/api/v1/projects/{id}",
 *     operationId="getProject",
 *     tags={"Projects"},
 *     summary="Get a single project",
 *     description="Retrieve details of a specific project. User must own the project.",
 *     security={{"bearerAuth":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="Project ID",
 *         required=true,
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Project retrieved successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Project retrieved successfully"),
 *             @OA\Property(property="data", ref="#/components/schemas/Project")
 *         )
 *     ),
 *     @OA\Response(response=401, ref="#/components/responses/Unauthorized"),
 *     @OA\Response(response=403, ref="#/components/responses/Forbidden"),
 *     @OA\Response(response=404, ref="#/components/responses/NotFound"),
 *     @OA\Response(response=500, ref="#/components/responses/ServerError")
 * )
 * 
 * @OA\Put(
 *     path="/api/v1/projects/{id}",
 *     operationId="updateProject",
 *     tags={"Projects"},
 *     summary="Update a project",
 *     description="Update an existing project. User must own the project.",
 *     security={{"bearerAuth":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="Project ID",
 *         required=true,
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         description="Updated project data",
 *         @OA\JsonContent(ref="#/components/schemas/ProjectRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Project updated successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Project updated successfully"),
 *             @OA\Property(property="data", ref="#/components/schemas/Project")
 *         )
 *     ),
 *     @OA\Response(response=401, ref="#/components/responses/Unauthorized"),
 *     @OA\Response(response=403, ref="#/components/responses/Forbidden"),
 *     @OA\Response(response=404, ref="#/components/responses/NotFound"),
 *     @OA\Response(response=422, ref="#/components/responses/ValidationError"),
 *     @OA\Response(response=500, ref="#/components/responses/ServerError")
 * )
 * 
 * @OA\Delete(
 *     path="/api/v1/projects/{id}",
 *     operationId="deleteProject",
 *     tags={"Projects"},
 *     summary="Delete a project",
 *     description="Soft delete a project and all its associated tasks. User must own the project.",
 *     security={{"bearerAuth":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="Project ID",
 *         required=true,
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Project deleted successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Project deleted successfully"),
 *             @OA\Property(property="data", type="object", nullable=true, example=null)
 *         )
 *     ),
 *     @OA\Response(response=401, ref="#/components/responses/Unauthorized"),
 *     @OA\Response(response=403, ref="#/components/responses/Forbidden"),
 *     @OA\Response(response=404, ref="#/components/responses/NotFound"),
 *     @OA\Response(response=500, ref="#/components/responses/ServerError")
 * )
 */
class ProjectEndpoints{}
