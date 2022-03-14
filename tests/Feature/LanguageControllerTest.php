<?php

namespace Tests\Feature;

use App\Models\Language;
use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class LanguageControllerTest extends TestCase
{
    use LazilyRefreshDatabase, WithFaker, WithoutMiddleware;

    public function test_a_user_can_read_all_languages()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        Language::factory()->count(5)->create();

        $response = $this->withoutExceptionHandling()
        ->get('/api/languages');

        $response->assertOk()
        ->assertJsonCount(5);
    }

    public function test_a_user_can_create_a_language()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $data = [
            'name' => $this->faker->word,
            'proficiency' => $this->faker->word
        ];

        $response = $this->withoutExceptionHandling()
        ->post('/api/languages', $data);

        $response->assertStatus(201);

        $this->assertDatabaseHas('languages', $data);
    }

    public function test_a_user_can_update_a_language()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $language = Language::factory()->create();

        $data = [
            'name' => $this->faker->word(),
            'proficiency' => $this->faker->word()
        ];

        $response = $this->withoutExceptionHandling()
        ->put('/api/languages/' . $language->id, $data);

        $response->assertOk();

        $this->assertDatabaseHas('languages', $data);
    }

    public function test_a_user_can_fetch_a_single_language()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $language = Language::factory()->create();

        $response = $this->withoutExceptionHandling()
        ->get('/api/languages/' . $language->id);

        $response->assertOk()
        ->assertJsonStructure();
    }

    public function test_a_user_can_delete_a_language()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $language = Language::factory()->create();

        $response = $this->withoutExceptionHandling()
        ->delete('/api/languages/' . $language->id);

        $response->assertOk();

        $this->assertSoftDeleted('languages', $language->toArray());
    }
}
