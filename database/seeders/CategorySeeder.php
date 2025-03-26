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
                ['name' => "Sales", 'image' => "category/sales.webp"],
                ['name' => "IT & Software", 'image' => "category/It_and_software.webp"],
                ['name' => "Creative/Design/Art", 'image' => "category/Art.webp"],
                ['name' => "Translation", 'image' => "category/work_home.webp"],
                ['name' => "Culture & values", 'image' => "category/It_and_software.webp"],
                ['name' => "Diversity & inclusion", 'image' => "category/It_and_software.webp"],
                ['name' => "Work/life balance", 'image' => "category/It_and_software.webp"],
                ['name' => "Compensation and benefits", 'image' => "category/It_and_software.webp"],
                ['name' => "Career opportunities", 'image' => "category/It_and_software.webp"],
                ['name' => "Senior management", 'image' => "category/It_and_software.webp"],
                ['name' => "Power BI", 'image' => "category/It_and_software.webp"],
                ['name' => "Graphic Designing", 'image' => "category/It_and_software.webp"],
                ['name' => "Education", 'image' => "category/It_and_software.webp"],
                ['name' => "UI / UX", 'image' => "category/It_and_software.webp"],
                ['name' => "Health Care", 'image' => "category/It_and_software.webp"],
                ['name' => "Content Writing", 'image' => "category/It_and_software.webp"],
    
            ];
            foreach ($categories as $category) {
                Category::create([
                    'name' =>  $category['name'],
                    'image' =>  $category['image'],
                ]);
            }
            
        }

}
