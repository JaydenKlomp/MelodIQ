<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'username',
        'email',
        'password',
        'phone',
        'avatar',
        'total_points',
        'trivia_played',
        'correct_answers',
        'time_spent',
        'followers',
        'following',
        'bio'
    ];

    protected $useTimestamps = false;

    public function getUserById($id)
    {
        return $this->where('id', $id)->first();
    }

    // ✅ NEW: Fetch user by username
    public function getUserByUsername($username)
    {
        return $this->where('username', $username)->first();
    }
}
