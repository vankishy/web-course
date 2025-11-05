<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProfile; // We need to use both models
use Illuminate\Http\Request;

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
        // 1. Use static user ID 1 if no ID is given (your static logic)
        if (is_null($id)) {
            $id = 1; // Default to user 1
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
            // We must manually decode the JSON string into an array
            $profileData = json_decode($userProfile->lainnya, true);
        }

        // 5. Pass BOTH the user object and the new profileData array to the view
        return view('profile', [
            'user' => $user,
            'profileData' => $profileData, // Pass the decoded array
        ]);
    }
}

