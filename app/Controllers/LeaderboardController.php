<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class LeaderboardController extends Controller
{
    public function index()
    {
        $userModel = new UserModel();

        // ✅ Sorting option (default: total_points)
        $sort = $this->request->getGet('sort') ?? 'total_points';

        // ✅ Allowed sorting fields
        $allowedSorts = ['total_points', 'correct_answers', 'time_spent', 'trivia_played'];
        if (!in_array($sort, $allowedSorts)) {
            $sort = 'total_points'; // Default if invalid input
        }

        // ✅ Fetch users, sorted by the selected option
        $users = $userModel->orderBy($sort, 'DESC')->findAll();

        return view('leaderboard', [
            'users' => $users,
            'sort' => $sort
        ]);
    }
}
