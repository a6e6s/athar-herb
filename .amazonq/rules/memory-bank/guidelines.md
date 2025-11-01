# Development Guidelines & Standards

## Code Quality Standards

### PHP Code Formatting
- **PSR Standards**: Follow PSR-4 autoloading and PSR-12 coding standards
- **Namespace Structure**: Use proper namespace hierarchy (`App\Models`, `App\Providers\Filament`)
- **Class Organization**: Place related classes in appropriate directories (Models, Providers, etc.)
- **Line Endings**: Use consistent CRLF line endings (Windows development environment)

### Documentation Standards
- **DocBlocks**: Include comprehensive PHPDoc comments for methods and properties
- **Type Declarations**: Use strict type hints for method parameters and return types
- **Property Documentation**: Document array structures and expected data types
- **Inline Comments**: Provide contextual comments for complex business logic

### Naming Conventions
- **Classes**: PascalCase (e.g., `AdminPanelProvider`, `Product`)
- **Methods**: camelCase (e.g., `category()`, `casts()`)
- **Properties**: snake_case for database fields, camelCase for PHP properties
- **Constants**: UPPER_SNAKE_CASE
- **Files**: Match class names exactly

## Structural Conventions

### Laravel Model Patterns
- **Fillable Arrays**: Explicitly define mass assignable attributes
- **Type Casting**: Use `casts()` method for proper data type conversion
- **Relationships**: Define Eloquent relationships with proper return type hints
- **Factory Integration**: Include `HasFactory` trait for all models

### Filament Admin Panel Structure
- **Panel Configuration**: Centralize admin panel setup in dedicated provider
- **Resource Discovery**: Use automatic resource discovery for scalability
- **Middleware Stack**: Apply comprehensive middleware for security and functionality
- **Color Schemes**: Use Filament's Color class for consistent theming

### Blade Template Standards
- **Conditional Rendering**: Use `@if` directives for feature toggles
- **Asset Management**: Implement fallback strategies for missing build assets
- **Responsive Design**: Use Tailwind CSS utility classes for responsive layouts
- **Dark Mode Support**: Include dark mode variants for all UI components

## Semantic Patterns

### Database Design Patterns
- **Timestamps**: Include `created_at` and `updated_at` on all models
- **Soft Deletes**: Consider implementing for data preservation
- **Foreign Keys**: Use proper relationship constraints
- **JSON Fields**: Cast JSON columns to arrays for easy manipulation

### Testing Architecture
- **Pest Framework**: Use Pest for modern, expressive testing
- **Test Organization**: Separate Feature and Unit tests
- **Custom Expectations**: Extend Pest expectations for domain-specific assertions
- **Test Case Inheritance**: Extend Laravel's TestCase for framework integration

### Service Provider Patterns
- **Panel Providers**: Separate Filament configuration into dedicated providers
- **Middleware Registration**: Register middleware in logical order
- **Resource Discovery**: Use convention-based resource discovery
- **Configuration Chaining**: Use fluent interface for panel configuration

## Internal API Usage

### Eloquent Relationships
```php
public function category(): BelongsTo
{
    return $this->belongsTo(Category::class);
}
```

### Model Casting
```php
protected function casts(): array
{
    return [
        'price' => 'decimal:2',
        'secondary_images' => 'array',
        'is_active' => 'boolean',
    ];
}
```

### Filament Panel Configuration
```php
return $panel
    ->default()
    ->id('admin')
    ->path('admin')
    ->login()
    ->colors(['primary' => Color::Amber]);
```

## Frequently Used Patterns

### Mass Assignment Protection
- Always define `$fillable` arrays on models
- Include all user-modifiable fields
- Exclude sensitive fields like passwords or tokens

### Blade Conditional Assets
- Check for build manifest existence before loading Vite assets
- Provide inline CSS fallback for development environments
- Use `@if` conditions for optional features

### Service Registration
- Register services in appropriate service providers
- Use deferred loading for performance optimization
- Implement proper dependency injection

### Testing Helpers
- Create custom Pest expectations for domain logic
- Use global helper functions for common test operations
- Extend base test case for shared functionality

## Code Idioms

### Laravel Conventions
- Use Eloquent relationships over manual joins
- Leverage model factories for test data generation
- Implement proper validation rules in form requests
- Use resource controllers for RESTful operations

### Filament Best Practices
- Organize resources by domain/feature
- Use resource discovery for automatic registration
- Implement proper authorization policies
- Customize panel appearance through configuration