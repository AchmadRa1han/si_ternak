<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisPakanModel extends Model
{
    protected $table            = 'jenis_pakan';
    protected $primaryKey       = 'id_jenis_pakan';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $allowedFields    = ['nama_jenis', 'kategori', 'satuan'];
}
