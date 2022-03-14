<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use App\Models\Affiliation;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

class AffiliationControllerTest extends TestCase
{
    use LazilyRefreshDatabase, WithFaker;

    public function test_a_user_can_read_all_affiliation()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        Affiliation::factory()->count(5)->create();

        $response = $this->withoutExceptionHandling()
            ->get('/api/affiliations');

        $response->assertOk()
            ->assertJsonCount(5);
    }

    public function test_a_user_can_create_a_affiliation()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $data = [
            'name' => $this->faker->word(),
            'description' => $this->faker->word()
        ];

        $response = $this->withoutExceptionHandling()
            ->post('/api/affiliations', $data);

        $response->assertStatus(201);

        $this->assertDatabaseHas('affiliations', $data);
    }

    public function test_a_user_can_update_a_affiliation()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $affiliation = Affiliation::factory()->create();

        $data = [
            'name' => $this->faker->word(),
            'description' => $this->faker->word()
        ];

        $response = $this->withoutExceptionHandling()
            ->put('/api/affiliations/' . $affiliation->id, $data);

        $response->assertOk();

        $this->assertDatabaseHas('affiliations', $data);
    }

    public function test_a_user_can_fetch_a_single_affiliation()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $affiliation = Affiliation::factory()->create();

        $response = $this->withoutExceptionHandling()
            ->get('/api/affiliations/' . $affiliation->id);

        $response->assertOk()
            ->assertJsonStructure();
    }

    public function test_a_user_can_delete_a_affiliation()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $affiliation = Affiliation::factory()->create();

        $response = $this->withoutExceptionHandling()
            ->delete('/api/affiliations/' . $affiliation->id);

        $response->assertOk();

        $this->assertSoftDeleted('affiliations', $affiliation->toArray());
    }
}
