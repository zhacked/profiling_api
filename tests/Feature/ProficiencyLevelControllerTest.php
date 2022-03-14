<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\ProficiencyLevel;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

class ProficiencyLevelControllerTest extends TestCase
{
    use LazilyRefreshDatabase, WithFaker;

    public function test_a_user_can_read_all_proficiency_levels()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

       ProficiencyLevel::factory()->count(1)->create();
        
        $response = $this->withoutExceptionHandling()
        ->get('/api/proficiency-levels');

        $response->assertOk()
        ->assertJsonCount(1);
    }

    public function test_a_user_can_create_a_proficiency_level()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $data = [
            'name' => $this->faker->word()
        ];

        $response = $this->withoutExceptionHandling()
        ->post('/api/proficiency-levels', $data);

        $response->assertStatus(201);

        $this->assertDatabaseHas('proficiency_levels', $data);
    }

    public function test_a_user_can_update_a_proficiency_level()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $proficiencylevel = ProficiencyLevel::factory()->create();

        $data = [
            'name' => $this->faker->word()

        ];

        $response = $this->withoutExceptionHandling()
        ->put('/api/proficiency-levels/' . $proficiencylevel->id, $data);

        $response->assertOk();

        $this->assertDatabaseHas('proficiency_levels', $data);
    }

    public function test_a_user_can_fetch_a_single_proficiency_level()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $proficiencylevel = ProficiencyLevel::factory()->create();

        $response = $this->withoutExceptionHandling()
        ->get('/api/proficiency-levels/' . $proficiencylevel->id);

        $response->assertOk()
        ->assertJsonStructure();
    }

    public function test_a_user_can_delete_a_proficiency_level()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $proficiencylevel = ProficiencyLevel::factory()->create();

        $response = $this->withoutExceptionHandling()
        ->delete('/api/proficiency-levels/' . $proficiencylevel->id);

        $response->assertOk();

        $this->assertSoftDeleted('proficiency_levels', $proficiencylevel->toArray());
    }
}
