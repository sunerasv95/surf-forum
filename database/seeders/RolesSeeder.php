<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'role_display_name' => 'Administrator',
                'role_slug' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role_display_name' => 'Member',
                'role_slug' => 'member',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role_display_name' => 'Guest',
                'role_slug' => 'guest',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
