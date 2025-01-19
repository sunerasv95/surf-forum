<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(), // Generate a related user
            'category_id' => Category::factory(), // Generate a related category
            'topic' => $this->faker->sentence, // Generate a random topic
            'content' => $this->faker->paragraphs(3, true), // Generate random content
            'tags' => $this->faker->words(5), // Generate an array of tags and encode to JSON
            'view_count' => $this->faker->numberBetween(0, 1000), // Generate a random view count
            'last_activity' => $this->faker->optional()->dateTimeThisYear(), // Generate a random timestamp or leave null
            'is_pinned' => $this->faker->boolean(10), // 10% chance the post is pinned
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Indicate that the post is pinned.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function pinned(): Factory
    {
        return $this->state(fn (array $attributes) => [
            'is_pinned' => true,
        ]);
    }

    /**
     * Indicate that the post has high view count.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function popular(): Factory
    {
        return $this->state(fn (array $attributes) => [
            'view_count' => $this->faker->numberBetween(1000, 5000),
        ]);
    }
}
