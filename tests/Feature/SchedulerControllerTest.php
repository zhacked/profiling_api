<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Scheduler;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

class SchedulerControllerTest extends TestCase
{
    use LazilyRefreshDatabase, WithFaker;

    public function test_a_user_can_read_all_schedules()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');
       
       Scheduler::factory()->count(1)->create();
        
        $response = $this->withoutExceptionHandling()
        ->get('/api/schedulers');

        $response->assertOk()
        ->assertJsonCount(1);
    }

    public function test_a_user_can_create_a_schedules()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $data = [
            'interview_date' => $this->faker->date('y-m-d'),
            'interview_start'=> $this->faker->date('H:i:s'),
            'interview_end'  => $this->faker->date('H:i:s'),
            'interview_link' => $this->faker->url(),
            'email' => $this->faker->safeEmail() ,
            'name' =>  $this->faker->firstName(),
            'position' =>$this->faker->word(),
            'address' =>$this->faker->address(),
            'note' => $this->faker->word(),
        ];

        $response = $this->withoutExceptionHandling()
        ->post('/api/schedulers', $data);

        $response->assertStatus(201);

        $this->assertDatabaseHas('schedulers', $data);
    }

    public function test_a_user_can_update_a_schedules()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $scheduler = Scheduler::factory()->create();

        $data = [
            'interview_date' => $this->faker->date('y-m-d'),
            'interview_start'=> $this->faker->date('H:i:s'),
            'interview_end'  => $this->faker->date('H:i:s'),
            'interview_link' => $this->faker->url(),
            'email' => $this->faker->safeEmail() ,
            'name' =>  $this->faker->firstName(),
            'position' =>$this->faker->word(),
            'address' =>$this->faker->address(),
            'note' => $this->faker->word(),
        ];

        $response = $this->withoutExceptionHandling()
        ->put('/api/schedulers/' . $scheduler->id, $data);

        $response->assertOk();

        $this->assertDatabaseHas('schedulers', $data);
    }

    public function test_a_user_can_fetch_a_single_schedules()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $scheduler = Scheduler::factory()->create();

        $response = $this->withoutExceptionHandling()
        ->get('/api/schedulers/' . $scheduler->id);

        $response->assertOk()
        ->assertJsonStructure();
    }

    public function test_a_user_can_delete_a_schedules()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $scheduler = Scheduler::factory()->create();
        
        $response = $this->withoutExceptionHandling()
        ->delete('/api/schedulers/' . $scheduler->id);

        $response->assertOk();

        $this->assertSoftDeleted('schedulers', $scheduler->toArray());
    }
}
