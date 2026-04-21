<?php

namespace App\Models;

use CodeIgniter\Model;

class PkbModel extends Model
{
    protected $table            = 'pemeriksaan_kebuntingan';
    protected $primaryKey       = 'id_pkb';
    protected $returnType       = 'object';
    protected $allowedFields    = [
        'id_hewan', 'tanggal_pkb', 'hasil_pkb', 'metode', 'id_petugas', 'keterangan'
    ];

    public function getPkb($id = null)
    {
        $builder = $this->db->table($this->table);
        $builder->select('pemeriksaan_kebuntingan.*, hewan.nama_hewan, peternak.nama_peternak, petugas_lapangan.nama_petugas');
        $builder->join('hewan', 'hewan.id_hewan = pemeriksaan_kebuntingan.id_hewan', 'left');
        $builder->join('peternak', 'peternak.id_peternak = hewan.id_peternak', 'left');
        $builder->join('petugas_lapangan', 'petugas_lapangan.id_petugas = pemeriksaan_kebuntingan.id_petugas', 'left');
        
        if ($id) {
            $builder->where('pemeriksaan_kebuntingan.id_pkb', $id);
            return $builder->get()->getRow();
        }
        
        $builder->orderBy('pemeriksaan_kebuntingan.tanggal_pkb', 'DESC');
        return $builder->get()->getResult();
    }
}
