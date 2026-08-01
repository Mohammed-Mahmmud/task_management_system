<?php

namespace App\Services;

use App\Exceptions\ProjectNotFoundException;
use App\Models\Project;
use App\Repositories\Contracts\ProjectRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProjectService
{
    public function __construct(
        private ProjectRepositoryInterface $projectRepository
    ) {}

    public function listForUser(int $userId, int $perPage = 15): LengthAwarePaginator
    {
        return $this->projectRepository->getAllForUser($userId, $perPage);
    }

    public function find(int $id): ?Project
    {
        return $this->projectRepository->findById($id);
    }

    public function create(array $data): Project
    {
        return $this->projectRepository->create($data);
    }

    public function update(int $id, array $data): Project
    {
        $project = $this->projectRepository->findById($id);
        return $this->projectRepository->update($project, $data);
    }

    public function delete(int $id): bool
    {
        $project = $this->projectRepository->findById($id);
        return $this->projectRepository->delete($project);
    }
}
