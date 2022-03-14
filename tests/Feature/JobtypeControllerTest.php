<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use App\Models\Jobtype;
use Illuminate\Support\Str;
use Database\Seeders\JobTypeSeeder;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

class JobtypeControllerTest extends TestCase
{
    use LazilyRefreshDatabase, WithFaker;

    public function test_a_user_can_read_all_jobtype()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        Jobtype::factory()->count(5)->create();

        $response = $this->withoutExceptionHandling()
        ->get('/api/job-types');

        $response->assertOk()
        ->assertJsonCount(5);
    }

    public function test_a_user_can_create_a_jobtype()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $data = [
            'name' => $this->faker->word(),
        ];

        $response = $this->withoutExceptionHandling()
        ->post('/api/job-types', $data);

        $response->assertStatus(201);

        $this->assertDatabaseHas('job_types', $data);
    }

    public function test_a_user_can_update_a_jobtype()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $jobtype = Jobtype::factory()->create();

        $data = [
            'name' => $this->faker->word(),
        ];

        $response = $this->withoutExceptionHandling()
        ->put('/api/job-types/' . $jobtype->id, $data);

        $response->assertOk();

        $this->assertDatabaseHas('job_types', $data);
    }

    public function test_a_user_can_fetch_a_single_jobtype()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $jobtype = Jobtype::factory()->create();

        $response = $this->withoutExceptionHandling()
        ->get('/api/job-types/' . $jobtype->id);

        $response->assertOk()
        ->assertJsonStructure();
    }

    public function test_a_user_can_delete_a_jobtype()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $jobtype = Jobtype::factory()->create();

        $response = $this->withoutExceptionHandling()
        ->delete('/api/job-types/' . $jobtype->id);

        $response->assertOk();

        $this->assertSoftDeleted('job_types', $jobtype->toArray());
    }
}
