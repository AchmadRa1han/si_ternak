<?php

namespace App\Models;

use CodeIgniter\Model;

class DashboardModel extends Model
{
    /**
     * Menghitung total kelompok ternak
     */
    public function countKelompok()
    {
        return $this->db->table('kelompok_ternak')->countAll();
    }

    /**
     * Menghitung laporan perkembangan bulan ini
     */
    public function countLaporanPerkembangan()
    {
        return $this->db->table('laporan_bulanan')
            ->where('bulan', date('m'))
            ->where('tahun', date('Y'))
            ->countAllResults();
    }

    /**
     * Menghitung inseminasi buatan bulan ini
     */
    public function countIbBulanIni()
    {
        // CI4 menggunakan query builder yang lebih intuitif
        return $this->db->table('inseminasi')
            ->where('MONTH(tanggal_ib)', date('m'))
            ->where('YEAR(tanggal_ib)', date('Y'))
            ->countAllResults();
    }

    /**
     * Menghitung laporan pakan bulan ini
     */
    public function countLaporanPakan()
    {
        return $this->db->table('laporan_produksi_pakan')
            ->where('bulan', date('m'))
            ->where('tahun', date('Y'))
            ->countAllResults();
    }

    /**
     * Menghitung total hewan aktif
     */
    public function countHewan()
    {
        return $this->db->table('hewan')
            ->where('status', 'aktif')
            ->countAllResults();
    }

    /**
     * Mengambil data untuk grafik produksi pakan 6 bulan terakhir
     */
    public function getPakanChartData()
    {
        $builder = $this->db->table('laporan_produksi_pakan');
        $builder->select('
            laporan_produksi_pakan.tahun, 
            laporan_produksi_pakan.bulan, 
            SUM(detail_produksi_pakan.jumlah_produksi) as total_produksi
        ');
        $builder->join('detail_produksi_pakan', 'laporan_produksi_pakan.id_laporan = detail_produksi_pakan.id_laporan');
        $builder->groupBy('tahun, bulan');
        $builder->orderBy('tahun DESC, bulan DESC');
        $builder->limit(6);
        
        $results = $builder->get()->getResultArray();
        return array_reverse($results);
    }
}
