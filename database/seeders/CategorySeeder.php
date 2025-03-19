<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

     public function run(): void
        {
            $categories = [
                "Web Development", "Marketing", "IT & Software", "Translation", "Link Development",
                "Culture & values", "Diversity & inclusion", "Work/life balance", "Compensation and benefits", "Career opportunities", 
                "Senior management", "Education", "E-learning", "Health Care", "Content Writing",
                "Power BI", "Graphic Designing", "UI / UX"
            ];
    
            foreach ($categories as $category) {
                Category::create([
                    'name' => $category,
                ]);
            }
            
        }

}
