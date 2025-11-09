<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Course;
use App\Models\Subcourse;
use App\Models\DetailCourse;
use App\Models\Leaderboard;
use App\Models\UserCourseProgress;
use App\Models\UserRoadmap;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LeaderboardTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test: Guest users cannot access leaderboard page
     */
    public function test_guests_cannot_access_leaderboard_page()
    {
        $response = $this->get('/leaderboard');

        $response->assertRedirect('/signin');
    }

    /**
     * Test: Authenticated user can view leaderboard with all required data
     */
    public function test_authenticated_user_can_view_leaderboard()
    {
        $user = User::factory()->create(['name' => 'Raphael Permana Barus']);

        $response = $this->actingAs($user)->get('/leaderboard');

        $response->assertStatus(200);
        $response->assertViewIs('leaderboard');
        $response->assertViewHas(['user', 'leaderboard', 'userStats', 'statistics']);
    }

    /**
     * Test: Leaderboard displays top 10 users correctly with points and badges
     */
    public function test_leaderboard_displays_top_10_with_correct_data()
    {
        // Create current user
        $currentUser = User::factory()->create(['name' => 'Current User']);

        // Create course hierarchy for progress tracking
        $course = Course::factory()->create();
        $subcourse = Subcourse::factory()->create(['course_id' => $course->course_id]);

        // Create 12 users with leaderboard rankings
        for ($i = 1; $i <= 12; $i++) {
            $user = User::factory()->create(['name' => "User $i"]);

            Leaderboard::create([
                'urutan' => $i,
                'user_id' => $user->user_id,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            // Create detail courses and progress untuk setiap user
            for ($j = 0; $j < $i; $j++) {
                $detail = DetailCourse::factory()->create([
                    'subcourse_id' => $subcourse->subcourse_id
                ]);

                UserCourseProgress::factory()->create([
                    'user_id' => $user->user_id,
                    'detail_course_id' => $detail->detail_course_id,
                    'done' => 1
                ]);
            }
        }

        $response = $this->actingAs($currentUser)->get('/leaderboard');

        $response->assertStatus(200);

        // Check bahwa leaderboard mempunyai 10 entry (dibuat 12)
        $leaderboard = $response->viewData('leaderboard');
        $this->assertCount(10, $leaderboard);
        $this->assertLessThanOrEqual(10, $leaderboard->count());

        // Check first user punya rank 1
        $this->assertEquals(1, $leaderboard->first()->rank);

        // Check user terakhir punya rank 10
        $this->assertEquals(10, $leaderboard->last()->rank);

        // Check points calculation: User 1 has 1 completed course (100 points)
        $firstUser = $leaderboard->first();
        $this->assertEquals(1, $firstUser->completed_courses);

        // Check that name is displayed
        $response->assertSee('User 1');

        // Check statistics are present
        $statistics = $response->viewData('statistics');
        $this->assertArrayHasKey('total_learners', $statistics);
        $this->assertArrayHasKey('active_today', $statistics);
        $this->assertArrayHasKey('courses_completed_today', $statistics);
    }

    /**
     * Test: Current user's rank is shown separately if not in top 10
     */
    public function test_user_rank_shown_separately_when_outside_top_10()
    {
        $currentUser = User::factory()->create(['name' => 'Current User']);

        // Place current user at rank 15
        Leaderboard::create([
            'urutan' => 15,
            'user_id' => $currentUser->user_id,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Create course hierarchy for progress
        $course = Course::factory()->create();
        $subcourse = Subcourse::factory()->create(['course_id' => $course->course_id]);

        // Give current user some progress
        for ($i = 0; $i < 3; $i++) {
            $detail = DetailCourse::factory()->create([
                'subcourse_id' => $subcourse->subcourse_id
            ]);

            UserCourseProgress::factory()->create([
                'user_id' => $currentUser->user_id,
                'detail_course_id' => $detail->detail_course_id,
                'done' => 1
            ]);
        }

        // Create top 10 users
        for ($i = 1; $i <= 10; $i++) {
            $user = User::factory()->create(['name' => "Top User $i"]);
            Leaderboard::create([
                'urutan' => $i,
                'user_id' => $user->user_id,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        $response = $this->actingAs($currentUser)->get('/leaderboard');

        $response->assertStatus(200);

        // Check that userStats is not null (user is outside top 10)
        $userStats = $response->viewData('userStats');
        $this->assertNotNull($userStats);

        // Check user's rank is 15
        $this->assertEquals(15, $userStats->rank);

        // Check user's name
        $this->assertEquals('Current User', $userStats->name);

        // Check completed courses count
        $this->assertEquals(3, $userStats->completed_courses);

        // Check points: 3 courses * 100 = 300 points
        $this->assertEquals(300, $userStats->points);

        // Check the view displays "Your Ranking" section
        $response->assertSee('Your Ranking');
        $response->assertSee('Current User');
    }

    /**
     * Test: Badges are awarded correctly based on completed courses
     */
    public function test_badges_awarded_correctly()
    {
        $user = User::factory()->create(['name' => 'Badge Earner']);

        Leaderboard::create([
            'urutan' => 1,
            'user_id' => $user->user_id,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Create course hierarchy
        $course = Course::factory()->create();
        $subcourse = Subcourse::factory()->create(['course_id' => $course->course_id]);

        for ($i = 0; $i < 15; $i++) {
            $detail = DetailCourse::factory()->create([
                'subcourse_id' => $subcourse->subcourse_id
            ]);

            UserCourseProgress::factory()->create([
                'user_id' => $user->user_id,
                'detail_course_id' => $detail->detail_course_id,
                'done' => 1
            ]);
        }

        $response = $this->actingAs($user)->get('/leaderboard');

        $response->assertStatus(200);

        $leaderboard = $response->viewData('leaderboard');
        $firstUser = $leaderboard->first();

        // Check all badges yang dipunya
        $this->assertContains('Master Learner', $firstUser->badges);
        $this->assertContains('Dedicated', $firstUser->badges);
        $this->assertContains('Quick Start', $firstUser->badges);
        $this->assertContains('Beginner', $firstUser->badges);

        // Badges akan ditampilkan di view
        $response->assertSee('Master Learner');
        $response->assertSee('Dedicated');
    }
}
