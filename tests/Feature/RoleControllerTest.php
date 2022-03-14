<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Database\Seeders\RolesSeeder;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoleControllerTest extends TestCase
{
    use LazilyRefreshDatabase,WithFaker;
    /**
     * Test to check if a user can read all roles
     *
     * @return void
     */
    public function test_a_user_can_read_all_the_roles()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        Role::factory()->count(5)->create();

        $response = $this->withoutExceptionHandling()
        ->get('/api/roles');

        $response->assertOk()
        ->assertJsonCount(5);

    }

    public function test_a_user_can_fetch_one_role()
    {

        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $role = Role::factory()->create();

        $response = $this->withoutExceptionHandling()
        ->get('/api/roles/' . $role->id);

        $response->assertOk()
        ->assertJsonStructure();


    }

    public function test_a_user_can_update_a_role()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $role = Role::factory()->create();
        
        $data = [
            'name' => $this->faker->word
        ];
        
        $response = $this->withoutExceptionHandling()
        ->put('/api/roles/' . $role->id, $data);

        $response->assertOk();

        $this->assertDatabaseHas('roles', $data);
    }
}
