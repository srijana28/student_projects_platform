<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Project;
use App\Models\University;
use App\Models\User;
use Illuminate\Database\Seeder;

class DemoDataSeeder extends Seeder
{
    public function run()
    {
        // Create 5 universities
        $universities = University::factory()->count(5)->create();

        // Create 10 users
        $users = User::factory()->count(10)->create();

        // Each user creates 2-4 projects
        $users->each(function ($user) use ($universities) {
            Project::factory()
                ->count(rand(2, 4))
                ->create([
                    'user_id' => $user->id,
                    'university_id' => $universities->random()->id,
                ]);
        });

        // Add comments and likes to projects
        Project::all()->each(function ($project) use ($users) {
            // Each project gets 1-5 comments from random users
            Comment::factory()
                ->count(rand(1, 5))
                ->create([
                    'project_id' => $project->id,
                    'user_id' => $users->random()->id,
                ]);

            // Each project gets liked by 1-8 random users
            $users->random(rand(1, 8))->each(function ($user) use ($project) {
                Like::factory()->create([
                    'project_id' => $project->id,
                    'user_id' => $user->id,
                ]);
            });
        });
    }
}