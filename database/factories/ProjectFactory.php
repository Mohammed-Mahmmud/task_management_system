<?php

namespace Database\Factories;

use App\Enums\ProjectStatus;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition(): array
    {
        $statuses = [
            ProjectStatus::Active->value => 60,
            ProjectStatus::Completed->value => 30,
            ProjectStatus::Archived->value => 10,
        ];

        return [
            'name' => fake()->words(3, true),
            'description' => fake()->sentence(10),
        ];
    }
}
