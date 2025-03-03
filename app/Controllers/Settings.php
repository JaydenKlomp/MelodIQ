<?php

namespace App\Controllers;

use App\Models\UserModel;

class Settings extends BaseController
{
    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $userModel = new UserModel();
        $user = $userModel->getUserById(session()->get('id'));

        return view('settings', ['user' => $user]);
    }

    public function updateProfile()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $userModel = new UserModel();
        $userId = session()->get('id');

        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone')
        ];

        // If a new profile picture is uploaded
        if ($file = $this->request->getFile('avatar')) {
            if ($file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move('uploads/avatars/', $newName);
                $data['avatar'] = 'uploads/avatars/' . $newName;
            }
        }

        $userModel->update($userId, $data);

        session()->set($data); // Update session data
        return redirect()->to('/settings')->with('success', 'Profile updated successfully!');
    }
}
