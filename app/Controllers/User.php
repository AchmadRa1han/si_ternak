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

    public function add()
    {
        $data['title'] = "Tambah Pengguna";
        return view('template/header', $data)
             . view('user/v_user_form', $data)
             . view('template/footer');
    }

    public function edit($id)
    {
        $data['title'] = "Edit Pengguna";
        $data['user'] = $this->userModel->find($id);
        return view('template/header', $data)
             . view('user/v_user_form', $data)
             . view('template/footer');
    }

    public function store()
    {
        $data = [
            'username'     => $this->request->getPost('username'),
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'email'        => $this->request->getPost('email'),
            'nip'          => $this->request->getPost('nip'),
            'jabatan'      => $this->request->getPost('jabatan'),
            'role'         => $this->request->getPost('role'),
            'is_active'    => $this->request->getPost('is_active')
        ];

        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $id = $this->request->getPost('id');
        if ($id) {
            $this->userModel->update($id, $data);
            session()->setFlashdata('success', 'Data pengguna berhasil diperbarui.');
        } else {
            $this->userModel->insert($data);
            session()->setFlashdata('success', 'Data pengguna berhasil ditambahkan.');
        }

        return redirect()->to(site_url('user'));
    }

    public function delete($id)
    {
        $this->userModel->delete($id);
        session()->setFlashdata('success', 'Data pengguna berhasil dihapus.');
        return redirect()->to(site_url('user'));
    }
}
