<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProfile; // We need to use both models
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Show the user's profile.
     * If no ID is passed, it shows the authenticated user's profile.
     *
     * @param  int|null  $id
     * @return \Illuminate\View\View
     */
    public function show($id = null)
    {
        // 1. If no ID is provided in the URL, use the logged-in user's ID
        if (is_null($id)) {
            $id = auth()->id(); // <--- THIS IS THE CRITICAL CHANGE
        }

        // 2. Find the user
        $user = User::find($id);

        // Handle if user not found
        if (!$user) {
            abort(404, 'User not found');
        }

        // 3. Manually find the user's profile
        $userProfile = UserProfile::where('user_id', $user->user_id)->first();

        // 4. Manually decode the 'lainnya' JSON string
        $profileData = [];
        if ($userProfile && !empty($userProfile->lainnya)) {
            $profileData = json_decode($userProfile->lainnya, true);
        }

        // 5. Pass BOTH the user object and the new profileData array to the view
        return view('profile', [
            'user' => $user,
            'profileData' => $profileData,
        ]);
    }
}

