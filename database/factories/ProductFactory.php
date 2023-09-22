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
            'size' => fake()->randomElement(['S', 'M', 'L', 'XL']),
            'price' => fake()->randomNumber(4, false),
            'is_available' => 1,
        ];
    }
}