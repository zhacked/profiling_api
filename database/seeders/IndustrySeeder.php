<?php

namespace Database\Seeders;

use App\Models\Industry;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class IndustrySeeder extends Seeder
{
    public function run(): void
    {
        $industries = [
            'Hotel / Resort',
            'Agency / Tour Operator',
            'Airline',
            'Car Rental',
            'Consulting and Training',
            'Cruise Ship',
            'Food and Beverage',
            'Gaming',
            'Meetings and Events',
            'Retail',
            'Serviced Residence',
            'Spa and Wellness',
            'Systems / Technology',
            'Talent Acquisition',
            'Theme Park'
        ];

        foreach($industries as $industry) {
            Industry::create([             
                'name'  => $industry
            ]);
        }
    }
}
