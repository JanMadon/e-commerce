<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'description' => fake()->text(200),
            'subcategory_id' => fake()->randomNumber(2),
            'price' => fake()->randomNumber(3),
            'quantity' => fake()->randomNumber(3),
            'sold' => fake()->randomNumber(3),
            'status' => fake()->randomElement(['active','hidden','deleted']),
        ];
    }
}
