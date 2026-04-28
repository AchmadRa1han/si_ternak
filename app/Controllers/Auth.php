<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function index()
    {
        if (session()->get('logged_in')) {
            return redirect()->to(site_url('dashboard'));
        }
        return view('auth/v_login');
    }

    public function process_login()
    {
        $model = new UserModel();
        
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $model->where('username', $username)->first();

        if ($user) {
            if (password_verify($password, $user->password)) {
                $session_data = [
                    'user_id'      => $user->id,
                    'username'     => $user->username,
                    'nama_lengkap' => $user->nama_lengkap,
                    'role'         => $user->role,
                    'logged_in'    => TRUE
                ];
                session()->set($session_data);
                return redirect()->to(site_url('dashboard'));
            } else {
                session()->setFlashdata('error', 'Password salah!');
                return redirect()->to(site_url('auth'));
            }
        } else {
            session()->setFlashdata('error', 'Username tidak ditemukan!');
            return redirect()->to(site_url('auth'));
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(site_url('auth'));
    }
}
