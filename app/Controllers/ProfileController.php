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
        $db = \Config\Database::connect();

        // If no username is provided, show the logged-in user's profile
        if (!$username) {
            $username = session()->get('username');
        }

        // Fetch user by username instead of ID
        $user = $userModel->getUserByUsername($username);

        if (!$user) {
            return redirect()->to('/')->with('error', 'User not found.');
        }

        // Fetch follower and following counts
        $followers = $followersModel->countFollowers($user['id']);
        $following = $followersModel->countFollowing($user['id']);

        // ✅ Correctly calculate answer accuracy
        $totalAnswers = $user['correct_answers'] + $user['incorrect_answers'];
        $accuracy = ($totalAnswers > 0) ? round(($user['correct_answers'] / $totalAnswers) * 100, 2) : 0;

        // ✅ Fetch actual leaderboard rank
        $query = $db->query("
        SELECT id, username, total_points,
        RANK() OVER (ORDER BY total_points DESC) as rank
        FROM users
    ");
        $leaderboard = $query->getResultArray();

        $rank = null;
        foreach ($leaderboard as $entry) {
            if ($entry['id'] == $user['id']) {
                $rank = $entry['rank'];
                break;
            }
        }

        return view('profile', [
            'user' => $user,
            'followers' => $followers,
            'following' => $following,
            'accuracy' => $accuracy,
            'rank' => $rank
        ]);
    }

}
