<?php

namespace App\Models;

use CodeIgniter\Model;

class DashboardModel extends Model
{
    /**
     * Menghitung total petugas
     */
    public function countPetugas()
    {
        return $this->db->table('petugas_lapangan')->countAll();
    }

    /**
     * Menghitung total pemilik
     */
    public function countPemilik()
    {
        return $this->db->table('peternak')->countAll();
    }

    /**
     * Menghitung total ternak
     */
    public function countTernak()
    {
        return $this->db->table('hewan')->countAll();
    }

    /**
     * Menghitung total vaksinasi
     */
    public function countVaksinasi()
    {
        return $this->db->table('laporan_vaksinasi_ternak')->countAll();
    }
}
