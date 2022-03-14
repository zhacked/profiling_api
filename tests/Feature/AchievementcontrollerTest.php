<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use App\Models\Achievement;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

class AchievementcontrollerTest extends TestCase
{
    use LazilyRefreshDatabase, WithFaker;

    public function test_a_user_can_read_all_achievement()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        Achievement::factory()->count(5)->create();

        $response = $this->withoutExceptionHandling()
        ->get('/api/achievements');

        $response->assertOk()
        ->assertJsonCount(5);
    }

    public function test_a_user_can_create_a_achievement()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $data = [
            'name' => $this->faker->word,
            'description' => $this->faker->word
        ];

        $response = $this->withoutExceptionHandling()
        ->post('/api/achievements', $data);

        $response->assertStatus(201);

        $this->assertDatabaseHas('achievements', $data);
    }

    public function test_a_user_can_update_a_achievement()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $achievement = Achievement::factory()->create();

        $data = [
            'name' => $this->faker->word(),
            'description' => $this->faker->word()
        ];

        $response = $this->withoutExceptionHandling()
        ->put('/api/achievements/' . $achievement->id, $data);

        $response->assertOk();

        $this->assertDatabaseHas('achievements', $data);
    }

    public function test_a_user_can_fetch_a_single_achievement()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $achievement = Achievement::factory()->create();

        $response = $this->withoutExceptionHandling()
        ->get('/api/achievements/' . $achievement->id);

        $response->assertOk()
        ->assertJsonStructure();
    }

    public function test_a_user_can_delete_a_achievement()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $achievement = Achievement::factory()->create();
        
        $response = $this->withoutExceptionHandling()
        ->delete('/api/achievements/' . $achievement->id);

        $response->assertOk();

        $this->assertSoftDeleted('achievements', $achievement->toArray());
    }
}
