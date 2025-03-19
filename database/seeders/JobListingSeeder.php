<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;


use App\Models\Company;
use App\Models\JobListing;
use App\Models\Category;

use Illuminate\Support\Str;

class JobListingSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure at least one company and one category exist
        if (!Company::exists()) {
            Company::factory()->count(5)->create(); // Create 5 companies if none exist
        }
        
        if (!Category::exists()) {
            Category::factory()->count(5)->create(); // Create 5 categories if none exist
        }
    
        foreach ([
            "Software Engineer", "Digital Marketer", "WordPress Developer",
            "Graphic Designer", "Data Analyst", "Project Manager",
            "SEO Specialist", "Backend Developer", "Frontend Developer",
            "UI/UX Designer", "Content Writer", "Network Administrator",
            "Cyber Security Analyst", "Business Analyst", "HR Manager",
            "Customer Support Specialist", "Sales Representative", "DevOps Engineer",
            "AI Engineer", "Mobile App Developer"
        ] as $job) {
            JobListing::create([
                'user_id' => 1,
                'company_id' => Company::inRandomOrder()->value('id'), // Ensure valid company ID
                'category_id' => Category::inRandomOrder()->value('id'), // Ensure valid category ID
                'title' => $job,
                'description' => "Description for $job.",
                'responsibilities' => "Responsibilities for $job.",
                'requirements' => "Requirements for $job.",
                'location' => "Egypt",
                'work_type' => "remote",
                'status' => "approved",
                'application_deadline' => now()->addDays(3),
                'experience_level' => 'fresh',
                'salary_min' => '1000',
                'salary_max' => '25000',
                'is_featured' => false,
                'availble_vacancies' => '1',
                'job_nature' => 'full-time'
            ]);
        }
    }
    

}
