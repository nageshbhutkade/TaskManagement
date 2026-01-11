<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition(): array
    {
        $titles = ['Complete project', 'Review code', 'Write tests', 'Deploy app', 'Fix bugs'];
        $descriptions = [
            'This is a sample task description',
            'Another task description for testing',
            'Complete this task as soon as possible',
            'Important task that needs attention'
        ];
        $statuses = Task::getStatuses();
        
        return [
            'title' => $titles[array_rand($titles)],
            'description' => $descriptions[array_rand($descriptions)],
            'status' => $statuses[array_rand($statuses)],
            'due_date' => date('Y-m-d', strtotime('+' . rand(1, 30) . ' days')),
        ];
    }

    public function pending(): static
    {
        return $this->state(['status' => Task::STATUS_PENDING]);
    }

    public function inProgress(): static
    {
        return $this->state(['status' => Task::STATUS_IN_PROGRESS]);
    }

    public function completed(): static
    {
        return $this->state(['status' => Task::STATUS_COMPLETED]);
    }
}
