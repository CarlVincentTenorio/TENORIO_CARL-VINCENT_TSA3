<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            User::updateOrCreate(
                ['username' => 'carlvincent'],
                [
                    'full_name' => 'Carl Vincent Tenorio',
                    // Replace this sample address with your preferred email.
                    'email' => 'carlvincent@example.com',
                ]
            );

            $today = today()->toImmutable();

            $tasks = [
                ['Review MVC concepts', 'completed', -1],
                ['Prepare the project outline', 'completed', -1],
                ['Create the Laravel migrations', 'completed', 0],
                ['Build the task list page', 'in progress', 0],
                ['Review the project requirements', 'pending', 0],
                ['Test the profile page', 'pending', 1],
                ['Update the project README', 'pending', 1],
                ['Deploy the application', 'pending', 1],
            ];

            foreach ($tasks as [$title, $status, $offset]) {
                Task::updateOrCreate(
                    ['title' => $title],
                    [
                        'status' => $status,
                        'task_date' => $today->addDays($offset)->toDateString(),
                    ]
                );
            }
        });
    }
}
