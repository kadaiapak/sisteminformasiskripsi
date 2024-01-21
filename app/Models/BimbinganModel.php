<?php

namespace App\Models;

use CodeIgniter\Model;

class BimbinganModel extends Model
{
    protected $table = 'bimbingan';
    protected $primaryKey = 'bimbingan_id';

    protected $useTimestamps = true;
    protected $allowedFields = [
    'bimbingan_id',
    'bb_nim',
    'bb_waktu',
    'bb_skripsi_uuid',
    'bb_subjek',
    'bb_isi',
    'bb_data_dukung',
    'is_verifikasi',
    'is_deleted',
    'deleted_at'
];

    public function getAll($nim = null)
    {   
        $builder = $this->db->table('bimbingan');
        $builder->select('bimbingan.*,skripsi.*');
        $builder->join('skripsi', 'bimbingan.bb_skripsi_uuid = skripsi.skripsi_uuid');
        if($nim) {
            $builder->where('nim_mahasiswa', $nim);
        }
        $query = $builder->get();
        return $query->getResultArray(); 
    }

    public function getAllBimbinganPerMahasiswa($UUIDSkripsi)
    {   
        $builder = $this->db->table('bimbingan');
        $builder->select('bimbingan.*,skripsi.*');
        $builder->join('skripsi', 'bimbingan.bb_skripsi_uuid = skripsi.skripsi_uuid');
        $builder->where('bimbingan.bb_skripsi_uuid', $UUIDSkripsi);
        $query = $builder->get();
        return $query->getResultArray(); 
    }

    // digunakan untuk menampilkan bimbingan oleh masing masing dosen pembimbing
    // digunakan oleh Bimbingan::index
    public function getAllBimbinganByDosen($nidn = null)
    {
        $build = $this->db->query(
            "SELECT bimbingan.bb_nim, skripsi.skripsi_uuid, skripsi.status_pengajuan_skripsi, COUNT(bb_nim) as total_bimbingan, profil.prf_nama_portal, profil.prodi_portal,
            COUNT(IF(is_verifikasi = 0, 1, NULL)) as belum_verifikasi, 
            COUNT(IF(is_verifikasi = 1, 1, NULL)) as sudah_verifikasi
            FROM bimbingan
            JOIN skripsi ON bimbingan.bb_skripsi_uuid = skripsi.skripsi_uuid
            JOIN profil ON bimbingan.bb_nim = profil.prf_nim_portal
            WHERE skripsi.dosen_pembimbing = $nidn
            GROUP BY bimbingan.bb_nim, skripsi.skripsi_uuid, bimbingan.bb_skripsi_uuid");
        $result = $build->getResultArray();
        return $result;
    }

    // used by bimbingan/tambahBimbingan($data)
    public function tambahBimbingan($data)
    {
        $builder = $this->db->table('bimbingan');
        return $builder->insert($data);
    }

     // used by Skripsi -> index();
     public function cekBisaBimbingan()
     {
         $nim  = session()->get('username');
         $builder = $this->db->table('skripsi');
         $builder->where('nim_mahasiswa', $nim);
         $builder->groupStart();
         $builder->where('status_pengajuan_skripsi', '3');
         $builder->orWhere('status_pengajuan_skripsi', '4');
         $builder->orWhere('status_pengajuan_skripsi', '5');
         $builder->groupEnd();
         $query = $builder->get();
         return $query->getNumRows();
     }
}