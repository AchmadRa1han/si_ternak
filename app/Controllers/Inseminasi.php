<?php

namespace App\Controllers;

use App\Models\InseminasiModel;
use App\Models\PkbModel;
use App\Models\KelahiranModel;

class Inseminasi extends BaseController
{
    protected $ibModel;
    protected $pkbModel;
    protected $kelahiranModel;

    public function __construct()
    {
        $this->ibModel = new InseminasiModel();
        $this->pkbModel = new PkbModel();
        $this->kelahiranModel = new KelahiranModel();
    }

    // --- INSEMINASI BUATAN (IB) ---

    public function index()
    {
        $data['title'] = 'Data Inseminasi Buatan';
        $data['inseminasi'] = $this->ibModel->getInseminasi();
        
        return view('template/header', $data)
             . view('inseminasi/v_inseminasi_index', $data)
             . view('template/footer');
    }

    public function store_ib()
    {
        $this->ibModel->insert([
            'id_ib'           => 'IB' . time(),
            'id_hewan'        => $this->request->getPost('id_hewan'),
            'tanggal_ib'      => $this->request->getPost('tanggal_ib'),
            'id_petugas'      => $this->request->getPost('id_petugas'),
            'ib_ke'           => $this->request->getPost('ib_ke'),
            'id_pejantan'     => $this->request->getPost('id_pejantan'),
            'bangsa_pejantan' => $this->request->getPost('bangsa_pejantan'),
            'status'          => $this->request->getPost('status'),
            'created_by'      => session()->get('user_id')
        ]);

        session()->setFlashdata('success', 'Data Inseminasi Buatan berhasil ditambahkan.');
        return redirect()->to(base_url('inseminasi'));
    }

    // --- PEMERIKSAAN KEBUNTINGAN (PKB) ---

    public function pkb()
    {
        $data['title'] = 'Data Pemeriksaan Kebuntingan';
        $data['pkb'] = $this->pkbModel->getPkb();
        
        return view('template/header', $data)
             . view('inseminasi/v_pkb_index', $data)
             . view('template/footer');
    }

    public function store_pkb()
    {
        $this->pkbModel->insert($this->request->getPost());
        session()->setFlashdata('success', 'Data PKB berhasil ditambahkan.');
        return redirect()->to(base_url('inseminasi/pkb'));
    }

    // --- KELAHIRAN ---

    public function kelahiran()
    {
        $data['title'] = 'Data Kelahiran';
        $data['kelahiran'] = $this->kelahiranModel->getKelahiran();
        
        return view('template/header', $data)
             . view('inseminasi/v_kelahiran_index', $data)
             . view('template/footer');
    }

    public function store_kelahiran()
    {
        $this->kelahiranModel->insert($this->request->getPost());
        session()->setFlashdata('success', 'Data kelahiran berhasil ditambahkan.');
        return redirect()->to(base_url('inseminasi/kelahiran'));
    }
}
