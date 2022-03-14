<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use App\Models\Department;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

class DepartmentControllerTest extends TestCase
{
    use LazilyRefreshDatabase, WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_a_user_can_read_all_department()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        Department::factory()->count(5)->create();

        $response = $this->withoutExceptionHandling()
        ->get('/api/departments');

        $response->assertOk()
        ->assertJsonCount(5);
    }

    public function test_a_user_can_create_a_department()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $data = [
            'name' => $this->faker->word()
        ];

        $response = $this->withoutExceptionHandling()
        ->post('/api/departments', $data);

        $response->assertStatus(201);

        $this->assertDatabaseHas('departments', $data);
    }

    public function test_a_user_can_update_a_department()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $department = Department::factory()->create();

        $data = [
            'name' => $this->faker->word()
        ];

        $response = $this->withoutExceptionHandling()
        ->put('/api/departments/' . $department->id, $data);

        $response->assertOk();

        $this->assertDatabaseHas('departments', $data);
    }

    public function test_a_user_can_fetch_a_single_department()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $department = Department::factory()->create();

        $response = $this->withoutExceptionHandling()
        ->get('/api/departments/' . $department->id);

        $response->assertOk()
        ->assertJsonStructure();
    }

    public function test_a_user_can_delete_a_department()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $department = Department::factory()->create();

        $response = $this->withoutExceptionHandling()
        ->delete('/api/departments/' . $department->id);

        $response->assertOk();

        $this->assertSoftDeleted('departments', $department->toArray());
    }
}
