<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Herbs & Spices',
                'name_ar' => 'الأعشاب والتوابل',
                'slug' => 'herbs-spices',
                'description' => 'Natural herbs and premium spices for health and cooking',
                'description_ar' => 'أعشاب طبيعية وتوابل فاخرة للصحة والطبخ',
                'is_active' => true,
            ],
            [
                'name' => 'Natural Oils',
                'name_ar' => 'الزيوت الطبيعية',
                'slug' => 'natural-oils',
                'description' => 'Pure essential and carrier oils',
                'description_ar' => 'زيوت عطرية وناقلة نقية',
                'is_active' => true,
            ],
            [
                'name' => 'Honey & Bee Products',
                'name_ar' => 'العسل ومنتجات النحل',
                'slug' => 'honey-bee-products',
                'description' => 'Pure honey and natural bee products',
                'description_ar' => 'عسل نقي ومنتجات النحل الطبيعية',
                'is_active' => true,
            ],
            [
                'name' => 'Nuts & Seeds',
                'name_ar' => 'المكسرات والبذور',
                'slug' => 'nuts-seeds',
                'description' => 'Healthy nuts and nutritious seeds',
                'description_ar' => 'مكسرات صحية وبذور مغذية',
                'is_active' => true,
            ],
            [
                'name' => 'Herbal Tea',
                'name_ar' => 'شاي الأعشاب',
                'slug' => 'herbal-tea',
                'description' => 'Organic herbal tea blends',
                'description_ar' => 'خلطات شاي أعشاب عضوية',
                'is_active' => true,
            ],
            [
                'name' => 'Natural Remedies',
                'name_ar' => 'العلاجات الطبيعية',
                'slug' => 'natural-remedies',
                'description' => 'Traditional natural health remedies',
                'description_ar' => 'علاجات صحية طبيعية تقليدية',
                'is_active' => true,
            ],
            [
                'name' => 'Dried Fruits',
                'name_ar' => 'الفواكه المجففة',
                'slug' => 'dried-fruits',
                'description' => 'Premium dried fruits',
                'description_ar' => 'فواكه مجففة فاخرة',
                'is_active' => true,
            ],
            [
                'name' => 'Incense & Bakhoor',
                'name_ar' => 'البخور',
                'slug' => 'incense-bakhoor',
                'description' => 'Traditional Arabian incense',
                'description_ar' => 'بخور عربي تقليدي',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
