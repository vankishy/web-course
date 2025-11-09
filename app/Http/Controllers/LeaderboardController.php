<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Leaderboard;
use App\Models\User;
use App\Models\UserCourseProgress;
use App\Models\UserRoadmap;
use App\Models\UserCourseHistory;

class LeaderboardController extends Controller
{
    public function index()
    {
        try {
            // Get authenticated user
            $user = Auth::user();

            // Get top 10 leaderboard entries with user details
            $leaderboard = Leaderboard::with(['user' => function($query) {
                    $query->select('user_id', 'name', 'email');
                }])
                ->whereNull('deleted_at')
                ->orderBy('urutan', 'asc')
                ->limit(10)
                ->get()
                ->map(function($entry) use ($user) {
                    return (object)[
                        'rank' => $entry->urutan,
                        'user_id' => $entry->user_id,
                        'name' => $entry->user->name,
                        'points' => $this->calculateUserPoints($entry->user_id),
                        'completed_courses' => $this->getCompletedCoursesCount($entry->user_id),
                        'badges' => $this->getUserBadges($entry->user_id),
                        // 'is_current_user' => $entry->user_id === $user->user_id
                    ];
                });

            // Get current user's rank if not in top 10
            $currentUserRank = Leaderboard::where('user_id', $user->user_id)
                ->whereNull('deleted_at')
                ->first();

            $userStats = null;
            if ($currentUserRank && $currentUserRank->urutan > 10) {
                $userStats = (object)[
                    'rank' => $currentUserRank->urutan,
                    'user_id' => $user->user_id,
                    'name' => $user->name,
                    'points' => $this->calculateUserPoints($user->user_id),
                    'completed_courses' => $this->getCompletedCoursesCount($user->user_id),
                    'badges' => $this->getUserBadges($user->user_id),
                    'is_current_user' => true
                ];
            }

            // Get leaderboard statistics
            $statistics = [
                'total_learners' => User::whereNull('deleted_at')->count(),
                'active_today' => $this->getActiveTodayCount(),
                'courses_completed_today' => $this->getCoursesCompletedToday(),
                'top_performer_this_week' => $this->getTopPerformerThisWeek()
            ];

            return view('leaderboard', compact(
                'user',
                'leaderboard',
                'userStats',
                'statistics'
            ));

        } catch (\Exception $e) {
            // Log the error
            \Log::error('Leaderboard Error: ' . $e->getMessage());

            // Return view with empty data
            return view('leaderboard', [
                'user' => Auth::user(),
                'leaderboard' => collect([]),
                'userStats' => null,
                'statistics' => [
                    'total_learners' => 0,
                    'active_today' => 0,
                    'courses_completed_today' => 0,
                    'top_performer_this_week' => null
                ]
            ]);
        }
    }

    /**
     * Calculate user points based on activities
     */
    private function calculateUserPoints($userId)
    {
        // Count completed courses (done = 1)
        $completedCourses = UserCourseProgress::where('user_id', $userId)
            ->where('done', 1)
            ->whereNull('deleted_at')
            ->count();

        // Count enrolled roadmaps
        $roadmapsEnrolled = UserRoadmap::where('user_id', $userId)
            ->whereNull('deleted_at')
            ->count();

        // Points formula: 100 per completed course + 50 per roadmap
        return ($completedCourses * 100) + ($roadmapsEnrolled * 50);
    }

    /**
     * Get count of completed courses for a user
     */
    private function getCompletedCoursesCount($userId)
    {
        return UserCourseProgress::where('user_id', $userId)
            ->where('done', 1)
            ->whereNull('deleted_at')
            ->count();
    }

    /**
     * Get user badges based on achievements
     */
    private function getUserBadges($userId)
    {
        $badges = [];
        $completedCourses = $this->getCompletedCoursesCount($userId);

        if ($completedCourses >= 15) {
            $badges[] = 'Master Learner';
        }
        if ($completedCourses >= 10) {
            $badges[] = 'Dedicated';
        }
        if ($completedCourses >= 5) {
            $badges[] = 'Quick Start';
        }
        if ($completedCourses >= 1) {
            $badges[] = 'Beginner';
        }

        return $badges;
    }

    /**
     * Get count of users active today
     */
    private function getActiveTodayCount()
    {
        return UserCourseHistory::whereDate('last_seen', today())
            ->whereNull('deleted_at')
            ->distinct('user_id')
            ->count('user_id');
    }

    /**
     * Get count of courses completed today
     */
    private function getCoursesCompletedToday()
    {
        return UserCourseProgress::whereDate('updated_at', today())
            ->where('done', 1)
            ->whereNull('deleted_at')
            ->count();
    }

    /**
     * Get top performer of this week
     */
    private function getTopPerformerThisWeek()
    {
        $topUser = UserCourseProgress::select('user_id', DB::raw('COUNT(*) as courses_count'))
            ->whereBetween('updated_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->where('done', 1)
            ->whereNull('deleted_at')
            ->groupBy('user_id')
            ->orderBy('courses_count', 'desc')
            ->first();

        if ($topUser) {
            $user = User::find($topUser->user_id);
            if ($user) {
                return (object)[
                    'name' => $user->name,
                    'courses_completed' => $topUser->courses_count
                ];
            }
        }

        return null;
    }

    /**
     * Update leaderboard rankings (can be called via cron job or manually)
     */
    public function updateRankings()
    {
        try {
            // Get all users with their points
            $users = User::whereNull('deleted_at')
                ->get()
                ->map(function($user) {
                    return [
                        'user_id' => $user->user_id,
                        'points' => $this->calculateUserPoints($user->user_id)
                    ];
                })
                ->sortByDesc('points')
                ->values();

            // Clear existing leaderboard (soft delete)
            Leaderboard::query()->update(['deleted_at' => now()]);

            // Insert top users (you can adjust the limit as needed)
            foreach ($users->take(100) as $index => $userData) {
                // Check if entry exists
                $existing = Leaderboard::withTrashed()
                    ->where('user_id', $userData['user_id'])
                    ->first();

                if ($existing) {
                    // Update existing entry
                    $existing->update([
                        'urutan' => $index + 1,
                        'deleted_at' => null,
                        'updated_at' => now()
                    ]);
                } else {
                    // Create new entry
                    Leaderboard::create([
                        'urutan' => $index + 1,
                        'user_id' => $userData['user_id'],
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Leaderboard updated successfully',
                'total_ranked' => $users->count()
            ]);

        } catch (\Exception $e) {
            \Log::error('Leaderboard Update Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to update leaderboard: ' . $e->getMessage()
            ], 500);
        }
    }
}
