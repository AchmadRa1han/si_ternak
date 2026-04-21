<?php

namespace App\Models;

use CodeIgniter\Model;

class PeternakModel extends Model
{
    protected $table            = 'peternak';
    protected $primaryKey       = 'id_peternak';
    protected $useAutoIncrement = false;
    protected $returnType       = 'object';
    protected $allowedFields    = [
        'id_peternak', 'nama_peternak', 'alamat', 'desa', 'kecamatan', 'no_hp'
    ];

    public function getAll()
    {
        return $this->db->table($this->table)
            ->select('peternak.*, COUNT(hewan.id_hewan) as jumlah_hewan')
            ->join('hewan', 'hewan.id_peternak = peternak.id_peternak AND hewan.status = \'aktif\'', 'left')
            ->groupBy('peternak.id_peternak')
            ->get()->getResult();
    }
}
