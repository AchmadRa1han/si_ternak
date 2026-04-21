<?php

namespace App\Models;

use CodeIgniter\Model;

class KelahiranModel extends Model
{
    protected $table            = 'kelahiran';
    protected $primaryKey       = 'id_laporan';
    protected $returnType       = 'object';
    protected $allowedFields    = [
        'id_hewan', 'tgl_laporan', 'jenis_kelamin', 'bangsa', 'id_petugas', 'keterangan'
    ];

    public function getKelahiran($id = null)
    {
        $builder = $this->db->table($this->table);
        $builder->select('kelahiran.*, dat_ternak.nama_hewan, dat_pemilik.nama_peternak, dat_petugas.nama_petugas');
        $builder->join('dat_ternak', 'dat_ternak.id_ternak = kelahiran.id_hewan', 'left');
        $builder->join('dat_pemilik', 'dat_pemilik.id_pemilik = dat_ternak.id_pemilik', 'left');
        $builder->join('dat_petugas', 'dat_petugas.id_petugas = kelahiran.id_petugas', 'left');
        
        if ($id) {
            $builder->where('kelahiran.id_laporan', $id);
            return $builder->get()->getRow();
        }
        
        $builder->orderBy('kelahiran.tgl_laporan', 'DESC');
        return $builder->get()->getResult();
    }
}
