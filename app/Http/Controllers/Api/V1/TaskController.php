<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Task\StoreTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Http\Traits\ApiResponse;
use App\Services\ProjectService;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{
    use ApiResponse;

    public function __construct(private TaskService $taskService, private ProjectService $projectService) {}

    public function index(Request $request, $projectId): JsonResponse
    {
        $project = $this->projectService->find($projectId);
        
        if (!$project) {
            return $this->error('Project not found', 404);
        }

        if (Gate::denies('view', $project)) {
            return $this->error('Unauthorized', 403);
        }

        $filters = [
            'status' => $request->query('status'),
            'priority' => $request->query('priority'),
            'search' => $request->query('search'),
        ];

        $tasks = $this->taskService->listForProject($project->id, array_filter($filters));
        return $this->paginate(
            TaskResource::collection($tasks),
            'Tasks retrieved successfully'
        );
    }

    public function store(StoreTaskRequest $request, $projectId): JsonResponse
    {
        $project = $this->projectService->find($projectId);
        
        if (!$project) {
            return $this->error('Project not found', 404);
        }

        if (Gate::denies('view', $project)) {
            return $this->error('Unauthorized', 403);
        }

        $task = $this->taskService->create([
            ...$request->validated(),
            'project_id' => $project->id,
        ]);

        return $this->success(
            new TaskResource($task),
            'Task created successfully',
            201
        );
    }

    public function show($taskId): JsonResponse
    {
        $task = $this->taskService->find($taskId);
        
        if (!$task) {
            return $this->error('Task not found', 404);
        }

        if (Gate::denies('view', $task)) {
            return $this->error('Unauthorized', 403);
        }

        return $this->success(new TaskResource($task), 'Task retrieved successfully');
    }

    public function update(UpdateTaskRequest $request, $taskId): JsonResponse
    {
        $task = $this->taskService->find($taskId);
        
        if (!$task) {
            return $this->error('Task not found', 404);
        }

        if (Gate::denies('update', $task)) {
            return $this->error('Unauthorized', 403);
        }

        $task = $this->taskService->update($task->id, $request->validated());

        return $this->success(
            new TaskResource($task),
            'Task updated successfully'
        );
    }

    public function destroy($taskId): JsonResponse
    {
        $task = $this->taskService->find($taskId);
        
        if (!$task) {
            return $this->error('Task not found', 404);
        }

        if (Gate::denies('delete', $task)) {
            return $this->error('Unauthorized', 403);
        }

        $this->taskService->delete($task->id);

        return $this->success(null, 'Task deleted successfully');
    }

    public function priorities(): JsonResponse
    {
        $priorities = collect(TaskPriority::cases())->map(function ($priority) {
            return [
                'value' => $priority->value,
                'label' => $priority->label(),
                'color' => $priority->color(),
            ];
        });

        return $this->success($priorities, 'Task priorities retrieved successfully');
    }

    public function statuses(): JsonResponse
    {
        $statuses = collect(TaskStatus::cases())->map(function ($status) {
            return [
                'value' => $status->value,
                'label' => $status->label(),
                'color' => $status->color(),
            ];
        });

        return $this->success($statuses, 'Task statuses retrieved successfully');
    }
}
