<?php

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->token = $this->user->createToken('auth_token')->plainTextToken;
    $this->project = Project::factory()->create(['user_id' => $this->user->id]);
});

test('user can view tasks for their project', function () {
    Task::factory(5)->create(['project_id' => $this->project->id]);

    $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
        ->getJson("/api/v1/projects/{$this->project->id}/tasks");

    $response->assertStatus(200)
        ->assertJsonStructure([
            'success',
            'message',
            'data' => [
                'data',
                'links',
                'meta',
            ],
        ]);
});

test('user can create a task', function () {
    $taskData = [
        'title' => 'New Task',
        'description' => 'Task Description',
        'priority' => TaskPriority::High->value,
        'status' => TaskStatus::Todo->value,
        'due_date' => now()->addDays(7)->format('Y-m-d'),
    ];

    $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
        ->postJson("/api/v1/projects/{$this->project->id}/tasks", $taskData);

    $response->assertStatus(201)
        ->assertJsonStructure([
            'success',
            'message',
            'data' => ['id', 'title', 'priority', 'status'],
        ]);

    $this->assertDatabaseHas('tasks', [
        'title' => 'New Task',
        'project_id' => $this->project->id,
    ]);
});

test('user can view a single task', function () {
    $task = Task::factory()->create(['project_id' => $this->project->id]);

    $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
        ->getJson("/api/v1/tasks/{$task->id}");

    $response->assertStatus(200)
        ->assertJson([
            'success' => true,
            'data' => [
                'id' => $task->id,
                'title' => $task->title,
            ],
        ]);
});

test('user can update a task', function () {
    $task = Task::factory()->create(['project_id' => $this->project->id]);

    $updateData = [
        'title' => 'Updated Task Title',
        'status' => TaskStatus::InProgress->value,
    ];

    $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
        ->putJson("/api/v1/tasks/{$task->id}", $updateData);

    $response->assertStatus(200)
        ->assertJson([
            'success' => true,
            'message' => 'Task updated successfully',
        ]);

    $this->assertDatabaseHas('tasks', [
        'id' => $task->id,
        'title' => 'Updated Task Title',
    ]);
});

test('user can delete a task', function () {
    $task = Task::factory()->create(['project_id' => $this->project->id]);

    $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
        ->deleteJson("/api/v1/tasks/{$task->id}");

    $response->assertStatus(200)
        ->assertJson([
            'success' => true,
            'message' => 'Task deleted successfully',
        ]);

    $this->assertSoftDeleted('tasks', [
        'id' => $task->id,
    ]);
});

test('user can filter tasks by status', function () {
    Task::factory()->create([
        'project_id' => $this->project->id,
        'status' => TaskStatus::Todo,
    ]);
    Task::factory()->create([
        'project_id' => $this->project->id,
        'status' => TaskStatus::Done,
    ]);

    $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
        ->getJson("/api/v1/projects/{$this->project->id}/tasks?status=" . TaskStatus::Todo->value);

    $response->assertStatus(200);
});

test('user can filter tasks by priority', function () {
    Task::factory()->create([
        'project_id' => $this->project->id,
        'priority' => TaskPriority::High,
    ]);
    Task::factory()->create([
        'project_id' => $this->project->id,
        'priority' => TaskPriority::Low,
    ]);

    $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
        ->getJson("/api/v1/projects/{$this->project->id}/tasks?priority=" . TaskPriority::High->value);

    $response->assertStatus(200);
});

test('user can search tasks by title', function () {
    Task::factory()->create([
        'project_id' => $this->project->id,
        'title' => 'Important Task',
    ]);
    Task::factory()->create([
        'project_id' => $this->project->id,
        'title' => 'Regular Task',
    ]);

    $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
        ->getJson("/api/v1/projects/{$this->project->id}/tasks?search=Important");

    $response->assertStatus(200);
});

test('user cannot access tasks from another users project', function () {
    $otherUser = User::factory()->create();
    $otherProject = Project::factory()->create(['user_id' => $otherUser->id]);
    $task = Task::factory()->create(['project_id' => $otherProject->id]);

    $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
        ->getJson("/api/v1/tasks/{$task->id}");

    $response->assertStatus(403);
});

test('task creation requires title field', function () {
    $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
        ->postJson("/api/v1/projects/{$this->project->id}/tasks", [
            'description' => 'Description without title',
        ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['title']);
});

test('task priority must be valid enum value', function () {
    $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
        ->postJson("/api/v1/projects/{$this->project->id}/tasks", [
            'title' => 'Task',
            'priority' => 'invalid_priority',
        ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['priority']);
});

test('task status must be valid enum value', function () {
    $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
        ->postJson("/api/v1/projects/{$this->project->id}/tasks", [
            'title' => 'Task',
            'status' => 'invalid_status',
        ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['status']);
});

test('due date must be a valid date', function () {
    $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
        ->postJson("/api/v1/projects/{$this->project->id}/tasks", [
            'title' => 'Task',
            'due_date' => 'not-a-date',
        ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['due_date']);
});
