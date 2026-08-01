# Task Management API

A professional RESTful API built with Laravel 13 for managing projects and tasks with full authentication, authorization, and notification features.

## Features

- **Authentication & Authorization**: Laravel Sanctum token-based authentication
- **Project Management**: Full CRUD operations for projects with status tracking
- **Task Management**: Comprehensive task management with priorities, statuses, and due dates
- **Dashboard**: Aggregate statistics and metrics
- **Filtering & Search**: Advanced filtering by status, priority, and search by title
- **Automated Overdue Notifications**: Time-based email notifications for overdue tasks
- **Soft Deletes**: Soft delete support for projects and tasks
- **API Documentation**: Complete Postman collection included
- **Testing**: Comprehensive Pest test suite
- **Docker Support**: Fully containerized with Docker Compose (app, queue worker, scheduler)

## Technology Stack

- **Framework**: Laravel 13
- **PHP**: 8.3
- **Database**: MySQL 8.0
- **Authentication**: Laravel Sanctum
- **Queue**: Database driver
- **Task Scheduling**: Laravel Scheduler
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
- **Automated overdue task detection via scheduled command**
- **Queue-based email notifications**
- **One-time notification per task (tracked via overdue_notified_at)**
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

This single command starts all required services:
- **app**: Laravel application server
- **mysql**: Database server
- **phpmyadmin**: Database management interface
- **queue**: Background queue worker for processing jobs
- **scheduler**: Task scheduler that runs every minute

**No manual queue or scheduler commands are needed!** Everything runs automatically.

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
- **phpMyAdmin**: http://localhost:8080 (user: root, password: root)
- **Mailpit Web UI**: http://localhost:8025
- **MySQL**: localhost:3306 (user: root, password: root)

## Docker Services

The application runs 6 separate Docker containers:

1. **app** - Laravel application (port 8000)
2. **mysql** - MySQL 8.0 database (port 3306)
3. **phpmyadmin** - Database management UI (port 8080)
4. **queue** - Queue worker processing background jobs
5. **scheduler** - Task scheduler running every minute
6. **mailpit** - Email testing tool (SMTP: 1025, Web UI: 8025)

All services start automatically with `docker compose up`. No manual intervention required.

## API Endpoints

### Authentication
- `POST /api/v1/register` - Register new user
- `POST /api/v1/login` - Login user
- `POST /api/v1/logout` - Logout user (requires authentication)

### Dashboard
- `GET /api/v1/dashboard` - Get dashboard statistics (requires authentication)

### Projects
- `GET /api/v1/projects` - List all projects (paginated)
- `GET /api/v1/projects/statuses` - Get available project statuses
- `POST /api/v1/projects` - Create new project
- `GET /api/v1/projects/{id}` - Get single project
- `PUT /api/v1/projects/{id}` - Update project
- `DELETE /api/v1/projects/{id}` - Delete project (soft delete)

### Tasks
- `GET /api/v1/projects/{project}/tasks` - List project tasks (paginated)
- `GET /api/v1/tasks/priorities` - Get available task priorities
- `GET /api/v1/tasks/statuses` - Get available task statuses
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

## Mail Testing

The application uses **Mailpit** for email testing during development and technical assessments.

### What is Mailpit?
Mailpit is a lightweight email testing tool that captures all outgoing emails without sending them to real recipients. This means:
- ✅ No SMTP credentials required
- ✅ All emails are captured locally
- ✅ Safe for development and testing
- ✅ Professional email preview interface

### How to Use

1. **Start the application**
```bash
docker compose up -d --build
```

2. **Open Mailpit Web UI**
Navigate to: **http://localhost:8025**

3. **Trigger email notifications**
- Create an overdue task (set `due_date` to a past date)
- Wait for the scheduler (runs daily at 00:05) or trigger manually:
```bash
docker compose exec app php artisan tasks:notify-overdue
```

4. **View emails in Mailpit**
- All outgoing emails appear in the Mailpit web interface
- View HTML and plain text versions
- Inspect email headers and content
- No emails are sent to actual recipients

### Configuration
The application is pre-configured to use Mailpit:
```env
MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_ENCRYPTION=null
```

### Production Deployment
For production, update `.env` with real SMTP credentials:
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.your-provider.com
MAIL_PORT=587
MAIL_ENCRYPTION=tls
MAIL_USERNAME=your-username
MAIL_PASSWORD=your-password
```

## Overdue Task Notifications

The system automatically sends email notifications for overdue tasks:

### How It Works
1. **Scheduler**: Runs daily at 00:05 (5 minutes after midnight)
2. **Detection**: Identifies tasks where:
   - `due_date` is before today
   - `status` is NOT "Done"
   - `overdue_notified_at` is NULL (not yet notified)
3. **Notification**: Sends professional email to project owner
4. **Tracking**: Sets `overdue_notified_at` to prevent duplicate notifications

### One-Time Notification
Each task receives the overdue notification **only once**. Even if a task remains overdue for weeks, no additional emails are sent unless `overdue_notified_at` is manually reset to NULL.

### Manual Testing
To manually trigger the overdue notification check:
```bash
docker compose exec app php artisan tasks:notify-overdue
```

### Architecture
- **Command**: `tasks:notify-overdue` (app/Console/Commands/NotifyOverdueTasks.php)
- **Job**: `SendTaskOverdueNotificationJob` (queued, processes in background)
- **Notification**: `TaskOverdueNotification` (Laravel Mail notification)
- **Scope**: `readyForOverdueNotification()` (filters eligible tasks)

## Queue Workers & Scheduler

### Automatic Background Processing
When you run `docker compose up`, the following services start automatically:

**Queue Worker** (container: `laravel_queue`)
- Processes background jobs (email notifications, etc.)
- Command: `php artisan queue:work`
- Runs continuously
- Auto-restarts on failure

**Scheduler** (container: `laravel_scheduler`)
- Executes scheduled tasks every minute
- Command: `php artisan schedule:run`
- Runs the overdue notification check daily at 00:05

**No manual commands required!** Both queue worker and scheduler run automatically in dedicated containers.

### Monitoring
View queue worker logs:
```bash
docker compose logs -f queue
```

View scheduler logs:
```bash
docker compose logs -f scheduler
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
├── Console/
│   └── Commands/            # Artisan commands (NotifyOverdueTasks)
├── Enums/                   # PHP 8 enum classes
├── Exceptions/              # Custom exceptions
├── Http/
│   ├── Controllers/
│   │   └── Api/V1/         # API controllers
│   ├── Requests/           # Form request validators
│   ├── Resources/          # API resources
│   └── Traits/             # Reusable traits (ApiResponse)
├── Jobs/                   # Queue jobs (SendTaskOverdueNotificationJob)
├── Mail/                   # Mailable classes (legacy, not used)
├── Models/                 # Eloquent models
├── Notifications/          # Notification classes (TaskOverdueNotification)
├── Observers/              # Eloquent observers (ProjectObserver only)
├── Policies/               # Authorization policies
├── Providers/              # Service providers
├── Repositories/
│   ├── Contracts/         # Repository interfaces
│   └── Eloquent/          # Repository implementations
└── Services/               # Business logic services

database/
├── factories/              # Model factories
├── migrations/             # Database migrations
└── seeders/                # Database seeders

routes/
├── api.php                 # API routes
└── console.php             # Scheduled tasks registration

tests/
├── Feature/
│   ├── Api/V1/            # API feature tests
│   └── Auth/              # Authentication tests
└── Unit/                   # Unit tests
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
