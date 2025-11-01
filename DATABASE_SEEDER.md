# Database Seeder Documentation

This document explains the sample data that has been seeded into the Athar Herb application database.

## Seeded Data Summary

The database seeder creates the following sample data:

### 1. Users (6 total)

- **Admin User**
  - Email: `admin@athar-herb.com`
  - Password: `password`
  - Purpose: Access to Filament admin panel

- **5 Sample Users** (Arabic names)
  - ahmed@example.com
  - fatima@example.com
  - mohammed@example.com
  - sarah@example.com
  - omar@example.com
  - Password (all): `password`

### 2. Categories (5 items)

1. **الزيوت الطبيعية** - Natural Oils
2. **العسل** - Honey
3. **الأعشاب** - Herbs
4. **التوابل** - Spices
5. **البذور** - Seeds

### 3. Products (5 items)

1. **زيت الزيتون البكر** - Extra Virgin Olive Oil (120 SAR)
   - Category: Natural Oils
   - Stock: 50
   - Featured: Yes

2. **عسل السدر الطبيعي** - Natural Sidr Honey (250 SAR)
   - Category: Honey
   - Stock: 30
   - Featured: Yes

3. **زعتر بري** - Wild Thyme (45 SAR)
   - Category: Herbs
   - Stock: 100
   - Featured: Yes

4. **كركم عضوي** - Organic Turmeric (55 SAR)
   - Category: Spices
   - Stock: 80
   - Featured: Yes

5. **حبة البركة** - Black Seed (35 SAR)
   - Category: Seeds
   - Stock: 120
   - Featured: Yes

### 4. Banners (3 items)

1. **منتجات طبيعية 100%** - 100% Natural Products
2. **عروض خاصة** - Special Offers
3. **شحن مجاني** - Free Shipping

### 5. Testimonials (5 items)

Customer reviews from:
- Sarah Ahmed
- Mohammed Ali
- Fatima Khaled
- Ahmed Mahmoud
- Noura Saeed

All reviews are 5-star ratings with Arabic content praising product quality and service.

### 6. FAQs (5 items)

Common questions about:
1. Payment methods
2. Delivery time
3. Product authenticity (100% natural)
4. Return/exchange policy
5. Free shipping eligibility

### 7. Blog Posts (5 items)

1. **فوائد زيت الزيتون البكر للصحة** - Benefits of Extra Virgin Olive Oil
2. **كيف تختار العسل الطبيعي الأصلي** - How to Choose Pure Natural Honey
3. **الأعشاب المفيدة لتقوية المناعة** - Herbs for Boosting Immunity
4. **فوائد الكركم العضوي وطرق استخدامه** - Benefits of Organic Turmeric
5. **حبة البركة: الحبة السوداء المعجزة** - Black Seed: The Miracle

### 8. Pages (2 items)

1. **Privacy Policy** (سياسة الخصوصية)
2. **Terms and Conditions** (الشروط والأحكام)

## Running the Seeder

### Fresh Database with Seeding

```bash
php artisan migrate:fresh --seed
```

This command will:
1. Drop all existing tables
2. Run all migrations
3. Seed the database with sample data

### Seed Only (without migrations)

```bash
php artisan db:seed
```

**Warning**: This will fail if data already exists due to unique constraints. Use `migrate:fresh --seed` instead.

## Data Characteristics

### Bilingual Content
All content is provided in both Arabic and English:
- `name` / `name_ar`
- `title` / `title_ar`
- `description` / `description_ar`
- `content` / `content_ar`

### Active Status
All seeded items are marked as active/published:
- Products: `is_active = true`, `is_featured = true`
- Categories: `is_active = true`
- Banners: `is_active = true`
- Testimonials: `is_approved = true`
- FAQs: `is_active = true`
- Posts: `is_published = true`
- Pages: `is_published = true`

### Realistic Data
- Products have proper pricing, SKUs, and stock quantities
- Blog posts have varied published dates (1-30 days ago)
- All content is contextually relevant to a natural products store
- Arabic content is authentic and properly written

## Notes

- All product images, banner images, and post images use placeholder paths
- The admin user can access the Filament panel at `/admin`
- All featured products will appear on the homepage
- Blog posts are assigned to the admin user
- Testimonials are pre-approved and ready to display

## Next Steps

After seeding:
1. Access Filament admin panel: `/admin`
2. Login with: `admin@athar-herb.com` / `password`
3. View the frontend to see all seeded data in action
4. Customize or add more data through the admin panel
5. Replace placeholder images with actual product photos

## File Location

Database seeder file: `database/seeders/DatabaseSeeder.php`
