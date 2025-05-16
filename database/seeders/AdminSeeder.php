<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admin')->insert([
            'username' => 'admin',
            'firstname' => 'System',
            'lastname' => 'Admin',
            'email' => 'admin@vividblock.com',
            'password' => Hash::make('password123'), // Use a secure password
            'admin_type' => 1,
            'admin_status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
