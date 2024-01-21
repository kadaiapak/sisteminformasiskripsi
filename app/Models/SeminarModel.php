<?php

namespace App\Models;

use CodeIgniter\Model;

class SeminarModel extends Model
{
    protected $table = 'seminar';
    protected $primaryKey = 'smr_id';

    protected $useTimestamps = true;
    protected $allowedFields = [
    'smr_id',
    'smr_uuid',
    'smr_nim_m',
    'smr_s_uuid',
    'smr_hari',
    'smr_tanggal',
    'smr_sesi',
    'smr_ruangan',
    'smr_status',
    'penguji_satu',
    'penguji_dua',
    'smr_pesan_admin',
    'smr_pesan_kadep',
    'user_verifikator',
    'kadep_verifikator',
    'sedang_diproses',
    'tanggal_diproses_admin',
    'tanggal_diproses_kadep',
    'sudah_terlaksana',
    'nomor_surat',
    'qr_code',
    'smr_is_deleted',
];

    // used by skripsi/index
        // untuk menampilkan data seminar oleh mahasiswa berdasarkan nim mahasiswa tersebut
    // used by seminar/semua_seminar 
        // untuk menampilkan data seminar yang akan diverifikasi oleh admin, ataupun kadep
    public function getAll($nim = null, $level = null, $departemen = null)
    {   
        $builder = $this->db->table('seminar');
        $builder->select('seminar.*, 
            profil.prf_nama_portal as nama_mahasiswa, 
            skripsi.judul_skripsi as judul_skripsi,
            seminar_sesi.jam_alias as seminar_sesi_alias,
            seminar_ruangan.ruangan_alias as seminar_ruangan_alias, 
            fip_dosen_pembimbing.nidn as d_pembimbing_nidn, fip_dosen_pembimbing.peg_gel_dep as d_pembimbing_peg_gel_dep, fip_dosen_pembimbing.peg_nama as d_pembimbing_peg_nama, fip_dosen_pembimbing.peg_gel_bel as d_pembimbing_peg_gel_bel,
        ');
        $builder->join('skripsi', 'seminar.smr_s_uuid = skripsi.skripsi_uuid');
        $builder->join('seminar_sesi', 'seminar.smr_sesi = seminar_sesi.seminar_s_id');
        $builder->join('seminar_ruangan', 'seminar.smr_ruangan = seminar_ruangan.seminar_r_id');
        $builder->join('fip_dosen as fip_dosen_pembimbing', 'fip_dosen_pembimbing.nidn = skripsi.dosen_pembimbing');
        $builder->join('profil', 'seminar.smr_nim_m = profil.prf_nim_portal');
        if($nim){$builder->where('nim_mahasiswa', $nim);}
        if($departemen){$builder->where('profil.departemen_input', $departemen);}
        // jika user level adalah admin departemen maka
        if($level != null & $level == '7'){
            $builder->groupStart();
            $builder->where('smr_status', '1');
            $builder->orWhere('smr_status', '2');
            $builder->orWhere('smr_status', '3');
            $builder->groupEnd();
        }
        // end
        // jika user level adalah kadep
        if($level != null && $level == '4'){
            $builder->groupStart();
            $builder->where('smr_status', '3');
            $builder->orWhere('smr_status', '4');
            $builder->orWhere('smr_status', '5');
            $builder->groupEnd();
        }
        // end
        $builder->orderBy('smr_status','desc');
        $query = $builder->get();
        return $query->getResultArray(); 
    }

    //  FIX
    // digunakan oleh seminar::index
    // untuk mendapatkan semua seminar berdasarkan dosen yang login
    public function getAllSeminarByDosen($nidn = null)
    {
        $build = $this->db->query(
            "SELECT seminar.smr_uuid,seminar.smr_nim_m, seminar.penguji_satu, seminar.penguji_dua, seminar.smr_status,
            seminar.smr_tanggal, seminar.smr_hari, seminar.smr_sesi, seminar.smr_ruangan, seminar.sudah_terlaksana,
            skripsi.judul_skripsi, skripsi.dosen_pembimbing, skripsi.dosen_pa,
            seminar_ruangan.ruangan_alias, seminar_sesi.jam_alias,
            profil.prf_nama_portal, IF(skripsi.dosen_pembimbing = $nidn, 'Pembimbing', 
            IF(seminar.penguji_satu = $nidn, 'Penguji Satu', 
            IF(seminar.penguji_dua = $nidn, 'Penguji Dua', 'Selain Itu'))) AS sebagai
            FROM seminar
            JOIN skripsi ON seminar.smr_s_uuid = skripsi.skripsi_uuid
            JOIN profil ON seminar.smr_nim_m = profil.prf_nim_portal
            JOIN seminar_ruangan ON seminar.smr_ruangan = seminar_ruangan.seminar_r_id
            JOIN seminar_sesi ON seminar.smr_sesi = seminar_sesi.seminar_s_id
            WHERE (seminar.smr_status = 3 OR seminar.smr_status = 5) 
            AND (seminar.penguji_satu = $nidn
            OR seminar.penguji_dua = $nidn
            OR skripsi.dosen_pembimbing = $nidn)
            ORDER BY seminar.smr_tanggal ASC");
        $result = $build->getResultArray();
        return $result;
    }


    // used by Skripsi -> index();
    // untuk cek apakah mahasiswa tersebut bisa mengajukan seminar baru
    public function getStatusSeminar()
    {
        $nim  = session()->get('username');
        $builder = $this->db->table('seminar');
        $builder->select('smr_status');
        $builder->where('smr_nim_m', $nim);
        $builder->orderBy('created_at','DESC');
        $builder->limit(1);
        $query = $builder->get();
        return $query->getRowArray();
    }

    // used by seminar::detail
    // used by seminar::verifikasi
    public function getDetail($UUIDSeminar = null)
    {   
        $builder = $this->db->table('seminar');
        $builder->select('seminar.*,
            profil.prf_nama_portal as nama_mahasiswa, 
            skripsi.judul_skripsi as judul_skripsi, 
            seminar_sesi.jam_alias as seminar_sesi_alias,
            seminar_ruangan.ruangan_alias as seminar_ruangan_alias,
            seminar.penguji_satu, seminar.penguji_dua,
            fip_dosen_pembimbing.nidn as d_pembimbing_nidn, fip_dosen_pembimbing.peg_gel_dep as d_pembimbing_peg_gel_dep, fip_dosen_pembimbing.peg_nama as d_pembimbing_peg_nama, fip_dosen_pembimbing.peg_gel_bel as d_pembimbing_peg_gel_bel,
            fip_dosen_pa.nidn as d_pa_nidn, fip_dosen_pa.peg_gel_dep as d_pa_peg_gel_dep, fip_dosen_pa.peg_nama as d_pa_peg_nama, fip_dosen_pa.peg_gel_bel as d_pa_peg_gel_bel,
            fip_penguji_satu.nidn as d_penguji_satu_nidn, fip_penguji_satu.peg_gel_dep as d_penguji_satu_peg_gel_dep, fip_penguji_satu.peg_nama as d_penguji_satu_peg_nama, fip_penguji_satu.peg_gel_bel as d_penguji_satu_peg_gel_bel,
            fip_penguji_dua.nidn as d_penguji_dua_nidn, fip_penguji_dua.peg_gel_dep as d_penguji_dua_peg_gel_dep, fip_penguji_dua.peg_nama as d_penguji_dua_peg_nama, fip_penguji_dua.peg_gel_bel as d_penguji_dua_peg_gel_bel,
        ');
        $builder->join('profil', 'seminar.smr_nim_m = profil.prf_nim_portal');
        $builder->join('skripsi', 'seminar.smr_s_uuid = skripsi.skripsi_uuid');
        $builder->join('seminar_sesi', 'seminar.smr_sesi = seminar_sesi.seminar_s_id');
        $builder->join('seminar_ruangan', 'seminar.smr_ruangan = seminar_ruangan.seminar_r_id');
        $builder->join('fip_dosen as fip_dosen_pembimbing', 'fip_dosen_pembimbing.nidn = skripsi.dosen_pembimbing', 'left');
        $builder->join('fip_dosen as fip_dosen_pa', 'fip_dosen_pa.nidn = skripsi.dosen_pa', 'left');
        $builder->join('fip_dosen as fip_penguji_satu', 'fip_penguji_satu.nidn = seminar.penguji_satu','left');
        $builder->join('fip_dosen as fip_penguji_dua', 'fip_penguji_dua.nidn = seminar.penguji_dua','left');
        if($UUIDSeminar) {
            $builder->where('smr_uuid', $UUIDSeminar);
        }
        $query = $builder->get();
        return $query->getRow(); 
    }

     // used by seminar::print_surat
    public function getDetailSurat($UUIDSeminar = null)
    {   
        $builder = $this->db->table('seminar');
        $builder->select('seminar.smr_uuid, seminar.smr_nim_m, seminar.smr_hari, seminar.smr_tanggal, seminar.nomor_surat, seminar.qr_code as qr_code,
            profil.prf_nama_portal as nama_mahasiswa, profil.departemen_input,
            skripsi.judul_skripsi as judul_skripsi, 
            seminar_sesi.jam_alias as seminar_sesi_alias,
            seminar_ruangan.ruangan_alias as seminar_ruangan_alias,
            seminar.penguji_satu, seminar.penguji_dua,
            seminar.tanggal_diproses_kadep as tanggal_diproses_kadep,
            fip_dosen_pembimbing.nidn as d_pembimbing_nidn, fip_dosen_pembimbing.peg_gel_dep as d_pembimbing_peg_gel_dep, fip_dosen_pembimbing.peg_nama as d_pembimbing_peg_nama, fip_dosen_pembimbing.peg_gel_bel as d_pembimbing_peg_gel_bel,
            fip_penguji_satu.nidn as d_penguji_satu_nidn, fip_penguji_satu.peg_nip as d_penguji_satu_nip ,fip_penguji_satu.peg_gel_dep as d_penguji_satu_peg_gel_dep, fip_penguji_satu.peg_nama as d_penguji_satu_peg_nama, fip_penguji_satu.peg_gel_bel as d_penguji_satu_peg_gel_bel,
            fip_penguji_dua.nidn as d_penguji_dua_nidn, fip_penguji_dua.peg_nip as d_penguji_dua_nip, fip_penguji_dua.peg_gel_dep as d_penguji_dua_peg_gel_dep, fip_penguji_dua.peg_nama as d_penguji_dua_peg_nama, fip_penguji_dua.peg_gel_bel as d_penguji_dua_peg_gel_bel,
            departemen.departemen_nama as nama_departemen, departemen.departemen_email as email_departemen, departemen.departemen_website as website_departemen, departemen.departemen_kd_surat as kode_surat_departemen, departemen.departemen_nm_kadep as nama_kadep_departemen, departemen.departemen_nip_kadep as nip_kadep_departemen
        ');
        $builder->join('profil', 'seminar.smr_nim_m = profil.prf_nim_portal');
        $builder->join('skripsi', 'seminar.smr_s_uuid = skripsi.skripsi_uuid');
        $builder->join('seminar_sesi', 'seminar.smr_sesi = seminar_sesi.seminar_s_id');
        $builder->join('seminar_ruangan', 'seminar.smr_ruangan = seminar_ruangan.seminar_r_id');
        $builder->join('fip_dosen as fip_dosen_pembimbing', 'fip_dosen_pembimbing.nidn = skripsi.dosen_pembimbing', 'left');
        $builder->join('fip_dosen as fip_penguji_satu', 'fip_penguji_satu.nidn = seminar.penguji_satu','left');
        $builder->join('fip_dosen as fip_penguji_dua', 'fip_penguji_dua.nidn = seminar.penguji_dua','left');
        $builder->join('departemen','profil.departemen_input = departemen.departemen_id');
        $builder->where('smr_uuid', $UUIDSeminar);
        $builder->groupStart();
        $builder->where('smr_status', '5');
        $builder->orWhere('smr_status', '6');
        $builder->groupEnd();
        $query = $builder->get();
        return $query->getRowArray(); 
    }

    public function simpanSeminar($data = null, $nama = null)
    {
        $builder = $this->db->table('seminar');
        $builder->set('smr_uuid','UUID()', FALSE);
        $builder->insert($data);

        $insert_id = $this->db->insertID();
        $builderdua = $this->db->table('file_syarat_seminar_mahasiswa');
        $file_upload = array();
        foreach ($nama as $nm) {
            $file_uploaddua = array(
                'smr_id' => $insert_id,
                'persyaratan_id' => $nm['persyaratan_id'],
                'judul' => $nm['judul'],
                'judul_alias' => $nm['judul_alias'],
                'nama_file' => $nm['nama_file']
            );
            array_push($file_upload, $file_uploaddua);
        }
        if(count($file_upload) != 0){
            $builderdua->insertBatch($file_upload);
        }
        $this->db->table('skripsi')
        ->set('status_keseluruhan', 5)
        ->where('skripsi_uuid', $data['smr_s_uuid'])
        ->update();
    }

    public function verifikasiSeminar($UUIDSeminar = null, $data = null)
    {
        date_default_timezone_set('ASIA/JAKARTA');
        $tanggal_diproses_admin = date('Y-m-d H:i:s');
        $builder = $this->db->table('seminar');
        $builder->select('smr_nim_m');
        $builder->where('smr_uuid', $UUIDSeminar);
        $query = $builder->get();
        $nim = $query->getRowArray();

        $builderdua = $this->db->table('seminar');
        $builderdua->select('smr_id');
        $builderdua->where('smr_status', '3');
        $builderdua->where('smr_uuid !=', $UUIDSeminar);
        $querydua = $builderdua->get();
        $hasil = $querydua->getResultArray();
        if(count($hasil) > 0){
            return false;
        }
    
        $buildertiga = $this->db->table('seminar');
        $buildertiga->set('smr_status', '2');
        $buildertiga->set('smr_pesan_admin', 'Sudah ada seminar saudara yang di acc');
        $buildertiga->set('user_verifikator', session()->get('user_id'));
        $buildertiga->set('tanggal_diproses_admin', $tanggal_diproses_admin);
        $buildertiga->set('sedang_diproses', 0);
        $buildertiga->where('smr_nim_m', $nim);
        $buildertiga->where('smr_uuid !=', $UUIDSeminar);
        $buildertiga->where('smr_status !=', 4);
        $buildertiga->update();
        
        $builderempat = $this->db->table('seminar');
        $builderempat->where('smr_uuid', $UUIDSeminar);
        $builderempat->update($data);

        return true;
    }
    
}