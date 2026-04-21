<?php

namespace App\Models;

use CodeIgniter\Model;

class VaksinasiModel extends Model
{
    protected $table            = 'laporan_vaksinasi_ternak';
    protected $primaryKey       = 'id';
    protected $returnType       = 'object';
    protected $allowedFields    = [
        'id', 'id_program', 'program_vaksinasi', 'id_penyakit', 'penyakit', 
        'kecamatan', 'desa', 'tanggal_vaksinasi', 'urutan_vaksinasi', 
        'namapetugas', 'nomorpetugas', 'identifikasihewan', 'eartag', 
        'rumpun', 'hewan', 'jenis_kelamin', 'umur', 'namapemilik', 
        'telppemilik', 'nikpemilik'
    ];

    public function insertBatchCustom($data)
    {
        if (empty($data)) return 0;
        
        // CI4 menggunakan replace() untuk penanganan duplikat
        foreach ($data as $row) {
            $this->db->table($this->table)->replace($row);
        }
        return true;
    }

    public function getRekapByMonth()
    {
        return $this->db->table($this->table)
            ->select('YEAR(tanggal_vaksinasi) as tahun, MONTH(tanggal_vaksinasi) as bulan, COUNT(*) as total_vaksinasi, COUNT(DISTINCT kecamatan) as jumlah_kecamatan, COUNT(DISTINCT desa) as jumlah_desa, COUNT(DISTINCT namapemilik) as jumlah_pemilik')
            ->groupBy(['YEAR(tanggal_vaksinasi)', 'MONTH(tanggal_vaksinasi)'])
            ->orderBy('tahun DESC, bulan DESC')
            ->get()->getResult();
    }

    public function getRekapByPetugas($filters = [])
    {
        $builder = $this->db->table($this->table);
        $builder->select('namapetugas, COUNT(*) as total_vaksinasi, COUNT(DISTINCT kecamatan) as jumlah_kecamatan, COUNT(DISTINCT desa) as jumlah_desa, MIN(tanggal_vaksinasi) as vaksinasi_pertama, MAX(tanggal_vaksinasi) as vaksinasi_terakhir');

        if (!empty($filters['bulan'])) {
            $builder->where('MONTH(tanggal_vaksinasi)', $filters['bulan']);
        }
        if (!empty($filters['tahun'])) {
            $builder->where('YEAR(tanggal_vaksinasi)', $filters['tahun']);
        }

        $builder->groupBy('namapetugas');
        $builder->orderBy('total_vaksinasi DESC');
        return $builder->get()->getResult();
    }

    public function getDistinctPeriods()
    {
        return $this->db->table($this->table)
            ->select('YEAR(tanggal_vaksinasi) as tahun, MONTH(tanggal_vaksinasi) as bulan')
            ->groupBy(['tahun', 'bulan'])
            ->orderBy('tahun DESC, bulan DESC')
            ->get()->getResult();
    }
}
