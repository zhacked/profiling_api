<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use App\Models\Skill;
use Database\Seeders\SkillSeeder;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

class SkillControllerTest extends TestCase
{
    use LazilyRefreshDatabase, WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_a_user_can_read_all_skills()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $this->seed(SkillSeeder::class);

        $response = $this->withoutExceptionHandling()
            ->get('/api/skills');

        $response->assertOk();

    }

    public function test_a_user_can_add_a_skill()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $data = [
            'id' => $this->faker->uuid,
            'name' => $this->faker->word
        ];


        $response = $this->withoutExceptionHandling()
        ->post('/api/skills', $data);

        $response->assertStatus(201);
    }

    public function test_a_user_can_update_a_skill()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $Skill = Skill::factory()->makeOne();

        $response = $this->withoutExceptionHandling()
        ->put('/api/skills/' . $Skill->id, [
            'name' => 'update'
        ]);


        $response->assertOk();
    }

    public function test_a_user_can_fetch_a_single_skill()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $Skill = Skill::factory()->makeOne();

        $response = $this->withoutExceptionHandling()
        ->get('api/skills/' . $Skill->id);

        $response->assertOk()
        ->assertJsonStructure();
    }
    public function test_a_user_can_delete_a_single_skill()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $skill = Skill::factory()->create();

        $response = $this->withoutExceptionHandling()
        ->delete('api/skills/' . $skill->id);

        $response->assertOk();

        $this->assertSoftDeleted('skills', $skill->toArray());
    }
}
