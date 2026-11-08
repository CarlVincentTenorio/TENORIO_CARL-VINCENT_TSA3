# Tasks for Today Management System

A Laravel application developed by **Carl Vincent Tenorio** for IT0049 Web System Technologies, Technical Summative Assessment 3. It displays today's tasks, a complete task list ordered by date, one user profile, and an About page.

Repository: https://github.com/CarlVincentTenorio/TENORIO_CARL-VINCENT_TSA3

**Hosted application:** Add your working public application URL here after deployment.

## Requirements

- PHP 8.2 or newer, with Laravel's required extensions and `pdo_sqlite` for the default database.
- Composer 2.
- Git to clone the repository.

This project uses Laravel 12, Blade, Eloquent, SQLite, and a local CSS stylesheet. Its pages run without an npm build step. The default development database is SQLite; MySQL is also supported through Laravel's database configuration.

## Setup on Windows PowerShell

Clone the completed repository, install dependencies, and create your local environment:

```powershell
git clone https://github.com/CarlVincentTenorio/TENORIO_CARL-VINCENT_TSA3.git
cd TENORIO_CARL-VINCENT_TSA3
composer install
Copy-Item .env.example .env
```

Create an empty SQLite file if it does not already exist:

```powershell
if (-not (Test-Path database/database.sqlite)) { New-Item -ItemType File -Path database/database.sqlite }
```

Generate an application key, create the schema, seed the records, and start the server:

```powershell
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

Open http://127.0.0.1:8000. If `php` is not recognized, add your PHP installation folder to PATH. If SQLite is unavailable, run `php --ini`, enable `extension=pdo_sqlite` in that configuration file, and reopen your terminal.

## Pages

| URL | Behavior |
| --- | --- |
| `/` | Welcome page displaying only tasks whose `task_date` is today. |
| `/tasks` | All tasks ordered by date ascending, with ID as a stable secondary order. |
| `/profile` | The single seeded user's username, full name, and email. |
| `/about` | Static project information identifying Carl Vincent Tenorio as the developer. |

Dates use the `Asia/Manila` application timezone, configured by `APP_TIMEZONE`.

## Database

The `tasks` migration creates `id`, `title`, `status` with a database default of `pending`, `task_date`, and timestamps. The `users` migration creates `id`, unique `username`, `full_name`, `email`, and timestamps.

On a fresh database, the seeder creates **8 tasks across 3 dates**: 2 yesterday, 3 today, and 3 tomorrow, together with **exactly 1 user record**. The profile uses the sample email `carlvincent@example.com`; replace it in `database/seeders/DatabaseSeeder.php` with your preferred address.

To update the sample records and move their dates around the current day:

```powershell
php artisan db:seed
```

The seeder updates the same records by task title and username, so repeating it does not duplicate its eight tasks or user. It resets those sample tasks to their seeded statuses and leaves unrelated manually added records alone. The Welcome page always uses the actual current date; it can correctly become empty when no stored task is scheduled for that date.

Migrations and seeders are included so the database can be recreated without a separate SQL export. Additional cache and queue migrations from the standard Laravel skeleton may also be present.

## MVC structure

- `routes/web.php` maps each required URL to a controller method.
- `TaskController` retrieves today's tasks and the complete task list using Eloquent.
- `PageController` retrieves the profile and renders About.
- `Task` and `User` define the application models and mass-assignment fields.
- `resources/views` contains the four page views, their shared layout, and the shared task-table partial.
- `public/css/app.css` styles the application and its mobile layout.

## Verification

```powershell
php artisan test
php artisan view:cache
php artisan route:list --except-vendor
```

Feature tests cover today's date filtering, the complete list's ordering, profile data, developer attribution, empty states, the database default status, username uniqueness, repeat seeding across dates, and HTML escaping. Tests use an in-memory SQLite database. Run these checks in your PHP environment before submission.

After the initial seed, verify that Welcome displays 3 tasks, Task List displays 8 tasks across 3 dates, Profile displays the seeded user, and About identifies the developer. Also check the pages at a narrow browser width.

## Optional MySQL configuration

Create an empty `tsa3_db` database in MySQL or phpMyAdmin. Replace the SQLite database settings in `.env` with your MySQL connection details:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tsa3_db
DB_USERNAME=root
DB_PASSWORD=
```

Use the actual account and password for your database. Then run:

```powershell
php artisan config:clear
php artisan migrate --seed
```

PHP must have `pdo_mysql` enabled. The tests continue to use isolated SQLite data.

## Deployment and submission

Deploy to a host that can run PHP and Laravel. Point the web document root at this project's **`public`** directory. Configure production environment variables on the host, including `APP_ENV=production`, `APP_DEBUG=false`, your public `APP_URL`, a generated `APP_KEY`, `APP_TIMEZONE=Asia/Manila`, and the host's database credentials.

Install production dependencies and initialize the database:

```bash
composer install --no-dev --optimize-autoloader
php artisan migrate --seed --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

Generate an application key once for a new deployment if the host has not already provided one, before caching configuration. The host must permit writes to `storage` and `bootstrap/cache`. SQLite deployments need a persistent writable database file; use the host's supported database service when the filesystem is temporary.

Verify `/`, `/tasks`, `/profile`, and `/about` on the public URL. A local development address and a GitHub source URL are not publicly hosted application URLs. GitHub Pages cannot execute this PHP application.

Submit both the GitHub repository link and the working hosted application link. Replace the hosted-application placeholder near the beginning of this README with your actual URL.

Keep `.env`, `vendor`, `node_modules`, and local SQLite data out of Git. Commit `.env.example`, `composer.json`, `composer.lock`, the source code, migrations, seeders, and this README.

## References

- Laravel 12 installation: https://laravel.com/docs/12.x/installation
- Eloquent: https://laravel.com/docs/12.x/eloquent
- Query builder date filtering and ordering: https://laravel.com/docs/12.x/queries
- Database seeding: https://laravel.com/docs/12.x/seeding
- Deployment: https://laravel.com/docs/12.x/deployment
