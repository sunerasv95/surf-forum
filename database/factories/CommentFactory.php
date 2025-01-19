<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
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
            'commentable_id' => null, // Will be set when creating a commentable entity
            'commentable_type' => null, // Will be set when creating a commentable entity
            'parent_id' => null, // Default to null for top-level comments
            'comment_content' => $this->faker->paragraph, // Generate random comment content
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Indicate the comment has a parent (nested comment).
     *
     * @param int $parentId
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function asReply(int $parentId): Factory
    {
        return $this->state(fn (array $attributes) => [
            'parent_id' => $parentId,
        ]);
    }

    /**
     * Associate the comment with a commentable entity.
     *
     * @param \Illuminate\Database\Eloquent\Model $commentable
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function forCommentable($commentable): Factory
    {
        return $this->state(fn (array $attributes) => [
            'commentable_id' => $commentable->id,
            'commentable_type' => get_class($commentable),
        ]);
    }
}
