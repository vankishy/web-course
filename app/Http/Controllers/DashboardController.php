<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <-- Pastikan ini di-import

class DashboardController extends Controller
{
    public function index()
    {
        // =============================================
        // DATABASE VERSION - UNCOMMENT WHEN READY
        // =============================================
        /*
        try {
            // ... (kode database Anda tetap dikomentari) ...
        } catch (\Exception $e) {
            // Fallback to placeholder if database error
            return $this->getPlaceholderData();
        }
        */

        // =============================================
        // PLACEHOLDER VERSION - CURRENTLY ACTIVE
        // =============================================
        // Tetap memanggil fungsi ini
        return $this->getPlaceholderData();
    }

    /**
     * Get placeholder data for development
     */
    private function getPlaceholderData()
    {
        // ▼▼▼ PERUBAHAN DIMULAI DI SINI ▼▼▼

        // 1. Ambil pengguna yang sedang login saat ini
        $loggedInUser = Auth::user();

        // 2. Buat objek $user, tapi gunakan nama dari $loggedInUser jika ada
        $user = (object)[
            // Ambil ID asli jika user login, jika tidak fallback ke 1
            'id' => $loggedInUser ? $loggedInUser->user_id : 1, // Menggunakan user_id sesuai model Anda
            
            // Ambil NAMA asli jika user login, jika tidak fallback ke 'Guest'
            'name' => $loggedInUser ? $loggedInUser->name : 'Guest', 
            
            // Ambil EMAIL asli jika user login, jika tidak fallback
            'email' => $loggedInUser ? $loggedInUser->email : 'guest@example.com' 
        ];

        // ▲▲▲ PERUBAHAN SELESAI DI SINI ▲▲▲


        // --- Data placeholder lainnya tetap sama seperti kode Anda ---
       $featuredCourses = [
            (object)[
                'course_id' => 1,
                'name' => 'Web Development Fundamentals',
                'description' => 'Learn HTML, CSS, and JavaScript basics to build modern websites',
                'level' => 'Beginner',
                'duration' => '4 weeks',
                'roadmaps' => [
                    (object)['name' => 'Full-Stack Developer'],
                    (object)['name' => 'Frontend Specialist']
                ]
            ],
            (object)[
                'course_id' => 2,
                'name' => 'Python for Beginners', 
                'description' => 'Start your programming journey with Python fundamentals',
                'level' => 'Beginner',
                'duration' => '6 weeks',
                'roadmaps' => [
                    (object)['name' => 'Data Scientist'],
                    (object)['name' => 'Backend Developer']
                ]
            ],
            (object)[
                'course_id' => 3,
                'name' => 'Data Science Essentials',
                'description' => 'Introduction to data analysis, visualization, and machine learning',
                'level' => 'Intermediate', 
                'duration' => '8 weeks',
                'roadmaps' => [
                    (object)['name' => 'Data Scientist'],
                    (object)['name' => 'AI Engineer']
                ]
            ],
            (object)[
                'course_id' => 4,
                'name' => 'Mobile App Development',
                'description' => 'Build cross-platform mobile applications with React Native',
                'level' => 'Intermediate',
                'duration' => '10 weeks',
                'roadmaps' => [
                    (object)['name' => 'Mobile Developer']
                ]
            ],
            (object)[
                'course_id' => 5,
                'name' => 'Cloud Computing Basics',
                'description' => 'Understand AWS, Azure, and GCP cloud fundamentals',
                'level' => 'Beginner',
                'duration' => '5 weeks',
                'roadmaps' => [
                    (object)['name' => 'DevOps Engineer'],
                    (object)['name' => 'Cloud Architect']
                ]
            ],
            (object)[
                'course_id' => 6,
                'name' => 'DevOps Foundation',
                'description' => 'Master CI/CD, Docker, Kubernetes, and infrastructure basics',
                'level' => 'Intermediate',
                'duration' => '7 weeks',
                'roadmaps' => [
                    (object)['name' => 'DevOps Engineer']
                ]
            ]
        ];

        $popularRoadmaps = [
            (object)[
                'roadmap_id' => 1,
                'name' => 'Full-Stack Developer Path',
                'course_count' => 12,
                'duration' => '6 months',
                'enrollments_count' => 150
            ],
            (object)[
                'roadmap_id' => 2, 
                'name' => 'Data Scientist Path',
                'course_count' => 10,
                'duration' => '5 months',
                'enrollments_count' => 120
            ],
            (object)[
                'roadmap_id' => 3,
                'name' => 'DevOps Engineer Path',
                'course_count' => 8,
                'duration' => '4 months',
                'enrollments_count' => 95
            ]
        ];

        $recentActivity = [
            (object)[
                'course_name' => 'Web Development Fundamentals',
                'action' => 'Started learning',
                'time' => '2 hours ago'
            ],
            (object)[
                'course_name' => 'Python for Beginners',
                'action' => 'Completed module 3',
                'time' => '1 day ago'
            ],
            (object)[
                'course_name' => 'Data Science Essentials', 
                'action' => 'Added to watch later',
                'time' => '2 days ago'
            ],
            (object)[
                'course_name' => 'Cloud Computing Basics',
                'action' => 'Viewed course',
                'time' => '3 days ago'
            ]
        ];

        $stats = [
            'enrolled_courses' => 3,
            'completed_courses' => 1,
            'watch_later' => 5,
            'learning_hours' => 24
        ];

        return view('dashboard', compact(
            'user', 
            'featuredCourses', 
            'popularRoadmaps', 
            'recentActivity',
            'stats'
        ));
    }

    // =============================================
    // DATABASE HELPER FUNCTIONS - UNCOMMENT WHEN READY
    // =============================================
    /*
    private function generateCourseDescription($courseName) { // ... }
    private function getCourseLevel($courseId) { // ... }
    private function getCourseDuration($courseId) { // ... }
    private function calculateRoadmapDuration($roadmapId) { // ... }
    private function calculateLearningHours($userId) { // ... }
    */
}