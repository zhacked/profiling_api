<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Location;
use App\Models\Education;
use App\Models\Application;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

class ApplicationControllerTest extends TestCase
{
    use LazilyRefreshDatabase, WithFaker, WithoutMiddleware;

    public function test_a_user_can_read_all_applications()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        Application::factory()->count(5)->create();

        $response = $this->withoutExceptionHandling()
        ->get('/api/applications');

        $response->assertOk()
        ->assertJsonCount(5);
    }

    public function test_a_user_can_fetch_all_applications_ending_soon()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        Application::factory()->count(5)->create();

        $response = $this->withoutExceptionHandling()
        ->get('/api/applications?sort_by=apply_before');

        $response->assertOk()
        ->assertJsonCount(5);
    }

    public function test_a_user_can_create_a_application()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $data = [
            'recruiter_id' => $user->id,
            'location_id' => Location::factory()->create()->id,
            'logo' => '/fake/path',
            'job_title' => $this->faker->word,
            'company_name' => $this->faker->word,
            'apply_before' => $this->faker->date('y-m-d'),
            'salary' => $this->faker->randomDigit,
        ];

        $response = $this->withoutExceptionHandling()
        ->post('/api/applications', $data);

        $response->assertStatus(201);

        $this->assertDatabaseHas('applications', $data);
    }

    public function test_a_user_can_update_a_application()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $application = Application::factory()->create();

        $data = [
            'recruiter_id' => $user->id,
            'location_id' => Location::factory()->create()->id,
            'logo' => '/fake/path',
            'job_title' => $this->faker->word,
            'company_name' => $this->faker->word,
            'apply_before' => $this->faker->date('y-m-d'),
            'salary' => $this->faker->randomDigit,
        ];

        $response = $this->withoutExceptionHandling()
        ->put('/api/applications/' . $application->id, $data);

        $response->assertOk();

        $this->assertDatabaseHas('applications', $data);
    }

    public function test_a_user_can_fetch_a_single_applications()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $application = Application::factory()->create();

        $response = $this->withoutExceptionHandling()
        ->get('/api/applications/' . $application->id);

        $response->assertOk()
        ->assertJsonStructure();
    }

    public function test_a_user_can_delete_a_applications()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $application = Application::factory()->create();

        $response = $this->withoutExceptionHandling()
        ->delete('/api/applications/' . $application->id);


        $response->assertOk();

        $this->assertSoftDeleted('applications', $application->toArray());
    }

}
