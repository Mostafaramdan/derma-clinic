# Copilot Instructions for Derma Clinic

## Project Overview
- **Domain:** Dermatology clinic management system
- **Framework:** Laravel 12 (PHP), Tailwind CSS, Vite, Bootstrap, Blade
- **Purpose:** Manage patients, visits, prescriptions, services, labs, chronic diseases, and admin users in a unified web app.

## Architecture & Key Patterns
- **Modular Structure:**
  - Each domain (Patients, Visits, Labs, etc.) has its own Model, Controller, Migration, Seeder, and Blade views.
  - All CRUD operations use a card-based, centered UI layout with colored SVG icons per module.
- **Data Flow:**
  - Eloquent models in `app/Models/` represent all major entities.
  - Controllers in `app/Http/Controllers/` handle business logic and route requests.
  - Blade templates in `resources/views/` are organized by module.
  - Route definitions are in `routes/web.php` (web), `routes/auth.php` (auth), and `routes/console.php` (CLI).
- **Admin Menu:**
  - Sidebar/menu structure is defined in `config/admin_menu.php`.
- **Localization:**
  - All user-facing text is translatable via `resources/lang/`.

## Developer Workflows
- **Setup:**
  - `composer install` (PHP deps), `npm install` (JS/CSS deps)
  - Copy `.env.example` to `.env` and configure
  - `php artisan key:generate`
  - `php artisan migrate --seed` (migrates and seeds DB)
  - `npm run build` (builds frontend assets)
  - `php artisan serve` (dev server)
- **Testing:**
  - Run all tests: `php artisan test`
  - Tests are in `tests/Feature/` and `tests/Unit/`
  - Use model factories in `database/factories/` for test data
- **Frontend:**
  - Uses Tailwind CSS and Bootstrap for styling
  - Vite for asset bundling (`vite.config.js`)
- **Blade Components:**
  - Shared UI in `app/View/Components/`
  - Follow card-based, icon-driven design for all CRUD pages

## Project-Specific Conventions
- **No duplicate page headings** in Blade views
- **Action buttons** (edit, delete, add) use Bootstrap icons and color coding
- **All tables** are styled with rounded corners and hover effects
- **Admin roles/permissions** managed via seeders and `config/permission.php`
- **New modules** should follow the existing structure: Model, Controller, Migration, Seeder, Blade views

## Integration Points
- **Database:** SQLite by default (`database/database.sqlite`), configurable in `.env`
- **Authentication:** Laravel built-in, with role-based access
- **Localization:** Add new languages in `resources/lang/`
- **Menu:** Update `config/admin_menu.php` for navigation changes

## Examples
- To add a new module (e.g., Allergies):
  1. Create model in `app/Models/Allergy.php`
  2. Create migration in `database/migrations/`
  3. Create controller in `app/Http/Controllers/AllergyController.php`
  4. Add Blade views in `resources/views/allergies/`
  5. Update `config/admin_menu.php`

- To run all tests:
  ```
  php artisan test
  ```

- To build frontend assets:
  ```
  npm run build
  ```

---

For more details, see `README.md` and module-specific files. When in doubt, follow the structure and conventions of existing modules.
