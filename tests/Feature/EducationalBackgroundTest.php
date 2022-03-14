<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Education;
use App\Models\EducationalBackground;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

class EducationalBackgroundTest extends TestCase
{
    use LazilyRefreshDatabase, WithFaker, WithoutMiddleware;

    public function test_a_user_can_read_record_of_users_educational_background()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        EducationalBackground::factory()->count(1)->create();
   
        $response = $this->withoutExceptionHandling()
        ->get('/api/educational-backgrounds');

        $response->assertOk()
        ->assertJsonCount(1);
    }

    public function test_a_user_can_create_a_educational_background()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $data = [
            'user_id' => $user->id,
            'education_id'=> Education::factory()->create()->id,
            'study_from_month' => $this->faker->date('m'),
            'study_from_year' => $this->faker->date('y'),
            'study_to_month' => $this->faker->date('m'),
            'study_to_year' => $this->faker->date('y'),
            'degree' =>$this->faker->word,
        ];
     
        $response = $this->withoutExceptionHandling()
        ->post('/api/educational-backgrounds', $data);

        $response->assertStatus(201);

        $this->assertDatabaseHas('educational_backgrounds', $data);
    }

    public function test_a_user_can_update_a_educational_background()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $educationalbackground = EducationalBackground::factory()->create();

        $data = [
            'user_id' => $user->id,
            'education_id'=> Education::factory()->create()->id,
            'study_from_month' => $this->faker->date('m'),
            'study_from_year' => $this->faker->date('y'),
            'study_to_month' => $this->faker->date('m'),
            'study_to_year' => $this->faker->date('y'),
            'degree' =>$this->faker->word,
        ];

        $response = $this->withoutExceptionHandling()
        ->put('/api/educational-backgrounds/' . $educationalbackground->id, $data);

        $response->assertOk();

        $this->assertDatabaseHas('educational_backgrounds', $data);
    }

    public function test_a_user_can_fetch_a_single_educational_background()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $educationalbackground = EducationalBackground::factory()->create();

        $response = $this->withoutExceptionHandling()
        ->get('/api/educational-backgrounds/' . $educationalbackground->id);

        $response->assertOk()
        ->assertJsonStructure();
    }

    public function test_a_user_can_delete_a_educational_background()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $educationalbackground = EducationalBackground::factory()->create();

        $response = $this->withoutExceptionHandling()
        ->delete('/api/educational-backgrounds/' . $educationalbackground->id);

        
        $response->assertOk();

        $this->assertSoftDeleted('educational_backgrounds', $educationalbackground->toArray());
    }

}
