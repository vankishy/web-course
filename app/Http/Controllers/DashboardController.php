<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\Roadmap;
use App\Models\UserCourseHistory;
use App\Models\UserCourseProgress;
use App\Models\WatchLater;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $currentUser = Auth::user();
        if (!$currentUser) {
            return redirect()->route('signin');
        }

        $hour = Carbon::now('Asia/Jakarta')->hour;
        $greeting = match(true) {
            $hour < 12 => 'Good Morning',
            $hour < 18 => 'Good Afternoon',
            default => 'Good Evening',
        };

        $accountAge = str_replace(' ago', '', $currentUser->created_at->diffForHumans());

        /** @var \App\Models\User $currentUser */
        $dashboardStats = [
            'roadmaps_started' => $currentUser->roadmaps()->count(),
            'completed_courses_count' => UserCourseProgress::where('user_id', $currentUser->user_id)->where('done', 1)->count(),
            'watch_later_count' => WatchLater::where('user_id', $currentUser->user_id)->whereNull('deleted_at')->count(),
            'total_learning_hours' => 24
        ];
        
        $featuredCoursesList = Course::with('roadmaps')->take(6)->get();
        $popularRoadmapsList = Roadmap::withCount(['courses', 'userRoadmaps'])->orderByDesc('user_roadmaps_count')->take(3)->get();
        $popularRoadmaps = $popularRoadmapsList->map(function ($roadmap) {
             $roadmap->course_count = $roadmap->courses_count;
             $roadmap->enrollment_count = $roadmap->user_roadmaps_count;
             $roadmap->estimated_duration = '5 Months';
             return $roadmap;
        });
        $recentUserActivity = UserCourseHistory::query()
            ->join('detail_course', 'user_course_history.detail_course_id', '=', 'detail_course.detail_course_id')
            ->join('subcourse', 'detail_course.subcourse_id', '=', 'subcourse.subcourse_id')
            ->join('course', 'subcourse.course_id', '=', 'course.course_id')
            ->where('user_course_history.user_id', $currentUser->user_id)
            ->orderByDesc('user_course_history.last_seen')
            ->take(4)
            ->get(['user_course_history.last_seen', 'detail_course.name as detail_name', 'course.name as course_name']);
        $recentActivityFormatted = $recentUserActivity->map(function ($item) {
            return (object)[
                'course_name' => $item->course_name,
                'action_description' => 'Viewed ' . $item->detail_name,
                'time_ago' => Carbon::parse($item->last_seen)->diffForHumans()
            ];
        });
        $watchLaterCourses = WatchLater::query()
            ->join('detail_course', 'watchlater.detail_course_id', '=', 'detail_course.detail_course_id')
            ->join('subcourse', 'detail_course.subcourse_id', '=', 'subcourse.subcourse_id')
            ->join('course', 'subcourse.course_id', '=', 'course.course_id')
            ->where('watchlater.user_id', $currentUser->user_id)
            ->orderByDesc('watchlater.created_at')
            ->take(5)
            ->get(['course.course_id', 'course.name as course_name', 'course.desc as course_description']);

        return view('dashboard', compact('currentUser', 'dashboardStats', 'featuredCoursesList', 'popularRoadmaps', 'recentActivityFormatted', 'watchLaterCourses', 'greeting', 'accountAge'));
    }
}