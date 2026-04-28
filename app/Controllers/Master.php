<?php

namespace App\Controllers;

use App\Models\DatPetugasModel;
use App\Models\DatPemilikModel;
use App\Models\JenisPakanModel;
use App\Models\DatTernakModel;

class Master extends BaseController
{
    protected $petugasModel;
    protected $peternakModel;
    protected $pakanModel;
    protected $hewanModel;

    public function __construct()
    {
        $this->petugasModel = new DatPetugasModel();
        $this->peternakModel = new DatPemilikModel();
        $this->pakanModel = new JenisPakanModel();
        $this->hewanModel = new DatTernakModel();
    }

    // --- CRUD PETUGAS ---
    public function petugas()
    {
        $data['title'] = "Petugas Lapangan";
        $data['petugas_list'] = $this->petugasModel->paginate(10, 'petugas');
        $data['pager'] = $this->petugasModel->pager;
        
        return view('template/header', $data)
             . view('master/petugas/v_index', $data)
             . view('template/footer');
    }

    public function petugas_add()
    {
        $data['title'] = "Tambah Petugas";
        return view('template/header', $data)
             . view('master/petugas/v_form', $data)
             . view('template/footer');
    }

    public function petugas_edit($id)
    {
        $data['title'] = "Edit Petugas";
        $data['petugas'] = $this->petugasModel->find($id);
        return view('template/header', $data)
             . view('master/petugas/v_form', $data)
             . view('template/footer');
    }

    public function petugas_store()
    {
        $this->petugasModel->insert($this->request->getPost());
        session()->setFlashdata('success', 'Data berhasil ditambahkan.');
        return redirect()->to(base_url('master/petugas'));
    }

    public function petugas_update($id)
    {
        $this->petugasModel->update($id, $this->request->getPost());
        session()->setFlashdata('success', 'Data berhasil diperbarui.');
        return redirect()->to(base_url('master/petugas'));
    }

    public function petugas_delete($id)
    {
        $this->petugasModel->delete($id);
        session()->setFlashdata('success', 'Data berhasil dihapus.');
        return redirect()->to(base_url('master/petugas'));
    }

    // --- CRUD PETERNAK ---
    public function peternak()
    {
        $data['title'] = "Data Peternak";
        $data['peternak_list'] = $this->peternakModel
            ->select('peternak.*, COUNT(hewan.id_hewan) as jumlah_hewan')
            ->join('hewan', 'hewan.id_peternak = peternak.id_peternak', 'left')
            ->groupBy('peternak.id_peternak')
            ->paginate(10, 'peternak');
        $data['pager'] = $this->peternakModel->pager;
        
        return view('template/header', $data)
             . view('master/peternak/v_index', $data)
             . view('template/footer');
    }

    public function peternak_add()
    {
        $data['title'] = "Tambah Peternak";
        return view('template/header', $data)
             . view('master/peternak/v_form', $data)
             . view('template/footer');
    }

    public function peternak_edit($id)
    {
        $data['title'] = "Edit Peternak";
        $data['peternak'] = $this->peternakModel->find($id);
        return view('template/header', $data)
             . view('master/peternak/v_form', $data)
             . view('template/footer');
    }

    public function peternak_store()
    {
        $this->peternakModel->insert($this->request->getPost());
        session()->setFlashdata('success', 'Data berhasil ditambahkan.');
        return redirect()->to(base_url('master/peternak'));
    }

    public function peternak_update($id)
    {
        $this->peternakModel->update($id, $this->request->getPost());
        session()->setFlashdata('success', 'Data berhasil diperbarui.');
        return redirect()->to(base_url('master/peternak'));
    }

    public function peternak_delete($id)
    {
        $this->peternakModel->delete($id);
        session()->setFlashdata('success', 'Data berhasil dihapus.');
        return redirect()->to(base_url('master/peternak'));
    }

    // --- CRUD HEWAN ---
    public function hewan()
    {
        $data['title'] = "Data Hewan";
        $data['hewan_list'] = $this->hewanModel
            ->select('hewan.*, peternak.nama_peternak')
            ->join('peternak', 'peternak.id_peternak = hewan.id_peternak', 'left')
            ->paginate(10, 'hewan');
        $data['pager'] = $this->hewanModel->pager;
        
        return view('template/header', $data)
             . view('master/hewan/v_index', $data)
             . view('template/footer');
    }

    public function hewan_add()
    {
        $data['title'] = "Tambah Hewan";
        $data['peternak_list'] = $this->peternakModel->findAll();
        return view('template/header', $data)
             . view('master/hewan/v_form', $data)
             . view('template/footer');
    }

    public function hewan_edit($id)
    {
        $data['title'] = "Edit Hewan";
        $data['hewan'] = $this->hewanModel->find($id);
        $data['peternak_list'] = $this->peternakModel->findAll();
        return view('template/header', $data)
             . view('master/hewan/v_form', $data)
             . view('template/footer');
    }

    public function hewan_store()
    {
        $this->hewanModel->insert($this->request->getPost());
        session()->setFlashdata('success', 'Data hewan berhasil ditambahkan.');
        return redirect()->to(base_url('master/hewan'));
    }

    public function hewan_update($id)
    {
        $this->hewanModel->update($id, $this->request->getPost());
        session()->setFlashdata('success', 'Data hewan berhasil diperbarui.');
        return redirect()->to(base_url('master/hewan'));
    }

    public function hewan_delete($id)
    {
        $this->hewanModel->delete($id);
        session()->setFlashdata('success', 'Data hewan berhasil dihapus.');
        return redirect()->to(base_url('master/hewan'));
    }
}
