<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Banner;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

class BannerControllerTest extends TestCase
{
    use LazilyRefreshDatabase, WithFaker;

    public function test_a_user_can_read_all_banners()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        Banner::factory()->count(5)->create();

        $response = $this->withoutExceptionHandling()
        ->get('/api/banners');

        $response->assertOk()
        ->assertJsonCount(5);
    }

    public function test_a_user_can_create_a_banner()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $data = [
            'tag' => $this->faker->word,
            'image' => '/fake/path',
            'description' => $this->faker->word
        ];

        $response = $this->withoutExceptionHandling()
        ->post('/api/banners', $data);

        $response->assertStatus(201);

        $this->assertDatabaseHas('banners', $data);
    }

    public function test_a_user_can_update_a_banner()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $banner = Banner::factory()->create();
        
        $data = [
            'tag' => $this->faker->word,
            'image' => '/fake/path',
            'description' => $this->faker->word
        ];

        $response = $this->withoutExceptionHandling()
        ->put('/api/banners/' . $banner->id, $data);

        $response->assertOk();

        $this->assertDatabaseHas('banners', $data);
    }

    public function test_a_user_can_fetch_a_single_banner()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $banner = Banner::factory()->create();

        $response = $this->withoutExceptionHandling()
        ->get('/api/banners/' . $banner->id);

        $response->assertOk()
        ->assertJsonStructure();
    }

    public function test_a_user_can_delete_a_banner()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $banner = Banner::factory()->create();
        
        $response = $this->withoutExceptionHandling()
        ->delete('/api/banners/' . $banner->id);

        $response->assertOk();

        $this->assertSoftDeleted('banners', $banner->toArray());
    }
}
