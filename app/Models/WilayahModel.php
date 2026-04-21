<?php

namespace App\Models;

use CodeIgniter\Model;

class WilayahModel extends Model
{
    public function getAllKecamatan()
    {
        return $this->db->table('kode_kecamatan')
            ->orderBy('kecamatan_nama', 'ASC')
            ->get()->getResult();
    }

    public function getDesaByKecamatan($kecamatan_id)
    {
        return $this->db->table('kode_desa')
            ->where('kecamatan_id', $kecamatan_id)
            ->orderBy('desa_nama', 'ASC')
            ->get()->getResult();
    }
}
