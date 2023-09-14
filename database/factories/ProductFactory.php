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
            'gender' => fake()->randomElement(['men', 'women']),
            'type' => fake()->randomElement(['tshirt', 'shoes', 'jean']),
            'picture_id' => fake()->randomNumber(5, false),
            'price' => fake()->randomNumber(4, false),
            'is_available' => 1,
        ];
    }
}