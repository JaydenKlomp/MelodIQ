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
        'bio',
        'is_admin'
    ];

    protected $useTimestamps = false;

    public function getUserById($id)
    {
        return $this->where('id', $id)->first();
    }

    public function getUserByUsername($username)
    {
        return $this->where('username', $username)->first();
    }

    public function getUserByEmail($email)
    {
        return $this->select('id, username, email, avatar, is_admin, password') // ✅ Ensure is_admin is selected
        ->where('email', $email)
            ->first();
    }

}
