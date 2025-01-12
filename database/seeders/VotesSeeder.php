<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VotesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('votes')->insert([
            // Votes for posts
            [
                'user_id' => 1,
                'votable_id' => 1,
                'votable_type' => 'post',
                'value' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'votable_id' => 2,
                'votable_type' => 'post',
                'value' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'votable_id' => 3,
                'votable_type' => 'post',
                'value' => -1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 4,
                'votable_id' => 4,
                'votable_type' => 'post',
                'value' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 5,
                'votable_id' => 5,
                'votable_type' => 'post',
                'value' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Votes for comments
            [
                'user_id' => 6,
                'votable_id' => 1,
                'votable_type' => 'comment',
                'value' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 7,
                'votable_id' => 2,
                'votable_type' => 'comment',
                'value' => -1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 8,
                'votable_id' => 3,
                'votable_type' => 'comment',
                'value' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 9,
                'votable_id' => 4,
                'votable_type' => 'comment',
                'value' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 10,
                'votable_id' => 5,
                'votable_type' => 'comment',
                'value' => -1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
