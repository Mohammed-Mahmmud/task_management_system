<?php

namespace App\Mail;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TaskOverdueMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Task $task
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Task Overdue Notification',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.task-overdue',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
