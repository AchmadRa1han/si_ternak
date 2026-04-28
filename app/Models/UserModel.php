<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $allowedFields    = [
        'username', 'password', 'nama_lengkap', 'email', 'nip', 'jabatan', 'role', 'is_active', 'last_login'
    ];
    protected $useTimestamps = true;

    public function login($username, $password)
    {
        return $this->where('username', $username)
                    ->where('password', $password) // Note: In production use password_verify
                    ->first();
    }
}
