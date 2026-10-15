# Appointment Booking – Laravel Backend

## Overview

This repository contains the Laravel REST API backend for the Appointment Booking application. It provides API endpoints for authentication and role management, with plans to support additional appointment management features.

The frontend is built using React, and the backend uses Laravel with MySQL.

## Tech Stack

- **Backend:** Laravel, PHP
- **Database:** MySQL
- **Authentication:** Laravel Sanctum
- **API:** RESTful API
- **Frontend:** React (separate project)

## Features

### Authentication
- User login
- Token-based authentication using Laravel Sanctum
- Retrieve the authenticated user
- Logout and revoke the current access token
- Protected API routes

### Role Management
- List roles with pagination
- Create a role
- Retrieve a role by ID
- Update a role
- Delete a role
- Validate role names and prevent duplicate names

### Error Handling
- Validation errors
- Not-found responses for missing roles
- Authentication error responses for protected endpoints

## Requirements

- PHP version supported by your installed Laravel version
- Composer
- MySQL
- Node.js and npm for the separate React frontend

## Installation

### 1. Clone the repository

```bash
git clone <your-repository-url>
cd <your-laravel-project-folder>
```

### 2. Install PHP dependencies

```bash
composer install
```

### 3. Configure environment variables

Copy the example environment file:

```bash
cp .env.example .env
```

Configure your database settings in `.env`:

```env
APP_NAME="Appointment Booking"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=appointment_booking
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```

Use your own local database credentials. Do not commit `.env` or publish real credentials.

### 4. Generate the application key

```bash
php artisan key:generate
```

### 5. Create the database

Create a MySQL database named `appointment_booking`, or use another name and update `.env` accordingly.

### 6. Run migrations

```bash
php artisan migrate
```

If your project has seeders configured