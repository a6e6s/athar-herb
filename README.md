php artisan make:filament-resource Category --generate --view
php artisan make:filament-resource Product  --generate --view
php artisan make:filament-resource Order  --generate --view
php artisan make:filament-resource Review  --generate --view
php artisan make:filament-resource Wishlist  --generate --view
php artisan make:filament-resource Page  --generate --view
php artisan make:filament-resource Post  --generate --view
php artisan make:filament-resource Banner  --generate --view
php artisan make:filament-resource Faq  --generate --view
php artisan make:filament-resource Testimonial  --generate --view
php artisan make:filament-resource User  --generate --view

## prompt for resource enhance and orginizing
Please refine and enhance the (Product Resource) in my Laravel Filament v4 eCommerce application.
Focus on improving the visual design, layout, and overall user experience across all components — including Forms, Tables, and Infolists.

Organize product fields into logical sections and tabs (e.g., General Info, Pricing, Inventory, Media, SEO).
Apply consistent spacing, icons, and responsive design for a clean, modern interface.
Improve table usability with better column organization, sorting, filtering, and quick actions.
Enhance Infolist presentation with a clear and attractive layout for product details.
Make sure to add the required translation 
Ensure the UI aligns with Filament’s V4 best UX practices and provides a seamless workflow for managing products.
Important: 
    1- when you use this types on form pages (Section,Tabs,Tab,Get,Str) use this 
        [
        use Filament\Schemas\Components\Section;
        use Filament\Schemas\Components\Tabs;
        use Filament\Schemas\Components\Tabs\Tab;
        use Filament\Schemas\Components\Utilities\Get;
        use Illuminate\Support\Str;
        ]
    2- if there table image record use defaultImageUrl(fn($record) => $record->image_path ? asset('storage/' . $record->image_path) : url('/images/placeholder.png')
## Prompt for translation 
Please Translate all Filament resources for (User) and interfaces to support Arabic language.
Ensure that all static text, labels, form fields, table columns, navigation items, and notifications are fully translated into Arabic.
