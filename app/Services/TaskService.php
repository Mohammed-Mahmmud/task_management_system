<?php

namespace App\Services;

use App\Exceptions\TaskNotFoundException;
use App\Models\Task;
use App\Repositories\Contracts\TaskRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TaskService
{
    public function __construct(
        private TaskRepositoryInterface $taskRepository
    ) {}

    public function listForProject(int $projectId, array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        return $this->taskRepository->getAllForProject($projectId, $filters, $perPage);
    }

    public function find(int $id): ?Task
    {
        return $this->taskRepository->findById($id);
    }

    public function create(array $data): Task
    {
        return $this->taskRepository->create($data);
    }

    public function update(int $id, array $data): Task
    {
        $task = $this->taskRepository->findById($id);
        return $this->taskRepository->update($task, $data);
    }

    public function delete(int $id): bool
    {
        $task = $this->taskRepository->findById($id);
        return $this->taskRepository->delete($task);
    }
}
