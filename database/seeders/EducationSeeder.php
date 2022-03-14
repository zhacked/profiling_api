<?php

namespace Database\Seeders;


use App\Models\Education;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class EducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $eductions = [
            'High school',
            'Vocational',
            'Certificate',
            'College level',
            'Bachelors degree',
            'Masters degree or higher',
        ];

        foreach($eductions as $eduction) {
            Education::create([
                'name'  => $eduction
            ]);
        }
    }
}
