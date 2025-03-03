<?php

namespace App\Models;

use CodeIgniter\Model;

class FollowersModel extends Model
{
    protected $table = 'followers';
    protected $primaryKey = 'id';
    protected $allowedFields = ['follower_id', 'following_id'];

    public function isFollowing($followerId, $followingId)
    {
        return $this->where(['follower_id' => $followerId, 'following_id' => $followingId])->first();
    }

    public function follow($followerId, $followingId)
    {
        return $this->insert(['follower_id' => $followerId, 'following_id' => $followingId]);
    }

    public function unfollow($followerId, $followingId)
    {
        return $this->where(['follower_id' => $followerId, 'following_id' => $followingId])->delete();
    }

    public function countFollowers($userId)
    {
        return $this->where('following_id', $userId)->countAllResults();
    }

    public function countFollowing($userId)
    {
        return $this->where('follower_id', $userId)->countAllResults();
    }
}
