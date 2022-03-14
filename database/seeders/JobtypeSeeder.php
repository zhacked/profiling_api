<?php

namespace Database\Seeders;

use App\Models\JobType;
use Illuminate\Database\Seeder;

class JobTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jobType = [
            'Full time',
            'Part time',
            'Contractual',
            'Project',
            'Internship'

        ];

        foreach($jobType as $type) {
            JobType::create([
                'name'  => $type
            ]);
        }
    }
}
