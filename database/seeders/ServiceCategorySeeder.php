<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceCategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('service_categories')->insert([
            ['name' => 'Home Cleaning', 'description' => 'Cleaning and maintenance services', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'AC Repair', 'description' => 'Cooling system installation and repair', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Plumbing', 'description' => 'Fixing and installing plumbing lines', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
