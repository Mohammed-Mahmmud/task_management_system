<?php

namespace App\OpenApi;

/**
 * @OA\Get(
 *     path="/api/v1/projects/{project}/tasks",
 *     operationId="listTasksForProject",
 *     tags={"Tasks"},
 *     summary="List tasks for a project",
 *     description="Retrieve a paginated list of tasks for a specific project with optional filtering by status, priority, and search.",
 *     security={{"bearerAuth":{}}},
 *     @OA\Parameter(
 *         name="project",
 *         in="path",
 *         description="Project ID",
 *         required=true,
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Parameter(
 *         name="status",
 *         in="query",
 *         description="Filter by task status",
 *         required=false,
 *         @OA\Schema(type="string", enum={"todo", "in_progress", "done"})
 *     ),
 *     @OA\Parameter(
 *         name="priority",
 *         in="query",
 *         description="Filter by task priority",
 *         required=false,
 *         @OA\Schema(type="string", enum={"low", "medium", "high"})
 *     ),
 *     @OA\Parameter(
 *         name="search",
 *         in="query",
 *         description="Search tasks by title",
 *         required=false,
 *         @OA\Schema(type="string", example="authentication")
 *     ),
 *     @OA\Parameter(
 *         name="page",
 *         in="query",
 *         description="Page number for pagination",
 *         required=false,
 *         @OA\Schema(type="integer", example=1, minimum=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Tasks retrieved successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Tasks retrieved successfully"),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Task")),
 *                 @OA\Property(property="links", ref="#/components/schemas/PaginationLinks"),
 *                 @OA\Property(property="meta", ref="#/components/schemas/PaginationMeta")
 *             )
 *         )
 *     ),
 *     @OA\Response(response=401, ref="#/components/responses/Unauthorized"),
 *     @OA\Response(response=403, ref="#/components/responses/Forbidden"),
 *     @OA\Response(response=404, ref="#/components/responses/NotFound"),
 *     @OA\Response(response=500, ref="#/components/responses/ServerError")
 * )
 * 
 * @OA\Get(
 *     path="/api/v1/tasks/priorities",
 *     operationId="getTaskPriorities",
 *     tags={"Tasks"},
 *     summary="Get available task priorities",
 *     description="Retrieve all available task priority options with their labels and colors.",
 *     security={{"bearerAuth":{}}},
 *     @OA\Response(
 *         response=200,
 *         description="Task priorities retrieved successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Task priorities retrieved successfully"),
 *             @OA\Property(
 *                 property="data",
 *                 type="array",
 *                 @OA\Items(ref="#/components/schemas/PriorityOption")
 *             )
 *         )
 *     ),
 *     @OA\Response(response=401, ref="#/components/responses/Unauthorized"),
 *     @OA\Response(response=500, ref="#/components/responses/ServerError")
 * )
 * 
 * @OA\Get(
 *     path="/api/v1/tasks/statuses",
 *     operationId="getTaskStatuses",
 *     tags={"Tasks"},
 *     summary="Get available task statuses",
 *     description="Retrieve all available task status options with their labels and colors.",
 *     security={{"bearerAuth":{}}},
 *     @OA\Response(
 *         response=200,
 *         description="Task statuses retrieved successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Task statuses retrieved successfully"),
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
 *     path="/api/v1/projects/{project}/tasks",
 *     operationId="createTask",
 *     tags={"Tasks"},
 *     summary="Create a new task",
 *     description="Create a new task within a specific project. User must own the project.",
 *     security={{"bearerAuth":{}}},
 *     @OA\Parameter(
 *         name="project",
 *         in="path",
 *         description="Project ID",
 *         required=true,
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         description="Task data",
 *         @OA\JsonContent(ref="#/components/schemas/TaskRequest")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Task created successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Task created successfully"),
 *             @OA\Property(property="data", ref="#/components/schemas/Task")
 *         )
 *     ),
 *     @OA\Response(response=401, ref="#/components/responses/Unauthorized"),
 *     @OA\Response(response=403, ref="#/components/responses/Forbidden"),
 *     @OA\Response(response=404, ref="#/components/responses/NotFound"),
 *     @OA\Response(response=422, ref="#/components/responses/ValidationError"),
 *     @OA\Response(response=500, ref="#/components/responses/ServerError")
 * )
 * 
 * @OA\Get(
 *     path="/api/v1/tasks/{id}",
 *     operationId="getTask",
 *     tags={"Tasks"},
 *     summary="Get a single task",
 *     description="Retrieve details of a specific task. User must own the parent project.",
 *     security={{"bearerAuth":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="Task ID",
 *         required=true,
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Task retrieved successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Task retrieved successfully"),
 *             @OA\Property(property="data", ref="#/components/schemas/Task")
 *         )
 *     ),
 *     @OA\Response(response=401, ref="#/components/responses/Unauthorized"),
 *     @OA\Response(response=403, ref="#/components/responses/Forbidden"),
 *     @OA\Response(response=404, ref="#/components/responses/NotFound"),
 *     @OA\Response(response=500, ref="#/components/responses/ServerError")
 * )
 * 
 * @OA\Put(
 *     path="/api/v1/tasks/{id}",
 *     operationId="updateTask",
 *     tags={"Tasks"},
 *     summary="Update a task",
 *     description="Update an existing task. User must own the parent project.",
 *     security={{"bearerAuth":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="Task ID",
 *         required=true,
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         description="Updated task data",
 *         @OA\JsonContent(ref="#/components/schemas/TaskRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Task updated successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Task updated successfully"),
 *             @OA\Property(property="data", ref="#/components/schemas/Task")
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
 *     path="/api/v1/tasks/{id}",
 *     operationId="deleteTask",
 *     tags={"Tasks"},
 *     summary="Delete a task",
 *     description="Soft delete a task. User must own the parent project.",
 *     security={{"bearerAuth":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="Task ID",
 *         required=true,
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Task deleted successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Task deleted successfully"),
 *             @OA\Property(property="data", type="object", nullable=true, example=null)
 *         )
 *     ),
 *     @OA\Response(response=401, ref="#/components/responses/Unauthorized"),
 *     @OA\Response(response=403, ref="#/components/responses/Forbidden"),
 *     @OA\Response(response=404, ref="#/components/responses/NotFound"),
 *     @OA\Response(response=500, ref="#/components/responses/ServerError")
 * )
 */
class TaskEndpoints{}
