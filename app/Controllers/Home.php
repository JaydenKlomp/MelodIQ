<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\TriviaModel;

class Home extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $triviaModel = new TriviaModel();

        // Get top 5 players
        $topPlayers = $userModel->orderBy('total_points', 'DESC')->limit(5)->find();

        // Get 3 recent trivias
        $recentTrivias = $triviaModel->orderBy('created_at', 'DESC')->limit(3)->find();

        return view('home', [
            'topPlayers' => $topPlayers,
            'recentTrivias' => $recentTrivias
        ]);
    }
}
