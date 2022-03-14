<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\WithFaker;

class UsersSeeder extends Seeder
{

    use WithFaker;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
        User::factory(10)->create();
    }
}
