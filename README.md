# E-Intendance

E-Intendance is a project designed to streamline and manage budget-related administrative tasks between two types of users: **transmitter** and **admin**. The transmitter can suggest budget commands (requests), and the admin reviews each command to accept or reject it, ensuring efficient and controlled budget management.

## Features

- Budget command suggestion and approval workflow
- Role-based access: émetteur (transmitter) and admin
- Task management and tracking
- User authentication and roles
- Reporting and analytics
- Responsive user interface

## Installation

```bash
git clone https://github.com/yourusername/E-Intendance.git
cd E-Intendance
# Install PHP dependencies
composer install
# Copy and configure environment variables
cp .env.example .env
php artisan key:generate
# Run database migrations
php artisan migrate
```

## Usage

```bash
# Start the local development server
php artisan serve
```

Access the app at `http://localhost:8000`.

You can log in as an admin using the following credentials:

```
email: bachari@lisi-budget.com
password: password
```

You can log in as a user using the following credentials:

```
email: Transmitter@lisi-budget.com
password: password
```

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/YourFeature`)
3. Commit your changes (`git commit -am 'Add new feature'`)
4. Push to the branch (`git push origin feature/YourFeature`)
5. Open a pull request

## Contact

For questions or support, please open an issue or contact the maintainer.

