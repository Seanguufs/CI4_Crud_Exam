<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Auth extends BaseController
{
    public function index()
    {
        if (session()->get('isLoggedIn') == TRUE) {
            $redirect = $this->request->getGet('redirect') ?? 'dashboard';
            return redirect()->to(base_url($redirect));
        }

        if (!$this->validate(['username'  => 'required'])) {
            return view('pages/commons/login');
        } else {
            $inputEmail     = htmlspecialchars($this->request->getVar('username', FILTER_UNSAFE_RAW));
            $inputPassword  = htmlspecialchars($this->request->getVar('password', FILTER_UNSAFE_RAW));
            $user           = $this->ApplicationModel->getUser(username: $inputEmail);
            if ($user) {
                $password        = $user['password'];
                $verify = password_verify($inputPassword, $password);
                if ($verify) {
                    session()->set([
                        'username'        => $user['username'],
                        'role'            => $user['role'],
                        'isLoggedIn'     => TRUE
                    ]);
                    $redirect = $this->request->getPost('redirect') ?? 'dashboard';
                    return redirect()->to(base_url($redirect));
                } else {
                    session()->setFlashdata('notif_error', '<b>Your ID or Password is Wrong !</b> ');
                    return redirect()->to(base_url());
                }
            } else {
                session()->setFlashdata('notif_error', '<b>Your ID or Password is Wrong!</b> ');
                return redirect()->to(base_url());
            }
        }
    }
    public function logout()
    {
        $this->session->destroy();
        return redirect()->to(base_url('/'));
    }

    public function forbiddenPage()
    {
        $data = array_merge($this->data, [
            'title'         => 'Forbidden Page'
        ]);
        return view('pages/commons/forbidden', $data);
    }

    public function register()
    {
        return view('pages/commons/register');
    }

    public function registration()
    {
        if (!$this->validate([
            'username'       => ['label' => 'Email', 'rules' => 'required|is_unique[users.username]|valid_email'],
            'password'       => ['label' => 'Password', 'rules' => 'required|min_length[6]'],
            'password_confirm' => ['label' => 'Password Confirmation', 'rules' => 'matches[password]'],
        ])) {
            session()->setFlashdata('notif_error', implode(' ', $this->validation->getErrors()));
            return redirect()->back()->withInput();
        } else {
            $inputFullname = htmlspecialchars($this->request->getVar('name', FILTER_UNSAFE_RAW));
            $inputEmail    = htmlspecialchars($this->request->getVar('username', FILTER_UNSAFE_RAW));
            $inputPassword = htmlspecialchars($this->request->getVar('password', FILTER_UNSAFE_RAW));
            $dataUser      = [
                'inputFullname' => $inputFullname,
                'inputUsername' => $inputEmail,
                'inputPassword' => $inputPassword,
                'inputRole'     => 1
            ];
            $this->ApplicationModel->createUser($dataUser);
            session()->set([
                'username'   => $inputEmail,
                'role'       => 1,
                'isLoggedIn' => TRUE
            ]);
            session()->setFlashdata('notif_success', '<b>Registration Successfully!</b>');
            return redirect()->to(base_url('exam'));
        }
    }
}
