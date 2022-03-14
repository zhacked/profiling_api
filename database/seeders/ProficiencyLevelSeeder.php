<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProficiencyLevel;

class ProficiencyLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ProficiencyLevels = [
            'Beginner',
           ' Intermediate',
            'Fluent',
        ];

        foreach($ProficiencyLevels as $ProficiencyLevel) {
            ProficiencyLevel::create([
                'name'  => $ProficiencyLevel
            ]);
        }
    }
}
