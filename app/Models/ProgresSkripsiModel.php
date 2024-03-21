<?php

namespace App\Models;

use CodeIgniter\Model;

class ProgresSkripsiModel extends Model
{
    protected $table = 'progres_skripsi';
    protected $primaryKey = 'nim';
    protected $useTimestamps = true;
    protected $allowedFields = [
    'nim',
    'status'
];

    // akses oleh controller skripsi::semua_skripsi
    public function getAll($departemen = null)
    {   
        $builder = $this->db->table('progres_skripsi');
        $builder->select('progres_skripsi.*, profil.prf_nama_portal as nama, profil.prodi_portal as prodi');
        $builder->join('profil', 'progres_skripsi.nim = profil.prf_nim_portal');
        if($departemen && $departemen != 0){
            $builder->where('profil.departemen_input', $departemen);
        }
        $builder->orderBy('created_at', 'desc');
        $query = $builder->get();
        return $query->getResultArray();
    }
}