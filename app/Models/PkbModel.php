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
        $builder->select('pemeriksaan_kebuntingan.*, dat_ternak.nama_hewan, dat_pemilik.nama_peternak, dat_petugas.nama_petugas');
        $builder->join('dat_ternak', 'dat_ternak.id_ternak = pemeriksaan_kebuntingan.id_hewan', 'left');
        $builder->join('dat_pemilik', 'dat_pemilik.id_pemilik = dat_ternak.id_pemilik', 'left');
        $builder->join('dat_petugas', 'dat_petugas.id_petugas = pemeriksaan_kebuntingan.id_petugas', 'left');
        
        if ($id) {
            $builder->where('pemeriksaan_kebuntingan.id_pkb', $id);
            return $builder->get()->getRow();
        }
        
        $builder->orderBy('pemeriksaan_kebuntingan.tanggal_pkb', 'DESC');
        return $builder->get()->getResult();
    }
}
