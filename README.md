# Task Management API

A professional RESTful API built with **Laravel 13** for managing projects and tasks, with full authentication, authorization, and automated notifications.

## Features

- **Authentication & Authorization** — Laravel Sanctum token-based auth, policy-based access control
- **Project & Task Management** — Full CRUD with status tracking, priorities, and due dates
- **Dashboard** — Aggregate statistics and metrics
- **Filtering & Search** — By status, priority, and title
- **Automated Overdue Notifications** — Scheduled, queued email notifications (one-time per task)
- **Soft Deletes** — Cascading soft delete on projects and tasks
- **Fully Dockerized** — App, queue worker, scheduler, database, and mail testing, all containerized
- **Tested** — Comprehensive Pest test suite
- **Documented** — Complete Postman collection included

## Tech Stack

| Layer | Technology |
|---|---|
| Framework | Laravel 13 (PHP 8.3) |
| Database | MySQL 8.0 |
| Auth | Laravel Sanctum |
| Queue | Database driver |
| Scheduling | Laravel Scheduler |
| Testing | Pest |
| Containerization | Docker & Docker Compose |

## Architecture

**Patterns:** Repository Pattern · Service Layer · API Resources · Policy-Based Authorization · Observer Pattern · Enums for statuses/priorities

**Domain models:**
- **Users** — application users with authentication
- **Projects** — user-owned, with status (Active / Completed / Archived)
- **Tasks** — project-scoped, with priority (Low / Medium / High) and status (Todo / In Progress / Done)

**Key components:**
- `NotifyOverdueTasks` command → `SendTaskOverdueNotificationJob` (queued) → `TaskOverdueNotification`
- `readyForOverdueNotification()` scope filters eligible tasks
- `overdue_notified_at` ensures each task is notified only once

```
app/
├── Console/Commands/       # NotifyOverdueTasks
├── Enums/
├── Http/Controllers/Api/V1/
├── Jobs/                   # SendTaskOverdueNotificationJob
├── Models/
├── Notifications/          # TaskOverdueNotification
├── Observers/               # ProjectObserver
├── Policies/
├── Repositories/{Contracts,Eloquent}/
└── Services/

database/{factories,migrations,seeders}/
routes/{api.php,console.php}
tests/{Feature,Unit}/
```

## Getting Started

**Prerequisites:** Docker Desktop, Git

```bash
git clone <repository-url>
cd task_management_system
cp .env.example .env
docker compose up -d --build
```

That single command builds all containers, installs dependencies, generates the app key, runs migrations, and seeds the database. No manual steps required.

### Access Points

| Service | URL | Credentials |
|---|---|---|
| API | http://localhost:8000 | — |
| phpMyAdmin | http://localhost:8080 | root / root |
| Mailpit (email testing) | http://localhost:8025 | — |
| MySQL | localhost:3306 | root / root |

### Docker Services

| Container | Purpose |
|---|---|
| `app` | Laravel application (port 8000) |
| `mysql` | MySQL 8.0 database |
| `phpmyadmin` | Database management UI |
| `queue` | Background job worker |
| `scheduler` | Runs the task scheduler every minute |
| `mailpit` | Captures outgoing email for testing |

## API Endpoints

**Auth**
```
POST /api/v1/register
POST /api/v1/login
POST /api/v1/logout          (auth required)
```

**Dashboard**
```
GET /api/v1/dashboard         (auth required)
```

**Projects**
```
GET    /api/v1/projects
GET    /api/v1/projects/statuses
POST   /api/v1/projects
GET    /api/v1/projects/{id}
PUT    /api/v1/projects/{id}
DELETE /api/v1/projects/{id}   (soft delete)
```

**Tasks**
```
GET    /api/v1/projects/{project}/tasks
GET    /api/v1/tasks/priorities
GET    /api/v1/tasks/statuses
POST   /api/v1/projects/{project}/tasks
GET    /api/v1/tasks/{id}
PUT    /api/v1/tasks/{id}
DELETE /api/v1/tasks/{id}       (soft delete)
```

Query params for tasks: `status` (todo / in_progress / done), `priority` (low / medium / high), `search`.

## API Documentation

Complete interactive API documentation is available via **Swagger/OpenAPI**:

**📚 Access Swagger UI:** http://localhost:8000/api/documentation

### Features:
- ✅ **Interactive API Explorer** - Test all endpoints directly from your browser
- ✅ **Authentication Support** - Use the "Authorize" button to set your Bearer token
- ✅ **Complete Request/Response Examples** - See exactly what to send and expect
- ✅ **Auto-Generated** - Documentation stays in sync with code

### Quick Start:
1. Open http://localhost:8000/api/documentation
2. Click **"Authorize"** button (🔒 icon at top right)
3. Enter: `Bearer {your-token}` (get token from `/api/v1/login` endpoint)
4. Click **"Authorize"** then **"Close"**
5. Try any endpoint by clicking **"Try it out"**

### Getting Your Token:
```bash
# Login first
curl -X POST http://localhost:8000/api/v1/login \
  -H "Content-Type: application/json" \
  -d '{"email":"admin@example.com","password":"password"}'

# Copy the token from the response and use it in Swagger UI
```

## Testing

```bash
docker compose exec app php artisan test
docker compose exec app php artisan test --filter AuthenticationTest
docker compose exec app php artisan test --filter ProjectTest
docker compose exec app php artisan test --filter TaskTest
docker compose exec app php artisan test --filter DashboardTest
```

Covers authentication, project/task CRUD with authorization, filtering, dashboard stats, and validation/error handling.

## Database Seeding

Seeded automatically on first `docker compose up`. To reseed manually:

```bash
docker compose exec app php artisan db:seed
```

Creates 3 users (`admin@example.com`, `test@example.com`, `demo@example.com` — password: `password`), 3–5 projects each, and 5–10 tasks per project with varied statuses, priorities, and overdue dates.

## Overdue Task Notifications

**How it works:**
1. Scheduler runs daily at `09:05`
2. Finds tasks where `due_date` is past, `status` ≠ Done, and `overdue_notified_at` is `NULL`
3. Sends an email to the project owner via a queued job
4. Sets `overdue_notified_at` to prevent duplicate notifications

**Manual trigger:**
```bash
docker compose exec app php artisan tasks:notify-overdue
```

**Testing with Mailpit:** open http://localhost:8025, create a task with a past `due_date`, then run the command above. All emails are captured locally — nothing is sent to real addresses.

To speed up testing, `routes/console.php` supports switching the schedule to `->everyMinute()` temporarily; always revert to `->dailyAt('09:05')` before committing.

## Useful Commands

```bash
# Logs
docker compose logs -f app
docker compose logs -f queue
docker compose logs -f scheduler

# Shell access
docker compose exec app bash

# Cache
docker compose exec app php artisan optimize:clear

# Code style
docker compose exec app ./vendor/bin/pint

# Stop / rebuild
docker compose down
docker compose up -d --build
```

## Response Format

```json
// Success
{ "success": true, "message": "Operation successful", "data": {} }

// Error
{ "success": false, "message": "Error message", "errors": {} }

// Paginated
{
  "success": true,
  "message": "Data retrieved successfully",
  "data": {
    "data": [],
    "links": { "first": "...", "last": "...", "prev": null, "next": "..." },
    "meta": { "current_page": 1, "from": 1, "last_page": 5, "per_page": 15, "to": 15, "total": 65 }
  }
}
```

## Environment Variables

See `.env.example` for the full list. Key defaults:

```env
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=mysql
DB_DATABASE=task_management_db
DB_USERNAME=root
DB_PASSWORD=root

QUEUE_CONNECTION=database
CACHE_STORE=database

MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
```

For production, replace the `MAIL_*` block with real SMTP credentials.

## Security

Sanctum token auth · bcrypt password hashing · policy-based authorization · input validation · Eloquent ORM (SQL injection protection) · XSS/CSRF protection · rate limiting

## License

MIT