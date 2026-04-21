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
        $builder->select('inseminasi.*, dat_ternak.nama_hewan, dat_pemilik.nama_peternak, dat_petugas.nama_petugas');
        $builder->join('dat_ternak', 'dat_ternak.id_ternak = inseminasi.id_hewan', 'left');
        $builder->join('dat_pemilik', 'dat_pemilik.id_pemilik = dat_ternak.id_pemilik', 'left');
        $builder->join('dat_petugas', 'dat_petugas.id_petugas = inseminasi.id_petugas', 'left');
        
        if ($id) {
            $builder->where('inseminasi.id_ib', $id);
            return $builder->get()->getRow();
        }
        
        $builder->orderBy('inseminasi.tanggal_ib', 'DESC');
        return $builder->get()->getResult();
    }
}
