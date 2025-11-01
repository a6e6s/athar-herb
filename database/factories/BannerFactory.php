<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Banner;

class BannerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Banner::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(4),
            'subtitle' => fake()->word(),
            'description' => fake()->text(),
            'image' => fake()->word(),
            'link_url' => fake()->word(),
            'link_text' => fake()->word(),
            'is_active' => fake()->boolean(),
            'sort_order' => fake()->numberBetween(-10000, 10000),
            'target_blank' => fake()->boolean(),
        ];
    }
}
