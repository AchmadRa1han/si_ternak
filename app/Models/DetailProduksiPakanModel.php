<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailProduksiPakanModel extends Model
{
    protected $table            = 'detail_produksi_pakan';
    protected $primaryKey       = 'id_detail';
    protected $returnType       = 'object';
    protected $allowedFields    = ['id_laporan', 'id_jenis_pakan', 'jumlah_produksi'];

    public function getByLaporan($id_laporan)
    {
        return $this->db->table($this->table)
            ->select('detail_produksi_pakan.*, jenis_pakan.nama_jenis')
            ->join('jenis_pakan', 'detail_produksi_pakan.id_jenis_pakan = jenis_pakan.id_jenis_pakan')
            ->where('id_laporan', $id_laporan)
            ->get()->getResult();
    }
}
