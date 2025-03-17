<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
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
            'job_title' => $this->faker->jobTitle,
            'address' => $this->faker->address,
            'phone_number' => $this->faker->unique()->phoneNumber,
            'bio' => $this->faker->paragraph,
            'resume_path' => $this->faker->url,
            'linkedin_url' => $this->faker->url,
            'skills' => json_encode(['PHP', 'Laravel', 'JavaScript']),
            'experiences' => json_encode([
                ['company' => 'Company A', 'role' => 'Developer', 'duration' => '2 years'],
                ['company' => 'Company B', 'role' => 'Senior Developer', 'duration' => '3 years'],
            ]),
            'certifications' => json_encode(['Laravel Certified', 'AWS Certified']),
        ];
    }
}
