<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_a_user_can_register()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john@gmail.com',
            'password' => 'test12345',
            'password_confirmation' => 'test12345'
        ];

        $response = $this->withoutExceptionHandling()
            ->post('/api/auth/register', $data);

        $response->assertStatus(201);

        $this->assertDatabaseHas('users', [
            'name' => $data['name'],
            'email' => $data['email']
        ]);
    }

    public function test_a_user_can_login()
    {
        $user = User::factory()->create();

        $response = $this->withoutExceptionHandling()
            ->withoutMiddleware()->post('/api/auth/login', [
                'email' => $user->email,
                'password' => 'test12345'
            ]);

        $response->assertOk();

        $this->assertAuthenticatedAs($user);
    }
}
