<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class SchedulerFactory extends Factory
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
            'interview_date' => $this->faker->date('y-m-d'),
            'interview_start' => $this->faker->date('H:i:s'),
            'interview_end' => $this->faker->date('H:i:s'),
            'interview_link' => $this->faker->url,
            'email'  => $this->faker->safeEmail ,
            'name' =>  $this->faker->firstName,
            'position'  =>$this->faker->word,
            'address' =>$this->faker->address,
            'note'=> $this->faker->word

        ];
    }
}
