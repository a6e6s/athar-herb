<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Path to CSV file - adjust this to your actual CSV location
        $csvPath = database_path('seeders/data/Athar_Products_Complete_AR_EN.csv');

        // Check if CSV file exists
        if (!File::exists($csvPath)) {
            $this->command->warn("CSV file not found at: {$csvPath}");
            $this->command->info("Please place your CSV file at the above location or update the path.");
            $this->command->info("Creating sample products instead...");
            $this->createSampleProducts();
            return;
        }

        // Read CSV file
        $file = fopen($csvPath, 'r');
        $header = fgetcsv($file); // Get header row

        $this->command->info("CSV Headers: " . implode(', ', $header));
        $rowNumber = 1;

        while (($row = fgetcsv($file)) !== false) {
            $rowNumber++;

            // Map CSV columns to array (adjust indices based on your CSV structure)
            $data = array_combine($header, $row);

            try {
                // Extract product data from CSV based on actual column names
                $productNameEn = trim($data['Product Name (English)'] ?? '');
                $productNameAr = trim($data['Product Name (Arabic)'] ?? '');
                $descriptionEn = trim($data['Description (English)'] ?? $data['Description ((English)'] ?? '');
                $descriptionAr = trim($data['Description (Arabic)'] ?? '');
                $categoryNameEn = trim($data['Category (English)'] ?? '');
                $categoryNameAr = trim($data['Category (Arabic)'] ?? '');
                $code = trim($data['Code'] ?? '');
                $netCost = trim($data['Net Cost Value'] ?? $data['Cost Price'] ?? '0');
                $inStock = trim($data['In Stock'] ?? '0');

                // Skip if product name is empty
                if (empty($productNameEn)) {
                    continue;
                }

                // Generate unique slug
                $slug = Str::slug($productNameEn);

                // Check if product already exists by slug or SKU
                $existingProduct = Product::where('slug', $slug)
                    ->orWhere('sku', $code)
                    ->first();

                if ($existingProduct) {
                    $this->command->warn("Skipping row {$rowNumber}: Product '{$productNameEn}' already exists");
                    continue;
                }

                // Get or create category
                $categoryName = !empty($categoryNameEn) ? $categoryNameEn : 'General';
                $categoryNameArFinal = !empty($categoryNameAr) ? $categoryNameAr : 'عام';

                $category = Category::firstOrCreate(
                    ['slug' => Str::slug($categoryName)],
                    [
                        'name' => $categoryName,
                        'name_ar' => $categoryNameArFinal,
                        'description' => 'High quality ' . strtolower($categoryName),
                        'description_ar' => $categoryNameArFinal . ' عالية الجودة',
                        'is_active' => true,
                    ]
                );

                // Create product
                Product::create([
                    'category_id' => $category->id,
                    'name' => $productNameEn,
                    'name_ar' => !empty($productNameAr) ? $productNameAr : $productNameEn,
                    'slug' => $slug,
                    'short_description' => !empty($descriptionEn) ? Str::limit($descriptionEn, 200) : 'High quality product',
                    'short_description_ar' => !empty($descriptionAr) ? Str::limit($descriptionAr, 200) : 'منتج عالي الجودة',
                    'description' => !empty($descriptionEn) ? $descriptionEn : 'Premium quality product with excellent features',
                    'description_ar' => !empty($descriptionAr) ? $descriptionAr : 'منتج فاخر بجودة عالية ومميزات ممتازة',
                    'price' => (float)($netCost ?: 50.00),
                    'discount_price' => null,
                    'cost_price' => (float)($netCost ?: null),
                    'sku' => !empty($code) ? $code : 'PRD-' . str_pad($rowNumber, 5, '0', STR_PAD_LEFT),
                    'stock_quantity' => (int)($inStock ?: rand(10, 100)),
                    'low_stock_threshold' => 10,
                    'weight' => null,
                    'unit_of_measure' => 'piece',
                    'unit_of_measure_ar' => 'قطعة',
                    'is_active' => true,
                    'is_featured' => rand(0, 5) === 0, // 20% chance of being featured
                ]);

                $this->command->info("Imported product: {$data['Product_Name_EN']}");

            } catch (\Exception $e) {
                $this->command->error("Error importing row {$rowNumber}: " . $e->getMessage());
            }
        }

        fclose($file);
        $this->command->info("Product import completed!");
    }

    /**
     * Create sample products if CSV is not found
     */
    private function createSampleProducts(): void
    {
        $categories = Category::all();

        if ($categories->isEmpty()) {
            $this->command->warn("No categories found. Please run CategorySeeder first.");
            return;
        }

        $sampleProducts = [
            // Herbs & Spices
            [
                'category' => 'herbs-spices',
                'name' => 'Organic Turmeric Powder',
                'name_ar' => 'مسحوق الكركم العضوي',
                'price' => 45.00,
                'description' => 'Premium organic turmeric powder, rich in curcumin',
                'description_ar' => 'مسحوق كركم عضوي فاخر، غني بالكركمين',
            ],
            [
                'category' => 'herbs-spices',
                'name' => 'Black Seed (Habat Al Baraka)',
                'name_ar' => 'حبة البركة',
                'price' => 35.00,
                'discount_price' => 28.00,
                'description' => 'Pure black seed, known for its health benefits',
                'description_ar' => 'حبة البركة النقية، معروفة بفوائدها الصحية',
            ],
            [
                'category' => 'herbs-spices',
                'name' => 'Saffron Premium',
                'name_ar' => 'زعفران فاخر',
                'price' => 250.00,
                'description' => 'Finest quality saffron threads',
                'description_ar' => 'أجود خيوط الزعفران',
            ],

            // Natural Oils
            [
                'category' => 'natural-oils',
                'name' => 'Argan Oil Pure',
                'name_ar' => 'زيت الأرغان النقي',
                'price' => 120.00,
                'description' => 'Cold-pressed pure argan oil',
                'description_ar' => 'زيت أرغان نقي معصور على البارد',
            ],
            [
                'category' => 'natural-oils',
                'name' => 'Black Seed Oil',
                'name_ar' => 'زيت حبة البركة',
                'price' => 65.00,
                'discount_price' => 55.00,
                'description' => 'Premium black seed oil, cold pressed',
                'description_ar' => 'زيت حبة البركة الفاخر، معصور على البارد',
            ],

            // Honey & Bee Products
            [
                'category' => 'honey-bee-products',
                'name' => 'Sidr Honey Natural',
                'name_ar' => 'عسل السدر الطبيعي',
                'price' => 180.00,
                'description' => 'Pure Sidr honey from Yemen',
                'description_ar' => 'عسل سدر نقي من اليمن',
            ],
            [
                'category' => 'honey-bee-products',
                'name' => 'Acacia Honey',
                'name_ar' => 'عسل الأكاسيا',
                'price' => 95.00,
                'discount_price' => 85.00,
                'description' => 'Light and mild acacia honey',
                'description_ar' => 'عسل أكاسيا خفيف ومعتدل',
            ],
            [
                'category' => 'honey-bee-products',
                'name' => 'Royal Jelly Fresh',
                'name_ar' => 'غذاء ملكات النحل الطازج',
                'price' => 150.00,
                'description' => 'Fresh royal jelly, natural superfood',
                'description_ar' => 'غذاء ملكات النحل الطازج، غذاء خارق طبيعي',
            ],

            // Nuts & Seeds
            [
                'category' => 'nuts-seeds',
                'name' => 'Raw Almonds',
                'name_ar' => 'لوز نيء',
                'price' => 55.00,
                'description' => 'Premium raw almonds',
                'description_ar' => 'لوز نيء فاخر',
            ],
            [
                'category' => 'nuts-seeds',
                'name' => 'Chia Seeds Organic',
                'name_ar' => 'بذور الشيا العضوية',
                'price' => 40.00,
                'discount_price' => 35.00,
                'description' => 'Organic chia seeds, rich in omega-3',
                'description_ar' => 'بذور شيا عضوية، غنية بأوميغا 3',
            ],

            // Herbal Tea
            [
                'category' => 'herbal-tea',
                'name' => 'Chamomile Tea',
                'name_ar' => 'شاي البابونج',
                'price' => 30.00,
                'description' => 'Organic chamomile flowers tea',
                'description_ar' => 'شاي زهور البابونج العضوي',
            ],
            [
                'category' => 'herbal-tea',
                'name' => 'Green Tea with Mint',
                'name_ar' => 'شاي أخضر بالنعناع',
                'price' => 35.00,
                'description' => 'Refreshing green tea with fresh mint',
                'description_ar' => 'شاي أخضر منعش بالنعناع الطازج',
            ],

            // Natural Remedies
            [
                'category' => 'natural-remedies',
                'name' => 'Propolis Extract',
                'name_ar' => 'مستخلص البروبوليس',
                'price' => 85.00,
                'description' => 'Natural propolis extract, immune booster',
                'description_ar' => 'مستخلص البروبوليس الطبيعي، معزز للمناعة',
            ],

            // Dried Fruits
            [
                'category' => 'dried-fruits',
                'name' => 'Medjool Dates Premium',
                'name_ar' => 'تمر المجدول الفاخر',
                'price' => 75.00,
                'description' => 'Premium Medjool dates from Saudi Arabia',
                'description_ar' => 'تمر مجدول فاخر من السعودية',
            ],
            [
                'category' => 'dried-fruits',
                'name' => 'Dried Figs',
                'name_ar' => 'تين مجفف',
                'price' => 50.00,
                'discount_price' => 42.00,
                'description' => 'Natural dried figs, no added sugar',
                'description_ar' => 'تين مجفف طبيعي، بدون سكر مضاف',
            ],

            // Incense & Bakhoor
            [
                'category' => 'incense-bakhoor',
                'name' => 'Oud Bakhoor Premium',
                'name_ar' => 'بخور العود الفاخر',
                'price' => 200.00,
                'description' => 'Premium oud bakhoor, authentic Arabian fragrance',
                'description_ar' => 'بخور عود فاخر، عطر عربي أصيل',
            ],
        ];

        foreach ($sampleProducts as $index => $productData) {
            $category = Category::where('slug', $productData['category'])->first();

            if (!$category) {
                continue;
            }

            Product::create([
                'category_id' => $category->id,
                'name' => $productData['name'],
                'name_ar' => $productData['name_ar'],
                'slug' => Str::slug($productData['name']),
                'short_description' => Str::limit($productData['description'], 150),
                'short_description_ar' => Str::limit($productData['description_ar'], 150),
                'description' => $productData['description'],
                'description_ar' => $productData['description_ar'],
                'price' => $productData['price'],
                'discount_price' => $productData['discount_price'] ?? null,
                'cost_price' => isset($productData['price']) ? $productData['price'] * 0.6 : null,
                'sku' => 'PRD-' . str_pad($index + 1, 5, '0', STR_PAD_LEFT),
                'stock_quantity' => rand(20, 150),
                'low_stock_threshold' => 10,
                'unit_of_measure' => 'piece',
                'unit_of_measure_ar' => 'قطعة',
                'is_active' => true,
                'is_featured' => in_array($index, [0, 3, 5, 10, 14]), // Feature some products
            ]);
        }

        $this->command->info("Created " . count($sampleProducts) . " sample products.");
    }
}
