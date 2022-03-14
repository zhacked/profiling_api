<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class CredentialFactory extends Factory
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
            'name' => $this->faker->word,
            'issuing_body' => $this->faker->word,
            'month' => $this->faker->date('m'),
            'year' => $this->faker->date('y')
        ];
    }
}
