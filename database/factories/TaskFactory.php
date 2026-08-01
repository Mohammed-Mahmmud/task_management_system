<?php

namespace Database\Factories;

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition(): array
    {
        $dueDate = fake()->randomElement([
            now()->subDays(rand(1, 30)),
            now()->addDays(rand(1, 30)),
            null,
        ]);

        return [
            'project_id' => Project::factory(),
            'title' => fake()->sentence(4),
            'description' => fake()->paragraph(),
            'priority' => fake()->randomElement([
                TaskPriority::Low->value,
                TaskPriority::Medium->value,
                TaskPriority::High->value,
            ]),
            'status' => fake()->randomElement([
                TaskStatus::Todo->value,
                TaskStatus::InProgress->value,
                TaskStatus::Done->value,
            ]),
            'due_date' => $dueDate,
        ];
    }

    public function overdue(): static
    {
        return $this->state(fn (array $attributes) => [
            'due_date' => now()->subDays(rand(1, 30)),
            'status' => fake()->randomElement([
                TaskStatus::Todo->value,
                TaskStatus::InProgress->value,
            ]),
        ]);
    }

    public function completed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => TaskStatus::Done->value,
        ]);
    }

    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => fake()->randomElement([
                TaskStatus::Todo->value,
                TaskStatus::InProgress->value,
            ]),
        ]);
    }
}
