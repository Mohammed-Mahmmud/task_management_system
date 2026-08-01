<!DOCTYPE html>
<html>
<head>
    <title>Task Overdue Notification</title>
</head>
<body>
    <h2>Task Overdue Notification</h2>
    <p>Hello,</p>
    <p>Your task "<strong>{{ $task->title }}</strong>" is overdue.</p>
    <p><strong>Project:</strong> {{ $task->project->name }}</p>
    <p><strong>Due Date:</strong> {{ $task->due_date->format('Y-m-d') }}</p>
    <p><strong>Status:</strong> {{ $task->status->label() }}</p>
    <p><strong>Priority:</strong> {{ $task->priority->label() }}</p>
    @if($task->description)
    <p><strong>Description:</strong> {{ $task->description }}</p>
    @endif
    <p>Please take action to complete this task.</p>
</body>
</html>
