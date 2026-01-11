<?php

namespace App\Http\Requests;

use App\Models\Task;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        // For now allowing all authenticated users
        // In production, implement proper authorization logic
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'status' => ['nullable', Rule::in(Task::getStatuses())],
            'due_date' => 'nullable|date',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'The task title is required.',
            'title.max' => 'The task title must not exceed 255 characters.',
            'status.in' => 'The status must be one of: ' . implode(', ', Task::getStatuses()) . '.',
            'due_date.date' => 'The due date must be a valid date.',
        ];
    }
}
