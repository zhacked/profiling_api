<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use LazilyRefreshDatabase, WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_a_user_can_read_all_users()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        User::factory()->count(5)->create();

        $response = $this->withoutExceptionHandling()
        ->get('/api/users');

        $response->assertOk()
            ->assertJsonCount(6);
    }

    public function test_a_user_can_add_a_user()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $data = [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ];

        $response = $this->withoutExceptionHandling()
        ->post('/api/users', $data);

        $response->assertStatus(201);

        $this->assertDatabaseHas('users', $data);
    }

    public function test_a_user_can_update_a_user()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $user = User::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail()
        ];

        $response = $this->withoutExceptionHandling()
        ->put('/api/users/' . $user->id, $data);

        $response->assertOk();

        $this->assertDatabaseHas('users', $data);
    }

    public function test_a_user_can_fetch_a_single_user()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $user = User::factory()->makeOne();

        $response = $this->withoutExceptionHandling()
        ->get('/api/users/' . $user->uuid);

        $response->assertOk()
        ->assertJsonStructure();
    }
}
