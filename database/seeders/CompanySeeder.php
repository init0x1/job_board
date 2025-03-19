<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = [
            "Valeo", "Siemens", "Avelabs", "Luxfort", "Link Development",
            "Etisalat", "Huawei", "Samsung", "Microsoft", "Facebook", "Vois", 
            "Google", "Axios", "We", "Afaqy", "Apple", "IBM", "Placeholder", 
            "Foodics", "Daftra"
        ];

        foreach ($companies as $company) {
            Company::create([
                'name' => $company,
                'logo_path' => "img/svg_icon/2.svg", // Default logo
                'website' => "https://www.website.com",
                'description' => "company description",
                'industry' => "software",
                'established_year' => 2025, // Ensure it's an integer, not a full timestamp
                'brands_images' => json_encode([
                    "brands/brand1.png",
                    "brands/brand2.png",
                    "brands/brand3.png",
                    "brands/brand4.png",
                    "brands/brand5.png",
                    "brands/brand6.png"
                ]) 
            ]);
        }
    }
}
