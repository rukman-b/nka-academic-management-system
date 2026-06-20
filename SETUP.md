# Setup Guide

***NKA Academic Management System***

---

## Introduction

This guide explains how to set up the **NKA Academic Management System** locally using Docker.

The project is designed so that readers can clone the repository, start the containers, install dependencies, prepare the database, and run the baseline test suite with minimal manual configuration.

The setup uses Docker for the main development services, so PHP, MariaDB, Redis, and Nginx do not need to be installed directly on the host machine.

---

## Technology Stack

The project uses the following stack:

* Laravel 11
* PHP 8.2
* Livewire 3
* AdminLTE 3
* MariaDB 10.11
* Redis
* Nginx
* Docker Compose
* Vite
* Pest / PHPUnit for testing

---

## Prerequisites

Before starting, make sure the following tools are installed:

* Git
* Docker
* Docker Compose

On Linux, Docker should also be running:

```bash
sudo systemctl start docker
```

To verify Docker is working:

```bash
docker ps
```

---

## Clone the Repository

```bash
git clone https://github.com/rukman-b/nka-academic-management-system.git
cd nka-academic-management-system
```

---

## Quick Setup

The recommended setup method is to use the provided setup script:

```bash
chmod +x setup.sh
./setup.sh
```

The script will:

* Create `.env` from `.env.example` if it does not already exist
* Create required Laravel runtime folders
* Build and start Docker containers
* Install Composer dependencies
* Generate the Laravel application key
* Prepare the application database
* Prepare the testing database
* Run migrations
* Run seeders
* Create the Laravel storage link
* Apply required runtime permissions

After the setup completes, the application should be available locally.

---

## Application URLs

| Service         | URL                   |
| --------------- | --------------------- |
| Application     | http://localhost:8000 |
| phpMyAdmin      | http://localhost:8080 |
| Vite Dev Server | http://localhost:5173 |

These ports can be changed in `.env` using the forwarding variables described below.

---

## Environment Configuration

The project uses `.env.example` as the public template for local configuration.

During setup, this file is copied to:

```text
.env
```

The `.env` file is used for the local Docker development environment.

Important database values:

```env
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=nka_hub
DB_USERNAME=nka_user
DB_PASSWORD=secret
DB_ROOT_PASSWORD=secret
DB_TEST_DATABASE=nka_hub_testing
```

### Host Port Forwarding

The Docker containers use internal service ports, while the host machine accesses them through forwarded ports.

The default forwarded ports are:

```env
APP_FORWARD_PORT=8000
PHPMYADMIN_FORWARD_PORT=8080
VITE_FORWARD_PORT=5173
DB_FORWARD_PORT=3307
REDIS_FORWARD_PORT=6380
```

This means:

* The Laravel application is available at `localhost:8000`
* phpMyAdmin is available at `localhost:8080`
* Vite is available at `localhost:5173`
* MariaDB is available from the host at `localhost:3307`
* Redis is available from the host at `localhost:6380`

Inside Docker, Laravel still connects to MariaDB using:

```env
DB_HOST=db
DB_PORT=3306
```

---

## Docker Services

The Docker setup starts the following services:

| Service      | Purpose                             |
| ------------ | ----------------------------------- |
| `laravel`    | PHP / Laravel application container |
| `nginx`      | Web server                          |
| `db`         | MariaDB database                    |
| `redis`      | Cache, session, and queue support   |
| `node`       | Vite development server             |
| `phpmyadmin` | Browser-based database management   |

To check container status:

```bash
docker compose ps
```

---

## Daily Workflow

Start the system:

```bash
docker compose up -d
```

Stop the system:

```bash
docker compose down
```

Stop the system and delete Docker volumes:

```bash
docker compose down -v
```

Use `docker compose down -v` carefully because it deletes local database data stored in Docker volumes.

---

## Manual Setup

The quick setup script is recommended. However, the project can also be set up manually.

### 1. Copy the environment file

```bash
cp .env.example .env
```

### 2. Start Docker containers

```bash
docker compose up -d --build
```

### 3. Run the Laravel setup script inside the container

```bash
docker compose exec --user root laravel sh docker/setup.sh
```

This internal setup script installs dependencies, generates the application key, prepares databases, runs migrations, runs seeders, creates the storage link, and fixes runtime permissions.

---

## Database Setup

The project uses two local databases:

| Database          | Purpose                         |
| ----------------- | ------------------------------- |
| `nka_hub`         | Main local application database |
| `nka_hub_testing` | Automated testing database      |

The setup script creates and prepares both databases.

The application uses:

```env
DB_DATABASE=nka_hub
```

The test suite uses:

```env
DB_DATABASE=nka_hub_testing
```

This separation prevents automated tests from modifying the normal local application database.

---

## Testing Configuration

The active test suite uses Pest / PHPUnit.

Run tests with:

```bash
docker compose exec laravel php artisan test
```

The test configuration is mainly defined in:

```text
phpunit.xml
```

The testing environment uses:

```env
APP_ENV=testing
DB_DATABASE=nka_hub_testing
CACHE_STORE=array
SESSION_DRIVER=array
QUEUE_CONNECTION=sync
MAIL_MAILER=array
```

This keeps tests fast and separate from the normal Redis-backed local application environment.

---

## Laravel Scheduler and Cron

The project includes a Laravel scheduled command for cleaning old login attempt records.

To view the registered scheduled tasks:

```bash
docker compose exec laravel php artisan schedule:list
```

Example schedule:

```text
0 3 1 * *  php artisan cleanup:login-attempts
```

This means the command is scheduled to run monthly on the first day of the month at 03:00.

To run due scheduled tasks through Laravel's scheduler:

```bash
docker compose exec laravel php artisan schedule:run
```

The cleanup command can also be run manually:

```bash
docker compose exec laravel php artisan cleanup:login-attempts
```

This command affects the `login_attempts` table. It deletes only old login attempt records, usually records older than 90 days. It does not clear all login attempt records.

Scheduler execution history is stored separately in the `scheduler_logs` table. The Sysadmin dashboard uses this table to display the **Cron Scheduler Execution Duration** chart.

To check recent scheduler logs:

```bash
docker compose exec laravel php artisan tinker
```

```php
\App\Models\SchedulerLog::latest()->take(5)->get();
```

If the scheduler chart is empty, it usually means no due scheduled task has run yet, or no scheduler log records exist.

---

## Active Tests and Legacy Tests

The active test suite currently contains a small baseline set of tests. These tests verify that the application can boot, the testing environment is active, and the core setup is working.

Active test locations:

```text
tests/Unit
tests/Feature
```

Legacy tests from an earlier schema/design stage are kept in:

```text
tests/_legacy
```

The legacy tests are intentionally excluded from the active PHPUnit test suite. They are preserved for future refactoring after being aligned with the current database schema, factories, seeders, and Livewire components.

This allows the repository to keep a stable passing baseline while still retaining earlier test work for future improvement.

---

## Useful Commands

### Run tests

```bash
docker compose exec laravel php artisan test
```

### Clear Laravel cache

```bash
docker compose exec --user root laravel php artisan optimize:clear
```

### Run migrations

```bash
docker compose exec --user root laravel php artisan migrate
```

### Run seeders

```bash
docker compose exec --user root laravel php artisan db:seed
```

### Open a shell inside the Laravel container

```bash
docker compose exec laravel sh
```

### Open Tinker

```bash
docker compose exec laravel php artisan tinker
```

### View container logs

```bash
docker compose logs
```

For a specific service:

```bash
docker compose logs laravel
docker compose logs nginx
docker compose logs db
```

---

## Runtime Folders and Permissions

Laravel requires several runtime folders for cache, sessions, logs, compiled views, and public storage.

The setup scripts create and prepare these folders automatically:

```text
storage/app/public
storage/framework/cache/data
storage/framework/sessions
storage/framework/testing
storage/framework/views
storage/logs
bootstrap/cache
```

Only placeholder `.gitignore` files are committed inside these runtime folders. Generated files such as logs, sessions, cache files, compiled views, and Debugbar files should not be committed to Git.

---

## phpMyAdmin Access

phpMyAdmin is available at:

```text
http://localhost:8080
```

Default login values:

```text
Server: db
Username: nka_user
Password: secret
```

The database used by the application is:

```text
nka_hub
```

The database used by automated tests is:

```text
nka_hub_testing
```

---

## Project Notes

This repository represents a Phase 1 implementation of the NKA Academic Management System.

Current focus areas include:

* Staff-side administration
* Role-based access control
* Multi-guard authentication structure
* Academic management foundations
* Docker-based local development
* Baseline automated testing

Student and employer-facing areas are partially implemented and may be extended in future phases.

All sample data is synthetic and intended for development or demonstration purposes only.

---

## Troubleshooting

### Docker containers do not start

Check Docker is running:

```bash
sudo systemctl start docker
docker ps
```

Then rebuild:

```bash
docker compose up -d --build
```

---

### Application key is missing

Run:

```bash
docker compose exec --user root laravel php artisan key:generate
```

---

### Database connection fails

Check the containers:

```bash
docker compose ps
```

Check database logs:

```bash
docker compose logs db
```

Confirm `.env` contains:

```env
DB_HOST=db
DB_PORT=3306
DB_DATABASE=nka_hub
DB_USERNAME=nka_user
DB_PASSWORD=secret
```

---

### Tests fail because the test database is missing

Run the internal setup script again:

```bash
docker compose exec --user root laravel sh docker/setup.sh
```

Then clear Laravel cache:

```bash
docker compose exec --user root laravel php artisan optimize:clear
```

Run tests again:

```bash
docker compose exec laravel php artisan test
```

---

### Permission issues in `storage` or `bootstrap/cache`

Run:

```bash
docker compose exec --user root laravel sh docker/setup.sh
```

The setup script recreates required folders and applies the expected runtime permissions.

---

### Clear Laravel Log File

Laravel writes application logs to the following file:

```text
storage/logs/laravel.log
```

In the Docker development environment, this file may be owned by the container user, usually `www-data`. Because of this, the file may not be directly editable from the host machine.

To clear the Laravel log file safely, run:

```bash
docker compose exec laravel truncate -s 0 storage/logs/laravel.log
```

Alternatively, the log file can be cleared from the host machine using:

```bash
sudo truncate -s 0 storage/logs/laravel.log
```

---

## Resetting the Local Environment

To fully reset the Docker environment, including database data:

```bash
docker compose down -v
```

Then run setup again:

```bash
./setup.sh
```

Use this only when a clean local database is required.

---

## Next Steps

After setup, readers can explore:

* Laravel routes
* Admin dashboards
* RBAC permissions
* Multi-guard authentication structure
* Academic data models
* Docker service architecture
* Baseline automated tests

To run the test suite:

```bash
docker compose exec laravel php artisan test
```
