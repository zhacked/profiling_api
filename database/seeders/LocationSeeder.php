<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locations = [
            'Australia',
            'Cambodia',
            'China',
            'Guam',
            'Hong Kong', 
            'Indonesia',
            'Japan',
            'Macau',
            'Malaysia',
            'New Zealand',
            'Philippines',
            'Saipan',
            'Singapore',
            'South Korea',
            'Taiwan',
            'Thailand',
            'Vietnam'
        ];

        foreach($locations as $location) {
            Location::create([
                'name'  => $location
            ]);
        }
    }
}
