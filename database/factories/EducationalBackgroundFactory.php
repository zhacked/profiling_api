<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Education;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class EducationalBackgroundFactory extends Factory
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
            'user_id' => User::factory()->create()->id,
            'education_id'=> Education::factory()->create()->id,
            'study_from_month' => $this->faker->date('m'),
            'study_from_year' => $this->faker->date('y'),
            'study_to_month' => $this->faker->date('m'),
            'study_to_year' => $this->faker->date('y'),
            'degree' =>$this->faker->word,
        ];
    }
}
