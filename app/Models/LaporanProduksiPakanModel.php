<?php

namespace App\Models;

use CodeIgniter\Model;

class LaporanProduksiPakanModel extends Model
{
    protected $table            = 'laporan_produksi_pakan';
    protected $primaryKey       = 'id_laporan';
    protected $returnType       = 'object';
    protected $allowedFields    = ['id_kelompok', 'bulan', 'tahun', 'status'];

    public function getAllWithGroup($filters = [])
    {
        $builder = $this->db->table($this->table);
        $builder->select('laporan_produksi_pakan.*, kelompok_produksi_pakan.nama_kelompok, SUM(detail_produksi_pakan.jumlah_produksi) as total_produksi');
        $builder->join('kelompok_produksi_pakan', 'laporan_produksi_pakan.id_kelompok = kelompok_produksi_pakan.id_kelompok');
        $builder->join('detail_produksi_pakan', 'laporan_produksi_pakan.id_laporan = detail_produksi_pakan.id_laporan', 'left');

        if (!empty($filters['bulan'])) {
            $builder->where('laporan_produksi_pakan.bulan', $filters['bulan']);
        }
        if (!empty($filters['tahun'])) {
            $builder->where('laporan_produksi_pakan.tahun', $filters['tahun']);
        }

        $builder->groupBy('laporan_produksi_pakan.id_laporan');
        $builder->orderBy('laporan_produksi_pakan.tahun DESC, laporan_produksi_pakan.bulan DESC');
        return $builder->get()->getResult();
    }

    public function getDistinctPeriods()
    {
        return $this->db->table($this->table)
            ->select('tahun, bulan')
            ->groupBy(['tahun', 'bulan'])
            ->orderBy('tahun DESC, bulan DESC')
            ->get()->getResult();
    }

    public function getByIdWithGroup($id)
    {
        return $this->db->table($this->table)
            ->select('laporan_produksi_pakan.*, kelompok_produksi_pakan.nama_kelompok')
            ->join('kelompok_produksi_pakan', 'laporan_produksi_pakan.id_kelompok = kelompok_produksi_pakan.id_kelompok')
            ->where('id_laporan', $id)
            ->get()->getRow();
    }

    public function getProductionReportData($filters = [])
    {
        if (empty($filters['bulan']) || empty($filters['tahun'])) {
            return [];
        }

        $builder = $this->db->table('kelompok_produksi_pakan k');
        $builder->select('k.kecamatan, k.nama_kelompok, k.desa, j.nama_jenis, d.jumlah_produksi');
        $builder->join('laporan_produksi_pakan l', 'k.id_kelompok = l.id_kelompok AND l.bulan = ' . $this->db->escape($filters['bulan']) . ' AND l.tahun = ' . $this->db->escape($filters['tahun']), 'left');
        $builder->join('detail_produksi_pakan d', 'l.id_laporan = d.id_laporan', 'left');
        $builder->join('jenis_pakan j', 'd.id_jenis_pakan = j.id_jenis_pakan', 'left');

        $builder->orderBy('k.kecamatan ASC, k.nama_kelompok ASC');
        return $builder->get()->getResultArray();
    }
}
