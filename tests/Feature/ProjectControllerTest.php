<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use App\Models\Project;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

class ProjectControllerTest extends TestCase
{
    use LazilyRefreshDatabase, WithFaker;

    public function test_a_user_can_read_all_projects()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        Project::factory()->count(5)->create();

        $response = $this->withoutExceptionHandling()
        ->get('/api/projects');

        $response->assertOk()
        ->assertJsonCount(5);
    }

    public function test_a_user_can_create_a_project()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $data = [
            'name' => $this->faker->word,
            'description' => $this->faker->word
        ];

        $response = $this->withoutExceptionHandling()
        ->post('/api/projects', $data);

        $response->assertStatus(201);

        $this->assertDatabaseHas('projects', $data);
    }

    public function test_a_user_can_update_a_project()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $project = Project::factory()->create();

        $data = [
            'name' => $this->faker->word(),
            'description' => $this->faker->word()
        ];

        $response = $this->withoutExceptionHandling()
        ->put('/api/projects/' . $project->id, $data);

        $response->assertOk();

        $this->assertDatabaseHas('projects', $data);
    }

    public function test_a_user_can_fetch_a_single_projectt()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $project = Project::factory()->create();

        $response = $this->withoutExceptionHandling()
        ->get('/api/projects/' . $project->id);

        $response->assertOk()
        ->assertJsonStructure();
    }

    public function test_a_user_can_delete_a_project()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $project = Project::factory()->create();

        $response = $this->withoutExceptionHandling()
        ->delete('/api/projects/' . $project->id);

        $response->assertOk();

        $this->assertSoftDeleted('projects', $project->toArray());
    }
}
