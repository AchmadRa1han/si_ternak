<?php

namespace App\Models;

use CodeIgniter\Model;

class DatTernakModel extends Model
{
    protected $table            = 'dat_ternak';
    protected $primaryKey       = 'id_ternak';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $allowedFields    = [
        'id_ternak', 'id_pemilik', 'nama_hewan', 'bangsa_induk', 
        'jenis_kelamin', 'tanggal_lahir', 'status'
    ];

    public function getAll()
    {
        return $this->db->table($this->table)
            ->select('dat_ternak.*, dat_pemilik.nama_peternak')
            ->join('dat_pemilik', 'dat_pemilik.id_pemilik = dat_ternak.id_pemilik', 'left')
            ->get()->getResult();
    }
}
