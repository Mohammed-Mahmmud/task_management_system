<?php

use App\Enums\ProjectStatus;
use App\Enums\TaskStatus;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->token = $this->user->createToken('auth_token')->plainTextToken;
});

test('dashboard returns correct project statistics', function () {
    Project::factory()->create([
        'user_id' => $this->user->id,
        'status' => ProjectStatus::Active,
    ]);
    Project::factory()->create([
        'user_id' => $this->user->id,
        'status' => ProjectStatus::Active,
    ]);
    Project::factory()->create([
        'user_id' => $this->user->id,
        'status' => ProjectStatus::Completed,
    ]);

    $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
        ->getJson('/api/v1/dashboard');

    $response->assertStatus(200)
        ->assertJson([
            'success' => true,
            'data' => [
                'total_projects' => 3,
                'active_projects' => 2,
            ],
        ]);
});

test('dashboard returns correct task statistics', function () {
    $project = Project::factory()->create(['user_id' => $this->user->id]);

    Task::factory()->create([
        'project_id' => $project->id,
        'status' => TaskStatus::Done,
    ]);
    Task::factory()->create([
        'project_id' => $project->id,
        'status' => TaskStatus::Done,
    ]);
    Task::factory()->create([
        'project_id' => $project->id,
        'status' => TaskStatus::Todo,
    ]);
    Task::factory()->create([
        'project_id' => $project->id,
        'status' => TaskStatus::InProgress,
    ]);

    $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
        ->getJson('/api/v1/dashboard');

    $response->assertStatus(200)
        ->assertJson([
            'success' => true,
            'data' => [
                'total_tasks' => 4,
                'completed_tasks' => 2,
                'pending_tasks' => 2,
            ],
        ]);
});

test('dashboard correctly identifies overdue tasks', function () {
    $project = Project::factory()->create(['user_id' => $this->user->id]);

    Task::factory()->create([
        'project_id' => $project->id,
        'due_date' => now()->subDays(5),
        'status' => TaskStatus::Todo,
    ]);
    Task::factory()->create([
        'project_id' => $project->id,
        'due_date' => now()->subDays(3),
        'status' => TaskStatus::InProgress,
    ]);
    Task::factory()->create([
        'project_id' => $project->id,
        'due_date' => now()->subDays(1),
        'status' => TaskStatus::Done,
    ]);

    $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
        ->getJson('/api/v1/dashboard');

    $response->assertStatus(200)
        ->assertJson([
            'success' => true,
            'data' => [
                'overdue_tasks' => 2,
            ],
        ]);
});

test('dashboard returns zero statistics for new user', function () {
    $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
        ->getJson('/api/v1/dashboard');

    $response->assertStatus(200)
        ->assertJson([
            'success' => true,
            'data' => [
                'total_projects' => 0,
                'active_projects' => 0,
                'total_tasks' => 0,
                'completed_tasks' => 0,
                'pending_tasks' => 0,
                'overdue_tasks' => 0,
            ],
        ]);
});

test('dashboard only shows data for authenticated user', function () {
    $otherUser = User::factory()->create();
    $otherProject = Project::factory()->create(['user_id' => $otherUser->id]);
    Task::factory(5)->create(['project_id' => $otherProject->id]);

    Project::factory()->create(['user_id' => $this->user->id]);

    $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
        ->getJson('/api/v1/dashboard');

    $response->assertStatus(200)
        ->assertJson([
            'success' => true,
            'data' => [
                'total_projects' => 1,
                'total_tasks' => 0,
            ],
        ]);
});

test('unauthenticated user cannot access dashboard', function () {
    $response = $this->getJson('/api/v1/dashboard');

    $response->assertStatus(401)
        ->assertJson([
            'success' => false,
            'message' => 'Unauthenticated',
        ]);
});

test('dashboard returns all required metrics', function () {
    $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
        ->getJson('/api/v1/dashboard');

    $response->assertStatus(200)
        ->assertJsonStructure([
            'success',
            'message',
            'data' => [
                'total_projects',
                'active_projects',
                'total_tasks',
                'completed_tasks',
                'pending_tasks',
                'overdue_tasks',
            ],
        ]);
});
