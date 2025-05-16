<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SmtpSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('smtp_settings')->insert([
            'host' => 'smtp.hostinger.com',
            'username' => 'test2@vbstaging.com',
            'password' => 'tapa8637@A',
            'email' => 'test2@vbstaging.com',
            'port' => 587,
            'protocol' => 'TLS',
            'status' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
