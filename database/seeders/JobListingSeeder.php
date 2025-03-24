<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\JobListing;
use App\Models\Category;
use Illuminate\Support\Arr; // Import Arr helper
use Illuminate\Support\Str;

class JobListingSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure at least one company and one category exist
        if (!Company::exists()) {
            Company::factory()->count(5)->create();
        }
        
        if (!Category::exists()) {
            Category::factory()->count(5)->create(); 
        }

        // Define possible values
        $workTypes = ['remote', 'onsite', 'hybrid'];
        $jobNatures = ['full-time', 'part-time', 'hybrid'];
        $statuses = ['pending', 'approved', 'rejected'];
        $experienceLevels = ['intern', 'fresh', 'junior', 'senior', 'expert', 'lead', 'manager'];
        $locations = ['Egypt', "United States", "Canada", "United Kingdom", "Germany", "France"];

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
                'company_id' => Company::inRandomOrder()->value('id'), 
                'category_id' => Category::inRandomOrder()->value('id'), 
                'title' => $job,
                'description' => "Description for $job.",
                'responsibilities' => "Responsibilities for $job.",
                'requirements' => "Requirements for $job.",
                'location' =>  Arr::random($locations),
                'work_type' => Arr::random($workTypes),
                'status' => Arr::random($statuses),

                'application_deadline' => now()->addYears(1)->format('Y-m-d'), 
                'experience_level' => Arr::random($experienceLevels), 
                'salary_min' => '1000',
                'salary_max' => '25000',
                'is_featured' => false,
                'availble_vacancies' => '1',
                'job_nature' => Arr::random($jobNatures) 
            ]);
        }
    }
}
