<?php
namespace App\Models;
use CodeIgniter\Model;

class PkbModel extends Model {
    protected $table = "pemeriksaan_kebuntingan";
    protected $primaryKey = "id_pkb";
    protected $returnType = "object";
    protected $allowedFields = [
        "id_hewan", "id_petugas", "tanggal_ib", "tanggal_pkb", "kecamatan", "desa", 
        "hasil_kebuntingan", "metode", "umur_kebuntingan", "created_by"
    ];

    public function getPkb($id = null) {
        $builder = $this->db->table($this->table);
        $builder->select("pemeriksaan_kebuntingan.*, hewan.jenis_kelamin, peternak.nama_peternak, petugas_lapangan.nama_petugas");
        $builder->join("hewan", "hewan.id_hewan = pemeriksaan_kebuntingan.id_hewan", "left");
        $builder->join("peternak", "peternak.id_peternak = hewan.id_peternak", "left");
        $builder->join("petugas_lapangan", "petugas_lapangan.id_petugas = pemeriksaan_kebuntingan.id_petugas", "left");
        if ($id) return $builder->where("pemeriksaan_kebuntingan.id_pkb", $id)->get()->getRow();
        return $builder->orderBy("pemeriksaan_kebuntingan.tanggal_pkb", "DESC")->get()->getResult();
    }
}
