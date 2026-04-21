<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisPakanModel extends Model
{
    protected $table            = 'jenis_pakan';
    protected $primaryKey       = 'id_jenis_pakan';
    protected $useAutoIncrement = false; // Karena ID diatur manual di form
    protected $returnType       = 'object';
    protected $allowedFields    = ['id_jenis_pakan', 'nama_jenis', 'kategori', 'satuan'];
}
