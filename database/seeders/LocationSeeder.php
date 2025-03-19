<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\Location;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        // Fetch countries from API
        $response = Http::withoutVerifying()->get('https://restcountries.com/v3.1/all');


        if ($response->successful()) {
            $countries = $response->json();

            foreach ($countries as $country) {
                Location::create([
                    'name' => $country['name']['common'] ?? 'Unknown'
                ]);
            }
        } else {
            // Fallback: Use a static country list if API fails
            $this->fallbackCountries();
        }
    }

    private function fallbackCountries()
    {
        $countries = [
            "United States", "Canada", "United Kingdom", "Germany", "France",
            "Italy", "Spain", "Egypt", "Brazil", "India", "China", "Japan",
            "Australia", "South Africa", "Russia", "Mexico", "Argentina",
            "Saudi Arabia", "United Arab Emirates", "Turkey"
        ];

        foreach ($countries as $country) {
            Location::create(['name' => $country]);
        }
    }
}
