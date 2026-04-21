<?php

namespace App\Models;

use CodeIgniter\Model;

class DatPemilikModel extends Model
{
    protected $table            = 'dat_pemilik';
    protected $primaryKey       = 'id_pemilik';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $allowedFields    = [
        'id_pemilik', 'nama_peternak', 'alamat', 'desa', 'kecamatan', 'no_hp'
    ];

    public function getAll()
    {
        return $this->db->table($this->table)
            ->select('dat_pemilik.*, COUNT(dat_ternak.id_ternak) as jumlah_hewan')
            ->join('dat_ternak', 'dat_ternak.id_pemilik = dat_pemilik.id_pemilik AND dat_ternak.status = \'aktif\'', 'left')
            ->groupBy('dat_pemilik.id_pemilik')
            ->get()->getResult();
    }
}
