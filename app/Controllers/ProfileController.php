<?php

namespace App\Controllers;

use App\Models\UserModel;

class ProfileController extends BaseController
{
    public function show()
    {
<<<<<<< HEAD
        $user = $this->data['user'];

        if (! $user) {
=======
        $userId = $this->data['user']['userID'] ?? null;
        if (!$userId) {
>>>>>>> 9ba83627075c63629f030a4305e2abafb941156b
            session()->destroy();
            return redirect()->to('/login');
        }

<<<<<<< HEAD
        return view('profile/show', array_merge($this->data, ['user' => $user]));
=======
        $userModel = new UserModel();
        $user = $userModel->find($userId);

        if (!$user) {
            session()->destroy();
            return redirect()->to('/login');
        }

        $this->data['user'] = array_merge($this->data['user'], $user);
        return view('profile/show', $this->data);
>>>>>>> 9ba83627075c63629f030a4305e2abafb941156b
    }

    public function edit()
    {
<<<<<<< HEAD
        $user = $this->data['user'];
        return view('profile/edit', array_merge($this->data, ['user' => $user]));
=======
        $userId = $this->data['user']['userID'] ?? null;
        if (!$userId) {
            return redirect()->to('/login');
        }

        $userModel = new UserModel();
        $user = $userModel->find($userId);

        if (!$user) {
            return redirect()->to('/login');
        }

        $this->data['user'] = array_merge($this->data['user'], $user);
        return view('profile/edit', $this->data);
>>>>>>> 9ba83627075c63629f030a4305e2abafb941156b
    }

    public function update()
    {
<<<<<<< HEAD
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
=======
        $userId = $this->data['user']['userID'] ?? null;
        if (!$userId) {
            return redirect()->to('/login');
        }

        $userModel = new UserModel();
        $user = $userModel->find($userId);

        if (!$user) {
            return redirect()->to('/login');
        }

        // Validation
        $rules = [
            'fullname' => 'required|min_length[3]',
            'username' => "required|is_unique[users.username,id,{$userId}]",
            'student_id' => 'permit_empty|max_length[20]',
            'course' => 'permit_empty|max_length[100]',
            'year_level' => 'permit_empty|integer|greater_than[0]|less_than[6]',
            'section' => 'permit_empty|max_length[50]',
            'phone' => 'permit_empty|max_length[20]',
            'address' => 'permit_empty',
        ];

        if (!$this->validate($rules)) {
>>>>>>> 9ba83627075c63629f030a4305e2abafb941156b
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $updateData = [
            'fullname' => $this->request->getPost('fullname'),
            'username' => $this->request->getPost('username'),
<<<<<<< HEAD
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
=======
            'student_id' => $this->request->getPost('student_id'),
            'course' => $this->request->getPost('course'),
            'year_level' => $this->request->getPost('year_level'),
            'section' => $this->request->getPost('section'),
            'phone' => $this->request->getPost('phone'),
            'address' => $this->request->getPost('address'),
        ];

        // Handle image upload
        $file = $this->request->getFile('profile_image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $validationRule = [
                'profile_image' => 'uploaded[profile_image]|is_image[profile_image]|mime_in[profile_image,image/jpg,image/jpeg,image/png,image/webp]|max_size[profile_image,2048]'
            ];

            if ($this->validate($validationRule)) {
                // Delete old image
                if (!empty($user['profile_image'])) {
                    $oldImagePath = FCPATH . 'uploads/profiles/' . $user['profile_image'];
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                // Generate unique filename
                $ext = $file->getExtension();
                $newName = 'avatar_' . $userId . '_' . time() . '.' . $ext;
                
                // Move file
                $file->move(FCPATH . 'uploads/profiles/', $newName);
                $updateData['profile_image'] = $newName;
            }
        }

        // Update profile
        $userModel->updateProfile($userId, $updateData);

        // Update session
        $updatedUser = $this->ApplicationModel->getUser(userID: $userId);
        session()->set([
            'username' => $updatedUser['username'],
            'role' => $updatedUser['role_id']
        ]);

        return redirect()->to('/profile')->with('success', 'Profile updated successfully!');
>>>>>>> 9ba83627075c63629f030a4305e2abafb941156b
    }
}
