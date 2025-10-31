<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\ServiceCategory;
use App\Models\Service;
use App\Models\Vendor;
use App\Models\VendorService;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
        // === Vendor User ===
        $vendorUser = User::where('role', 'vendor')->first();

        // === Vendor Profile ===
        $vendor = Vendor::firstOrCreate([
            'user_id' => $vendorUser->id,
        ], [
            'company_name' => 'CoolFix Experts',
            'bio' => 'Experienced professionals for AC and cleaning services.',
            'rating' => 4.8,
            'verified' => true,
            'documents' => json_encode(['trade_license.pdf']),
            'status' => 'approved',
        ]);

        // === Categories ===
        $categories = [
            'Home Services',
            'Appliance Repair',
            'Cleaning',
            'Plumbing',
            'Electrical'
        ];

        foreach ($categories as $cat) {
            ServiceCategory::firstOrCreate(['name' => $cat]);
        }

        // === Services ===
        $service1 = Service::firstOrCreate([
            'name' => 'AC Repair',
            'description' => 'Complete air conditioning system inspection and repair.',
            'base_price' => 1200,
            'category_id' => ServiceCategory::where('name', 'Appliance Repair')->first()->id,
        ]);

        $service2 = Service::firstOrCreate([
            'name' => 'House Cleaning',
            'description' => 'Deep cleaning service for entire homes.',
            'base_price' => 800,
            'category_id' => ServiceCategory::where('name', 'Cleaning')->first()->id,
        ]);

        // === Vendor Services ===
        VendorService::firstOrCreate([
            'vendor_id' => $vendor->id,
            'service_id' => $service1->id,
        ], [
            'base_price' => 1200,
        ]);

        VendorService::firstOrCreate([
            'vendor_id' => $vendor->id,
            'service_id' => $service2->id,
        ], [
            'base_price' => 800,
        ]);
    }
}
