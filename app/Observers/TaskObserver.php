<?php

namespace App\Observers;

use App\Enums\TaskStatus;
use App\Jobs\SendTaskOverdueNotificationJob;
use App\Models\Task;

class TaskObserver
{
    public function created(Task $task): void
    {
        $this->checkOverdue($task);
    }

    public function updated(Task $task): void
    {
        $this->checkOverdue($task);
    }

    private function checkOverdue(Task $task): void
    {
        if ($task->due_date && 
            $task->due_date->isPast() && 
            $task->status !== TaskStatus::Done) {
            SendTaskOverdueNotificationJob::dispatch($task);
        }
    }
}
