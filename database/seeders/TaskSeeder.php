<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        $projects = Project::all();

        foreach ($projects as $project) {
            Task::factory(rand(5, 10))->create([
                'project_id' => $project->id,
            ]);

            Task::factory(rand(1, 3))->overdue()->create([
                'project_id' => $project->id,
            ]);

            Task::factory(rand(2, 4))->completed()->create([
                'project_id' => $project->id,
            ]);

            Task::factory(rand(2, 3))->pending()->create([
                'project_id' => $project->id,
            ]);
        }
    }
}
