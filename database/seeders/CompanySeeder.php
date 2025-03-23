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
            ['name' => "Valeo", 'logo' => "company_logos/valeo.png"],
            ['name' => "Siemens", 'logo' => "company_logos/siemens.png"],
            ['name' => "Avelabs", 'logo' => "company_logos/avelabs.png"],
            ['name' => "Luxfort", 'logo' => "company_logos/luxfort.png"],
            ['name' => "Link Development", 'logo' => "company_logos/link_development.jpeg"],
            ['name' => "Etisalat", 'logo' => "company_logos/etisalat.png"],
            ['name' => "Huawei", 'logo' => "company_logos/huawei.png"],
            ['name' => "Samsung", 'logo' => "company_logos/samsung.png"],
            ['name' => "Microsoft", 'logo' => "company_logos/microsoft.png"],
            ['name' => "Facebook", 'logo' => "company_logos/Facebook.png"],
            ['name' => "Vois", 'logo' => "company_logos/vois.jpeg"],
            ['name' => "Google", 'logo' => "company_logos/Google.png"],
            ['name' => "Axios", 'logo' => "company_logos/axios.png"],
            ['name' => "We", 'logo' => "company_logos/we.png"],
            ['name' => "Afaqy", 'logo' => "company_logos/afaqy.png"],
            ['name' => "Apple", 'logo' => "company_logos/apple.png"],
            ['name' => "IBM", 'logo' => "company_logos/ibm.png"],
            ['name' => "Placeholder", 'logo' => "company_logos/placeholder.png"],
            ['name' => "Foodics", 'logo' => "company_logos/foodics.png"],
            ['name' => "Daftra", 'logo' => "company_logos/daftra.png"],
            ['name' => "xceed", 'logo' => "company_logos/xceed.png"]

        ];

        foreach ($companies as $company) {
            Company::create([
                'name' => $company['name'],
                'logo_path' => $company['logo'], // Use the logo from the array
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