<?php
namespace App\Models;
use CodeIgniter\Model;

class KelahiranModel extends Model {
    protected $table = "kelahiran";
    protected $primaryKey = "id_laporan";
    protected $returnType = "object";
    protected $allowedFields = [
        "tgl_laporan", "tgl_kelahiran", "id_hewan", "id_petugas", "kecamatan", "desa", 
        "jenis_kelamin", "metode_kawin", "kode_straw", "id_pembuatan", "bangsa_pejantan", 
        "produsen_pejantan", "status_kelahiran", "created_by"
    ];

    public function getKelahiran($id = null) {
        $builder = $this->db->table($this->table);
        $builder->select("kelahiran.*, hewan.jenis_kelamin as JENIS_KELAMIN_INDUK, peternak.nama_peternak, petugas_lapangan.nama_petugas");
        $builder->join("hewan", "hewan.id_hewan = kelahiran.id_hewan", "left");
        $builder->join("peternak", "peternak.id_peternak = hewan.id_peternak", "left");
        $builder->join("petugas_lapangan", "petugas_lapangan.id_petugas = kelahiran.id_petugas", "left");
        if ($id) return $builder->where("kelahiran.id_laporan", $id)->get()->getRow();
        return $builder->orderBy("kelahiran.tgl_laporan", "DESC")->get()->getResult();
    }
}
