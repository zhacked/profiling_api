<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use App\Models\Location;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

class LocationControllerTest extends TestCase
{
    use LazilyRefreshDatabase, WithFaker;

    public function test_a_user_can_read_all_locations()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        Location::factory()->count(5)->create();

        $response = $this->withoutExceptionHandling()
        ->get('/api/locations');

        $response->assertOk()
        ->assertJsonCount(5);
    }

    public function test_a_user_can_create_a_location()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $data = [
            'name' => $this->faker->word()
        ];

        $response = $this->withoutExceptionHandling()
        ->post('/api/locations', $data);

        $response->assertStatus(201);

        $this->assertDatabaseHas('locations', $data);
    }

    public function test_a_user_can_update_a_location()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $location = Location::factory()->create();

        $data = [
            'name' => $this->faker->word(),
        ];

        $response = $this->withoutExceptionHandling()
        ->put('/api/locations/' . $location->id, $data);

        $response->assertOk();

        $this->assertDatabaseHas('locations', $data);
    }

    public function test_a_user_can_fetch_a_single_location()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $location = Location::factory()->create();

        $response = $this->withoutExceptionHandling()
        ->get('/api/locations/' . $location->id);

        $response->assertOk()
        ->assertJsonStructure();
    }

    public function test_a_user_can_delete_a_location()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $location = Location::factory()->create();

        $response = $this->withoutExceptionHandling()
        ->delete('/api/locations/' . $location->id);

        $response->assertOk();

        $this->assertSoftDeleted('locations', $location->toArray());
    }
}
