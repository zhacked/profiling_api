<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\Education;
use App\Models\Industry;
use App\Models\JobLevel;
use App\Models\JobType;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobFactory extends Factory
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
            'industry_id' => Industry::factory()->create()->id,
            'department_id' => Department::factory()->create()->id,
            'job_level_id'=> JobLevel::factory()->create()->id,
            'job_type_id'=> JobType::factory()->create()->id,
            'education_id'=> Education::factory()->create()->id,
            'job_title' => $this->faker->word,
            'contract'   => $this->faker->word,
            'description'  => $this->faker->word,
            'minimum_requirements'  => $this->faker->word,
            'min_salary'  => $this->faker->numberBetween(0, 10000),
            'max_salary'  => $this->faker->numberBetween(10001, 20000),
            'location'  => $this->faker->word,
            'perks_benefits'  => $this->faker->word .','. $this->faker->word . ','. $this->faker->word,
            'no_of_vacancy' =>  $this->faker->randomDigit,
            'header_image' => $this->faker->image(storage_path('/app/public/images'), 352, 123, null, false),
            'featured_image' => $this->faker->image(storage_path('/app/public/images'), 619, 643, null, false),
        ];
    }
}
