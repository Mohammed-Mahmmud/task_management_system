<?php

namespace App\Notifications;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskOverdueNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public Task $task
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Task Overdue: ' . $this->task->title)
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('This is a reminder that one of your tasks has become overdue.')
            ->line('**Task Details:**')
            ->line('• **Title:** ' . $this->task->title)
            ->line('• **Project:** ' . $this->task->project->name)
            ->line('• **Due Date:** ' . $this->task->due_date->format('F j, Y'))
            ->line('• **Priority:** ' . $this->task->priority->label())
            ->line('• **Status:** ' . $this->task->status->label())
            ->when($this->task->description, function ($mail) {
                return $mail->line('• **Description:** ' . $this->task->description);
            })
            ->action('View Task', url('/'))
            ->line('Please take action on this task as soon as possible.')
            ->salutation('Best regards, ' . config('app.name'));
    }
}
