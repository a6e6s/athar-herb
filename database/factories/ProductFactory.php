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
        return [
            'category_id' => Category::factory(),
            'name' => fake()->name(),
            'slug' => fake()->slug(),
            'short_description' => fake()->text(),
            'description' => fake()->text(),
            'price' => fake()->randomFloat(2, 0, 99999999.99),
            'cost_price' => fake()->randomFloat(2, 0, 99999999.99),
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
