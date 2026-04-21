<?php

namespace App\Models;

use CodeIgniter\Model;

class InseminasiModel extends Model
{
    protected $table            = 'inseminasi';
    protected $primaryKey       = 'id_ib';
    protected $returnType       = 'object';
    protected $allowedFields    = [
        'id_ib', 'id_hewan', 'tanggal_ib', 'id_petugas', 
        'ib_ke', 'id_pejantan', 'bangsa_pejantan', 'status', 'created_by'
    ];

    public function getInseminasi($id = null)
    {
        $builder = $this->db->table($this->table);
        $builder->select('inseminasi.*, hewan.nama_hewan, peternak.nama_peternak, petugas_lapangan.nama_petugas');
        $builder->join('hewan', 'hewan.id_hewan = inseminasi.id_hewan', 'left');
        $builder->join('peternak', 'peternak.id_peternak = hewan.id_peternak', 'left');
        $builder->join('petugas_lapangan', 'petugas_lapangan.id_petugas = inseminasi.id_petugas', 'left');
        
        if ($id) {
            $builder->where('inseminasi.id_ib', $id);
            return $builder->get()->getRow();
        }
        
        $builder->orderBy('inseminasi.tanggal_ib', 'DESC');
        return $builder->get()->getResult();
    }
}
