<?php

namespace App\Models;

use CodeIgniter\Model;

class LaporanBulananModel extends Model
{
    protected $table            = 'laporan_bulanan';
    protected $primaryKey       = 'id';
    protected $returnType       = 'object';
    protected $allowedFields    = [
        'kelompok_id', 'bulan', 'tahun', 
        'populasi_awal_dewasa_jt', 'populasi_awal_dewasa_bt', 
        'populasi_awal_anak_jt', 'populasi_awal_anak_bt', 
        'lahir_jt', 'lahir_bt', 'mati_dewasa_jt', 'mati_dewasa_bt', 
        'mati_anak_jt', 'mati_anak_bt', 'jual_jt', 'jual_bt', 'keterangan'
    ];

    public function getAllWithKelompok($tahun = null, $bulan = null)
    {
        $builder = $this->db->table($this->table);
        $builder->select('laporan_bulanan.*, kelompok_ternak.nama_kelompok, kelompok_ternak.kode_kelompok');
        $builder->join('kelompok_ternak', 'laporan_bulanan.kelompok_id = kelompok_ternak.id');
        
        if ($tahun && $bulan) {
            $builder->where('laporan_bulanan.tahun', $tahun);
            $builder->where('laporan_bulanan.bulan', $bulan);
        }

        $builder->orderBy('laporan_bulanan.tahun DESC, laporan_bulanan.bulan DESC');
        return $builder->get()->getResult();
    }

    public function getDistinctPeriods()
    {
        return $this->db->table($this->table)
            ->select('tahun, bulan')
            ->distinct()
            ->orderBy('tahun DESC, bulan DESC')
            ->get()->getResult();
    }
}
