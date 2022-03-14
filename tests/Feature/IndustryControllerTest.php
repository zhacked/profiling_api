<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use App\Models\Industry;
use Database\Seeders\IndustrySeeder;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

class IndustryControllerTest extends TestCase
{
    use LazilyRefreshDatabase, WithFaker;

    /** @test */
    public function itListAllIndustryInAscendingOrder(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $this->seed(IndustrySeeder::class);

        $response = $this->withoutExceptionHandling()
            ->get('api/industries');

        $response->assertOk()
            ->assertJsonCount(15, 'data');
    }
    public function test_a_user_can_create_a_industry()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $data = [
            'name' => $this->faker->word()
        ];

        $response = $this->withoutExceptionHandling()
        ->post('/api/industries', $data);

        $response->assertStatus(201);

        $this->assertDatabaseHas('industries', $data);
    }

    public function test_a_user_can_update_a_industry()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $industry = Industry::factory()->create();

        $data = [
            'name' => $this->faker->word()
        ];

        $response = $this->withoutExceptionHandling()
        ->put('/api/industries/'.$industry->id, $data);

        $response->assertOk();

        $this->assertDatabaseHas('industries', $data);
    }

    public function test_a_user_can_fetch_a_single_industry()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $industry = Industry::factory()->create();

        $response = $this->withoutExceptionHandling()
        ->get('/api/industries/' . $industry->id);

        $response->assertOk()
        ->assertJsonStructure();
    }

    public function test_a_user_can_delete_a_industry()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $industry = Industry::factory()->create();

        $response = $this->withoutExceptionHandling()
        ->delete('/api/industries/' . $industry->id);

        $response->assertOk();

        $this->assertSoftDeleted('industries', $industry->toArray());
    }
}
