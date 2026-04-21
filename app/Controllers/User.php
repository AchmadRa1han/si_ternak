<?php

namespace App\Controllers;

use App\Models\UserModel;

class User extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $data['title'] = "Manajemen Pengguna";
        $data['users'] = $this->userModel->findAll();
        
        return view('template/header', $data)
             . view('user/v_user_index', $data)
             . view('template/footer');
    }

    public function store()
    {
        $data = $this->request->getPost();
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        
        $this->userModel->insert($data);
        session()->setFlashdata('success', 'Data user berhasil ditambahkan.');
        return redirect()->to(base_url('user'));
    }

    public function update($id)
    {
        $data = $this->request->getPost();
        if (!empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        } else {
            unset($data['password']);
        }

        $this->userModel->update($id, $data);
        session()->setFlashdata('success', 'Data user berhasil diperbarui.');
        return redirect()->to(base_url('user'));
    }

    public function delete($id)
    {
        $this->userModel->delete($id);
        session()->setFlashdata('success', 'Data user berhasil dihapus.');
        return redirect()->to(base_url('user'));
    }
}
