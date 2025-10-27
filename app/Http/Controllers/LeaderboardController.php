<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LeaderboardController extends Controller
{
    public function index()
    {
        // =============================================
        // DATABASE VERSION - UNCOMMENT WHEN READY
        // =============================================
        /*
        try {
            // Get authenticated user
            $user = Auth::user();

            // Get top 10 leaderboard entries with user details
            $leaderboard = \App\Models\Leaderboard::with(['user' => function($query) {
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
                        'is_current_user' => $entry->user_id === $user->user_id
                    ];
                });

            // Get current user's rank if not in top 10
            $currentUserRank = \App\Models\Leaderboard::where('user_id', $user->user_id)
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
                'total_learners' => \App\Models\User::whereNull('deleted_at')->count(),
                'active_today' => $this->getActiveTodayCount(),
                'courses_completed_today' => $this->getCoursesCompletedToday(),
                'top_performer_this_week' => $this->getTopPerformerThisWeek()
            ];

        } catch (\Exception $e) {
            // Fallback to placeholder if database error
            return $this->getPlaceholderData();
        }
        */

        // =============================================
        // PLACEHOLDER VERSION - CURRENTLY ACTIVE
        // =============================================
        return $this->getPlaceholderData();
    }

    /**
     * Get placeholder data for development
     */
    private function getPlaceholderData()
    {
        $loggedInUser = Auth::user();

        // 2. Buat objek $user, tapi gunakan data dari $loggedInUser jika ada
        $user = (object)[
            // Ambil ID asli jika user login, jika tidak fallback ke 1
            'user_id' => $loggedInUser ? $loggedInUser->user_id : 1, // Menggunakan user_id sesuai model Anda
            
            // Ambil NAMA asli jika user login, jika tidak fallback ke 'Guest'
            'name' => $loggedInUser ? $loggedInUser->name : 'Guest', 
            
            // Ambil EMAIL asli jika user login, jika tidak fallback
            'email' => $loggedInUser ? $loggedInUser->email : 'guest@example.com' 
        ];


        $leaderboard = [
            (object)[
                'rank' => 1,
                'user_id' => 5,
                'name' => 'Ahmad Rizki',
                'points' => 2850,
                'completed_courses' => 15,
                'badges' => ['Master Learner', 'Speed Runner', 'Perfectionist'],
                'is_current_user' => false
            ],
            (object)[
                'rank' => 2,
                'user_id' => 12,
                'name' => 'Siti Nurhaliza',
                'points' => 2720,
                'completed_courses' => 14,
                'badges' => ['Fast Learner', 'Dedicated'],
                'is_current_user' => false
            ],
            (object)[
                'rank' => 3,
                'user_id' => 8,
                'name' => 'Budi Santoso',
                'points' => 2580,
                'completed_courses' => 13,
                'badges' => ['Consistent', 'Team Player'],
                'is_current_user' => false
            ],
            (object)[
                'rank' => 4,
                'user_id' => 15,
                'name' => 'Dewi Kartika',
                'points' => 2340,
                'completed_courses' => 12,
                'badges' => ['Rising Star'],
                'is_current_user' => false
            ],
            (object)[
                'rank' => 5,
                'user_id' => 3,
                'name' => 'Rudi Hermawan',
                'points' => 2180,
                'completed_courses' => 11,
                'badges' => ['Dedicated Learner'],
                'is_current_user' => false
            ],
            (object)[
                'rank' => 6,
                'user_id' => 1,
                'name' => $loggedInUser ? $loggedInUser->name : 'Guest',
                'points' => 2050,
                'completed_courses' => 10,
                'badges' => ['Quick Start'],
                'is_current_user' => true
            ],
            (object)[
                'rank' => 7,
                'user_id' => 9,
                'name' => 'Rina Wulandari',
                'points' => 1920,
                'completed_courses' => 9,
                'badges' => ['Persistent'],
                'is_current_user' => false
            ],
            (object)[
                'rank' => 8,
                'user_id' => 6,
                'name' => 'Agung Prasetyo',
                'points' => 1780,
                'completed_courses' => 8,
                'badges' => ['Early Adopter'],
                'is_current_user' => false
            ],
            (object)[
                'rank' => 9,
                'user_id' => 14,
                'name' => 'Lisa Andriani',
                'points' => 1650,
                'completed_courses' => 7,
                'badges' => ['Newcomer'],
                'is_current_user' => false
            ],
            (object)[
                'rank' => 10,
                'user_id' => 11,
                'name' => 'Hendra Wijaya',
                'points' => 1520,
                'completed_courses' => 6,
                'badges' => ['Beginner'],
                'is_current_user' => false
            ]
        ];

        // Current user is in top 10, so no separate userStats needed
        $userStats = null;

        $statistics = [
            'total_learners' => 1247,
            'active_today' => 342,
            'courses_completed_today' => 58,
            'top_performer_this_week' => (object)[
                'name' => 'Ahmad Rizki',
                'courses_completed' => 3
            ]
        ];

        return view('leaderboard', compact(
            'user',
            'leaderboard',
            'userStats',
            'statistics'
        ));
    }

    // =============================================
    // DATABASE HELPER FUNCTIONS - UNCOMMENT WHEN READY
    // =============================================
    //
    // private function calculateUserPoints($userId)
    // {
    //     // Calculate points based on completed courses, activities, etc.
    //     $completedCourses = \App\Models\UserCourseHistory::where('user_id', $userId)
    //         ->whereNull('deleted_at')
    //         ->count();

    //     $roadmapsEnrolled = \App\Models\UserRoadmap::where('user_id', $userId)
    //         ->whereNull('deleted_at')
    //         ->count();

    //     // Points formula: 100 per course + 50 per roadmap
    //     return ($completedCourses * 100) + ($roadmapsEnrolled * 50);
    // }

    // private function getCompletedCoursesCount($userId)
    // {
    //     return \App\Models\UserCourseHistory::where('user_id', $userId)
    //         ->whereNull('deleted_at')
    //         ->distinct('course_id')
    //         ->count();
    // }

    // private function getUserBadges($userId)
    // {
    //     $badges = [];
    //     $completedCourses = $this->getCompletedCoursesCount($userId);

    //     if ($completedCourses >= 15) {
    //         $badges[] = 'Master Learner';
    //     }
    //     if ($completedCourses >= 10) {
    //         $badges[] = 'Dedicated';
    //     }
    //     if ($completedCourses >= 5) {
    //         $badges[] = 'Quick Start';
    //     }

    //     return $badges;
    // }

    // private function getActiveTodayCount()
    // {
    //     return \App\Models\UserCourseHistory::whereDate('created_at', today())
    //         ->distinct('user_id')
    //         ->count();
    // }

    // private function getCoursesCompletedToday()
    // {
    //     return \App\Models\UserCourseHistory::whereDate('created_at', today())
    //         ->count();
    // }

    // private function getTopPerformerThisWeek()
    // {
    //     $topUser = \App\Models\UserCourseHistory::select('user_id', DB::raw('COUNT(*) as courses_count'))
    //         ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
    //         ->groupBy('user_id')
    //         ->orderBy('courses_count', 'desc')
    //         ->first();

    //     if ($topUser) {
    //         $user = \App\Models\User::find($topUser->user_id);
    //         return (object)[
    //             'name' => $user->name,
    //             'courses_completed' => $topUser->courses_count
    //         ];
    //     }

    //     return null;
    // }

    // Update leaderboard rankings (can be called via cron job or manually)
    // public function updateRankings()
    // {
    //     try {
    //         // Get all users with their points
    //         $users = \App\Models\User::whereNull('deleted_at')
    //             ->get()
    //             ->map(function($user) {
    //                 return [
    //                     'user_id' => $user->user_id,
    //                     'points' => $this->calculateUserPoints($user->user_id)
    //                 ];
    //             })
    //             ->sortByDesc('points')
    //             ->values();
    //
    //         // Clear existing leaderboard
    //         \App\Models\Leaderboard::query()->delete();
    //
    //         // Insert top 10 users
    //         foreach ($users->take(10) as $index => $userData) {
    //             \App\Models\Leaderboard::create([
    //                 'urutan' => $index + 1,
    //                 'user_id' => $userData['user_id'],
    //                 'created_at' => now(),
    //                 'updated_at' => now()
    //             ]);
    //         }
    //
    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Leaderboard updated successfully'
    //         ]);
    //
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Failed to update leaderboard: ' . $e->getMessage()
    //         ], 500);
    //     }
    // }
}
