<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use App\Models\Education;
use Database\Seeders\EducationSeeder;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

class EducationControllerTest extends TestCase
{
    use LazilyRefreshDatabase, WithFaker;

    public function test_a_user_can_read_all_education()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        Education::factory()->count(5)->create();

        $response = $this->withoutExceptionHandling()
        ->get('/api/educations');

        $response->assertOk()
        ->assertJsonCount(5);
    }

    public function test_a_user_can_create_a_education()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $data = [
            'name' => $this->faker->word()
        ];

        $response = $this->withoutExceptionHandling()
        ->post('/api/educations', $data);

        $response->assertStatus(201);

        $this->assertDatabaseHas('educations', $data);
    }

    public function test_a_user_can_update_a_education()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $education = Education::factory()->create();

        $data = [
            'name' => $this->faker->word(),
        ];

        $response = $this->withoutExceptionHandling()
        ->put('/api/educations/' . $education->id, $data);

        $response->assertOk();

        $this->assertDatabaseHas('educations', $data);
    }

    public function test_a_user_can_fetch_a_single_education()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $education = Education::factory()->create();

        $response = $this->withoutExceptionHandling()
        ->get('/api/educations/' . $education->id);

        $response->assertOk()
        ->assertJsonStructure();
    }

    public function test_a_user_can_delete_a_education()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $education = Education::factory()->create();

        $response = $this->withoutExceptionHandling()
        ->delete('/api/educations/' . $education->id);

        $response->assertOk();

        $this->assertSoftDeleted('educations', $education->toArray());
    }
}
