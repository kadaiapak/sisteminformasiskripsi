<?php

namespace App\Models;

use CodeIgniter\Model;

class FilePersyaratanUjianModel extends Model
{
    protected $table = 'file_syarat_ujian_mahasiswa';
    protected $primaryKey = 'fsum_id';
    protected $allowedFields = [
    'us_id',
    'judul',
    'nama_file',
    ];

    public function getDetailPersyaratan($idSeminar=null)
    {
        $builder = $this->db->table('file_syarat_ujian_mahasiswa');
        $builder->select('*');
        $builder->where('us_id', $idSeminar);
        $result = $builder->get();
        return $result->getResultArray();
    }
}