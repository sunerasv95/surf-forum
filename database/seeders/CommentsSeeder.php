<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('comments')->insert([
            [
                'user_id' => 1,
                'commentable_id' => 1,
                'commentable_type' => 'post',
                'comment_content' => 'Great post about surfing gear!',
                'parent_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'commentable_id' => 1,
                'commentable_type' => 'post',
                'comment_content' => 'I also recommend checking out XYZ brand.',
                'parent_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'commentable_id' => 2,
                'commentable_type' => 'post',
                'comment_content' => 'Top surf destinations are always changing.',
                'parent_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 4,
                'commentable_id' => 2,
                'commentable_type' => 'post',
                'comment_content' => 'I heard Bali is a must-visit this year.',
                'parent_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 5,
                'commentable_id' => 3,
                'commentable_type' => 'post',
                'comment_content' => 'Great suggestions for beginners!',
                'parent_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 6,
                'commentable_id' => 3,
                'commentable_type' => 'post',
                'comment_content' => 'I started at Bondi Beach and it was perfect.',
                'parent_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 7,
                'commentable_id' => 4,
                'commentable_type' => 'post',
                'comment_content' => 'These advanced spots sound exciting!',
                'parent_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 8,
                'commentable_id' => 4,
                'commentable_type' => 'post',
                'comment_content' => 'Can anyone recommend equipment for big waves?',
                'parent_id' => 7,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 9,
                'commentable_id' => 5,
                'commentable_type' => 'post',
                'comment_content' => 'Beginner-friendly beaches are underrated.',
                'parent_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 10,
                'commentable_id' => 5,
                'commentable_type' => 'post',
                'comment_content' => 'My first wave was at Waikiki Beach!',
                'parent_id' => 9,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'commentable_id' => 6,
                'commentable_type' => 'post',
                'comment_content' => 'Paddling tips were super helpful, thanks!',
                'parent_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'commentable_id' => 6,
                'commentable_type' => 'post',
                'comment_content' => 'Anyone have advice for reducing fatigue?',
                'parent_id' => 11,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'commentable_id' => 7,
                'commentable_type' => 'post',
                'comment_content' => 'Wave reading is an art form!',
                'parent_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 4,
                'commentable_id' => 7,
                'commentable_type' => 'post',
                'comment_content' => 'This post is spot on about swells.',
                'parent_id' => 13,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 5,
                'commentable_id' => 8,
                'commentable_type' => 'post',
                'comment_content' => 'Fantastic tips for handling big waves!',
                'parent_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
