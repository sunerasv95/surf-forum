<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mainCategories = [
            'Beginner Tips',
            'Advanced Waves',
            'Surf Gear',
            'Best Beaches',
            'Surfing Events',
        ];

        $subCategories = [
            'Paddling Basics', 'Wave Reading', 'Board Setup', 'Balance Tips', 'Safety Rules',
            'Big Wave Surfing', 'Tide Timing', 'Weather Analysis', 'High-Performance Boards', 'Aerial Tricks',
            'Wetsuits', 'Surfboards', 'Leashes', 'Waxing Tips', 'Storage Solutions',
            'Hawaii Beaches', 'Australia Spots', 'California Waves', 'European Surf', 'Island Escapes',
        ];

        $categoryData = [];

        // Create main categories
        foreach ($mainCategories as $index => $mainCategoryName) {
            $mainCategoryId = DB::table('categories')->insertGetId([
                'parent_id' => null,
                'category_name' => $mainCategoryName,
                'category_slug' => trim(Str::slug($mainCategoryName, '-')),
                'is_parent' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Assign 4 subcategories to each main category
            $subCategoryGroup = array_slice($subCategories, $index * 4, 4);

            foreach ($subCategoryGroup as $subCategoryName) {
                $categoryData[] = [
                    'parent_id' => $mainCategoryId,
                    'category_name' => $subCategoryName,
                    'category_slug' => trim(Str::slug($subCategoryName, '-')),
                    'is_parent' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // Insert subcategories
        DB::table('categories')->insert($categoryData);
    }
}
