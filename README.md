# Task Management API

A complete REST CRUD API for task management built with Laravel, following PSR-12 coding standards and SOLID principles.

## Features

- ✅ Complete CRUD operations for tasks
- ✅ Form Request validation
- ✅ API Resources for consistent responses
- ✅ Proper error handling with HTTP status codes
- ✅ Factory and Seeder for test data
- ✅ PSR-12 coding standards
- ✅ SOLID principles implementation

## Task Fields

- `title` (required, string, max 255)
- `description` (optional, text)
- `status` (enum: pending, in_progress, completed)
- `due_date` (optional, date)

## Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd example-app
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database configuration**
   Update `.env` file with your database credentials:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=task_management
   DB_USERNAME=root
   DB_PASSWORD=your_password
   ```

5. **Run migrations**
   ```bash
   php artisan migrate
   ```

6. **Seed database (optional)**
   ```bash
   php artisan db:seed --class=TaskSeeder
   ```

7. **Start the server**
   ```bash
   php artisan serve
   ```

## API Endpoints

| Method | URL | Description |
|--------|-----|-------------|
| GET | `/api/tasks` | Get all tasks |
| POST | `/api/tasks` | Create a new task |
| GET | `/api/tasks/{id}` | Get a specific task |
| PUT/PATCH | `/api/tasks/{id}` | Update a specific task |
| DELETE | `/api/tasks/{id}` | Delete a specific task |

## API Usage Examples

### Create Task
```bash
curl -X POST http://localhost:8000/api/tasks \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "title": "Complete Laravel API",
    "description": "Build a complete REST API",
    "status": "pending",
    "due_date": "2024-01-15"
  }'
```

### Get All Tasks
```bash
curl -X GET http://localhost:8000/api/tasks \
  -H "Accept: application/json"
```

### Update Task
```bash
curl -X PUT http://localhost:8000/api/tasks/1 \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{"status": "completed"}'
```

### Delete Task
```bash
curl -X DELETE http://localhost:8000/api/tasks/1 \
  -H "Accept: application/json"
```

## Testing

### Run Feature Tests
```bash
# Run all tests
php artisan test

# Run specific test class
php artisan test --filter=TaskApiTest

# Run with coverage
php artisan test --coverage
```

### Test Coverage
The project includes comprehensive feature tests covering:
- ✅ Create task (success case)
- ✅ Create task (validation failure)
- ✅ List all tasks
- ✅ Update existing task
- ✅ Delete task

### Generate Test Data
```bash
# Create 5 tasks using factory
php artisan test:factory

# Seed database with sample tasks
php artisan db:seed --class=TaskSeeder
```

### Using Tinker
```bash
php artisan tinker

# Create tasks
Task::factory()->count(5)->create();

# Create specific status tasks
Task::factory()->pending()->create();
Task::factory()->inProgress()->create();
Task::factory()->completed()->create();
```

## Architecture

- **Controllers**: Handle HTTP requests and responses
- **Form Requests**: Validate incoming data
- **API Resources**: Format API responses consistently
- **Services**: Business logic layer
- **Models**: Data layer with Eloquent ORM
- **Factories**: Generate test data
- **Seeders**: Populate database with sample data

## Status Codes

- `200` - Success
- `201` - Created
- `204` - No Content (Delete)
- `404` - Not Found
- `422` - Validation Error
- `500` - Server Error

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
