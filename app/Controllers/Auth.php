<?php

namespace App\Controllers;

use App\Controllers\BaseController;
<<<<<<< HEAD
=======
use CodeIgniter\HTTP\ResponseInterface;
>>>>>>> 9ba83627075c63629f030a4305e2abafb941156b

class Auth extends BaseController
{
    public function index()
    {
<<<<<<< HEAD
        // Already logged in — redirect to correct dashboard
        if (session()->has('user')) {
            return $this->redirectByRole(session('user')['role'] ?? '');
        }

        if (! $this->validate(['inputEmail' => 'required'])) {
            return view('pages/commons/login');
        }

        $inputEmail    = trim((string) $this->request->getVar('inputEmail'));
        $inputPassword = trim((string) $this->request->getVar('inputPassword'));

        // JOIN roles to get role slug
        $found = $this->db->table('users')
            ->select('users.*, roles.name AS role_name, users.id AS userID')
            ->join('roles', 'roles.id = users.role_id', 'left')
            ->where('users.username', $inputEmail)
            ->get()->getRowArray();

        if (! $found) {
            session()->setFlashdata('notif_error', "<b>Invalid email address:</b> '$inputEmail' - user not found in database.");
            return redirect()->to(base_url('/'));
        }
        
        if (! password_verify($inputPassword, $found['password'])) {
            session()->setFlashdata('notif_error', '<b>Invalid password provided for that account.</b>');
            return redirect()->to(base_url('/'));
        }

        $roleName = $found['role_name'] ?? 'student';

        session()->set('user', [
            'id'       => $found['id'],
            'userID'   => $found['id'],
            'name'     => $found['fullname'],
            'fullname' => $found['fullname'],
            'email'    => $found['username'],
            'username' => $found['username'],
            'role'     => $roleName,
            'role_id'  => $found['role_id'],
        ]);

        // Keep legacy key for old filter compatibility
        session()->set('isLoggedIn', true);
        session()->set('username', $found['username']);
        session()->set('role', $found['role'] ?? 1);

        return $this->redirectByRole($roleName);
    }

    private function redirectByRole(string $role)
    {
        return match($role) {
            'admin', 'teacher', 'coordinator' => redirect()->to('/dashboard'),
            'student'                         => redirect()->to('/student/dashboard'),
            default                           => redirect()->to('/dashboard'),
        };
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('/'));
    }

    public function unauthorized()
    {
        return view('errors/unauthorized');
    }

    public function forbiddenPage()
    {
        $data = array_merge($this->data, ['title' => 'Forbidden']);
        return response()->setStatusCode(403)->setBody(view('pages/commons/forbidden', $data));
=======
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
>>>>>>> 9ba83627075c63629f030a4305e2abafb941156b
    }

    public function register()
    {
        return view('pages/commons/register');
    }

    public function registration()
    {
<<<<<<< HEAD
        if (! $this->validate([
            'inputRole'      => ['label' => 'Role',                  'rules' => 'required|in_list[admin,teacher,coordinator,student]'],
            'inputVerify'    => ['label' => 'Verification',          'rules' => 'required'],
            'inputEmail'     => ['label' => 'Email',                 'rules' => 'required|valid_email|is_unique[users.username]|regex_match[/^[^@]+@school\.edu\.ph$/]'],
            'inputPassword'  => ['label' => 'Password',              'rules' => 'required|min_length[6]'],
            'inputPassword2' => ['label' => 'Password Confirmation',  'rules' => 'required|matches[inputPassword]'],
        ])) {
            session()->setFlashdata('notif_error',
                implode(' ', array_filter([
                    $this->validation->getError('inputRole'),
                    $this->validation->getError('inputVerify'),
                    $this->validation->getError('inputEmail'),
                    $this->validation->getError('inputPassword'),
                    $this->validation->getError('inputPassword2'),
                ]))
            );
            return redirect()->back()->withInput();
        }

        $selectedRole = $this->request->getVar('inputRole');
        $inputVerify  = trim($this->request->getVar('inputVerify'));
        $codes        = config('RegistrationCodes');

        // Verify the code/ID based on role
        $valid = match($selectedRole) {
            'admin'       => $inputVerify === $codes->adminCode,
            'coordinator' => $inputVerify === $codes->coordinatorCode,
            'teacher'     => in_array($inputVerify, $codes->teacherIds, true),
            'student'     => in_array($inputVerify, $codes->studentIds, true) || preg_match('/^42300\d{4}$/', $inputVerify),
            default       => false,
        };

        if (! $valid) {
            $labels = ['admin' => 'Admin code', 'coordinator' => 'Coordinator code', 'teacher' => 'Teacher ID', 'student' => 'Student ID'];
            session()->setFlashdata('notif_error', '<b>' . ($labels[$selectedRole] ?? 'Verification') . ' is invalid.</b> Please check and try again.');
            return redirect()->back()->withInput();
        }

        $roleRow = $this->db->table('roles')->where('name', $selectedRole)->get()->getRowArray();
        $roleId  = $roleRow['id'] ?? null;

        $this->db->table('users')->insert([
            'fullname'   => $this->request->getVar('inputFullname'),
            'username'   => $this->request->getVar('inputEmail'),
            'password'   => password_hash($this->request->getVar('inputPassword'), PASSWORD_DEFAULT),
            'role'       => 1,
            'role_id'    => $roleId,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        session()->setFlashdata('notif_success', '<b>Registration successful!</b> Please login.');
        return redirect()->to(base_url('/'));
=======
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
>>>>>>> 9ba83627075c63629f030a4305e2abafb941156b
    }
}
