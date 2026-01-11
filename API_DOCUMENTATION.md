# Task Management API Documentation

## Base URL
```
http://localhost:8000/api
```

## Response Format
All responses follow a consistent JSON format with proper HTTP status codes.

## Endpoints

### 1. Get All Tasks
**GET** `/tasks`

**Description:** Retrieve all tasks with metadata

**Response (200):**
```json
{
    "data": [
        {
            "id": 1,
            "title": "Complete project",
            "description": "Finish the Laravel API project",
            "status": "pending",
            "due_date": "2024-01-15",
            "created_at": "2024-01-10T10:00:00.000000Z",
            "updated_at": "2024-01-10T10:00:00.000000Z"
        }
    ],
    "meta": {
        "total": 1
    }
}
```

### 2. Create Task
**POST** `/tasks`

**Description:** Create a new task

**Request Body:**
```json
{
    "title": "Task title",
    "description": "Task description (optional)",
    "status": "pending",
    "due_date": "2024-01-15"
}
```

**Validation Rules:**
- `title`: required, string, max 255 characters
- `description`: optional, string
- `status`: optional, enum (pending, in_progress, completed)
- `due_date`: optional, date format (YYYY-MM-DD)

**Response (201):**
```json
{
    "data": {
        "id": 1,
        "title": "Task title",
        "description": "Task description",
        "status": "pending",
        "due_date": "2024-01-15",
        "created_at": "2024-01-10T10:00:00.000000Z",
        "updated_at": "2024-01-10T10:00:00.000000Z"
    }
}
```

**Validation Error (422):**
```json
{
    "message": "The title field is required. (and 1 more error)",
    "errors": {
        "title": [
            "The task title is required."
        ],
        "status": [
            "The status must be one of: pending, in_progress, completed."
        ]
    }
}
```

### 3. Get Single Task
**GET** `/tasks/{id}`

**Description:** Retrieve a specific task by ID

**Response (200):**
```json
{
    "data": {
        "id": 1,
        "title": "Task title",
        "description": "Task description",
        "status": "pending",
        "due_date": "2024-01-15",
        "created_at": "2024-01-10T10:00:00.000000Z",
        "updated_at": "2024-01-10T10:00:00.000000Z"
    }
}
```

**Response (404):**
```json
{
    "message": "Task not found"
}
```

### 4. Update Task
**PUT/PATCH** `/tasks/{id}`

**Description:** Update an existing task

**Request Body:**
```json
{
    "title": "Updated title",
    "description": "Updated description",
    "status": "in_progress",
    "due_date": "2024-01-20"
}
```

**Validation Rules:**
- `title`: sometimes required, string, max 255 characters
- `description`: optional, string
- `status`: optional, enum (pending, in_progress, completed)
- `due_date`: optional, date format (YYYY-MM-DD)

**Response (200):**
```json
{
    "data": {
        "id": 1,
        "title": "Updated title",
        "description": "Updated description",
        "status": "in_progress",
        "due_date": "2024-01-20",
        "created_at": "2024-01-10T10:00:00.000000Z",
        "updated_at": "2024-01-10T11:00:00.000000Z"
    }
}
```

### 5. Delete Task
**DELETE** `/tasks/{id}`

**Description:** Delete a specific task

**Response (204):** No content

**Response (404):**
```json
{
    "message": "Task not found"
}
```

## Status Values
- `pending`: Task is not started
- `in_progress`: Task is currently being worked on
- `completed`: Task is finished

## Error Responses

### Server Error (500)
```json
{
    "message": "Failed to create task",
    "error": "Database connection failed"
}
```

### Validation Error (422)
```json
{
    "message": "The title field is required.",
    "errors": {
        "title": [
            "The task title is required."
        ]
    }
}
```

### Not Found (404)
```json
{
    "message": "Task not found"
}
```

## Architecture Features

- **PSR-12 Coding Standards**: All code follows PSR-12 formatting
- **SOLID Principles**: 
  - Single Responsibility: TaskService handles business logic
  - Dependency Inversion: Controller depends on TaskService abstraction
  - Open/Closed: Extensible through service layer
- **Form Request Validation**: Dedicated request classes for validation
- **API Resources**: Consistent response formatting
- **Proper Error Handling**: Appropriate HTTP status codes
- **Dependency Injection**: Services injected via constructor

## Example Usage

### Create a task
```bash
curl -X POST http://localhost:8000/api/tasks \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "title": "Learn Laravel",
    "description": "Complete Laravel tutorial",
    "status": "pending",
    "due_date": "2024-01-15"
  }'
```

### Get all tasks
```bash
curl -X GET http://localhost:8000/api/tasks \
  -H "Accept: application/json"
```

### Update a task
```bash
curl -X PUT http://localhost:8000/api/tasks/1 \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "status": "completed"
  }'
```

### Delete a task
```bash
curl -X DELETE http://localhost:8000/api/tasks/1 \
  -H "Accept: application/json"
```