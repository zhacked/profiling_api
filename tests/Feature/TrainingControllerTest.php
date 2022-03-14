<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use App\Models\Training;

class TrainingControllerTest extends TestCase
{
    use LazilyRefreshDatabase, WithFaker;

    public function test_a_user_can_read_all_training()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        Training::factory()->count(5)->create();
    
        $response = $this->withoutExceptionHandling()
        ->get('/api/trainings');

        $response->assertOk()
        ->assertJsonCount(5);
    }

    public function test_a_user_can_create_a_training()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $data = [
            'name' => $this->faker->word(),
            'description' => $this->faker->word(), 
            'month' => $this->faker->date('m'),
            'year' =>  $this->faker->date('Y')
        ];

        $response = $this->withoutExceptionHandling()
        ->post('/api/trainings', $data);

        $response->assertStatus(201);

        $this->assertDatabaseHas('trainings', $data);
    }

    public function test_a_user_can_update_a_training()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $training = Training::factory()->create();

        $data = [
            'name' => $this->faker->word(),
            'description' => $this->faker->word(),          
            'month' => $this->faker->date('m'),
            'year' =>  $this->faker->date('Y')

        ];

        $response = $this->withoutExceptionHandling()
        ->put('/api/trainings/' . $training->id, $data);

        $response->assertOk();

        $this->assertDatabaseHas('trainings', $data);
    }

    public function test_a_user_can_fetch_a_single_training()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $training = Training::factory()->create();

        $response = $this->withoutExceptionHandling()
        ->get('/api/trainings/' . $training->id);

        $response->assertOk()
        ->assertJsonStructure();
    }

    public function test_a_user_can_delete_a_training()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $training = Training::factory()->create();

        $response = $this->withoutExceptionHandling()
        ->delete('/api/trainings/' . $training->id);

        $response->assertOk();

        $this->assertSoftDeleted('trainings', $training->toArray());
    }
}