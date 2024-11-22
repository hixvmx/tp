# Full Stack Developer Technical Test

This guide will walk you through the steps to clone, set up, and run the project locally.

---

## Prerequisites

Before proceeding, ensure that the following software is installed on your machine:

- **PHP** (version 8.1 or higher)
- **Composer** (latest version)
- **MySQL** (or any other supported database)
- **Node.js** and **npm** (for managing front-end dependencies)
- **Git** (for version control)

---

## Installation Instructions

### 1. Clone the repository and install dependencies

Run the following commands in your terminal:

```bash
# Clone the repository
git clone https://github.com/hixvmx/tp.git

# Navigate into the project directory
cd tp

# Install PHP dependencies
composer install

# Install front-end dependencies
npm install

# Build front-end assets
npm run build

# Run database migrations
php artisan migrate

# Seed the database with sample data
php artisan db:seed
```

### 2. Start the development environment

To run the application, execute the following commands simultaneously in different terminal windows:

```bash
# Start the Laravel development server
php artisan serve

# Start the front-end development server
npm run dev

# Start the Laravel queue worker
php artisan queue:work
```

### 3. Access the application
Visit the application in your browser at https://localhost:8000.