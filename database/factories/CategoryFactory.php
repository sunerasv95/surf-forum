<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'parent_id' => null, // Default to null for top-level categories
            'category_name' => $this->faker->word, // Generate a random category name
            'is_parent' => 0, // Default to 0, can be overridden for parent categories
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
