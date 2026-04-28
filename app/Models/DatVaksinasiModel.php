<?php

namespace App\Models;

use CodeIgniter\Model;

class DatVaksinasiModel extends Model
{
    protected $table            = 'laporan_vaksinasi_ternak';
    protected $primaryKey       = 'id';
    protected $returnType       = 'object';
    protected $useTimestamps    = true;
    protected $allowedFields    = [
        'id_program', 'program_vaksinasi', 'id_penyakit', 'penyakit', 
        'provinsi', 'kabupaten', 'kecamatan', 'desa', 'tanggal_vaksinasi', 
        'urutan_vaksinasi', 'namapetugas', 'nomorpetugas', 'identifikasihewan', 
        'eartag', 'rumpun', 'hewan', 'jenis_kelamin', 'umur', 'namapemilik', 
        'telppemilik', 'nikpemilik', 'created_by'
    ];

    public function insertBatchCustom($data)
    {
        if (empty($data)) return 0;
        return $this->db->table($this->table)->ignore(true)->insertBatch($data); // ignore true to prevent duplicate errors if eartag/date is unique (though no unique constraint shown, good practice)
    }

    public function getRekapByMonth()
    {
        return $this->db->table($this->table)
            ->select('YEAR(tanggal_vaksinasi) as tahun, MONTH(tanggal_vaksinasi) as bulan, COUNT(*) as total_vaksinasi, COUNT(DISTINCT kecamatan) as jumlah_kecamatan, COUNT(DISTINCT desa) as jumlah_desa, COUNT(DISTINCT nikpemilik) as jumlah_pemilik')
            ->groupBy(['YEAR(tanggal_vaksinasi)', 'MONTH(tanggal_vaksinasi)'])
            ->orderBy('tahun DESC, bulan DESC')
            ->get()->getResult();
    }

    public function getRekapByPetugas($bulan = null, $tahun = null)
    {
        $builder = $this->db->table($this->table)
            ->select('namapetugas, COUNT(*) as total_vaksinasi, COUNT(DISTINCT kecamatan) as jumlah_kecamatan, COUNT(DISTINCT desa) as jumlah_desa, MIN(tanggal_vaksinasi) as vaksinasi_pertama, MAX(tanggal_vaksinasi) as vaksinasi_terakhir')
            ->groupBy('namapetugas')
            ->orderBy('total_vaksinasi DESC');

        if ($bulan && $tahun) {
            $builder->where('MONTH(tanggal_vaksinasi)', $bulan);
            $builder->where('YEAR(tanggal_vaksinasi)', $tahun);
        }

        return $builder->get()->getResult();
    }

    public function getGroupedPeriods()
    {
        $periods = $this->db->table($this->table)
            ->select('YEAR(tanggal_vaksinasi) as tahun, MONTH(tanggal_vaksinasi) as bulan')
            ->groupBy(['YEAR(tanggal_vaksinasi)', 'MONTH(tanggal_vaksinasi)'])
            ->orderBy('tahun DESC, bulan DESC')
            ->get()->getResult();

        $grouped = [];
        foreach ($periods as $p) {
            $grouped[$p->tahun][] = $p->bulan;
        }
        return $grouped;
    }
}
