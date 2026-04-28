<?php
namespace App\Models;
use CodeIgniter\Model;

class LaporanProduksiPakanModel extends Model {
    protected $table = "laporan_produksi_pakan";
    protected $primaryKey = "id_laporan";
    protected $returnType = "object";
    protected $allowedFields = ["id_kelompok", "bulan", "tahun", "periode_laporan", "status", "created_by"];
    protected $useTimestamps = true;

    public function getAllWithGroup($filters = []) {
        $builder = $this->db->table($this->table);
        $builder->select("laporan_produksi_pakan.*, users.nama_lengkap as nama_petugas, kelompok_produksi_pakan.nama_kelompok, SUM(detail_produksi_pakan.jumlah_produksi) as total_produksi");
        $builder->join("users", "laporan_produksi_pakan.created_by = users.id", "left");
        $builder->join("kelompok_produksi_pakan", "laporan_produksi_pakan.id_kelompok = kelompok_produksi_pakan.id_kelompok", "left");
        $builder->join("detail_produksi_pakan", "laporan_produksi_pakan.id_laporan = detail_produksi_pakan.id_laporan", "left");
        
        if (!empty($filters["bulan"])) $builder->where("laporan_produksi_pakan.bulan", $filters["bulan"]);
        if (!empty($filters["tahun"])) $builder->where("laporan_produksi_pakan.tahun", $filters["tahun"]);
        
        $builder->groupBy("laporan_produksi_pakan.id_laporan");
        $builder->orderBy("laporan_produksi_pakan.tahun DESC, laporan_produksi_pakan.bulan DESC");
        return $builder->get()->getResult();
    }

    public function getProductionReportData($filters = []) {
        $builder = $this->db->table("detail_produksi_pakan");
        $builder->select("kelompok_produksi_pakan.kecamatan, kelompok_produksi_pakan.nama_kelompok, kelompok_produksi_pakan.desa, jenis_pakan.nama_jenis, detail_produksi_pakan.jumlah_produksi");
        $builder->join("laporan_produksi_pakan", "detail_produksi_pakan.id_laporan = laporan_produksi_pakan.id_laporan");
        $builder->join("kelompok_produksi_pakan", "laporan_produksi_pakan.id_kelompok = kelompok_produksi_pakan.id_kelompok");
        $builder->join("jenis_pakan", "detail_produksi_pakan.id_jenis_pakan = jenis_pakan.id_jenis_pakan");
        
        if (!empty($filters['bulan'])) $builder->where('laporan_produksi_pakan.bulan', $filters['bulan']);
        if (!empty($filters['tahun'])) $builder->where('laporan_produksi_pakan.tahun', $filters['tahun']);

        return $builder->get()->getResultArray();
    }

    public function getDistinctPeriods() {
        return $this->db->table($this->table)
            ->select("bulan, tahun")
            ->groupBy("bulan, tahun")
            ->orderBy("tahun DESC, bulan DESC")
            ->get()->getResult();
    }
}
