<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\TriviaModel;

class Home extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $db = \Config\Database::connect();

        $topPlayers = $userModel->orderBy('total_points', 'DESC')->limit(5)->findAll();

        $userStats = [];
        if (session()->get('isLoggedIn')) {
            $userStats = $userModel->select('trivia_played, total_points, correct_answers')
                ->where('id', session()->get('id'))
                ->first();
        }

        return view('home', [
            'topPlayers' => $topPlayers,
            'userStats' => $userStats
        ]);
    }

}
