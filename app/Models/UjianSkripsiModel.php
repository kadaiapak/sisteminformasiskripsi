<?php

namespace App\Models;

use CodeIgniter\Model;

class UjianSkripsiModel extends Model
{
    protected $table = 'ujian_skripsi';
    protected $primaryKey = 'us_id';

    protected $useTimestamps = true;
    protected $allowedFields = [
    'us_id',
    'us_uuid', 
    'us_nim_m',
    'us_s_uuid',
    'us_hari',
    'us_tanggal',
    'us_sesi',
    'us_ruangan',
    'us_status',
    'us_pesan_admin',
    'us_pesan_kadep',
    'user_verifikator',
    'kadep_verifikator',
    'sedang_diproses',
    'tanggal_diproses_admin',
    'tanggal_diproses_kadep',
    'sudah_terlaksana',
    'nomor_surat',
    'nilai_p',
    'nilai_p_satu',
    'nilai_p_dua',
    'berita_acara',
    'total_p',
    'total_p_satu',
    'total_p_dua',
    'rata_rata_angka',
    'rata_rata_huruf',
    'us_is_deleted',
];

    // used by skripsi/index
        // untuk menampilkan data ujian skripsi oleh mahasiswa berdasarkan nim mahasiswa tersebut
    // used by ujian_skripsi/semua_ujian_ujian_skripsi 
        // untuk menampilkan data ujian_skripsi yang akan diverifikasi oleh admin, ataupun kadep
    public function getAll($nim = null, $level=null, $departemen = null)
    {   
        $builder = $this->db->table('ujian_skripsi');
        $builder->select('ujian_skripsi.*, 
            profil.prf_nama_portal as nama_mahasiswa, 
            skripsi.judul_skripsi as judul_skripsi,
            seminar_sesi.jam_alias as ujian_sesi_alias,
            seminar_ruangan.ruangan_alias as ujian_ruangan_alias, 
            fip_dosen_pembimbing.nidn as d_pembimbing_nidn, fip_dosen_pembimbing.peg_gel_dep as d_pembimbing_peg_gel_dep, fip_dosen_pembimbing.peg_nama as d_pembimbing_peg_nama, fip_dosen_pembimbing.peg_gel_bel as d_pembimbing_peg_gel_bel,
        ');
        $builder->join('skripsi', 'ujian_skripsi.us_s_uuid = skripsi.skripsi_uuid');
        $builder->join('seminar_sesi', 'ujian_skripsi.us_sesi = seminar_sesi.seminar_s_id');
        $builder->join('seminar_ruangan', 'ujian_skripsi.us_ruangan = seminar_ruangan.seminar_r_id');
        $builder->join('fip_dosen as fip_dosen_pembimbing', 'fip_dosen_pembimbing.nidn = skripsi.dosen_pembimbing');
        $builder->join('profil', 'ujian_skripsi.us_nim_m = profil.prf_nim_portal');
        if($nim){$builder->where('nim_mahasiswa', $nim);}
        if($departemen){$builder->where('profil.departemen_input', $departemen);}
        // jika user level adalah admin maka
        if($level != null & $level == '7'){
            $builder->groupStart();
            $builder->where('us_status', '1');
            $builder->orWhere('us_status', '2');
            $builder->orWhere('us_status', '3');
            $builder->groupEnd();
        }
        // end
        // jika user level adalah kadep
        if($level != null && $level == '4'){
            $builder->groupStart();
            $builder->where('us_status', '3');
            $builder->orWhere('us_status', '4');
            $builder->orWhere('us_status', '5');
            $builder->groupEnd();
        }
        // end
        $builder->orderBy('us_status', 'desc');
        $query = $builder->get();
        return $query->getResultArray(); 
    }

    public function simpanUjian($data = null, $nama = null)
    {
        $builder = $this->db->table('ujian_skripsi');
        $builder->set('us_uuid','UUID()', FALSE);
        $builder->insert($data);
        
        $insert_id = $this->db->insertID();
        $builderdua = $this->db->table('file_syarat_ujian_mahasiswa');
        $file_upload = array();
        foreach ($nama as $nm) {
            $file_uploaddua = array(
                'us_id' => $insert_id,
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
            ->where('skripsi_uuid', $data['us_s_uuid'])
            ->update();
    }

    // used by seminar::detail
    // used by seminar::verifikasi
    public function getDetail($UUIDUjian = null)
    {   
        $builder = $this->db->table('ujian_skripsi');
        $builder->select('ujian_skripsi.*,
            profil.prf_nama_portal as nama_mahasiswa, 
            profil.nohp_baru, profil.prodi_portal,
            skripsi.judul_skripsi as judul_skripsi, 
            skripsi.deskripsi_skripsi as deskripsi_skripsi,
            seminar_sesi.jam_alias as ujian_sesi_alias,
            seminar_ruangan.ruangan_alias as ujian_ruangan_alias,
            seminar.penguji_satu, seminar.penguji_dua,
            fip_dosen_pembimbing.nidn as d_pembimbing_nidn, fip_dosen_pembimbing.peg_gel_dep as d_pembimbing_peg_gel_dep, fip_dosen_pembimbing.peg_nama as d_pembimbing_peg_nama, fip_dosen_pembimbing.peg_gel_bel as d_pembimbing_peg_gel_bel,
            fip_dosen_pa.nidn as d_pa_nidn, fip_dosen_pa.peg_gel_dep as d_pa_peg_gel_dep, fip_dosen_pa.peg_nama as d_pa_peg_nama, fip_dosen_pa.peg_gel_bel as d_pa_peg_gel_bel,
            fip_penguji_satu.nidn as d_penguji_satu_nidn, fip_penguji_satu.peg_gel_dep as d_penguji_satu_peg_gel_dep, fip_penguji_satu.peg_nama as d_penguji_satu_peg_nama, fip_penguji_satu.peg_gel_bel as d_penguji_satu_peg_gel_bel,
            fip_penguji_dua.nidn as d_penguji_dua_nidn, fip_penguji_dua.peg_gel_dep as d_penguji_dua_peg_gel_dep, fip_penguji_dua.peg_nama as d_penguji_dua_peg_nama, fip_penguji_dua.peg_gel_bel as d_penguji_dua_peg_gel_bel,
        ');
        $builder->join('seminar', 'ujian_skripsi.us_s_uuid = seminar.smr_s_uuid');
        $builder->join('profil', 'ujian_skripsi.us_nim_m = profil.prf_nim_portal');
        $builder->join('skripsi', 'ujian_skripsi.us_s_uuid = skripsi.skripsi_uuid');
        $builder->join('seminar_sesi', 'ujian_skripsi.us_sesi = seminar_sesi.seminar_s_id');
        $builder->join('seminar_ruangan', 'ujian_skripsi.us_ruangan = seminar_ruangan.seminar_r_id');
        $builder->join('fip_dosen as fip_dosen_pembimbing', 'fip_dosen_pembimbing.nidn = skripsi.dosen_pembimbing', 'left');
        $builder->join('fip_dosen as fip_dosen_pa', 'fip_dosen_pa.nidn = skripsi.dosen_pa', 'left');
        $builder->join('fip_dosen as fip_penguji_satu', 'fip_penguji_satu.nidn = seminar.penguji_satu','left');
        $builder->join('fip_dosen as fip_penguji_dua', 'fip_penguji_dua.nidn = seminar.penguji_dua','left');
        if($UUIDUjian) {
            $builder->where('us_uuid', $UUIDUjian);
        }
        $builder->where('seminar.smr_status', '5');
        $query = $builder->get();
        return $query->getRowArray(); 
    }

    public function verifikasiUjian($UUIDUjian = null, $data = null)
    {
        date_default_timezone_set('ASIA/JAKARTA');
        $tanggal_diproses_admin = date('Y-m-d H:i:s');
        $builder = $this->db->table('ujian_skripsi');
        $builder->select('us_nim_m');
        $builder->where('us_uuid', $UUIDUjian);
        $query = $builder->get();
        $nim = $query->getRowArray();

        $builderdua = $this->db->table('ujian_skripsi');
        $builderdua->select('us_id');
        $builderdua->where('us_status', '3');
        $builderdua->where('us_uuid !=', $UUIDUjian);
        $querydua = $builderdua->get();
        $hasil = $querydua->getResultArray();
        if(count($hasil) > 0){
            return false;
        }
    
        $buildertiga = $this->db->table('ujian_skripsi');
        $buildertiga->set('us_status', '2');
        $buildertiga->set('us_pesan_admin', 'Sudah ada ujian saudara yang di acc');
        $buildertiga->set('user_verifikator', session()->get('user_id'));
        $buildertiga->set('tanggal_diproses_admin', $tanggal_diproses_admin);
        $buildertiga->set('sedang_diproses', 0);
        $buildertiga->where('us_nim_m', $nim);
        $buildertiga->where('us_uuid !=', $UUIDUjian);
        $buildertiga->where('us_status !=', 4);
        $buildertiga->update();
        
        $builderempat = $this->db->table('ujian_skripsi');
        $builderempat->where('us_uuid', $UUIDUjian);
        $builderempat->update($data);

        return true;
    }

      // akses oleh controller ujianskripsi::pembimbing
      public function getAllUjianSkripsiByDosen($nidn = null)
      {   
        $build = $this->db->query(
            "SELECT ujian_skripsi.us_tanggal, ujian_skripsi.us_status , ujian_skripsi.us_uuid, ujian_skripsi.nilai_p, ujian_skripsi.nilai_p_satu, ujian_skripsi.nilai_p_dua, ujian_skripsi.berita_acara,
            seminar.smr_uuid, seminar.smr_nim_m, seminar.penguji_satu, seminar.penguji_dua, seminar.smr_status,
            seminar.smr_tanggal, seminar.smr_hari, seminar.smr_sesi, seminar.smr_ruangan, seminar.sudah_terlaksana,
            skripsi.judul_skripsi, skripsi.dosen_pembimbing,
            seminar_ruangan.ruangan_alias as nama_ruangan, seminar_sesi.jam_alias as sesi,
            profil.prf_nama_portal, IF(skripsi.dosen_pembimbing = $nidn, 'Pembimbing', 
            IF(seminar.penguji_satu = $nidn, 'Penguji Satu', 
            IF(seminar.penguji_dua = $nidn, 'Penguji Dua', 'Selain Itu'))) AS sebagai
            FROM seminar
            JOIN skripsi ON seminar.smr_s_uuid = skripsi.skripsi_uuid
            JOIN ujian_skripsi ON seminar.smr_s_uuid = ujian_skripsi.us_s_uuid
            JOIN profil ON seminar.smr_nim_m = profil.prf_nim_portal
            JOIN seminar_ruangan ON ujian_skripsi.us_ruangan = seminar_ruangan.seminar_r_id
            JOIN seminar_sesi ON ujian_skripsi.us_sesi = seminar_sesi.seminar_s_id
            WHERE (seminar.smr_status = 5 OR seminar.smr_status = 6)
            AND (ujian_skripsi.us_status = 5 OR ujian_skripsi.us_status = 6)
            AND (seminar.penguji_satu = $nidn
            OR seminar.penguji_dua = $nidn
            OR skripsi.dosen_pembimbing = $nidn)
            ORDER BY seminar.smr_tanggal ASC");
        $result = $build->getResultArray();
        return $result;

        // $build = $this->db->query(
        //     "SELECT ujian_skripsi.us_tanggal, ujian_skripsi.us_status , ujian_skripsi.us_uuid,seminar.smr_uuid, seminar.smr_nim_m, seminar.penguji_satu, seminar.penguji_dua, seminar.smr_status,
        //     seminar.smr_tanggal, seminar.smr_hari, seminar.smr_sesi, seminar.smr_ruangan, seminar.sudah_terlaksana,
        //     skripsi.judul_skripsi, skripsi.dosen_pembimbing,
        //     seminar_ruangan.ruangan_alias as nama_ruangan, seminar_sesi.jam_alias as sesi,
        //     profil.prf_nama_portal, IF(skripsi.dosen_pembimbing = $nidn, 'Pembimbing', 
        //     IF(seminar.penguji_satu = $nidn, 'Penguji Satu', 
        //     IF(seminar.penguji_dua = $nidn, 'Penguji Dua', 'Selain Itu'))) AS sebagai
        //     FROM seminar
        //     JOIN skripsi ON seminar.smr_s_uuid = skripsi.skripsi_uuid
        //     JOIN ujian_skripsi ON seminar.smr_s_uuid = ujian_skripsi.us_s_uuid
        //     JOIN profil ON seminar.smr_nim_m = profil.prf_nim_portal
        //     JOIN seminar_ruangan ON ujian_skripsi.us_ruangan = seminar_ruangan.seminar_r_id
        //     JOIN seminar_sesi ON ujian_skripsi.us_sesi = seminar_sesi.seminar_s_id
        //     WHERE (seminar.smr_status = 5 OR seminar.smr_status = 6)
        //     AND (ujian_skripsi.us_status = 5 OR ujian_skripsi.us_status = 6)
        //     AND (seminar.penguji_satu = $nidn
        //     OR seminar.penguji_dua = $nidn
        //     OR skripsi.dosen_pembimbing = $nidn)
        //     ORDER BY seminar.smr_tanggal ASC");
        // $result = $build->getResultArray();
        // return $result;
      }
}
