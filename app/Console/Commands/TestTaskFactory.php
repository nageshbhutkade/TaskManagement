<?php

namespace App\Console\Commands;

use App\Models\Task;
use Illuminate\Console\Command;

class TestTaskFactory extends Command
{
    protected $signature = 'test:factory';
    protected $description = 'Test TaskFactory';

    public function handle()
    {
        $this->info('Creating 5 tasks...');
        
        Task::factory()->count(5)->create();
        
        $this->info('Tasks created successfully!');
        $this->info('Total tasks: ' . Task::count());
        
        $this->table(
            ['ID', 'Title', 'Status', 'Due Date'],
            Task::all(['id', 'title', 'status', 'due_date'])->toArray()
        );
        
        return 0;
    }
}
