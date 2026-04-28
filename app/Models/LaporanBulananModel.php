<?php

namespace App\Models;

use CodeIgniter\Model;

class LaporanBulananModel extends Model
{
    protected $table            = 'laporan_bulanan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $allowedFields    = [
        'kelompok_id', 'bulan', 'tahun', 'ternak_awal_jt', 'ternak_awal_bt',
        'populasi_awal_dewasa_jt', 'populasi_awal_dewasa_bt', 
        'populasi_awal_anak_jt', 'populasi_awal_anak_bt', 
        'lahir_jt', 'lahir_bt', 'mati_dewasa_jt', 'mati_dewasa_bt', 
        'mati_anak_jt', 'mati_anak_bt', 'setor_jt', 'setor_bt', 
        'jual_jt', 'jual_bt', 'hilang_jt', 'hilang_bt', 
        'populasi_akhir_dewasa_jt', 'populasi_akhir_dewasa_bt', 
        'populasi_akhir_anak_jt', 'populasi_akhir_anak_bt', 
        'jumlah_kumulatif_jt', 'jumlah_kumulatif_bt', 'jumlah_total', 
        'keterangan', 'status', 'created_by'
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
