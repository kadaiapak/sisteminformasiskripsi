<?php

namespace App\Models;

use CodeIgniter\Model;

class RuanganModel extends Model
{
    protected $table = 'seminar_ruangan';
    protected $primaryKey = 'ruangan_id';
    protected $allowedFields = [
    'ruangan_alias',
    'ruangan_nama',
    'ruangan_keterangan',
    'ruangan_status',
    ];

        public function getAllRuangan()
        {
            $builder = $this->db->table('penjadwalan_ruangan');
            $builder->select('penjadwalan_ruangan.*,seminar_ruangan.ruangan_alias,seminar_ruangan.seminar_r_id');
            $builder->join('seminar_ruangan', 'seminar_ruangan.seminar_r_id = penjadwalan_ruangan.ruangan_id');
            $result = $builder->get();
            return $result->getResultArray();
        }

        public function getDaftarPemakaianRuangan()
        {
            $build = $this->db->query(
            'SELECT fip_dosen.peg_nama, fip_dosen.nidn, fip_dosen.peg_nip, fip_dosen.peg_gel_dep, fip_dosen.peg_gel_bel, 
                (SELECT COUNT(skripsi.dosen_pembimbing) FROM skripsi 
                    WHERE skripsi.dosen_pembimbing = fip_dosen.nidn 
                    AND skripsi.status_pengajuan_skripsi <> 1 
                    AND skripsi.status_pengajuan_skripsi <> 2) 
                    AS total_membimbing, 
                (SELECT COUNT(skripsi.dosen_pa) FROM skripsi 
                    WHERE skripsi.dosen_pa = fip_dosen.nidn 
                    AND skripsi.status_pengajuan_skripsi <> 1 
                    AND skripsi.status_pengajuan_skripsi <> 2) 
                    AS total_menjadi_pa, 
                (SELECT COUNT(skripsi.penguji_satu) FROM skripsi 
                    WHERE skripsi.penguji_satu = fip_dosen.nidn 
                    AND skripsi.status_pengajuan_skripsi <> 1 
                    AND skripsi.status_pengajuan_skripsi <> 2) 
                    AS total_menguji_satu, 
                (SELECT COUNT(skripsi.penguji_dua) FROM skripsi 
                    WHERE skripsi.penguji_dua = fip_dosen.nidn 
                    AND skripsi.status_pengajuan_skripsi <> 1 
                    AND skripsi.status_pengajuan_skripsi <> 2) 
                    AS total_menguji_dua 
            FROM fip_dosen ORDER BY `total_membimbing` DESC');
        $result = $build->getResult();
        return $result;
        }

        public function getRuanganDepartemen($idDepartemen = null)
    {
        $builder = $this->db->table('penjadwalan_ruangan');
        $builder->select('penjadwalan_ruangan.*,seminar_ruangan.ruangan_alias,seminar_ruangan.seminar_r_id');
        $builder->join('seminar_ruangan', 'seminar_ruangan.seminar_r_id = penjadwalan_ruangan.ruangan_id');
        $builder->where('penjadwalan_ruangan.departemen_id', $idDepartemen);
        $result = $builder->get();
        return $result->getResultArray();
    }

    public function semuaRuanganTerpakai()
    {
        $build = $this->db->query(
            'SELECT smr_nim_m, smr_hari, hari.hari_nama as nama_hari, smr_tanggal, smr_sesi, seminar_sesi.jam_alias as nama_sesi, smr_ruangan, seminar_ruangan.ruangan_alias as nama_ruangan, "Seminar" AS jenis_pemakaian
            FROM seminar
            INNER JOIN hari ON seminar.smr_hari = hari.hari_id
            INNER JOIN seminar_sesi ON seminar.smr_sesi = seminar_sesi.seminar_s_id
            INNER JOIN seminar_ruangan ON seminar.smr_ruangan = seminar_ruangan.seminar_r_id
            WHERE smr_status = 5
            UNION ALL 
            SELECT us_nim_m, us_hari, hari.hari_nama as nama_hari, us_tanggal, us_sesi, seminar_sesi.jam_alias as nama_sesi, us_ruangan, seminar_ruangan.ruangan_alias as nama_ruangan, "Ujian Skripsi" AS jenis_pemakaian
            FROM ujian_skripsi 
            INNER JOIN hari ON ujian_skripsi.us_hari = hari.hari_id
            INNER JOIN seminar_sesi ON ujian_skripsi.us_sesi = seminar_sesi.seminar_s_id
            INNER JOIN seminar_ruangan ON ujian_skripsi.us_ruangan = seminar_ruangan.seminar_r_id
            WHERE us_status = 5');
        $result = $build->getResultArray();
        return $result;
    }
}