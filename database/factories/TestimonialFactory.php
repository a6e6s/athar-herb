<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Testimonial;

class TestimonialFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Testimonial::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'role' => fake()->word(),
            'content' => fake()->paragraphs(3, true),
            'rating' => fake()->numberBetween(-10000, 10000),
            'avatar' => fake()->word(),
            'is_approved' => fake()->boolean(),
            'sort_order' => fake()->numberBetween(-10000, 10000),
        ];
    }
}
