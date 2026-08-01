<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Project\StoreProjectRequest;
use App\Http\Requests\Project\UpdateProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Http\Traits\ApiResponse;
use App\Enums\ProjectStatus;
use App\Services\ProjectService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;

class ProjectController extends Controller
{
    use ApiResponse;

    public function __construct(private ProjectService $projectService) {}

    public function index(): JsonResponse
    {
        $projects = $this->projectService->listForUser(auth()->id());
        return $this->paginate(ProjectResource::collection($projects),
            'Projects retrieved successfully'
        );
    }

    public function store(StoreProjectRequest $request): JsonResponse
    {
        $project = $this->projectService->create([
            ...$request->validated(),
            'user_id' => auth()->id(),
        ]);

        return $this->success(
            new ProjectResource($project),
            'Project created successfully',
            201
        );
    }

    public function show($projectId): JsonResponse
    {
        $project = $this->projectService->find($projectId);
        
        if (!$project) {
            return $this->error('Project not found', 404);
        }

        if (Gate::denies('view', $project)) {
            return $this->error('Unauthorized', 403);
        }

        return $this->success(new ProjectResource($project), 'Project retrieved successfully');
    }

    public function update(UpdateProjectRequest $request, $projectId): JsonResponse
    {
        $project = $this->projectService->find($projectId);
        
        if (!$project) {
            return $this->error('Project not found', 404);
        }

        if (Gate::denies('update', $project)) {
            return $this->error('Unauthorized', 403);
        }

        $project = $this->projectService->update($project->id, $request->validated());

        return $this->success(
            new ProjectResource($project),
            'Project updated successfully'
        );
    }

    public function destroy($projectId): JsonResponse
    {
        $project = $this->projectService->find($projectId);
        
        if (!$project) {
            return $this->error('Project not found', 404);
        }

        if (Gate::denies('delete', $project)) {
            return $this->error('Unauthorized', 403);
        }

        $this->projectService->delete($project->id);

        return $this->success(null, 'Project deleted successfully');
    }

    public function statuses(): JsonResponse
    {
        $statuses = collect(ProjectStatus::cases())->map(function ($status) {
            return [
                'value' => $status->value,
                'label' => $status->label(),
                'color' => $status->color(),
            ];
        });

        return $this->success($statuses, 'Project statuses retrieved successfully');
    }
}
