<?php

namespace App\Models;

use CodeIgniter\Model;

class DatTernakModel extends Model
{
    protected $table            = 'hewan';
    protected $primaryKey       = 'id_hewan';
    protected $useAutoIncrement = false;
    protected $returnType       = 'object';
    protected $allowedFields    = [
        'id_hewan', 'id_peternak', 'nama_hewan', 'bangsa_induk', 'jenis_kelamin', 'tanggal_lahir', 'status'
    ];

    public function getAll()
    {
        return $this->db->table($this->table)
            ->select('hewan.*, peternak.nama_peternak')
            ->join('peternak', 'peternak.id_peternak = hewan.id_peternak', 'left')
            ->get()->getResult();
    }
}