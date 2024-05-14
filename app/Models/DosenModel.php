<?php

namespace App\Models;

use CodeIgniter\Model;

class DosenModel extends Model
{
    protected $table = 'fip_dosen';
    protected $primaryKey = 'nidn';

    protected $useTimestamps = true;
    protected $allowedFields = [
    'nidn',
    'peg_nip',
    'peg_gel_dep',
    'peg_nama',
    'peg_gel_bel',
    'peg_status',
    'peg_bidan',
    'peg_pangkat',
    'peg_golongan',
    'peg_jabatan',
    'peg_tmp_lahir',
    'peg_tgl_lahir',
    'peg_sex',
    'peg_agama',
    'peg_prodi',
    'peg_pendidikan',
    'peg_tmt',
    'peg_no_sk',
    'peg_kota',
    'peg_pro',
    'peg_kawin',
    'peg_telp',
    'peg_hp',
    'nohp_baru',
    'no_wa',
    'peg_email',
    'email_baru',
    'peg_status_aktif',
    'peg_alamat',
    'alamat_baru',
    'verifikasi',
];

    // untuk menampilkan semua dosen
    public function getAll($departemen = null)
    {
        if($departemen != null) {
            $build = $this->db->query(
                "SELECT fip_dosen.peg_nama, fip_dosen.nidn, fip_dosen.peg_nip, fip_dosen.peg_gel_dep, fip_dosen.peg_gel_bel, fip_dosen.peg_prodi,
                (SELECT COUNT(skripsi.dosen_pembimbing) FROM skripsi 
                    WHERE skripsi.dosen_pembimbing = fip_dosen.nidn 
                    AND skripsi.status_pengajuan_skripsi = 3) 
                    AS total_membimbing, 
                (SELECT COUNT(skripsi.dosen_pa) FROM skripsi 
                    WHERE skripsi.dosen_pa = fip_dosen.nidn 
                    AND skripsi.status_pengajuan_skripsi = 3) AS total_menjadi_pa, 
                (SELECT COUNT(seminar.penguji_satu) FROM seminar 
                    WHERE seminar.penguji_satu = fip_dosen.nidn 
                    AND seminar.smr_status = 5) AS total_menguji_satu, 
                (SELECT COUNT(seminar.penguji_dua) FROM seminar 
                    WHERE seminar.penguji_dua = fip_dosen.nidn 
                    AND seminar.smr_status = 5) AS total_menguji_dua 
                FROM fip_dosen 
                WHERE fip_dosen.peg_prodi = '$departemen' ORDER BY total_membimbing ASC");
            $result = $build->getResult();
            return $result;
        }else {
            $build = $this->db->query(
                "SELECT fip_dosen.peg_nama, fip_dosen.nidn, fip_dosen.peg_nip, fip_dosen.peg_gel_dep, fip_dosen.peg_gel_bel, 
                (SELECT COUNT(skripsi.dosen_pembimbing) FROM skripsi 
                    WHERE skripsi.dosen_pembimbing = fip_dosen.nidn 
                    AND skripsi.status_pengajuan_skripsi = 3) AS total_membimbing, 
                (SELECT COUNT(skripsi.dosen_pa) FROM skripsi 
                    WHERE skripsi.dosen_pa = fip_dosen.nidn 
                    AND skripsi.status_pengajuan_skripsi = 3) AS total_menjadi_pa, 
                (SELECT COUNT(seminar.penguji_satu) FROM seminar 
                    WHERE seminar.penguji_satu = fip_dosen.nidn  
                    AND seminar.smr_status = 5) AS total_menguji_satu, 
                (SELECT COUNT(seminar.penguji_dua) FROM seminar 
                    WHERE seminar.penguji_dua = fip_dosen.nidn 
                    AND seminar.smr_status = 5) AS total_menguji_dua 
                FROM fip_dosen ORDER BY total_membimbing DESC");
            $result = $build->getResult();
            return $result;
        }

        // if($departemen != null) {
        //     $build = $this->db->query(
        //         "SELECT fip_dosen.peg_nama, fip_dosen.nidn, fip_dosen.peg_nip, fip_dosen.peg_gel_dep, fip_dosen.peg_gel_bel, 
        //         (SELECT COUNT(skripsi.dosen_pembimbing) FROM skripsi 
        //             WHERE skripsi.dosen_pembimbing = fip_dosen.nidn 
        //             AND skripsi.status_pengajuan_skripsi <> 1 
        //             AND skripsi.status_pengajuan_skripsi <> 2) 
        //             AS total_membimbing, 
        //         (SELECT COUNT(skripsi.dosen_pa) FROM skripsi 
        //             WHERE skripsi.dosen_pa = fip_dosen.nidn 
        //             AND skripsi.status_pengajuan_skripsi <> 1 
        //             AND skripsi.status_pengajuan_skripsi <> 2) AS total_menjadi_pa, 
        //         (SELECT COUNT(skripsi.penguji_satu) FROM skripsi 
        //             WHERE skripsi.penguji_satu = fip_dosen.nidn 
        //             AND skripsi.status_pengajuan_skripsi <> 1 
        //             AND skripsi.status_pengajuan_skripsi <> 2) AS total_menguji_satu, 
        //         (SELECT COUNT(skripsi.penguji_dua) FROM skripsi 
        //             WHERE skripsi.penguji_dua = fip_dosen.nidn 
        //             AND skripsi.status_pengajuan_skripsi <> 1 
        //             AND skripsi.status_pengajuan_skripsi <> 2) AS total_menguji_dua 
        //         FROM fip_dosen 
        //         WHERE fip_dosen.peg_prodi = '$departemen' ORDER BY total_membimbing ASC");
        //     $result = $build->getResult();
        //     return $result;
        // }else {
        //     $build = $this->db->query(
        //         "SELECT fip_dosen.peg_nama, fip_dosen.nidn, fip_dosen.peg_nip, fip_dosen.peg_gel_dep, fip_dosen.peg_gel_bel, 
        //         (SELECT COUNT(skripsi.dosen_pembimbing) FROM skripsi 
        //             WHERE skripsi.dosen_pembimbing = fip_dosen.nidn 
        //             AND skripsi.status_pengajuan_skripsi <> 1 
        //             AND skripsi.status_pengajuan_skripsi <> 2) 
        //             AS total_membimbing, 
        //         (SELECT COUNT(skripsi.dosen_pa) FROM skripsi 
        //             WHERE skripsi.dosen_pa = fip_dosen.nidn 
        //             AND skripsi.status_pengajuan_skripsi <> 1 
        //             AND skripsi.status_pengajuan_skripsi <> 2) AS total_menjadi_pa, 
        //         (SELECT COUNT(skripsi.penguji_satu) FROM skripsi 
        //             WHERE skripsi.penguji_satu = fip_dosen.nidn 
        //             AND skripsi.status_pengajuan_skripsi <> 1 
        //             AND skripsi.status_pengajuan_skripsi <> 2) AS total_menguji_satu, 
        //         (SELECT COUNT(skripsi.penguji_dua) FROM skripsi 
        //             WHERE skripsi.penguji_dua = fip_dosen.nidn 
        //             AND skripsi.status_pengajuan_skripsi <> 1 
        //             AND skripsi.status_pengajuan_skripsi <> 2) AS total_menguji_dua 
        //         FROM fip_dosen ORDER BY total_membimbing DESC");
        //     $result = $build->getResult();
        //     return $result;
        // }
        // QUERY UNTUK MENDAPATKAN DOSEN DAN JUMLAH MEMBIMBING, PA, PENGUJI SATU, PENGUJI DUA TANPA MELIHAT APAKAH SKRIPSI TERSEBUT DISETUJUI
        // $build = $this->db->query('SELECT fip_dosen.peg_nama, fip_dosen.nidn, fip_dosen.peg_nip, fip_dosen.peg_gel_dep, fip_dosen.peg_gel_bel,
        // (SELECT COUNT(skripsi.dosen_pembimbing) FROM skripsi WHERE skripsi.dosen_pembimbing = fip_dosen.nidn) AS total_membimbing, (SELECT COUNT(skripsi.dosen_pa) FROM skripsi WHERE skripsi.dosen_pa = fip_dosen.nidn) AS total_menjadi_pa, 
        // (SELECT COUNT(skripsi.penguji_satu) FROM skripsi WHERE skripsi.penguji_satu = fip_dosen.nidn) AS total_menguji_satu, 
        // (SELECT COUNT(skripsi.penguji_dua) FROM skripsi WHERE skripsi.penguji_dua = fip_dosen.nidn) AS total_menguji_dua FROM fip_dosen ORDER BY total_membimbing, total_menjadi_pa DESC;');
        // $result = $build->getResult();
        // return $result;

        // QUERY UNTUK MENDAPATKAN DOSEN DAN JUMLAH MEMBIMBING, PA, PENGUJI SATU, PENGUJI DUA TANPA MELIHAT APAKAH SKRIPSI TERSEBUT DISETUJUI
       
    }

    // untuk menampilkan semua dosen
    // master-dosen/index
    public function getAllDosen($departemen = null)
    {
        $build = $this->db->query(
            "SELECT fip_dosen.*, departemen.departemen_nama as nama_departemen,
            (SELECT COUNT(skripsi.dosen_pembimbing) FROM skripsi 
                WHERE skripsi.dosen_pembimbing = fip_dosen.nidn 
                AND skripsi.status_pengajuan_skripsi = 3) AS total_membimbing,
            (SELECT COUNT(skripsi.dosen_pa) FROM skripsi
                WHERE skripsi.dosen_pa = fip_dosen.nidn 
                AND skripsi.status_pengajuan_skripsi = 3) AS total_menjadi_pa, 
            (SELECT COUNT(seminar.penguji_satu) FROM seminar 
                WHERE seminar.penguji_satu = fip_dosen.nidn  
                AND seminar.smr_status = 5) AS total_menguji_satu, 
            (SELECT COUNT(seminar.penguji_dua) FROM seminar 
                WHERE seminar.penguji_dua = fip_dosen.nidn 
                AND seminar.smr_status = 5) AS total_menguji_dua 
            FROM fip_dosen 
            LEFT JOIN departemen ON fip_dosen.peg_prodi = departemen.departemen_id
            ORDER BY peg_nama ASC");
        $result = $build->getResultArray();
        return $result;
    }

    // untuk menampilkan detail dosen
    // digunakan oleh ProfilDosen::verifikasi
    public function getDetail($nidn = null)
    {
        $builder = $this->db->table('fip_dosen');
        $builder->select('*');
        $builder->where('nidn', $nidn);
        $query = $builder->get();
        return $query->getRowArray();
    }

     // digunakan sewaktu pertama kali login di aplikasi ini, untuk cek apakah dosen tersebut sudah memperbaharui data profil
    // digunakan oleh Auth::loginProcess
    public function cekIsVerifiedDosen($username = '')
    {
        $builder = $this->db->table('fip_dosen');
        $builder->select('verifikasi');
        $builder->where('nidn', $username);
        $query = $builder->get();
        return $query->getRowArray(); 
    }

    public function updateVerifikasiProfil($data, $username)
    {
        $builder = $this->db->table('fip_dosen');
        $builder->set($data);
        $builder->where('nidn', $username);
        $builder->update();
    }

    public function getAllGelarDepan()
    {
        $build = $this->db->query(
            "SELECT DISTINCT peg_gel_dep
            FROM fip_dosen
            ORDER BY peg_gel_dep ASC");
        $result = $build->getResultArray();
        return $result;
    }

    public function getAllGelarBelakang()
    {
        $build = $this->db->query(
            "SELECT DISTINCT peg_gel_bel
            FROM fip_dosen
            ORDER BY peg_gel_bel ASC
            ");
        $result = $build->getResultArray();
        return $result;
    }

    public function getAllStatus()
    {
        $build = $this->db->query(
            "SELECT DISTINCT peg_status
            FROM fip_dosen
            ORDER BY peg_status ASC
            ");
        $result = $build->getResultArray();
        return $result;
    }

    public function getAllBidang()
    {
        $build = $this->db->query(
            "SELECT DISTINCT peg_bidang
            FROM fip_dosen
            ORDER BY peg_bidang ASC");
        $result = $build->getResultArray();
        return $result;
    }

    public function getAllPangkat()
    {
        $build = $this->db->query(
            "SELECT DISTINCT peg_pangkat
            FROM fip_dosen
            ORDER BY peg_pangkat ASC");
        $result = $build->getResultArray();
        return $result;
    }

    public function getAllGolongan()
    {
        $build = $this->db->query(
            "SELECT DISTINCT peg_golongan
            FROM fip_dosen
            ORDER BY peg_golongan ASC");
        $result = $build->getResultArray();
        return $result;
    }

    public function getAllJabatan()
    {
        $build = $this->db->query(
            "SELECT DISTINCT peg_jabatan
            FROM fip_dosen
            ORDER BY peg_jabatan ASC");
        $result = $build->getResultArray();
        return $result;
    }

    public function getAllJenisKelamin()
    {
        $build = $this->db->query(
            "SELECT DISTINCT peg_sex
            FROM fip_dosen
            ORDER BY peg_sex ASC");
        $result = $build->getResultArray();
        return $result;
    }

    public function getAllAgama()
    {
        $build = $this->db->query(
            "SELECT DISTINCT peg_agama
            FROM fip_dosen
            ORDER BY peg_agama ASC");
        $result = $build->getResultArray();
        return $result;
    }

    public function getAllPendidikan()
    {
        $build = $this->db->query(
            "SELECT DISTINCT peg_pendidikan
            FROM fip_dosen
            ORDER BY peg_pendidikan ASC");
        $result = $build->getResultArray();
        return $result;
    }

    public function getAllStatusPernikahan()
    {
        $build = $this->db->query(
            "SELECT DISTINCT peg_kawin
            FROM fip_dosen
            ORDER BY peg_kawin ASC");
        $result = $build->getResultArray();
        return $result;
    }
} 