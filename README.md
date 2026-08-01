# Task Management API

A professional RESTful API built with Laravel 13 for managing projects and tasks with full authentication, authorization, and notification features.

## Features

- **Authentication & Authorization**: Laravel Sanctum token-based authentication
- **Project Management**: Full CRUD operations for projects with status tracking
- **Task Management**: Comprehensive task management with priorities, statuses, and due dates
- **Dashboard**: Aggregate statistics and metrics
- **Filtering & Search**: Advanced filtering by status, priority, and search by title
- **Notifications**: Email and database notifications for overdue tasks
- **Soft Deletes**: Soft delete support for projects and tasks
- **API Documentation**: Complete Postman collection included
- **Testing**: Comprehensive Pest test suite
- **Docker Support**: Fully containerized with Docker Compose

## Technology Stack

- **Framework**: Laravel 13
- **PHP**: 8.3
- **Database**: MySQL 8.0
- **Authentication**: Laravel Sanctum
- **Queue**: Database driver
- **Testing**: Pest
- **Containerization**: Docker & Docker Compose

## Project Architecture

### Domain Models
- **Users**: Application users with authentication
- **Projects**: User-owned projects with status tracking (Active, Completed, Archived)
- **Tasks**: Project tasks with priorities (Low, Medium, High) and statuses (Todo, In Progress, Done)

### Architecture Patterns
- **Repository Pattern**: Abstraction layer for data access
- **Service Layer**: Business logic encapsulation
- **Resource Pattern**: API response transformation
- **Policy-Based Authorization**: Laravel policies for access control
- **Observer Pattern**: Event-driven notifications
- **Enum Pattern**: Type-safe status and priority values

### Key Components
- Eloquent ORM with relationships
- Custom exception handling
- API response standardization via traits
- Database seeding with factories
- Email notifications for overdue tasks
- Database notifications
- Soft delete cascade on project deletion

## Installation

### Prerequisites
- Docker Desktop installed and running
- Git

### Setup Steps

1. **Clone the repository**
```bash
git clone <repository-url>
cd task_management_system
```

2. **Copy environment file**
```bash
copy .env.docker .env
```

3. **Start Docker containers**
```bash
docker compose up -d --build
```

4. **Install dependencies**
```bash
docker compose exec app composer install
```

5. **Generate application key**
```bash
docker compose exec app php artisan key:generate
```

6. **Run migrations**
```bash
docker compose exec app php artisan migrate
```

7. **Seed database** (optional)
```bash
docker compose exec app php artisan db:seed
```

## Access Points

- **API Base URL**: http://localhost:8000
- **phpMyAdmin**: http://localhost:8080 (user: root, password: root_password)
- **MySQL**: localhost:3306 (user: laravel_user, password: laravel_password)

## API Endpoints

### Authentication
- `POST /api/v1/register` - Register new user
- `POST /api/v1/login` - Login user
- `POST /api/v1/logout` - Logout user (requires authentication)

### Dashboard
- `GET /api/v1/dashboard` - Get dashboard statistics (requires authentication)

### Projects
- `GET /api/v1/projects` - List all projects (paginated)
- `POST /api/v1/projects` - Create new project
- `GET /api/v1/projects/{id}` - Get single project
- `PUT /api/v1/projects/{id}` - Update project
- `DELETE /api/v1/projects/{id}` - Delete project (soft delete)

### Tasks
- `GET /api/v1/projects/{project}/tasks` - List project tasks (paginated)
- `POST /api/v1/projects/{project}/tasks` - Create new task
- `GET /api/v1/tasks/{id}` - Get single task
- `PUT /api/v1/tasks/{id}` - Update task
- `DELETE /api/v1/tasks/{id}` - Delete task (soft delete)

### Query Parameters for Tasks
- `status`: Filter by status (todo, in_progress, done)
- `priority`: Filter by priority (low, medium, high)
- `search`: Search by title

## API Documentation

Use the included **Postman collection** for complete API documentation:

1. Import `Task Management API.postman_collection.json` into Postman
2. Import `Task Management API.postman_environment.json` for environment variables
3. Start with the Authentication folder to get your API token
4. The token is automatically saved for subsequent requests

## Testing

### Run all tests
```bash
docker compose exec app php artisan test
```

### Run specific test suite
```bash
docker compose exec app php artisan test --filter AuthenticationTest
docker compose exec app php artisan test --filter ProjectTest
docker compose exec app php artisan test --filter TaskTest
docker compose exec app php artisan test --filter DashboardTest
```

### Test Coverage
- Authentication tests (register, login, logout)
- Project CRUD tests with authorization
- Task CRUD tests with filtering
- Dashboard statistics tests
- Validation and error handling tests

## Database Seeding

The application includes comprehensive seeders:

```bash
docker compose exec app php artisan db:seed
```

This creates:
- 3 users (admin@example.com, test@example.com, demo@example.com)
- 3-5 projects per user
- 5-10 tasks per project with varied statuses and priorities
- Includes overdue, completed, and pending tasks

Default password for seeded users: `password`

## Queue Workers

For processing email notifications:

```bash
docker compose exec app php artisan queue:work
```

Or use the `--daemon` flag for production:

```bash
docker compose exec app php artisan queue:work --daemon
```

## Development Commands

### Clear caches
```bash
docker compose exec app php artisan cache:clear
docker compose exec app php artisan config:clear
docker compose exec app php artisan route:clear
```

### Generate IDE helper files
```bash
docker compose exec app composer require --dev barryvdh/laravel-ide-helper
docker compose exec app php artisan ide-helper:generate
docker compose exec app php artisan ide-helper:models
```

### Code formatting
```bash
docker compose exec app ./vendor/bin/pint
```

## Docker Management

### View logs
```bash
docker compose logs -f app
```

### Access container shell
```bash
docker compose exec app bash
```

### Stop containers
```bash
docker compose down
```

### Rebuild containers
```bash
docker compose up -d --build
```

## Project Structure

```
app/
├── Enums/                    # PHP 8 enum classes
├── Exceptions/               # Custom exceptions
├── Http/
│   ├── Controllers/
│   │   └── Api/V1/          # API controllers
│   ├── Requests/            # Form request validators
│   ├── Resources/           # API resources
│   └── Traits/              # Reusable traits (ApiResponse)
├── Jobs/                    # Queue jobs
├── Mail/                    # Mailable classes
├── Models/                  # Eloquent models
├── Notifications/           # Notification classes
├── Observers/               # Eloquent observers
├── Policies/                # Authorization policies
├── Providers/               # Service providers
├── Repositories/
│   ├── Contracts/          # Repository interfaces
│   └── Eloquent/           # Repository implementations
└── Services/                # Business logic services

database/
├── factories/               # Model factories
├── migrations/              # Database migrations
└── seeders/                 # Database seeders

tests/
├── Feature/
│   ├── Api/V1/             # API feature tests
│   └── Auth/               # Authentication tests
└── Unit/                    # Unit tests
```

## API Response Format

### Success Response
```json
{
    "success": true,
    "message": "Operation successful",
    "data": { }
}
```

### Error Response
```json
{
    "success": false,
    "message": "Error message",
    "errors": { }
}
```

### Paginated Response
```json
{
    "success": true,
    "message": "Data retrieved successfully",
    "data": {
        "data": [],
        "links": {
            "first": "...",
            "last": "...",
            "prev": null,
            "next": "..."
        },
        "meta": {
            "current_page": 1,
            "from": 1,
            "last_page": 5,
            "per_page": 15,
            "to": 15,
            "total": 65
        }
    }
}
```

## Environment Variables

Key environment variables (see `.env.example` for complete list):

```env
APP_NAME=Laravel
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=task_management_db
DB_USERNAME=root
DB_PASSWORD=root

QUEUE_CONNECTION=database
CACHE_STORE=database

MAIL_MAILER=log
```

## Security Features

- Token-based authentication (Laravel Sanctum)
- Password hashing with bcrypt
- Policy-based authorization
- Input validation
- SQL injection protection via Eloquent ORM
- XSS protection
- CSRF protection
- Rate limiting

## License

This project is open-sourced software licensed under the MIT license.

## Support

For issues or questions, please open an issue in the repository.
