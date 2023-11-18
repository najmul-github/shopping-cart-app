<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        // Create a regular user
        DB::table('users')->insert([
            'name' => 'regular_user',
            'email' => 'user@example.com',
            'password' => Hash::make('1234'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create an admin user
        DB::table('users')->insert([
            'name' => 'admin_user',
            'email' => 'admin@example.com',
            'password' => Hash::make('1234'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Assign roles to users
        DB::table('role_user')->insert([
            'role_id' => 1, // Assuming role_id 1 represents 'user'
            'user_id' => 1, // Assuming user_id 1 is the regular user
        ]);

        DB::table('role_user')->insert([
            'role_id' => 2, // Assuming role_id 2 represents 'admin'
            'user_id' => 2, // Assuming user_id 2 is the admin user
        ]);
    }
}
