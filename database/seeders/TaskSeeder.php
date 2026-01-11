<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        Task::factory()->count(10)->create();
        
        Task::factory()->pending()->count(3)->create();
        Task::factory()->inProgress()->count(2)->create();
        Task::factory()->completed()->count(5)->create();
    }
}
