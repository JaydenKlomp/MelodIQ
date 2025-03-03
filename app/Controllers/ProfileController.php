<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\FollowersModel;

class ProfileController extends BaseController
{
    public function index($username = null)
    {
        $userModel = new UserModel();
        $followersModel = new FollowersModel();

        // If no username is provided, show the logged-in user's profile
        if (!$username) {
            $username = session()->get('username'); // Default to logged-in user
        }

        // Fetch user by username instead of ID
        $user = $userModel->getUserByUsername($username);

        if (!$user) {
            return redirect()->to('/')->with('error', 'User not found.');
        }

        // Fetch follower and following counts
        $followers = $followersModel->countFollowers($user['id']);
        $following = $followersModel->countFollowing($user['id']);

        // Calculate accuracy percentage
        $accuracy = ($user['trivia_played'] > 0) ? round(($user['correct_answers'] / ($user['trivia_played'] * 10)) * 100, 2) : 0;

        return view('profile', [
            'user' => $user,
            'followers' => $followers,
            'following' => $following,
            'accuracy' => $accuracy
        ]);
    }
}
