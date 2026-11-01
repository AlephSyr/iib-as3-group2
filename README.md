# IIB Assignment 3 (Group 2) — Everyblog

A full-featured blog application built with Laravel 13, featuring a neo-brutalist × Frutiger Aero design, dynamic category labeling, and a complete administrative dashboard with CRUD capabilities.

## Tech Stack

- **Framework:** Laravel 13 (PHP 8.5)
- **Database:** SQLite (default), configurable via `.env`
- **Frontend:** Tailwind CSS v4, Vite 8
- **Testing:** Pest
- **Code Formatter:** Laravel Pint
- **Authentication:** Session-based admin auth (`admin_user_id`)

## Features

- Public blog with post listing, detail view, and category filtering
- "Browse by vibe" category tags on the welcome page with post counts
- Post likes
- Full admin dashboard with statistics and recent posts
- Admin Post CRUD (create, read, update, delete) with publish status, scheduled publishing, and date pickers
- Admin Category CRUD with color picker and active toggle
- Category auto-extraction from post content (`[Category: Name]` markers or keyword matching)
- Admin authentication (login/logout) with protected admin routes

## Team Roles

| Role | Placeholder Name | Responsibilities |
|------|------------------|------------------|
| Lead Programmer | [Alif] | Overall architecture, backend API development, database design, code reviews, deployment |
| Assistant Programmer | [Zenn, Zul] | Supports lead programmer with feature implementation, bug fixes, frontend integration, and maintenance tasks |
| QA Tester | [Zenn] | Test planning, bug reporting, feature verification, regression testing, testing |

## Requirements

- PHP 8.4+
- Composer
- Node.js & npm
- SQLite extension enabled (`pdo_sqlite`)

> **Windows note:** `pdo_sqlite` may be disabled in the default `php.ini`. Use a custom PHP ini scan dir (e.g. `C:\Users\ACER\AppData\Local\Temp\kilo\php-ini`) and set `$env:PHP_INI_SCAN_DIR` before running Artisan/Composer commands.

## Installation

### 1. Clone the repository

```bash
git clone <repository-url>
cd iib-as3-group2
```

### 2. Install PHP dependencies

```bash
composer install
```

### 3. Install Node dependencies

```bash
npm install --ignore-scripts
```

### 4. Configure environment

```bash
copy .env.example .env
```

Generate the application key:

```bash
php artisan key:generate
```

Ensure the SQLite database file exists:

```bash
type nul > database/database.sqlite
# or on PowerShell:
New-Item -ItemType File -Path "database/database.sqlite"
```

### 5. Run migrations and seeders

```bash
php artisan migrate --force
php artisan db:seed --force
```

This creates the database tables and seeds:
- Default categories
- Sample posts
- Admin user: `admin@inkwell.test` / `password`

### 6. Build frontend assets

```bash
npm run build
```

For development with hot reloading:

```bash
npm run dev
```

### 7. Serve the application

```bash
php artisan serve
```

Visit `http://localhost:8000` in your browser.

## One-command setup

The project includes a Composer setup script that runs the full installation:

```bash
composer run setup
```

This installs dependencies, copies `.env.example` to `.env`, generates the key, runs migrations, installs npm packages, and builds assets.

## Testing

Run the full test suite:

```bash
php artisan test
```

Or run a specific test file:

```bash
php artisan test --filter=AdminPostsTest
```

All tests use `RefreshDatabase` and run against an in-memory SQLite database.

## Code Style

This project uses Laravel Pint for PHP formatting. After modifying PHP files, run:

```bash
vendor/bin/pint --dirty --format agent
```

## Project Structure

```
app/
  Http/Controllers/Admin/   # Admin controllers (Post, Category, Dashboard, Auth)
  Http/Middleware/          # AdminMiddleware
  Models/                   # Category, Post models
  Services/                 # CategoryExtractor (auto-categorizes post content)
database/
  migrations/               # Posts, categories, cache, jobs tables
  seeders/                  # DatabaseSeeder, CategorySeeder, PostSeeder, AdminUserSeeder
  factories/                # CategoryFactory, PostFactory, UserFactory
resources/
  views/
    admin/                  # Admin Blade views (dashboard, posts, categories)
    blog/                   # Public blog Blade views (index, show)
    welcome.blade.php       # Landing page
    components/admin-layout.blade.php
routes/
  web.php                   # Web routes (public + admin)
```

## Routes

### Public
| Method | URI | Name | Description |
|--------|-----|------|-------------|
| GET | `/` | `home` | Landing page |
| GET | `/blog` | `blog.index` | Post archive with category filter |
| GET | `/blog/{post}` | `blog.show` | Single post view |
| POST | `/blog/{post}/like` | `blog.like` | Like a post |

### Admin (protected by `admin` middleware)
| Method | URI | Name | Description |
|--------|-----|------|-------------|
| GET | `/admin/login` | `admin.login` | Login form |
| POST | `/admin/login` | `admin.login.store` | Authenticate |
| POST | `/admin/logout` | `admin.logout` | Logout |
| GET | `/admin/dashboard` | `admin.dashboard` | Admin overview |
| GET/POST | `/admin/posts` | `admin.posts.*` | Post CRUD |
| GET/POST | `/admin/categories` | `admin.categories.*` | Category CRUD |

## Admin Credentials

| Email | Password |
|-------|----------|
| `admin@iib.test` | `password` |

Data Seeded via `AdminUserSeeder`.

## Design System

- **Theme:** Neo-brutalist × Frutiger Aero
- **Fonts:** Inter (body), Space Grotesk (display)
- **Colors:** Cyan/sky accents, bold 2px borders, hard drop-shadows, glassy gradients/blurs
- **Dark mode:** Supported via localStorage preference

## Available Commands

```bash
# PHP
composer install              # Install PHP dependencies
composer run setup            # Full one-time setup
php artisan key:generate      # Generate app encryption key
php artisan migrate           # Run database migrations
php artisan db:seed           # Seed database
php artisan serve             # Start development server
php artisan test              # Run Pest tests
php artisan route:list        # List all routes
vendor/bin/pint               # Format PHP code

# Node
npm install                   # Install JS dependencies
npm run build                 # Build production assets
npm run dev                   # Start Vite dev server
```

## License

MIT
