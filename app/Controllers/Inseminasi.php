<?php

namespace App\Controllers;

use App\Models\InseminasiModel;
use App\Models\PkbModel;
use App\Models\KelahiranModel;
use App\Models\DatTernakModel;
use App\Models\DatPetugasModel;

class Inseminasi extends BaseController
{
    protected $ibModel;
    protected $pkbModel;
    protected $kelahiranModel;
    protected $ternakModel;
    protected $petugasModel;

    public function __construct()
    {
        $this->ibModel = new InseminasiModel();
        $this->pkbModel = new PkbModel();
        $this->kelahiranModel = new KelahiranModel();
        $this->ternakModel = new DatTernakModel();
        $this->petugasModel = new DatPetugasModel();
    }

    // --- INSEMINASI BUATAN (IB) ---

    public function index()
    {
        $data['title'] = 'Data Inseminasi Buatan';
        $data['inseminasi'] = $this->ibModel
            ->select("inseminasi.*, hewan.jenis_kelamin, peternak.nama_peternak, petugas_lapangan.nama_petugas")
            ->join("hewan", "hewan.id_hewan = inseminasi.id_hewan", "left")
            ->join("peternak", "peternak.id_peternak = hewan.id_peternak", "left")
            ->join("petugas_lapangan", "petugas_lapangan.id_petugas = inseminasi.id_petugas", "left")
            ->orderBy("inseminasi.tanggal_ib", "DESC")
            ->paginate(10, 'ib');
        $data['pager'] = $this->ibModel->pager;
        
        return view('template/header', $data)
             . view('inseminasi/v_inseminasi_index', $data)
             . view('template/footer');
    }

    public function tambah_ib()
    {
        $data['title'] = 'Tambah Data Inseminasi';
        $data['hewan'] = $this->ternakModel->getAll();
        $data['petugas'] = $this->petugasModel->findAll();
        
        return view('template/header', $data)
             . view('inseminasi/v_inseminasi_form', $data)
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

    public function edit_ib($id)
    {
        $data['title'] = 'Edit Data Inseminasi';
        $data['ib'] = $this->ibModel->getInseminasi($id);
        $data['hewan'] = $this->ternakModel->getAll();
        $data['petugas'] = $this->petugasModel->findAll();
        
        return view('template/header', $data)
             . view('inseminasi/v_inseminasi_form', $data)
             . view('template/footer');
    }

    public function update_ib($id)
    {
        $this->ibModel->update($id, [
            'id_hewan'        => $this->request->getPost('id_hewan'),
            'tanggal_ib'      => $this->request->getPost('tanggal_ib'),
            'id_petugas'      => $this->request->getPost('id_petugas'),
            'ib_ke'           => $this->request->getPost('ib_ke'),
            'id_pejantan'     => $this->request->getPost('id_pejantan'),
            'bangsa_pejantan' => $this->request->getPost('bangsa_pejantan'),
            'status'          => $this->request->getPost('status')
        ]);

        session()->setFlashdata('success', 'Data Inseminasi Buatan berhasil diperbarui.');
        return redirect()->to(base_url('inseminasi'));
    }

    public function destroy_ib($id)
    {
        $this->ibModel->delete($id);
        session()->setFlashdata('success', 'Data Inseminasi Buatan berhasil dihapus.');
        return redirect()->to(base_url('inseminasi'));
    }

    // --- PEMERIKSAAN KEBUNTINGAN (PKB) ---

    public function pkb()
    {
        $data['title'] = 'Data Pemeriksaan Kebuntingan';
        $data['pkb'] = $this->pkbModel
            ->select("pkb.*, hewan.nama_hewan, hewan.jenis_kelamin, peternak.nama_peternak, petugas_lapangan.nama_petugas")
            ->join("hewan", "hewan.id_hewan = pkb.id_hewan", "left")
            ->join("peternak", "peternak.id_peternak = hewan.id_peternak", "left")
            ->join("petugas_lapangan", "petugas_lapangan.id_petugas = pkb.id_petugas", "left")
            ->orderBy("pkb.tanggal_pkb", "DESC")
            ->paginate(10, 'pkb');
        $data['pager'] = $this->pkbModel->pager;
        
        return view('template/header', $data)
             . view('inseminasi/v_pkb_index', $data)
             . view('template/footer');
    }

    public function tambah_pkb()
    {
        $data['title'] = 'Tambah Data PKB';
        $data['hewan'] = $this->ternakModel->getAll();
        $data['petugas'] = $this->petugasModel->findAll();
        
        return view('template/header', $data)
             . view('inseminasi/v_pkb_form', $data)
             . view('template/footer');
    }

    public function store_pkb()
    {
        $data = $this->request->getPost();
        $insertData = [
            'id_hewan'          => $data['id_hewan'],
            'tanggal_pkb'       => $data['tanggal_pkb'],
            'hasil_kebuntingan' => $data['hasil_kebuntingan'],
            'metode'            => $data['metode'],
            'id_petugas'        => $data['id_petugas'],
            'umur_kebuntingan'  => $data['umur_kebuntingan'],
            'created_by'        => session()->get('user_id')
        ];
        $this->pkbModel->insert($insertData);
        session()->setFlashdata('success', 'Data PKB berhasil ditambahkan.');
        return redirect()->to(base_url('inseminasi/pkb'));
    }

    public function edit_pkb($id)
    {
        $data['title'] = 'Edit Data PKB';
        $data['pkb'] = $this->pkbModel->getPkb($id);
        $data['hewan'] = $this->ternakModel->getAll();
        $data['petugas'] = $this->petugasModel->findAll();
        
        return view('template/header', $data)
             . view('inseminasi/v_pkb_form', $data)
             . view('template/footer');
    }

    public function update_pkb($id)
    {
        $data = $this->request->getPost();
        $updateData = [
            'id_hewan'          => $data['id_hewan'],
            'tanggal_pkb'       => $data['tanggal_pkb'],
            'hasil_kebuntingan' => $data['hasil_kebuntingan'],
            'metode'            => $data['metode'],
            'id_petugas'        => $data['id_petugas'],
            'umur_kebuntingan'  => $data['umur_kebuntingan']
        ];
        $this->pkbModel->update($id, $updateData);
        session()->setFlashdata('success', 'Data PKB berhasil diperbarui.');
        return redirect()->to(base_url('inseminasi/pkb'));
    }

    public function destroy_pkb($id)
    {
        $this->pkbModel->delete($id);
        session()->setFlashdata('success', 'Data PKB berhasil dihapus.');
        return redirect()->to(base_url('inseminasi/pkb'));
    }

    // --- KELAHIRAN ---

    public function kelahiran()
    {
        $data['title'] = 'Data Kelahiran';
        $data['kelahiran'] = $this->kelahiranModel
            ->select("kelahiran.*, hewan.nama_hewan, peternak.nama_peternak, petugas_lapangan.nama_petugas")
            ->join("hewan", "hewan.id_hewan = kelahiran.id_hewan", "left")
            ->join("peternak", "peternak.id_peternak = hewan.id_peternak", "left")
            ->join("petugas_lapangan", "petugas_lapangan.id_petugas = kelahiran.id_petugas", "left")
            ->orderBy("kelahiran.tgl_laporan", "DESC")
            ->paginate(10, 'kelahiran');
        $data['pager'] = $this->kelahiranModel->pager;
        
        return view('template/header', $data)
             . view('inseminasi/v_kelahiran_index', $data)
             . view('template/footer');
    }

    public function tambah_kelahiran()
    {
        $data['title'] = 'Tambah Data Kelahiran';
        $data['hewan'] = $this->ternakModel->getAll();
        $data['petugas'] = $this->petugasModel->findAll();
        
        return view('template/header', $data)
             . view('inseminasi/v_kelahiran_form', $data)
             . view('template/footer');
    }

    public function store_kelahiran()
    {
        $data = $this->request->getPost();
        $insertData = [
            'id_hewan'         => $data['id_hewan'],
            'tgl_laporan'      => $data['tgl_laporan'],
            'tgl_kelahiran'    => $data['tgl_kelahiran'] ?? $data['tgl_laporan'],
            'jenis_kelamin'    => $data['jenis_kelamin'],
            'bangsa'           => $data['bangsa'],
            'id_petugas'       => $data['id_petugas'],
            'metode_kawin'     => $data['metode_kawin'] ?? 'IB',
            'status_kelahiran' => $data['status_kelahiran'] ?? 'hidup',
            'created_by'       => session()->get('user_id')
        ];
        $this->kelahiranModel->insert($insertData);
        session()->setFlashdata('success', 'Data kelahiran berhasil ditambahkan.');
        return redirect()->to(base_url('inseminasi/kelahiran'));
    }

    public function edit_kelahiran($id)
    {
        $data['title'] = 'Edit Data Kelahiran';
        $data['kelahiran'] = $this->kelahiranModel->getKelahiran($id);
        $data['hewan'] = $this->ternakModel->getAll();
        $data['petugas'] = $this->petugasModel->findAll();
        
        return view('template/header', $data)
             . view('inseminasi/v_kelahiran_form', $data)
             . view('template/footer');
    }

    public function update_kelahiran($id)
    {
        $data = $this->request->getPost();
        $updateData = [
            'id_hewan'         => $data['id_hewan'],
            'tgl_laporan'      => $data['tgl_laporan'],
            'tgl_kelahiran'    => $data['tgl_kelahiran'] ?? $data['tgl_laporan'],
            'jenis_kelamin'    => $data['jenis_kelamin'],
            'bangsa'           => $data['bangsa'],
            'id_petugas'       => $data['id_petugas'],
            'metode_kawin'     => $data['metode_kawin'] ?? 'IB',
            'status_kelahiran' => $data['status_kelahiran'] ?? 'hidup'
        ];
        $this->kelahiranModel->update($id, $updateData);
        session()->setFlashdata('success', 'Data kelahiran berhasil diperbarui.');
        return redirect()->to(base_url('inseminasi/kelahiran'));
    }

    public function destroy_kelahiran($id)
    {
        $this->kelahiranModel->delete($id);
        session()->setFlashdata('success', 'Data kelahiran berhasil dihapus.');
        return redirect()->to(base_url('inseminasi/kelahiran'));
    }
}
