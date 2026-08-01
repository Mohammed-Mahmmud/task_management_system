<?php

namespace App\Services;

use App\Enums\ProjectStatus;
use App\Enums\TaskStatus;
use App\Models\Project;
use App\Models\Task;

class DashboardService
{
    public function getStats(int $userId): array
    {
        $projectStats = Project::where('user_id', $userId)
            ->selectRaw('
                COUNT(*) as total_projects,
                SUM(CASE WHEN status = ? THEN 1 ELSE 0 END) as active_projects
            ', [ProjectStatus::Active->value])
            ->first();

        $taskStats = Task::whereHas('project', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })
            ->selectRaw('
                COUNT(*) as total_tasks,
                SUM(CASE WHEN status = ? THEN 1 ELSE 0 END) as completed_tasks,
                SUM(CASE WHEN status != ? THEN 1 ELSE 0 END) as pending_tasks,
                SUM(CASE WHEN due_date < NOW() AND status != ? THEN 1 ELSE 0 END) as overdue_tasks
            ', [
                TaskStatus::Done->value,
                TaskStatus::Done->value,
                TaskStatus::Done->value,
            ])
            ->first();

        return [
            'total_projects' => $projectStats->total_projects ?? 0,
            'active_projects' => $projectStats->active_projects ?? 0,
            'total_tasks' => $taskStats->total_tasks ?? 0,
            'completed_tasks' => $taskStats->completed_tasks ?? 0,
            'pending_tasks' => $taskStats->pending_tasks ?? 0,
            'overdue_tasks' => $taskStats->overdue_tasks ?? 0,
        ];
    }
}
