# Derma Clinic Management System

## Overview

Derma Clinic is a comprehensive web-based management system designed for dermatology clinics. Built with Laravel 12, it provides a modern, unified, and user-friendly interface for managing all aspects of clinic operations, including patients, visits, prescriptions, services, chronic diseases, and administrative users. The system is optimized for efficiency, security, and ease of use, with a focus on a visually consistent and professional admin experience.

---

## Table of Contents

- [Features](#features)
- [Project Structure](#project-structure)
- [Modules](#modules)
- [UI/UX Design](#uiux-design)
- [Installation & Setup](#installation--setup)
- [Usage Guide](#usage-guide)
- [Customization](#customization)
- [Testing](#testing)
- [Contributing](#contributing)
- [License](#license)

---

## Features

- **Patient Management:** Register, edit, and track patients with detailed medical history and chronic diseases.
- **Visit Management:** Schedule and record visits, including visit types, services, medications, labs, advices, and files.
- **Prescription Module:** Create, edit, and print prescriptions with medication details.
- **Service & Lab Modules:** Manage clinic services, lab tests, and results.
- **Chronic Disease Tracking:** Assign and monitor chronic diseases for patients.
- **Admin & User Roles:** Secure authentication and role-based access for admins and staff.
- **Modern UI:** Unified, card-based design with colored icons and responsive layouts for all CRUD pages.
- **Audit & History:** Track changes and maintain a history of patient visits and treatments.
- **Localization Ready:** Easily adaptable for multiple languages.

---

## Project Structure

```
├── app/
│   ├── Http/
│   │   ├── Controllers/         # All module controllers (Patients, Visits, Labs, etc.)
│   │   ├── Middleware/          # Custom and default middleware
│   │   └── Requests/            # Form request validation classes
│   ├── Models/                  # Eloquent models for all entities
│   ├── Providers/               # Service providers
│   └── View/Components/         # Blade components for UI reuse
├── bootstrap/                   # Laravel bootstrap files
├── config/                      # Application and module configuration
├── database/
│   ├── factories/               # Model factories for testing
│   ├── migrations/              # Database schema migrations
│   └── seeders/                 # Database seeders
├── public/                      # Public assets and entry point
├── resources/
│   ├── css/                     # Tailwind/Bootstrap CSS
│   ├── js/                      # JavaScript assets
│   ├── lang/                    # Localization files
│   └── views/                   # Blade templates for all modules
├── routes/                      # Route definitions (web, auth, console)
├── storage/                     # Logs, cache, and file uploads
├── tests/                       # Feature and unit tests
├── vendor/                      # Composer dependencies
├── artisan                      # Laravel CLI
├── composer.json                # Composer dependencies
├── package.json                 # NPM dependencies
├── tailwind.config.js           # Tailwind CSS config
├── vite.config.js               # Vite build config
└── README.md                    # Project documentation
```

---

## Modules

### 1. Patients
- Register new patients with personal and contact information
- Assign chronic diseases
- View patient history and visits

### 2. Visits
- Schedule and manage patient visits
- Select visit type (consultation, follow-up, etc.)
- Attach services, medications, labs, advices, and files to each visit

### 3. Prescriptions
- Create and edit prescriptions for visits
- Add medications, dosages, and instructions
- Print or export prescriptions

### 4. Services
- Define and manage clinic services (procedures, consultations, etc.)
- Assign services to visits

### 5. Labs
- Manage lab tests and results
- Attach lab results to visits

### 6. Medications
- Manage medication inventory
- Assign medications to prescriptions and visits

### 7. Advices
- Store and manage medical advices
- Attach advices to visits

### 8. Chronic Diseases
- Define chronic diseases
- Assign to patients for long-term tracking

### 9. Admins
- Manage administrative users
- Assign roles and permissions

---

## UI/UX Design

- **Unified Card Layout:** All index, create, and edit pages use a centered card layout for clarity and focus.
- **Colored SVG Icons:** Each module features a unique, colored icon for quick visual identification (e.g., flask for labs, pill for medications, shield for admins).
- **Consistent Tables:** Data tables are styled with modern colors, rounded corners, and hover effects.
- **Action Buttons:** Edit, delete, and add buttons are color-coded and use Bootstrap icons for clarity.
- **Responsive Design:** Layout adapts to all screen sizes for desktop and mobile use.
- **No Duplicate Headings:** Page titles are clear and not repeated.

---

## Installation & Setup

1. **Clone the Repository:**
   ```
   git clone https://github.com/Mostafaramdan/derma-clinic.git
   cd derma-clinic
   ```

2. **Install Composer Dependencies:**
   ```
   composer install
   ```

3. **Install NPM Dependencies:**
   ```
   npm install
   ```

4. **Copy and Configure Environment File:**
   ```
   cp .env.example .env
   # Edit .env with your database and mail settings
   ```

5. **Generate Application Key:**
   ```
   php artisan key:generate
   ```

6. **Run Migrations and Seeders:**
   ```
   php artisan migrate --seed
   ```

7. **Build Frontend Assets:**
   ```
   npm run build
   ```

8. **Start the Development Server:**
   ```
   php artisan serve
   ```

---

## Usage Guide

1. **Login:** Access the system via `/login` using admin credentials (default admin may be seeded).
2. **Dashboard:** View statistics and quick links to all modules.
3. **Patients:** Add, edit, or search for patients. View their visit and prescription history.
4. **Visits:** Create new visits, attach services, medications, labs, advices, and files.
5. **Prescriptions:** Generate and print prescriptions for each visit.
6. **Admins:** Manage users and assign roles.
7. **Settings:** Configure clinic information and preferences (if available).

---

## Customization

- **Menus:** Edit `config/admin_menu.php` to customize the admin sidebar and navigation.
- **Localization:** Add new languages in `resources/lang/`.
- **UI Components:** Reuse or extend Blade components in `app/View/Components/` for custom UI elements.
- **Add Modules:** Create new models, controllers, migrations, and Blade views following the existing structure.

---

## Testing

- **Unit & Feature Tests:** Located in `tests/Unit/` and `tests/Feature/`.
- **Run All Tests:**
  ```
  php artisan test
  ```
- **Factories & Seeders:** Use model factories and seeders for test data.

---

## Contributing

Contributions are welcome! Please fork the repository, create a feature branch, and submit a pull request. For major changes, open an issue first to discuss your ideas.

---

## License

This project is open-sourced under the MIT license.
