# Docker Setup for Laravel Task Management System

## Prerequisites
- Docker Desktop installed
- Docker Compose installed

## Services Included
- **Laravel App**: PHP 8.3 with Laravel 13
- **MySQL**: Version 8.0
- **phpMyAdmin**: Web interface for MySQL

## Ports
- Laravel App: `http://localhost:8000`
- phpMyAdmin: `http://localhost:8080`
- MySQL: `localhost:3306`

## Database Credentials
- **Database Name**: task_management_db
- **Username**: root
- **Password**: root

## Setup Instructions

### 1. Copy Environment File
```bash
copy .env.example .env
```

### 2. Build and Start Containers
```bash
docker compose up -d --build
```

### 3. Install Dependencies
```bash
docker compose exec app composer install
```

### 4. Generate Application Key
```bash
docker compose exec app php artisan key:generate
```

### 5. Run Migrations
```bash
docker compose exec app php artisan migrate
```

### 6. Install NPM Dependencies (Optional for frontend)
```bash
docker compose exec app npm install
docker compose exec app npm run build
```

## Common Commands

### Start containers
```bash
docker compose up -d
```

### Stop containers
```bash
docker compose down
```

### View logs
```bash
docker compose logs -f app
```

### Access Laravel container shell
```bash
docker compose exec app bash
```

### Run artisan commands
```bash
docker compose exec app php artisan [command]
```

### Access MySQL
```bash
docker compose exec mysql mysql -u laravel_user -plaravel_password laravel
```

## Accessing Services

### Laravel Application
Open your browser and navigate to:
```
http://localhost:8000
```

### phpMyAdmin
Open your browser and navigate to:
```
http://localhost:8080
```
Login with:
- **Server**: mysql
- **Username**: root
- **Password**: root_password

### Postman API Testing
Use base URL:
```
http://localhost:8000/api
```

## Troubleshooting

### Permission Issues
If you encounter permission issues:
```bash
docker compose exec app chown -R www-data:www-data /var/www/storage
docker compose exec app chmod -R 775 /var/www/storage
```

### Clear Cache
```bash
docker compose exec app php artisan cache:clear
docker compose exec app php artisan config:clear
docker compose exec app php artisan route:clear
```

### Reset Database
```bash
docker compose exec app php artisan migrate:fresh --seed
```

## Stopping the Environment
```bash
docker compose down
```

To remove volumes as well (⚠️ this will delete database data):
```bash
docker compose down -v
```
