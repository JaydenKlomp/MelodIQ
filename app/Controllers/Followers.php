<?php

namespace App\Controllers;

use App\Models\FollowersModel;
use App\Models\UserModel;

class Followers extends BaseController
{
    public function follow($followingId)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $followerId = session()->get('id');

        if ($followerId == $followingId) {
            return redirect()->back()->with('error', "You can't follow yourself.");
        }

        $followersModel = new FollowersModel();

        if (!$followersModel->isFollowing($followerId, $followingId)) {
            $followersModel->follow($followerId, $followingId);
        }

        return redirect()->back()->with('success', 'You are now following this user.');
    }

    public function unfollow($followingId)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $followerId = session()->get('id');

        $followersModel = new FollowersModel();

        if ($followersModel->isFollowing($followerId, $followingId)) {
            $followersModel->unfollow($followerId, $followingId);
        }

        return redirect()->back()->with('success', 'You have unfollowed this user.');
    }
}
