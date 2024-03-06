<?php

namespace App\Models;

use CodeIgniter\Model;

class MengikutiSeminarModel extends Model
{
    protected $table = 'mengikuti_seminar';
    protected $primaryKey = 'mengikuti_seminar_id';

    protected $useTimestamps = true;
    protected $allowedFields = [
    'mengikuti_seminar_id',
    'uuid',
    'nim_pengikut',
    'nim_diikuti',
    'nama_diikuti',
    'dosen_pembimbing_diikuti',
    'judul_skripsi_diikuti',
    'hari_mengikuti',
    'tanggal_mengikuti',
    'ruangan',
    'status',
    'foto_selfi',
];

    // used by skripsi/index
    // untuk menampilkan data seminar yang diikuti oleh mahasiswa berdasarkan nim mahasiswa tersebut
    public function getAll($nim = null)
    {   
        $builder = $this->db->table('mengikuti_seminar');
        $builder->select('mengikuti_seminar.*, 
            seminar_ruangan.ruangan_alias as seminar_ruangan_alias, hari.hari_nama as hari
        ');
        $builder->join('seminar_ruangan', 'mengikuti_seminar.ruangan = seminar_ruangan.seminar_r_id');
        $builder->join('hari', 'mengikuti_seminar.hari_mengikuti = hari.hari_id');
        if($nim){$builder->where('nim_pengikut', $nim);}
        $builder->orderBy('mengikuti_seminar_id','asc');
        $query = $builder->get();
        return $query->getResultArray(); 
    }

    public function simpanMengikutiSeminar($data = null)
    {
        $builder = $this->db->table('mengikuti_seminar');
        $builder->set('uuid','UUID()', FALSE);
        $builder->insert($data);
    }
}