<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use App\Models\JobLevel;
use Database\Seeders\JobLevelSeeder;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

class JobLevelControllerTest extends TestCase
{
    use LazilyRefreshDatabase, WithFaker;

    public function test_a_user_can_read_all_jobLevel()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        JobLevel::factory()->count(5)->create();

        $response = $this->withoutExceptionHandling()
        ->get('/api/job-levels');

        $response->assertOk()
        ->assertJsonCount(5);
    }

    public function test_a_user_can_create_a_jobLevel()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $data = [
            'name' => $this->faker->word()
        ];

        $response = $this->withoutExceptionHandling()
        ->post('/api/job-levels', $data);

        $response->assertStatus(201);

        $this->assertDatabaseHas('job_levels', $data);
    }

    public function test_a_user_can_update_a_jobLevel()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $jobLevel = JobLevel::factory()->create();

        $data = [
            'name' => $this->faker->word()

        ];

        $response = $this->withoutExceptionHandling()
        ->put('/api/job-levels/' . $jobLevel->id, $data);

        $response->assertOk();

        $this->assertDatabaseHas('job_levels', $data);
    }

    public function test_a_user_can_fetch_a_single_jobLevel()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $jobLevel = JobLevel::factory()->create();

        $response = $this->withoutExceptionHandling()
        ->get('/api/job-levels/' . $jobLevel->id);

        $response->assertOk()
        ->assertJsonStructure();
    }

    public function test_a_user_can_delete_a_jobLevel()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $jobLevel = JobLevel::factory()->create();

        $response = $this->withoutExceptionHandling()
        ->delete('/api/job-levels/' . $jobLevel->id);

        $response->assertOk();

        $this->assertSoftDeleted('job_levels', $jobLevel->toArray());
    }
}
