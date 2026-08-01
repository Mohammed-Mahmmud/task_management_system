<?php

namespace App\Console\Commands;

use App\Jobs\SendTaskOverdueNotificationJob;
use App\Models\Task;
use Illuminate\Console\Command;

class NotifyOverdueTasks extends Command
{
    protected $signature = 'tasks:notify-overdue';

    protected $description = 'Send overdue notifications for tasks that have passed their due date';

    public function handle(): int
    {
        $count = 0;

        Task::readyForOverdueNotification()
            ->with('project.user')
            ->chunkById(100, function ($tasks) use (&$count) {
                foreach ($tasks as $task) {
                    SendTaskOverdueNotificationJob::dispatch($task);
                    $count++;
                }
            });

        $this->info("Dispatched {$count} overdue task notification(s).");

        return Command::SUCCESS;
    }
}
