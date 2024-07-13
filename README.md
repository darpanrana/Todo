# Todo App

A simple and intuitive Todo application built with Laravel.

## Table of Contents

- [Features](#features)
- [Installation](#installation)
- [Usage](#usage)

## Features

- User authentication (registration, login)
- Create, read, update, and delete tasks
- Mark tasks as complete or incomplete
- Responsive design

## Installation

1. Clone the repository:

    ```bash
    git clone https://github.com/your-username/todo-app.git
    ```

2. Navigate to the project directory:

    ```bash
    cd todo-app
    ```

3. Install the dependencies:

    ```bash
    composer install
    ```

4. Copy the `.env.example` file to `.env` and configure your environment variables:

    ```bash
    cp .env.example .env
    ```

5. Generate the application key:

    ```bash
    php artisan key:generate
    ```

6. Set up the database:

    - Configure your database settings in the `.env` file
    - Run the migrations:

        ```bash
        php artisan migrate
        ```

7. (Optional) Seed the database with sample data:

    ```bash
    php artisan db:seed
    ```

8. Serve the application:

    ```bash
    php artisan serve
    ```

    The application will be available at `http://localhost:8000`.

## Usage

1. Register a new account or log in with an existing account.
2. Create a new task by filling in the task name and clicking "Add Task".
3. Manage your tasks:
    - Mark tasks as complete or incomplete by clicking the checkbox.
    - Edit tasks by clicking the "Edit" button.
    - Delete tasks by clicking the "Delete" button.