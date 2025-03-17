<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'user_id' => \App\Models\User::factory(),
            'name' => $this->faker->company,
            'logo_path' => $this->faker->imageUrl(),
            'website' => $this->faker->url,
            'description' => $this->faker->paragraph,
            'industry' => $this->faker->word,
            'established_year' => $this->faker->year,
        ];
    }
}
