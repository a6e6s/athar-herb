<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Product;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $price = fake()->randomFloat(2, 20, 500);
        $hasDiscount = fake()->boolean(30); // 30% chance of having discount
        $discountPrice = $hasDiscount ? fake()->randomFloat(2, $price * 0.5, $price * 0.9) : null;

        return [
            'category_id' => Category::factory(),
            'name' => fake()->name(),
            'slug' => fake()->slug(),
            'short_description' => fake()->text(),
            'description' => fake()->text(),
            'price' => $price,
            'discount_price' => $discountPrice,
            'cost_price' => fake()->randomFloat(2, 10, $price * 0.6),
            'sku' => fake()->regexify('[A-Za-z0-9]{unique}'),
            'stock_quantity' => fake()->numberBetween(-10000, 10000),
            'low_stock_threshold' => fake()->numberBetween(-10000, 10000),
            'weight' => fake()->randomFloat(2, 0, 999999.99),
            'unit_of_measure' => fake()->word(),
            'expiration_date' => fake()->date(),
            'image_path' => fake()->word(),
            'secondary_images' => '{}',
            'is_active' => fake()->boolean(),
            'is_featured' => fake()->boolean(),
        ];
    }
}
