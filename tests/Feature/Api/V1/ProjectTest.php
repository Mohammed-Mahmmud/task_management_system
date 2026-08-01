<?php

use App\Enums\ProjectStatus;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->token = $this->user->createToken('auth_token')->plainTextToken;
});

test('user can view their projects list', function () {
    Project::factory(5)->create(['user_id' => $this->user->id]);

    $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
        ->getJson('/api/v1/projects');

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

test('user can create a project', function () {
    $projectData = [
        'name' => 'New Project',
        'description' => 'Project Description',
        'status' => ProjectStatus::Active->value,
    ];

    $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
        ->postJson('/api/v1/projects', $projectData);

    $response->assertStatus(201)
        ->assertJsonStructure([
            'success',
            'message',
            'data' => ['id', 'name', 'description', 'status'],
        ]);

    $this->assertDatabaseHas('projects', [
        'name' => 'New Project',
        'user_id' => $this->user->id,
    ]);
});

test('user can view a single project', function () {
    $project = Project::factory()->create(['user_id' => $this->user->id]);

    $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
        ->getJson("/api/v1/projects/{$project->id}");

    $response->assertStatus(200)
        ->assertJson([
            'success' => true,
            'data' => [
                'id' => $project->id,
                'name' => $project->name,
            ],
        ]);
});

test('user can update their project', function () {
    $project = Project::factory()->create(['user_id' => $this->user->id]);

    $updateData = [
        'name' => 'Updated Project Name',
        'description' => 'Updated Description',
    ];

    $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
        ->putJson("/api/v1/projects/{$project->id}", $updateData);

    $response->assertStatus(200)
        ->assertJson([
            'success' => true,
            'message' => 'Project updated successfully',
        ]);

    $this->assertDatabaseHas('projects', [
        'id' => $project->id,
        'name' => 'Updated Project Name',
    ]);
});

test('user can delete their project', function () {
    $project = Project::factory()->create(['user_id' => $this->user->id]);

    $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
        ->deleteJson("/api/v1/projects/{$project->id}");

    $response->assertStatus(200)
        ->assertJson([
            'success' => true,
            'message' => 'Project deleted successfully',
        ]);

    $this->assertSoftDeleted('projects', [
        'id' => $project->id,
    ]);
});

test('user cannot access another users project', function () {
    $otherUser = User::factory()->create();
    $project = Project::factory()->create(['user_id' => $otherUser->id]);

    $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
        ->getJson("/api/v1/projects/{$project->id}");

    $response->assertStatus(403);
});

test('user cannot update another users project', function () {
    $otherUser = User::factory()->create();
    $project = Project::factory()->create(['user_id' => $otherUser->id]);

    $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
        ->putJson("/api/v1/projects/{$project->id}", ['name' => 'Hacked']);

    $response->assertStatus(403);
});

test('user cannot delete another users project', function () {
    $otherUser = User::factory()->create();
    $project = Project::factory()->create(['user_id' => $otherUser->id]);

    $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
        ->deleteJson("/api/v1/projects/{$project->id}");

    $response->assertStatus(403);
});

test('project creation requires name field', function () {
    $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
        ->postJson('/api/v1/projects', [
            'description' => 'Description without name',
        ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['name']);
});

test('project status must be valid enum value', function () {
    $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
        ->postJson('/api/v1/projects', [
            'name' => 'Project',
            'status' => 'invalid_status',
        ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['status']);
});

test('deleted project is not accessible', function () {
    $project = Project::factory()->create(['user_id' => $this->user->id]);
    $project->delete();

    $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
        ->getJson("/api/v1/projects/{$project->id}");

    $response->assertStatus(404);
});
