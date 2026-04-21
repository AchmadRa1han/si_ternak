<?php

namespace App\Models;

use CodeIgniter\Model;

class PetugasModel extends Model
{
    protected $table            = 'petugas_lapangan';
    protected $primaryKey       = 'id_petugas';
    protected $useAutoIncrement = false;
    protected $returnType       = 'object';
    protected $allowedFields    = [
        'id_petugas', 'nama_petugas', 'nip', 'pangkat', 'jabatan', 'no_hp', 'is_active'
    ];
}
