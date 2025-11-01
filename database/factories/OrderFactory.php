<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Order;
use App\Models\User;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'order_number' => fake()->regexify('[A-Za-z0-9]{unique}'),
            'total_amount' => fake()->randomFloat(2, 0, 99999999.99),
            'status' => fake()->randomElement(["pending","processing","shipped","delivered","cancelled"]),
            'shipping_address' => '{}',
            'billing_address' => '{}',
        ];
    }
}
