<?php

namespace Database\Seeders;

use App\Models\Scheduler;
use Illuminate\Database\Seeder;

class SchedulerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Scheduler::factory()->count(1)->create();
    }
}
