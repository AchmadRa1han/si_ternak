<?php

namespace App\Models;

use CodeIgniter\Model;

class KelompokProduksiPakanModel extends Model
{
    protected $table            = 'kelompok_produksi_pakan';
    protected $primaryKey       = 'id_kelompok';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $allowedFields    = ['nama_kelompok', 'kecamatan', 'desa', 'alamat_lengkap', 'created_by'];
}
