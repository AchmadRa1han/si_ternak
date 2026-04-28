<?php

namespace App\Controllers;

use App\Models\KelompokTernakModel;
use App\Models\LaporanBulananModel;
use App\Models\WilayahModel;

class Perkembangan extends BaseController
{
    protected $kelompokModel;
    protected $laporanModel;
    protected $wilayahModel;

    public function __construct()
    {
        $this->kelompokModel = new KelompokTernakModel();
        $this->laporanModel = new LaporanBulananModel();
        $this->wilayahModel = new WilayahModel();
    }

    public function kelompok()
    {
        $data['title'] = "Data Kelompok Ternak";
        $data['kelompok_list'] = $this->kelompokModel
            ->select('kelompok_ternak.*, kecamatan.nama_kecamatan as kecamatan_nama, desa.nama_desa as desa_nama')
            ->join('kecamatan', 'kecamatan.id_kecamatan = kelompok_ternak.id_kecamatan', 'left')
            ->join('desa', 'desa.id_desa = kelompok_ternak.id_desa', 'left')
            ->paginate(10, 'kelompok');
        $data['pager'] = $this->kelompokModel->pager;
        
        return view('template/header', $data)
             . view('perkembangan/kelompok/v_index', $data)
             . view('template/footer');
    }

    public function kelompok_store()
    {
        $this->kelompokModel->insert($this->request->getPost());
        session()->setFlashdata('success', 'Data kelompok berhasil ditambahkan.');
        return redirect()->to(base_url('perkembangan/kelompok'));
    }

    public function kelompok_update($id)
    {
        $this->kelompokModel->update($id, $this->request->getPost());
        session()->setFlashdata('success', 'Data kelompok berhasil diperbarui.');
        return redirect()->to(base_url('perkembangan/kelompok'));
    }

    public function kelompok_delete($id)
    {
        $this->kelompokModel->delete($id);
        session()->setFlashdata('success', 'Data kelompok berhasil dihapus.');
        return redirect()->to(base_url('perkembangan/kelompok'));
    }

    public function laporan()
    {
        $data['title'] = "Laporan Bulanan Perkembangan";
        $data['periods'] = $this->laporanModel->getDistinctPeriods();
        
        $selected_period = $this->request->getGet('periode');
        $data['laporan_list'] = [];
        $data['pager'] = null;

        if ($selected_period) {
            $parts = explode('-', $selected_period);
            if (count($parts) == 2) {
                $data['laporan_list'] = $this->laporanModel
                    ->select('laporan_bulanan.*, kelompok_ternak.nama_kelompok')
                    ->join('kelompok_ternak', 'kelompok_ternak.id = laporan_bulanan.id_kelompok', 'left')
                    ->where('laporan_bulanan.bulan', $parts[0])
                    ->where('laporan_bulanan.tahun', $parts[1])
                    ->paginate(10, 'laporan_perkembangan');
                $data['pager'] = $this->laporanModel->pager;
            }
        }
        
        $data['selected_period'] = $selected_period;
        
        return view('template/header', $data)
             . view('perkembangan/laporan/v_index', $data)
             . view('template/footer');
    }

    public function get_desa_by_kecamatan()
    {
        $kecamatan_id = $this->request->getPost('kecamatan_id');
        $desa_list = $this->wilayahModel->getDesaByKecamatan($kecamatan_id);
        return $this->response->setJSON($desa_list);
    }
}
