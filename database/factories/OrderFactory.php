<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->randomNumber(3),
            'payment' => fake()->randomElement(['accepted','rejected','active']),
            'payd_at' => fake()->dateTime(),
            'amount_paid' => 0,
            'shiping_method' => fake()->randomElement(['lockerFree','locker','curier','self','-']),
        ];
    }
}
