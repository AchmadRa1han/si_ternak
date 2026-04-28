<?php

namespace App\Controllers;

use App\Models\JenisPakanModel;
use App\Models\LaporanProduksiPakanModel;
use App\Models\KelompokProduksiPakanModel;
use App\Models\DetailProduksiPakanModel;

class Pakan extends BaseController
{
    protected $jenisPakanModel;
    protected $laporanPakanModel;

    public function __construct()
    {
        $this->jenisPakanModel = new JenisPakanModel();
        $this->laporanPakanModel = new LaporanProduksiPakanModel();
    }

    public function index()
    {
        $data['title'] = 'Data Jenis Pakan';
        $data['pakan'] = $this->jenisPakanModel->findAll();
        
        return view('template/header', $data)
             . view('pakan/v_pakan_index', $data)
             . view('template/footer');
    }

    public function create()
    {
        $data['title'] = 'Tambah Jenis Pakan';
        return view('template/header', $data)
             . view('pakan/v_pakan_form')
             . view('template/footer');
    }

    public function store()
    {
        $this->jenisPakanModel->insert([
            'nama_jenis' => $this->request->getPost('nama_jenis'),
            'kategori'   => $this->request->getPost('kategori'),
            'satuan'     => $this->request->getPost('satuan')
        ]);
        return redirect()->to(base_url('pakan'));
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Jenis Pakan';
        $data['pakan'] = $this->jenisPakanModel->find($id);
        
        return view('template/header', $data)
             . view('pakan/v_pakan_form', $data)
             . view('template/footer');
    }

    public function update($id)
    {
        $this->jenisPakanModel->update($id, [
            'nama_jenis' => $this->request->getPost('nama_jenis'),
            'kategori'   => $this->request->getPost('kategori'),
            'satuan'     => $this->request->getPost('satuan')
        ]);
        return redirect()->to(base_url('pakan'));
    }

    public function delete($id)
    {
        $this->jenisPakanModel->delete($id);
        return redirect()->to(base_url('pakan'));
    }

    public function laporan_produksi()
    {
        $data['title'] = 'Daftar Laporan Produksi Pakan';
        $data['laporan'] = $this->laporanPakanModel->getAllWithGroup();
        
        return view('template/header', $data)
             . view('pakan/v_laporan_produksi_index', $data)
             . view('template/footer');
    }

    public function laporan_produksi_store()
    {
        $detailModel = new DetailProduksiPakanModel();

        $bulan = $this->request->getPost('bulan');
        $tahun = $this->request->getPost('tahun');

        $id_laporan = $this->laporanPakanModel->insert([
            'id_kelompok'     => $this->request->getPost('id_kelompok'),
            'bulan'           => $bulan,
            'tahun'           => $tahun,
            'periode_laporan' => $tahun . '-' . str_pad($bulan, 2, '0', STR_PAD_LEFT),
            'status'          => 'draft',
            'created_by'      => session()->get('user_id')
        ]);

        $id_jenis_pakan = $this->request->getPost('id_jenis_pakan');
        $jumlah_produksi = $this->request->getPost('jumlah_produksi');

        if ($id_jenis_pakan) {
            foreach ($id_jenis_pakan as $key => $val) {
                $detailModel->insert([
                    'id_laporan'      => $id_laporan,
                    'id_jenis_pakan'  => $val,
                    'jumlah_produksi' => $jumlah_produksi[$key]
                ]);
            }
        }

        return redirect()->to(base_url('pakan/laporan_produksi'));
    }

    public function laporan_bulanan()
    {
        $data['title'] = 'Laporan Bulanan Produksi Pakan';
        $data['all_jenis_pakan'] = $this->jenisPakanModel->findAll();

        $selected_period = $this->request->getGet('periode');
        $filters = [];
        if ($selected_period) {
            $parts = explode('-', $selected_period);
            if(count($parts) == 2) {
                $filters['bulan'] = $parts[0];
                $filters['tahun'] = $parts[1];
            }
        }

        $raw_data = $this->laporanPakanModel->getProductionReportData($filters);
        
        $processed_data = [];
        foreach ($raw_data as $row) {
            $kecamatan = $row['kecamatan'];
            $kelompok = $row['nama_kelompok'];
            $jenis_pakan = $row['nama_jenis'];
            $jumlah = $row['jumlah_produksi'];

            if (!isset($processed_data[$kecamatan])) {
                $processed_data[$kecamatan] = [];
            }
            if (!isset($processed_data[$kecamatan][$kelompok])) {
                $processed_data[$kecamatan][$kelompok]['alamat'] = $row['desa'];
                foreach ($data['all_jenis_pakan'] as $jp) {
                    $processed_data[$kecamatan][$kelompok][$jp->nama_jenis] = 0;
                }
            }
            if ($jenis_pakan) {
                $processed_data[$kecamatan][$kelompok][$jenis_pakan] = $jumlah;
            }
        }

        $periods = $this->laporanPakanModel->getDistinctPeriods();
        $grouped_periods = [];
        foreach ($periods as $p) {
            if (!isset($grouped_periods[$p->tahun])) {
                $grouped_periods[$p->tahun] = [];
            }
            $grouped_periods[$p->tahun][] = $p->bulan;
        }

        $data['laporan'] = $processed_data;
        $data['grouped_periods'] = $grouped_periods;
        $data['selected_period'] = $selected_period;
        $data['selected_bulan'] = !empty($filters['bulan']) ? $filters['bulan'] : date('m');
        $data['selected_tahun'] = !empty($filters['tahun']) ? $filters['tahun'] : date('Y');

        return view('template/header', $data)
             . view('pakan/v_laporan_bulanan_index', $data)
             . view('template/footer');
    }
}
