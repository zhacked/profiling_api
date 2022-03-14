<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use App\Models\Credential;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

class CredentialControllerTest extends TestCase
{
    use LazilyRefreshDatabase, WithFaker;

    public function test_a_user_can_read_all_credentials()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $c = Credential::factory()->count(5)->create();

        $response = $this->withoutExceptionHandling()
        ->get('/api/credentials');

        $response->assertOk()
        ->assertJsonCount(5);
    }

    public function test_a_user_can_create_a_credential()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $data = [
            'name' => $this->faker->word(),
            'issuing_body' => $this->faker->word(),
            'month' => $this->faker->date('m'),
            'year' => $this->faker->date('y')
        ];

        $response = $this->withoutExceptionHandling()
        ->post('/api/credentials', $data);

        $response->assertStatus(201);

        $this->assertDatabaseHas('credentials', $data);
    }

    public function test_a_user_can_update_a_credential()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $credential = Credential::factory()->create();

        $data = [
            'name' => $this->faker->word(),
            'issuing_body' => $this->faker->word(),
            'month' => $this->faker->date('m'),
            'year' => $this->faker->date('y')
        ];

        $response = $this->withoutExceptionHandling()
        ->put('/api/credentials/' . $credential->id, $data);

        $response->assertOk();

        $this->assertDatabaseHas('credentials', $data);
    }

    public function test_a_user_can_fetch_a_single_credential()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $credential = Credential::factory()->create();

        $response = $this->withoutExceptionHandling()
        ->get('/api/credentials/' . $credential->id);

        $response->assertOk()
        ->assertJsonStructure();
    }

    public function test_a_user_can_delete_a_credential()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $credential = Credential::factory()->create();

        $response = $this->withoutExceptionHandling()
        ->delete('/api/credentials/' . $credential->id);

        $response->assertOk();

        $this->assertSoftDeleted('credentials', $credential->toArray());
    }
}
