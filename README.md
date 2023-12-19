# AR Bus Ticketing System

AR Bus Ticketing System is a PHP-based web application that allows administrators to manage bus bookings, view booking history, and perform CRUD operations on buses and routes.

## Features

- Admin can view and manage bus bookings.
- CRUD operations on buses (Add, Delete).
- View and manage booking history.
- Print tickets functionality.

## Getting Started

### Prerequisites

- Web server (e.g., Apache, Nginx)
- PHP 7.0 or higher
- MySQL database

### Installation

1. **Configure your web server:**

   Set up your web server to serve the project from the desired directory.

2. **Import the database schema:**

   - Use the provided `ar_bus.sql` file to create the necessary tables.

3. **Update the database connection details:**

   - Open `includes/db.php` and modify the database connection parameters:

     ```php
     $servername = "localhost";
     $username = "your-username";
     $password = "your-password";
     $database = "ar_bus";
     ```

4. **Access the application:**

   - Open your web browser and navigate to the project's URL.

## Usage

- Log in as an administrator to access the admin dashboard.
- Use the navigation menu to perform various actions, such as managing buses, viewing booking history, etc.


