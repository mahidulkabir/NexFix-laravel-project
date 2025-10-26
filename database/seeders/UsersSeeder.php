<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin User',
                'email' => 'admin@nexfix.com',
                'phone' => '01000000000',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'address' => 'Dhaka, Bangladesh',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Test Vendor',
                'email' => 'vendor@nexfix.com',
                'phone' => '01000000001',
                'password' => Hash::make('password'),
                'role' => 'vendor',
                'address' => 'Dhaka',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Test Customer',
                'email' => 'customer@nexfix.com',
                'phone' => '01000000002',
                'password' => Hash::make('password'),
                'role' => 'customer',
                'address' => 'Chittagong',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
