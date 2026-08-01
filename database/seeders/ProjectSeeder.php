<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            if ($user->projects()->count() === 0) {
                Project::factory(rand(3, 5))->create([
                    'user_id' => $user->id,
                ]);
            }
        }
    }
}