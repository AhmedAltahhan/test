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
            'name' => fake()->unique()->name(),
            'description' => fake()->sentence(),
            'price' => fake()->numberBetween(100,1000),
            'slug' => fake()->unique()->word(1,true),
            'is_active' => fake()->numberBetween(0,1),
        ];
    }
}
