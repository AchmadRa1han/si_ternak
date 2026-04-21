<?php

namespace App\Models;

use CodeIgniter\Model;

class KelompokTernakModel extends Model
{
    protected $table            = 'kelompok_ternak';
    protected $primaryKey       = 'id';
    protected $returnType       = 'object';
    protected $allowedFields    = [
        'kode_kelompok', 'nama_kelompok', 'desa_id', 'kecamatan_id', 
        'alamat_lengkap', 'tahun_anggaran', 'sumber_dana', 'rasternak'
    ];

    public function getAll()
    {
        return $this->db->table($this->table)
            ->select('kelompok_ternak.*, kode_kecamatan.kecamatan_nama, kode_desa.desa_nama')
            ->join('kode_kecamatan', 'kelompok_ternak.kecamatan_id = kode_kecamatan.kecamatan_id', 'left')
            ->join('kode_desa', 'kelompok_ternak.desa_id = kode_desa.desa_id', 'left')
            ->orderBy('kelompok_ternak.id', 'DESC')
            ->get()->getResult();
    }
}
