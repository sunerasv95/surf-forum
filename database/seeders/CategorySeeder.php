<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'parent_id' => NULL,
                'category_name' => 'Surfing Gear',
                'is_parent' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'parent_id' => 1,
                'category_name' => 'Surfboards',
                'is_parent' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'parent_id' => 1,
                'category_name' => 'Wetsuits',
                'is_parent' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'parent_id' => NULL,
                'category_name' => 'Surf Destinations',
                'is_parent' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'parent_id' => 4,
                'category_name' => 'Best Spots for Beginners',
                'is_parent' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'parent_id' => 4,
                'category_name' => 'Advanced Surf Spots',
                'is_parent' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'parent_id' => NULL,
                'category_name' => 'Surfing Tips & Tricks',
                'is_parent' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'parent_id' => 7,
                'category_name' => 'Wave Reading Techniques',
                'is_parent' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'parent_id' => 7,
                'category_name' => 'Paddling Tips',
                'is_parent' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
