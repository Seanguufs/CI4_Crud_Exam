<?php

namespace App\Controllers;

use App\Models\UserModel;

class ProfileController extends BaseController
{
    public function show()
    {
        $user = $this->data['user'];

        if (! $user) {
            session()->destroy();
            return redirect()->to('/login');
        }

        return view('profile/show', array_merge($this->data, ['user' => $user]));
    }

    public function edit()
    {
        $user = $this->data['user'];
        return view('profile/edit', array_merge($this->data, ['user' => $user]));
    }

    public function update()
    {
        $user      = $this->data['user'];
        $userId    = $user['userID'] ?? $user['id'];
        $userModel = new UserModel();

        // Validate text fields
        $rules = [
            'fullname'         => 'required|min_length[3]',
            'username'         => "required|is_unique[users.username,id,{$userId}]",
            'new_password'     => 'permit_empty|min_length[8]',
            'confirm_password' => 'permit_empty|matches[new_password]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $updateData = [
            'fullname' => $this->request->getPost('fullname'),
            'username' => $this->request->getPost('username'),
        ];

        // Handle password change
        $newPassword = $this->request->getPost('new_password');
        if (! empty($newPassword)) {
            $updateData['password'] = password_hash($newPassword, PASSWORD_DEFAULT);
        }

        $userModel->updateProfile($userId, $updateData);

        // Refresh session so navbar name updates immediately
        $sessionUser = session('user');
        if ($sessionUser) {
            $sessionUser['name']     = $updateData['fullname'];
            $sessionUser['fullname'] = $updateData['fullname'];
            $sessionUser['username'] = $updateData['username'];
            $sessionUser['email']    = $updateData['username'];
            session()->set('user', $sessionUser);
        }
        session()->set('username', $updateData['username']);

        session()->setFlashdata('success', 'Profile updated successfully!');
        return redirect()->to('/profile');
    }
}
