<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('services')->insert([
            ['name' => 'Deep Home Cleaning', 'description' => 'Full house deep clean', 'category_id' => 1, 'base_price' => 1000, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'AC Installation', 'description' => 'Install new air conditioner', 'category_id' => 2, 'base_price' => 1200, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Water Pipe Fix', 'description' => 'Fix pipe leakage or block', 'category_id' => 3, 'base_price' => 800, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
