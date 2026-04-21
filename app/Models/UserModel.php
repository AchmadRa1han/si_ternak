<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object'; // Menggunakan object agar kompatibel dengan data lama
    protected $allowedFields    = [
        'username', 'password', 'nama_lengkap', 'email', 
        'nip', 'jabatan', 'role', 'is_active', 'last_login'
    ];

    public function getByUsername($username)
    {
        return $this->where('username', $username)->first();
    }

    public function updateLastLogin($id)
    {
        return $this->update($id, ['last_login' => date('Y-m-d H:i:s')]);
    }
}
