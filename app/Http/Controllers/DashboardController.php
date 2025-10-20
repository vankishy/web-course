<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
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
            
            // Get featured courses (from any roadmap)
            $featuredCourses = \App\Models\Course::with(['roadmaps'])
                ->whereNull('deleted_at')
                ->inRandomOrder()
                ->take(6)
                ->get()
                ->map(function($course) {
                    return (object)[
                        'course_id' => $course->course_id,
                        'name' => $course->name,
                        'description' => $this->generateCourseDescription($course->name),
                        'level' => $this->getCourseLevel($course->course_id),
                        'duration' => $this->getCourseDuration($course->course_id),
                        'roadmaps' => $course->roadmaps->take(2)
                    ];
                });

            // Get popular roadmaps (based on enrollment count)
            $popularRoadmaps = \App\Models\Roadmap::with(['course'])
                ->whereNull('deleted_at')
                ->withCount(['userRoadmaps as enrollments_count'])
                ->orderBy('enrollments_count', 'desc')
                ->take(3)
                ->get()
                ->map(function($roadmap) {
                    return (object)[
                        'roadmap_id' => $roadmap->roadmap_id,
                        'name' => $roadmap->name,
                        'course_count' => $roadmap->course->count(),
                        'duration' => $this->calculateRoadmapDuration($roadmap->roadmap_id),
                        'enrollments_count' => $roadmap->enrollments_count
                    ];
                });

            // Get user's recent activity
            $recentActivity = \App\Models\UserCourseHistory::with(['course'])
                ->where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get()
                ->map(function($history) {
                    return (object)[
                        'course_name' => $history->course->name,
                        'action' => 'Viewed course',
                        'time' => $history->created_at->diffForHumans()
                    ];
                });

            // Get user stats from database
            $stats = [
                'enrolled_courses' => \App\Models\UserRoadmap::where('user_id', $user->id)->count(),
                'completed_courses' => \App\Models\UserCourseHistory::where('user_id', $user->id)->count(),
                'watch_later' => \App\Models\Watchlater::where('user_id', $user->id)->count(),
                'learning_hours' => $this->calculateLearningHours($user->id)
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
        $user = (object)[
            'id' => 1,
            'name' => 'Mahesa',
            'email' => 'mahesa@WebCourse.com'
        ];

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
    private function generateCourseDescription($courseName)
    {
        $descriptions = [
            'Web Development' => 'Learn to build responsive websites and web applications',
            'Python' => 'Master Python programming from basics to advanced concepts',
            'Data Science' => 'Explore data analysis, visualization, and machine learning',
            'Mobile' => 'Build cross-platform mobile applications',
            'Cloud' => 'Understand cloud platforms and deployment strategies',
            'DevOps' => 'Learn CI/CD, containerization, and infrastructure management'
        ];
        
        foreach ($descriptions as $key => $description) {
            if (stripos($courseName, $key) !== false) {
                return $description;
            }
        }
        
        return 'Comprehensive course covering essential concepts and skills';
    }

    private function getCourseLevel($courseId)
    {
        $levels = ['Beginner', 'Intermediate', 'Advanced'];
        return $levels[array_rand($levels)];
    }

    private function getCourseDuration($courseId)
    {
        $durations = ['4 weeks', '6 weeks', '8 weeks', '10 weeks'];
        return $durations[array_rand($durations)];
    }

    private function calculateRoadmapDuration($roadmapId)
    {
        $durations = ['4 months', '5 months', '6 months', '8 months'];
        return $durations[array_rand($durations)];
    }

    private function calculateLearningHours($userId)
    {
        return rand(20, 100);
    }
    */
}