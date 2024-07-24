<?php

namespace App\Models;

use CodeIgniter\Model;

class FilePersyaratanSuratIzinPenelitianModel extends Model
{
    protected $table = 'file_syarat_surat_izin_penelitian';
    protected $primaryKey = 'fssip_id';
    protected $allowedFields = [
    'fssip_id',
    'sip_id',
    'persyaratan_id',
    'judul',
    'judul_alias',
    'nama_file',
    ];

    public function getDetailPersyaratan($idSuratIzinPenelitian=null)
    {
        $builder = $this->db->table('file_syarat_surat_izin_penelitian');
        $builder->select('*');
        $builder->where('sip_id', $idSuratIzinPenelitian);
        $result = $builder->get();
        return $result->getResultArray();
    }
}