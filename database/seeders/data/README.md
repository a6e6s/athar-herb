# Product CSV Data

## Instructions

Place your `Athar_Products_Complete_AR_EN.csv` file in this directory.

## Expected CSV Format

The CSV file should have the following columns:

### Required Columns:
- `Product_Name_EN` - Product name in English
- `Product_Name_AR` - Product name in Arabic
- `Category` - Category name in English
- `Category_AR` - Category name in Arabic
- `Price` - Product price (decimal)

### Optional Columns:
- `Discount_Price` - Discounted price (if applicable)
- `Cost_Price` - Cost price for profit calculation
- `SKU` - Stock Keeping Unit code
- `Stock` or `stock_quantity` - Stock quantity
- `Weight` - Product weight
- `Unit_EN` - Unit of measure in English (e.g., "piece", "kg")
- `Unit_AR` - Unit of measure in Arabic (e.g., "قطعة", "كيلو")
- `Short_Description_EN` - Short description in English
- `Short_Description_AR` - Short description in Arabic
- `Description_EN` - Full description in English
- `Description_AR` - Full description in Arabic

## Alternative Column Names

The seeder also supports these alternative column names:
- `name` instead of `Product_Name_EN`
- `name_ar` instead of `Product_Name_AR`
- `category` instead of `Category`
- `category_ar` instead of `Category_AR`
- `price` (lowercase)
- `sku` (lowercase)
- `stock_quantity` instead of `Stock`
- `unit` instead of `Unit_EN`
- `unit_ar` instead of `Unit_AR`

## Running the Seeder

### Option 1: Run all seeders
```bash
php artisan db:seed
```

### Option 2: Run specific seeders
```bash
# Seed categories first
php artisan db:seed --class=CategorySeeder

# Then seed products
php artisan db:seed --class=ProductSeeder
```

### Option 3: Fresh migration with seeders
```bash
php artisan migrate:fresh --seed
```

## What Happens if CSV is Not Found

If the CSV file is not found, the ProductSeeder will automatically create sample products with realistic data across all categories.

## Notes

- Categories will be created automatically from the CSV data
- Duplicate categories (same slug) will not be created
- Each product will be assigned to its category
- Products will be automatically activated (`is_active = true`)
- 20% of products will be randomly marked as featured
