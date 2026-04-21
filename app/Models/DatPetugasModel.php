<?php

namespace App\Models;

use CodeIgniter\Model;

class DatPetugasModel extends Model
{
    protected $table            = 'dat_petugas';
    protected $primaryKey       = 'id_petugas';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $allowedFields    = [
        'id_petugas', 'username', 'password', 'nama_lengkap', 'nama_petugas', 'email', 
        'nip', 'pangkat', 'jabatan', 'role', 'no_hp', 'is_active', 'last_login'
    ];

    public function getByUsername($username)
    {
        return $this->where('username', $username)->first();
    }

    public function updateLastLogin($id_petugas)
    {
        return $this->update($id_petugas, ['last_login' => date('Y-m-d H:i:s')]);
    }
}
