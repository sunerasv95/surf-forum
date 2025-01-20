<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $randomCategoryName = $this->faker->word;
        return [
            'category_name' => $randomCategoryName, // Generate a random category name
            'category_slug' => Str::slug($randomCategoryName), // Generate a slug from the category name
            'is_parent' => 1,
            'parent_id' => null, // Default to null for top-level categories
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
