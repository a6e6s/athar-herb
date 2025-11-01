# Quick Start Guide - Frontend

## Access the Website

1. Start your development server:
   ```bash
   php artisan serve
   ```

2. Visit: http://localhost:8000

## Available Routes

### Public Pages
- **Home**: http://localhost:8000
- **All Products**: http://localhost:8000/products
- **All Categories**: http://localhost:8000/categories
- **Blog**: http://localhost:8000/blog
- **About**: http://localhost:8000/about
- **Contact**: http://localhost:8000/contact
- **Cart**: http://localhost:8000/cart
- **Wishlist**: http://localhost:8000/wishlist

### Dynamic Pages (require data in database)
- **Product Details**: http://localhost:8000/products/{product-slug}
- **Category Products**: http://localhost:8000/categories/{category-slug}
- **Blog Post**: http://localhost:8000/blog/{post-slug}

### User Area (requires authentication)
- **Profile**: http://localhost:8000/profile
- **My Orders**: http://localhost:8000/orders

### Admin Panel
- **Filament Admin**: http://localhost:8000/admin

## File Locations

### Layouts
- Master Layout: `resources/views/layouts/app.blade.php`

### Components
- Navbar: `resources/views/components/navbar.blade.php`
- Footer: `resources/views/components/footer.blade.php`
- Banner Slider: `resources/views/components/banner-slider.blade.php`

### Pages
- Homepage: `resources/views/pages/home.blade.php`
- All other pages in: `resources/views/pages/`

### Assets
- CSS: `public/css/style.css`
- JS: `public/js/app.js`
- Images: `public/images/`

## Customization Tips

### 1. Edit Navigation Menu
Edit `resources/views/components/navbar.blade.php` - lines 13-48

### 2. Edit Footer Content
Edit `resources/views/components/footer.blade.php`

### 3. Change Homepage Sections
Edit `resources/views/pages/home.blade.php`

### 4. Add New Page
1. Create file: `resources/views/pages/yourpage.blade.php`
2. Start with:
   ```blade
   @extends('layouts.app')
   
   @section('title', 'Your Page Title')
   
   @section('content')
       <!-- Your content here -->
   @endsection
   ```
3. Add route in `routes/web.php`:
   ```php
   Route::get('/yourpage', function () {
       return view('pages.yourpage');
   })->name('yourpage');
   ```

### 5. Modify Styles
- Add custom CSS in the `<style>` tag in `resources/views/layouts/app.blade.php`
- Or edit `public/css/style.css`
- Use Bootstrap 5 utility classes

### 6. Add JavaScript
- Edit `public/js/app.js`
- Or use `@push('scripts')` in individual pages:
  ```blade
  @push('scripts')
  <script>
      // Your JS code
  </script>
  @endpush
  ```

## Testing Data

### Create Sample Products
Access Filament admin panel and create:
1. Categories (mark as active)
2. Products (mark as active, set featured flag for homepage)
3. Banners (mark as active for homepage slider)
4. Testimonials (mark as active for homepage)
5. FAQs (mark as active for homepage)
6. Blog Posts (mark as active)

### Database Seeding
Create a seeder if needed:
```bash
php artisan make:seeder ProductSeeder
php artisan db:seed --class=ProductSeeder
```

## Common Tasks

### Clear Cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

### Create New Controller
```bash
php artisan make:controller ProductController
```

Then update routes to use controller:
```php
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
```

### Add Authentication
```bash
composer require laravel/breeze --dev
php artisan breeze:install
php artisan migrate
npm install && npm run dev
```

## Troubleshooting

### Images Not Showing
1. Make sure storage is linked:
   ```bash
   php artisan storage:link
   ```
2. Check image paths use `asset('storage/...')`

### Styles Not Loading
1. Check file exists: `public/css/style.css`
2. Clear browser cache (Ctrl+Shift+R)
3. Verify asset path: `{{ asset('css/style.css') }}`

### 404 Errors
1. Check route is defined in `routes/web.php`
2. Check view file exists
3. Clear route cache: `php artisan route:clear`

### Database Errors
1. Run migrations: `php artisan migrate`
2. Check .env database credentials
3. Ensure tables have data

## Bootstrap 5 RTL Classes Reference

Common utility classes:
- `me-3` - Margin end (left in RTL)
- `ms-3` - Margin start (right in RTL)
- `pe-3` - Padding end (left in RTL)
- `ps-3` - Padding start (right in RTL)
- `text-start` - Text align right (in RTL)
- `text-end` - Text align left (in RTL)

## Resources

- [Laravel Documentation](https://laravel.com/docs)
- [Bootstrap 5 RTL](https://getbootstrap.com/docs/5.3/getting-started/rtl/)
- [Blade Templates](https://laravel.com/docs/blade)
- [Font Awesome Icons](https://fontawesome.com/icons)
- [Filament Admin](https://filamentphp.com/docs)
