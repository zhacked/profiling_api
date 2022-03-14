<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Location;
use App\Models\Education;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => Str::uuid(),
            'recruiter_id' => User::factory()->create()->id,
            'location_id' => Location::factory()->create()->id,
            'logo' => '/fake/path',
            'job_title' => $this->faker->word,
            'company_name' => $this->faker->word,
            'apply_before' => $this->faker->date('y-m-d'),
            'salary' => $this->faker->randomDigit,
        ];
    }
}
