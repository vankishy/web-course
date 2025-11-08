<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProfile;
use App\Models\UserCourseHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; // <-- ADDED: Need this for diffForHumans() on raw data

class ProfileController extends Controller
{
    /**
     * Show the user's profile.
     *
     * @param  int|null  $id
     * @return \Illuminate\View\View
     */
    public function show($id = null)
    {
        if (is_null($id)) {
            $id = auth()->id();
        }

        $user = User::find($id);

        if (!$user) {
            abort(404, 'User not found');
        }

        $userProfile = UserProfile::where('user_id', $user->user_id)->first();

        $profileData = [];
        if ($userProfile && !empty($userProfile->lainnya)) {
            $profileData = json_decode($userProfile->lainnya, true);
        }

        // ▼▼▼ FIXED: Query to fetch history with corrected table names and select keys ▼▼▼
        $recentActivity = UserCourseHistory::where('user_id', $user->user_id)
            ->join('detail_course as dc', 'dc.detail_course_id', '=', 'user_course_history.detail_course_id')
            ->join('subcourse as sc', 'sc.subcourse_id', '=', 'dc.subcourse_id') // Fix from previous step
            ->select(
                'sc.name as course_name',
                'dc.name as detail_name',
                'user_course_history.last_seen', // This is a string/raw datetime
                'sc.subcourse_id'
            )
            ->orderBy('user_course_history.last_seen', 'desc')
            ->limit(5)
            ->get();

        // ▼▼▼ FIXED: Manual Carbon casting for diffForHumans() to fix the error ▼▼▼
        $recentActivityFormatted = $recentActivity->map(function ($activity) {
            // FIX: Manually cast the string to a Carbon object before calling diffForHumans()
            $activity->time_ago = Carbon::parse($activity->last_seen)->diffForHumans();
            $activity->action_description = 'Last viewed: ' . $activity->detail_name;
            return $activity;
        });
        // ▲▲▲ END FIXED SECTION ▲▲▲

        return view('profile', [
            'user' => $user,
            'profileData' => $profileData,
            'recentActivityFormatted' => $recentActivityFormatted,
        ]);
    }
}