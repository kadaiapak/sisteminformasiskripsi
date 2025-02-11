<?php

namespace App\Models;

use CodeIgniter\Model;

class DepartemenModel extends Model
{
    protected $table = 'departemen';
    protected $primaryKey = 'departemen_id';
    protected $allowedFields = [
    'departemen_kd',
    'departemen_nama',
    'departemen_alias',
    'departemen_email',
    'departemen_website',
    'departemen_nm_kadep',
    'departemen_kd_surat',
    'departemen_nip_kadep',
    'judul_kop_surat',
    'jabatan_penanda_tangan',
    'nama_penanda_tangan',
    'nip_penanda_tangan',
    'dosen_yang_bisa_dipilih',
    'departemen_status',
    ];

    public function getAllOnly() 
    {
        $builder = $this->db->table('departemen');
        $builder->select('departemen_id, departemen_nama');
        $builder->where('departemen_status', 1);
        $builder->orderBy('departemen_id', 'asc');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getDetail($id = null)
{
    $builder = $this->db->table('departemen');
    $builder->select("departemen.*, 
        CASE 
            WHEN departemen.dosen_yang_bisa_dipilih = '@' THEN 'Semua Departemen'
            WHEN departemen.dosen_yang_bisa_dipilih IS NULL THEN NULL
            ELSE departemen_dua.departemen_nama 
        END AS departemen_dua_nama", false);
    $builder->join('departemen departemen_dua', 'departemen.dosen_yang_bisa_dipilih = departemen_dua.departemen_id', 'left');
    $builder->where('departemen.departemen_id', $id);
    $query = $builder->get();
    return $query->getRowArray();
}
}