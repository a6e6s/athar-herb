# Project Structure & Architecture

## Directory Organization

### Core Application (`app/`)
- **Models/**: Eloquent models for all entities (User, Product, Order, Category, etc.)
- **Http/Controllers/**: Request handling and business logic
- **Providers/**: Service providers including Filament admin panel configuration

### Database Layer (`database/`)
- **migrations/**: Database schema definitions with timestamped migration files
- **factories/**: Model factories for testing and seeding data
- **seeders/**: Database population scripts

### Frontend Assets (`resources/`)
- **views/**: Blade templates (minimal - primarily using Filament)
- **css/**: Tailwind CSS styling
- **js/**: JavaScript assets and Vite configuration

### Configuration (`config/`)
- Standard Laravel configuration files for app, database, auth, cache, etc.
- Filament admin panel configuration

### Public Assets (`public/`)
- **css/filament/**: Compiled Filament admin styles
- **js/filament/**: Compiled Filament admin scripts
- **fonts/filament/**: Admin panel typography assets

## Core Components & Relationships

### E-commerce Models
- **User**: Customer and admin accounts with role-based access
- **Category**: Hierarchical product categorization with parent-child relationships
- **Product**: Central inventory item with pricing, stock, and metadata
- **Order/OrderItem**: Order processing with line item details
- **Review**: Product feedback system with approval workflow
- **Wishlist**: Customer product favorites

### CMS Models
- **Page**: Static content pages with SEO optimization
- **Post**: Blog system with publishing workflow
- **Testimonial**: Customer testimonials with approval system
- **Banner**: Homepage promotional content
- **Faq**: Organized help content

### Pivot Relationships
- **category_product**: Many-to-many product categorization

## Architectural Patterns

### MVC Architecture
- **Models**: Eloquent ORM for database interactions
- **Views**: Blade templating with Filament admin interface
- **Controllers**: Request routing and business logic

### Admin Interface
- **Filament Framework**: Modern admin panel with form builders and table views
- **Resource-based**: Each model has corresponding Filament resource for CRUD operations

### Database Design
- **Migration-driven**: Version-controlled schema changes
- **Factory-supported**: Consistent test data generation
- **Relationship-rich**: Proper foreign key constraints and pivot tables

### Asset Management
- **Vite**: Modern build tool for CSS/JS compilation
- **Tailwind CSS**: Utility-first styling framework
- **Filament Assets**: Pre-built admin interface components