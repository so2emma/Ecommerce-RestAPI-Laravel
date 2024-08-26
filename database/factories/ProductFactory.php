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
            'name' => implode(' ', fake()->words(2)),
            "description" => fake()->sentence(10),
            "price" => fake()->randomFloat(2, 1),
            "stock" => fake()->randomNumber(4, false),
        ];
    }
}
