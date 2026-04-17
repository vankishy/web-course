<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Course;
use App\Models\SubCourse;
use App\Models\DetailCourse;
use App\Models\Roadmap;
use App\Models\WatchLater;
use App\Models\UserCourseProgress;
use Illuminate\Support\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function unauthenticated_users_are_redirected_to_login()
    {
        $response = $this->get(route('dashboard'));
        $response->assertStatus(302);
    }

    #[Test]
    public function authenticated_user_can_view_dashboard()
    {
        // Ensure this factory uses the 'user' table, not 'users'
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('dashboard'));

        $response->assertStatus(200);
        $response->assertViewIs('dashboard');
    }

    #[Test]
    public function dashboard_displays_correct_stats_and_lists()
    {
        // 1. Arrange: Setup User
        $user = User::factory()->create();

        // 2. Arrange: Setup Course Hierarchy to satisfy Foreign Keys
        // We need these to create valid progress and watchlater items
        $course = Course::factory()->create();
        $subcourse = Subcourse::factory()->create(['course_id' => $course->course_id]);
        $detail1 = DetailCourse::factory()->create(['subcourse_id' => $subcourse->subcourse_id]);
        $detail2 = DetailCourse::factory()->create(['subcourse_id' => $subcourse->subcourse_id]);
        $detail3 = DetailCourse::factory()->create(['subcourse_id' => $subcourse->subcourse_id]);
        // Extra details for watch later
        $detail4 = DetailCourse::factory()->create(['subcourse_id' => $subcourse->subcourse_id]);
        $detail5 = DetailCourse::factory()->create(['subcourse_id' => $subcourse->subcourse_id]);

        // 3. Arrange: Create Progress using the valid details
        UserCourseProgress::factory()->create([
            'user_id' => $user->user_id,
            'detail_course_id' => $detail1->detail_course_id,
            'done' => 1
        ]);
        UserCourseProgress::factory()->create([
            'user_id' => $user->user_id,
            'detail_course_id' => $detail2->detail_course_id,
            'done' => 1
        ]);
        UserCourseProgress::factory()->create([
            'user_id' => $user->user_id,
            'detail_course_id' => $detail3->detail_course_id,
            'done' => 1
        ]);

        // 4. Arrange: Create Watch Later items
        WatchLater::factory()->create([
            'user_id' => $user->user_id,
            'detail_course_id' => $detail4->detail_course_id,
        ]);
        WatchLater::factory()->create([
            'user_id' => $user->user_id,
            'detail_course_id' => $detail5->detail_course_id,
        ]);

        // 5. Arrange: Populate other lists
        // Create 5 more courses to have a total of 6 for the featured list
        Course::factory()->count(5)->create();
        Roadmap::factory()->count(3)->create();

        // 6. Act
        $response = $this->actingAs($user)->get(route('dashboard'));

        // 7. Assert
        $response->assertStatus(200);
        $response->assertViewHas(['dashboardStats', 'featuredCoursesList', 'popularRoadmaps']);

        $stats = $response->viewData('dashboardStats');
        // Assertions based on the data we created above
        $this->assertEquals(3, $stats['completed_courses_count'], 'Completed courses count should be 3');
        $this->assertEquals(2, $stats['watch_later_count'], 'Watch later count should be 2');
        $this->assertEquals(24, $stats['total_learning_hours']);
    }

    #[Test]
    public function dashboard_displays_dynamic_greeting_and_account_age()
    {        
        // Mock time to be 10 AM Jakarta time
        Carbon::setTestNow(Carbon::parse('2025-06-01 10:00:00', 'Asia/Jakarta'));

        $user = User::factory()->create([
            'name' => 'Test User',
            'created_at' => Carbon::parse('2025-04-01 10:00:00', 'Asia/Jakarta')
        ]);

        $response = $this->actingAs($user)->get(route('dashboard'));

        $response->assertStatus(200);
        $response->assertSee('Good Morning, Test User!');
        $response->assertSee('Member for 2 months');
        
        Carbon::setTestNow(); // Reset
    }
}