<?php

namespace Database\Seeders;

use App\Models\JobLevel;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class JobLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $jobLevel = [
            'Internship',
            'Entry Level',
            'Associate',
            'Mid-Senior level',
            'Director',
            'Executive'

        ];

        foreach($jobLevel as $level) {
            JobLevel::create([
                'name'  => $level
            ]);
        }

    }
}
