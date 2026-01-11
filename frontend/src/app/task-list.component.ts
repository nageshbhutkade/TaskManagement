import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { TaskService, Task } from './task.service';

@Component({
  selector: 'app-task-list',
  standalone: true,
  imports: [CommonModule, FormsModule],
  providers: [TaskService],
  templateUrl: './task-management.html',
  styleUrl: './app.css'
})
export class TaskListComponent implements OnInit {
  tasks: Task[] = [];
  newTask: Task = {
    title: '',
    description: '',
    status: 'pending',
    due_date: ''
  };

  constructor(private taskService: TaskService) {}

  ngOnInit() {
    this.loadTasks();
  }

  loadTasks() {
    this.taskService.getTasks().subscribe({
      next: (response) => {
        this.tasks = response.data || response;
      },
      error: (error) => console.error('Error loading tasks:', error)
    });
  }

  createTask() {
    if (this.newTask.title.trim()) {
      this.taskService.createTask(this.newTask).subscribe({
        next: () => {
          this.loadTasks();
          this.resetForm();
        },
        error: (error) => console.error('Error creating task:', error)
      });
    }
  }

  updateTaskStatus(task: Task, status: string) {
    this.taskService.updateTask(task.id!, { status: status as any }).subscribe({
      next: () => this.loadTasks(),
      error: (error) => console.error('Error updating task:', error)
    });
  }

  deleteTask(id: number) {
    this.taskService.deleteTask(id).subscribe({
      next: () => this.loadTasks(),
      error: (error) => console.error('Error deleting task:', error)
    });
  }

  resetForm() {
    this.newTask = {
      title: '',
      description: '',
      status: 'pending',
      due_date: ''
    };
  }
}