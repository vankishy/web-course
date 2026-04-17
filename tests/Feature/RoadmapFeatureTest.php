<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Roadmap;
use App\Models\Course;

class RoadmapFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_roadmap_detail_page()
    {
        $slug = 'frontend-developer';

        $response = $this->get('/roadmap/' . $slug);

        $response->assertStatus(302);
        $response->assertRedirect(route('signin'));
    }

    public function test_authenticated_user_can_see_roadmap_detail_with_courses()
    {
        $user = User::factory()->create();

        $roadmap = Roadmap::factory()->create([
            'name' => 'Frontend Developer Roadmap',
            'slug' => 'frontend-developer',
        ]);

        $course1 = Course::factory()->create(['name' => 'Belajar HTML Dasar']);
        $course2 = Course::factory()->create(['name' => 'Belajar CSS Modern']);

        $roadmap->courses()->attach([
            $course1->course_id,
            $course2->course_id
        ]);


        $response = $this->actingAs($user)
                         ->get('/roadmap/frontend-developer');


        $response->assertStatus(200);

        $response->assertSee('Frontend Developer Roadmap');
        $response->assertSee('Belajar HTML Dasar');
        $response->assertSee('Belajar CSS Modern');

        $response->assertViewIs('roadmap.detail');
    }

    public function test_authenticated_user_gets_404_for_invalid_slug()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
                         ->get('/roadmap/slug-yang-pasti-tidak-ada');

        $response->assertStatus(404);
    }
}