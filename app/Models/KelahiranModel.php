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
        $builder->select('kelahiran.*, hewan.nama_hewan, peternak.nama_peternak, petugas_lapangan.nama_petugas');
        $builder->join('hewan', 'hewan.id_hewan = kelahiran.id_hewan', 'left');
        $builder->join('peternak', 'peternak.id_peternak = hewan.id_peternak', 'left');
        $builder->join('petugas_lapangan', 'petugas_lapangan.id_petugas = kelahiran.id_petugas', 'left');
        
        if ($id) {
            $builder->where('kelahiran.id_laporan', $id);
            return $builder->get()->getRow();
        }
        
        $builder->orderBy('kelahiran.tgl_laporan', 'DESC');
        return $builder->get()->getResult();
    }
}
