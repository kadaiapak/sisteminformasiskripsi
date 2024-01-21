<?php

namespace App\Models;

use CodeIgniter\Model;

class FilePersyaratanSeminarModel extends Model
{
    protected $table = 'file_syarat_seminar_mahasiswa';
    protected $primaryKey = 'fssm_id';
    protected $allowedFields = [
    'smr_id',
    'judul',
    'nama_file',
    ];

    public function getDetailPersyaratan($idSeminar=null)
    {
        $builder = $this->db->table('file_syarat_seminar_mahasiswa');
        $builder->select('*');
        $builder->where('smr_id', $idSeminar);
        $result = $builder->get();
        return $result->getResultArray();
    }
}