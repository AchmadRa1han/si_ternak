<?php
namespace App\Models;
use CodeIgniter\Model;

class KelompokTernakModel extends Model {
    protected $table = "kelompok_ternak";
    protected $primaryKey = "id";
    protected $useAutoIncrement = true;
    protected $returnType = "object";
    protected $allowedFields = [
        "kode_kelompok", "nama_kelompok", "desa_id", "kecamatan_id", 
        "alamat_lengkap", "tahun_anggaran", "sumber_dana", "ras_ternak", "created_by"
    ];

    public function getAll()
    {
        return $this->db->table($this->table)
            ->select('kelompok_ternak.*, ref_kecamatan.KECAMATAN_NAMA as kecamatan_nama, ref_desa.DESA_NAMA as desa_nama')
            ->join('ref_kecamatan', 'kelompok_ternak.kecamatan_id = ref_kecamatan.KECAMATAN_ID', 'left')
            ->join('ref_desa', 'kelompok_ternak.desa_id = ref_desa.DESA_ID', 'left')
            ->get()->getResult();
    }
}
