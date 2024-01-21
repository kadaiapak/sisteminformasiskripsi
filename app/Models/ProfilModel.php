<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfilModel extends Model
{
    protected $table = 'profil';
    protected $primaryKey = 'prf_nim_portal';
    protected $useTimestamps = true;
    protected $allowedFields = [
    'prf_uuid',
    'prf_nim_portal',
    'thn_msk_portal',
    'prf_nama_portal',
    'tmp_lahir_portal',
    'tgl_lahir_portal',
    'jk_portal',
    'agama_portal',
    'nohp_portal',
    'nohp_baru',
    'nowa',
    'email',
    'idpdpt',
    'departemen_input',
    'idprodi_portal',
    'prodi_input',
    'prodi_portal',
    'nama_jurusan_portal',
    'kd_jurusan_portal',
    'id_fakultas_portal',
    'nama_fakultas_portal',
    'jjp_portal',
    'alamat_lengkap',
    'sudah_edit',
    ];

    // digunakan oleh controller Mahasiswa::index()
    // untuk menampilkan semua profil mahasiswa
    public function getAll()
    {
        $builder = $this->db->table('profil');
        $builder->select('*');
        $query = $builder->get();
        return $query->getResultArray();
    }

    // digunakan sewaktu pertama kali login di aplikasi ini, untuk cek apakah mahasiswa tersebut sudah memperbaharui data profil
    // digunakan oleh Auth::loginProcess
    public function cekIsVerified($nim = '')
    {
        $builder = $this->db->table('profil');
        $builder->select('profil.sudah_edit');
        $builder->where('prf_nim_portal', $nim);
        $query = $builder->get();
        return $query->getRowArray(); 
    }

    public function updateVerifikasiProfil($data, $username)
    {
        $builder = $this->db->table('profil');
        $builder->set('prf_uuid','UUID()', FALSE);
        $builder->where('', FALSE);
        $builder->insert($data);
    }

    public function getDetail($nim = '')
    {
        $builder = $this->db->table('profil');
        $builder->select('*');
        $builder->where('prf_nim_portal', $nim);
        $query = $builder->get();
        return $query->getRowArray(); 
    }

    public function getDepartemen($nim = null)
    {
        $builder = $this->db->table('profil');
        $builder->select('departemen_input');
        if($nim != null) {
            $builder->where('prf_nim_portal', $nim);
        }
        $query = $builder->get();
        return $query->getRowArray();
    }
}