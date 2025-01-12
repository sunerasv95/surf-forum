<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('posts')->insert([
            [
                'author_id' => 1,
                'category_id' => 1,
                'topic' => 'Best Surfing Gear for Beginners',
                'content' => 'Let’s discuss the best surfing gear for those starting out.',
                'tags' => json_encode(['gear', 'beginners', 'surfing']),
                'view_count' => 10,
                'last_activity' => now(),
                'is_pinned' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'author_id' => 2,
                'category_id' => 4,
                'topic' => 'Top Surf Destinations in 2025',
                'content' => 'Share your favorite surf spots for this year.',
                'tags' => json_encode(['destinations', 'surf', '2025']),
                'view_count' => 10,
                'last_activity' => now(),
                'is_pinned' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'author_id' => 3,
                'category_id' => 5,
                'topic' => 'Beginner-Friendly Beaches',
                'content' => 'What are some great beaches for learning to surf?',
                'tags' => json_encode(['beaches', 'surf', 'beginners']),
                'view_count' => 10,
                'last_activity' => now(),
                'is_pinned' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'author_id' => 4,
                'category_id' => 6,
                'topic' => 'Challenging Waves',
                'content' => 'Discuss advanced spots with strong waves.',
                'tags' => json_encode(['waves', 'advanced', 'surf']),
                'view_count' => 10,
                'last_activity' => now(),
                'is_pinned' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'author_id' => 5,
                'category_id' => 7,
                'topic' => 'Wave Reading Basics',
                'content' => 'Tips and tricks for reading waves effectively.',
                'tags' => json_encode(['waves', 'reading', 'surfing']),
                'view_count' => 10,
                'last_activity' => now(),
                'is_pinned' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'author_id' => 6,
                'category_id' => 8,
                'topic' => 'Improving Paddling Techniques',
                'content' => 'How to improve paddling for better performance.',
                'tags' => json_encode(['paddling', 'techniques', 'surf']),
                'view_count' => 10,
                'last_activity' => now(),
                'is_pinned' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'author_id' => 7,
                'category_id' => 3,
                'topic' => 'Choosing the Right Wetsuit',
                'content' => 'A guide to picking the perfect wetsuit for your needs.',
                'tags' => json_encode(['wetsuit', 'gear', 'surfing']),
                'view_count' => 10,
                'last_activity' => now(),
                'is_pinned' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'author_id' => 8,
                'category_id' => 2,
                'topic' => 'Top Surfboard Brands',
                'content' => 'Discuss the best surfboard brands available.',
                'tags' => json_encode(['surfboards', 'brands', 'gear']),
                'view_count' => 10,
                'last_activity' => now(),
                'is_pinned' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'author_id' => 9,
                'category_id' => 5,
                'topic' => 'Favorite Beginner Spots in Australia',
                'content' => 'Share your favorite beginner surf spots in Australia.',
                'tags' => json_encode(['Australia', 'surf', 'beginners']),
                'view_count' => 10,
                'last_activity' => now(),
                'is_pinned' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'author_id' => 10,
                'category_id' => 9,
                'topic' => 'Understanding Ocean Currents',
                'content' => 'Learn how to use ocean currents to your advantage while surfing.',
                'tags' => json_encode(['ocean', 'currents', 'surfing']),
                'view_count' => 10,
                'last_activity' => now(),
                'is_pinned' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
