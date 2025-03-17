<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobListing>
 */
class JobListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'company_id' => \App\Models\Company::factory(),
            'category_id' => \App\Models\Category::factory(),
            'title' => $this->faker->jobTitle,
            'description' => $this->faker->paragraph,
            'responsibilities' => $this->faker->paragraph,
            'requirements' => $this->faker->paragraph,
            'location' => $this->faker->city,
            'work_type' => $this->faker->randomElement(['remote', 'onsite', 'hybrid']),
            'experience_level' => $this->faker->randomElement(['intern', 'fresh', 'junior', 'senior', 'expert', 'lead', 'manager']),
            'salary_min' => $this->faker->randomFloat(2, 30000, 100000),
            'salary_max' => $this->faker->randomFloat(2, 100000, 200000),
            'application_deadline' => $this->faker->dateTimeBetween('now', '+1 year'),
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
            'is_featured' => $this->faker->boolean,
            'availble_vacancies' => $this->faker->numberBetween(1, 10),
            'job_nature' => $this->faker->randomElement(['full-time', 'part-time', 'hybrid']),
        ];
    }
}
