<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function processLogin()
    {
        $session = session();
        $userModel = new UserModel();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $userModel->getUserByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            $session->set([
                'id' => $user['id'],
                'username' => $user['username'],
                'email' => $user['email'],
                'avatar' => $user['avatar'],
                'isLoggedIn' => true
            ]);
            return redirect()->to('/');
        } else {
            return redirect()->back()->with('error', 'Invalid email or password.');
        }
    }

    public function register()
    {
        return view('auth/register');
    }

    public function processRegister()
    {
        $db = \Config\Database::connect();

        $sql = "INSERT INTO users (username, email, password, avatar, total_points, trivia_played, correct_answers, time_spent) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $data = [
            $this->request->getPost('username'),
            $this->request->getPost('email'),
            password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'assets/img/default-avatar.png',
            0, 0, 0, 0
        ];

        try {
            $query = $db->query($sql, $data);
            if (!$query) {
                throw new \Exception('Database error: ' . json_encode($db->error()));
            }
        } catch (\Exception $e) {
            log_message('error', $e->getMessage()); // Log error instead of showing it
            return redirect()->back()->with('error', 'Registration failed. Please try again.');
        }

        return redirect()->to('/login')->with('success', 'Registration successful! You can now log in.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
