<?php

namespace App\Models;

use CodeIgniter\Model;

class HistoriJudulSkripsiModel extends Model
{
    protected $table = 'histori_judul_skripsi';
    protected $primaryKey = 'histori_judul_skripsi_id';

    protected $useTimestamps = true;
    protected $allowedFields = [
    'skripsi_uuid',
    'nama_mahasiswa',
    'nim_mahasiswa',
    'periode_pengajuan',
    'tahun_pengajuan',
    'judul_skripsi',
    'deskripsi_skripsi',
    'konsentrasi_bidang',
    'dosen_pembimbing',
    'dosen_pa',
    'data_dukung',
];
    
    public function simpanHistoriJudulSkripsi($data)
    {
        date_default_timezone_set('ASIA/JAKARTA');
        $data['created_at'] = date('Y-m-d H:i:s');
        $builder = $this->db->table('histori_judul_skripsi');
        $builder->insert($data);
    }

    public function getDetail($nim = null)
    {
        $builder = $this->db->table('histori_judul_skripsi');
        $builder->select('*');
        $builder->where('nim_mahasiswa', $nim);
        $builder->orderBy('created_at', 'DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }

}