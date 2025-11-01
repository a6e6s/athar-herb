# Technology Stack & Development

## Core Technologies

### Backend Framework
- **Laravel 12**: Latest PHP framework with modern features
- **PHP 8.2+**: Required minimum version for Laravel 12 compatibility
- **Filament 4.0**: Admin panel framework for rapid CRUD interface development

### Frontend Technologies
- **Tailwind CSS 4.0**: Utility-first CSS framework
- **Vite 7.0**: Modern build tool and development server
- **Blade Templates**: Laravel's templating engine
- **Axios**: HTTP client for API requests

### Database & ORM
- **Eloquent ORM**: Laravel's built-in database abstraction
- **Database Migrations**: Version-controlled schema management
- **Model Factories**: Test data generation with Faker integration

### Development Tools
- **Laravel Pint**: PHP code style fixer
- **Pest 4.1**: Modern PHP testing framework
- **Laravel Sail**: Docker development environment
- **Blueprint**: Model and migration generator from YAML

## Development Commands

### Setup & Installation
```bash
composer run setup          # Full project setup
composer install           # Install PHP dependencies
npm install                # Install Node.js dependencies
php artisan key:generate    # Generate application key
php artisan migrate         # Run database migrations
```

### Development Workflow
```bash
composer run dev           # Start development servers (PHP, queue, Vite)
php artisan serve         # Start Laravel development server
npm run dev               # Start Vite development server
php artisan queue:listen  # Process background jobs
```

### Testing & Quality
```bash
composer run test         # Run test suite
php artisan test         # Alternative test command
vendor/bin/pint          # Fix code style
vendor/bin/pest          # Run Pest tests directly
```

### Build & Deployment
```bash
npm run build            # Build production assets
php artisan config:cache # Cache configuration
php artisan route:cache  # Cache routes
php artisan view:cache   # Cache Blade templates
```

## Package Dependencies

### Production Dependencies
- **filament/filament**: Admin panel framework
- **laravel/framework**: Core Laravel framework
- **laravel/tinker**: Interactive PHP REPL

### Development Dependencies
- **fakerphp/faker**: Test data generation
- **laravel-shift/blueprint**: Model generation from YAML
- **pestphp/pest**: Testing framework
- **nunomaduro/collision**: Error reporting

## Configuration Files
- **composer.json**: PHP dependency management and scripts
- **package.json**: Node.js dependencies and build scripts
- **vite.config.js**: Frontend build configuration
- **phpunit.xml**: Testing configuration
- **.env**: Environment-specific configuration