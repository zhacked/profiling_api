<?php

namespace Tests\Feature;

use App\Models\Department;
use App\Models\Education;
use App\Models\Industry;
use App\Models\Job;
use App\Models\JobLevel;
use App\Models\JobType;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

class JobControllerTest extends TestCase
{
    use LazilyRefreshDatabase, WithFaker, WithoutMiddleware;

    public function test_a_user_can_read_all_jobs()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        Job::factory()->count(5)->create();

        $response = $this->withoutExceptionHandling()
        ->get('/api/jobs');

        $response->assertOk()
        ->assertJsonCount(5);
    }

    public function test_a_user_can_create_a_job()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $data = [
            'industry_id' => Industry::factory()->create()->id,
            'department_id' => Department::factory()->create()->id,
            'job_level_id'=> JobLevel::factory()->create()->id,
            'job_type_id'=> JobType::factory()->create()->id,
            'education_id'=> Education::factory()->create()->id,
            'job_title' => $this->faker->word,
            'contract'   => $this->faker->word,
            'description'  => $this->faker->word,
            'minimum_requirements'  => $this->faker->word,
            'min_salary'  => $this->faker->randomDigit,
            'max_salary'  => $this->faker->randomDigit,
            'location'  => $this->faker->word,
            'perks_benefits'  => $this->faker->word .','. $this->faker->word . ','. $this->faker->word,
            'no_of_vacancy' =>  $this->faker->randomDigit
        ];

        $response = $this->withoutExceptionHandling()
        ->post('/api/jobs', $data);

        $response->assertStatus(201);

        $this->assertDatabaseHas('jobs', $data);
    }

    public function test_a_user_can_update_a_job()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $job = Job::factory()->create();

        $data = [
            'industry_id' => Industry::factory()->create()->id,
            'department_id' => Department::factory()->create()->id,
            'job_level_id'=> JobLevel::factory()->create()->id,
            'job_type_id'=> JobType::factory()->create()->id,
            'education_id'=> Education::factory()->create()->id,
            'job_title' => $this->faker->word,
            'contract'   => $this->faker->word,
            'description'  => $this->faker->word,
            'minimum_requirements'  => $this->faker->word,
            'min_salary'  => $this->faker->randomDigit,
            'max_salary'  => $this->faker->randomDigit,
            'location'  => $this->faker->word,
            'perks_benefits'  => $this->faker->word .','. $this->faker->word . ','. $this->faker->word,
            'no_of_vacancy' =>  $this->faker->randomDigit
        ];

        $response = $this->withoutExceptionHandling()
        ->put('/api/jobs/' . $job->id, $data);

        $response->assertOk();

        $this->assertDatabaseHas('jobs', $data);
    }

    public function test_a_user_can_fetch_a_single_job()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $job = Job::factory()->create();

        $response = $this->withoutExceptionHandling()
        ->get('/api/jobs/' . $job->id);

        $response->assertOk()
        ->assertJsonStructure();
    }

    public function test_a_user_can_delete_a_job()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $job = Job::factory()->create();

        $response = $this->withoutExceptionHandling()
        ->delete('/api/jobs/' . $job->id);

        $response->assertOk();

        $this->assertSoftDeleted('jobs', $job->toArray());
    }
}
