<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Page;

class PageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Page::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(4),
            'slug' => fake()->slug(),
            'content' => fake()->paragraphs(3, true),
            'meta_title' => fake()->word(),
            'meta_description' => fake()->word(),
            'is_published' => fake()->boolean(),
            'published_at' => fake()->dateTime(),
        ];
    }
}
