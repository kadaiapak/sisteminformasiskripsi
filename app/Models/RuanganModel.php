<?php

namespace App\Models;

use CodeIgniter\Model;
use DateTime;

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
        $builder->orWhere('penjadwalan_ruangan.departemen_id', '@');
        $result = $builder->get();
        return $result->getResultArray();
    }

    public function getRuanganUntukPengajuanSeminar($search = null, $hari = null, $idDepartemen = null)
    {
        $builder = $this->db->table('penjadwalan_ruangan');
        $builder->select('penjadwalan_ruangan.*,seminar_ruangan.ruangan_alias,seminar_ruangan.seminar_r_id');
        $builder->join('seminar_ruangan', 'seminar_ruangan.seminar_r_id = penjadwalan_ruangan.ruangan_id');
        $builder->groupStart();
        $builder->where('penjadwalan_ruangan.departemen_id', $idDepartemen);
        $builder->orWhere('penjadwalan_ruangan.departemen_id', '@');
        $builder->groupEnd();
        $builder->groupStart();
        $builder->where('penjadwalan_ruangan.hari_id', $hari);
        $builder->orWhere('penjadwalan_ruangan.hari_id', '@');
        $builder->groupEnd();
        if($search != null){
            $builder->like('seminar_ruangan.ruangan_alias', $search);
        }
        $result = $builder->get();
        return $result->getResultArray();
    }

    // public function getRuanganBisaDipakaiUntukPengajuanSeminar($search = null, $hari = null, $idDepartemen = null, $tanggal = null)
    // {
    //     // date_default_timezone_set('Asia/Jakarta');
    //     // date($tanggal);
    //     // echo '<pre>';
    //     // print_r($idDepartemen);
    //     // echo '<pre>';
    //     // die;
    //     // subquery mencari ruangan yang sudah terpakai

    //     $subquery = $this->db->table('seminar')
    //     ->select('smr_ruangan, smr_sesi')
    //     ->groupStart()
    //     ->where('smr_status', 3)
    //     ->orWhere('smr_status', 5)
    //     ->groupEnd()
    //     ->where('smr_hari', $hari)
    //     ->where('smr_tanggal', $tanggal)
    //     ->getCompiledSelect();

    //     $subquerydua = $this->db->table('seminar');

    //     echo '<pre>';
    //     print_r($subquery);
    //     echo '<pre>';
    //     die;    

    //     // $subquery = $this->db->table('seminar')
    //     // ->select('smr_ruangan')
    //     // ->groupStart()
    //     // ->where('smr_status', 3)
    //     // ->orWhere('smr_status', 5)
    //     // ->groupEnd()
    //     // ->where('smr_hari', $hari)
    //     // ->where('smr_tanggal', $tanggal)
    //     // ->get();

       

    //     $builder = $this->db->table('seminar_ruangan');
    //     $builder->select('seminar_r_id, ruangan_alias');
    //     $builder->join('penjadwalan_ruangan', 'penjadwalan_ruangan.ruangan_id = seminar_ruangan.seminar_r_id');
    //     $builder->groupStart();
    //     $builder->where('penjadwalan_ruangan.departemen_id', $idDepartemen);
    //     $builder->orWhere('penjadwalan_ruangan.departemen_id', '@');
    //     $builder->groupEnd();
    //     $builder->groupStart();
    //     $builder->where('penjadwalan_ruangan.hari_id', $hari);
    //     $builder->orWhere('penjadwalan_ruangan.hari_id', '@');
    //     $builder->groupEnd();
    //     $builder->groupStart();
    //     $builder->where("seminar_ruangan.seminar_r_id NOT IN ($subquery)", null, false);
    //     $builder->groupEnd();
    //     if($search != null){
    //         $builder->like('seminar_ruangan.ruangan_alias', $search);
    //     }
    //     $result = $builder->get();
    //     // $result = $builder->getCompiledSelect();
    //     // echo '<pre>';
    //     // print_r($result->getResultArray());
    //     // echo '</pre>';
    //     // die;

    //     return $result->getResultArray();

    //     // $builder = $this->db->table('penjadwalan_ruangan');
    //     // $builder->select('penjadwalan_ruangan.*,seminar_ruangan.ruangan_alias,seminar_ruangan.seminar_r_id');
    //     // $builder->join('seminar_ruangan', 'seminar_ruangan.seminar_r_id = penjadwalan_ruangan.ruangan_id');
    //     // $builder->groupStart();
    //     // $builder->where('penjadwalan_ruangan.departemen_id', $idDepartemen);
    //     // $builder->orWhere('penjadwalan_ruangan.departemen_id', '@');
    //     // $builder->groupEnd();
    //     // $builder->groupStart();
    //     // $builder->where('penjadwalan_ruangan.hari_id', $hari);
    //     // $builder->orWhere('penjadwalan_ruangan.hari_id', '@');
    //     // $builder->groupEnd(); 
    //     // $builder->groupStart();
    //     // $builder->where('seminar.smr_ruangan')
    //     // if($search != null){
    //     //     $builder->like('seminar_ruangan.ruangan_alias', $search);
    //     // }
    //     // $result = $builder->get();
    // }

    public function getRuanganBisaDipakaiUntukPengajuanSeminar($search = null, $hari = null, $idDepartemen = null, $tanggal = null)
    {
        // Membangun query untuk mendapatkan ruangan dan sesi yang tersedia
        $builder = $this->db->table('seminar_ruangan r');
        $builder->select('DISTINCT(r.seminar_r_id), r.ruangan_alias');
        $builder->join('seminar_sesi s', '1=1'); // Menggabungkan semua ruangan dengan semua sesi
        $builder->join('seminar sm', "sm.smr_ruangan = r.seminar_r_id AND sm.smr_sesi = s.seminar_s_id AND sm.smr_tanggal = '$tanggal' AND (sm.smr_status = 3 OR sm.smr_status = 5)", 'left');
        $builder->join('penjadwalan_ruangan', 'penjadwalan_ruangan.ruangan_id = r.seminar_r_id');
        $builder->groupStart();
        $builder->where('penjadwalan_ruangan.departemen_id', $idDepartemen);
        $builder->orWhere('penjadwalan_ruangan.departemen_id', '@');
        $builder->groupEnd();
        $builder->groupStart();
        $builder->where('penjadwalan_ruangan.hari_id', $hari);
        $builder->orWhere('penjadwalan_ruangan.hari_id', '@');
        $builder->groupEnd();
        $builder->where('sm.smr_id IS NULL');
        $builder->orderBy('ruangan_alias', 'ASC');
        return $builder->get()->getResultArray();
    }

    public function getSesiBisaDipakaiUntukPengajuanSeminar($hari = null, $idDepartemen = null, $tanggal = null, $idRuangan = null)
    {
        // Membangun query untuk mendapatkan ruangan dan sesi yang tersedia
        $builder = $this->db->table('seminar_ruangan r');
        $builder->select('s.seminar_s_id, s.jam_alias');
        $builder->join('seminar_sesi s', '1=1'); // Menggabungkan semua ruangan dengan semua sesi
        $builder->join('seminar sm', "sm.smr_ruangan = r.seminar_r_id AND sm.smr_sesi = s.seminar_s_id AND sm.smr_tanggal = '$tanggal' AND (sm.smr_status = 3 OR sm.smr_status = 5)", 'left');
        $builder->join('penjadwalan_ruangan', 'penjadwalan_ruangan.ruangan_id = r.seminar_r_id');
        $builder->groupStart();
        $builder->where('penjadwalan_ruangan.departemen_id', $idDepartemen);
        $builder->orWhere('penjadwalan_ruangan.departemen_id', '@');
        $builder->groupEnd();
        $builder->groupStart();
        $builder->where('penjadwalan_ruangan.hari_id', $hari);
        $builder->orWhere('penjadwalan_ruangan.hari_id', '@');
        $builder->groupEnd();
        $builder->where('sm.smr_id IS NULL');
        $builder->where('r.seminar_r_id', $idRuangan);
        $builder->orderBy('ruangan_alias', 'ASC');
        return $builder->get()->getResultArray();
    }

    // public function getRuanganBisaDipakaiUntukPengajuanSeminar($search = null, $hari = null, $idDepartemen = null, $tanggal = null)
    // {
    //     // Membangun query untuk mendapatkan ruangan dan sesi yang tersedia
    //     $builder = $this->db->table('seminar_ruangan r');
    //     $builder->select('r.seminar_r_id, r.ruangan_alias, s.seminar_s_id, s.jam_alias  , penjadwalan_ruangan.hari_id');
    //     $builder->join('seminar_sesi s', '1=1'); // Menggabungkan semua ruangan dengan semua sesi
    //     $builder->join('seminar sm', "sm.smr_ruangan = r.seminar_r_id AND sm.smr_sesi = s.seminar_s_id AND sm.smr_tanggal = '$tanggal' AND (sm.smr_status = 3 OR sm.smr_status = 5)", 'left');
    //     $builder->join('penjadwalan_ruangan', 'penjadwalan_ruangan.ruangan_id = r.seminar_r_id');
    //     $builder->groupStart();
    //     $builder->where('penjadwalan_ruangan.departemen_id', $idDepartemen);
    //     $builder->orWhere('penjadwalan_ruangan.departemen_id', '@');
    //     $builder->groupEnd();
    //     $builder->groupStart();
    //     $builder->where('penjadwalan_ruangan.hari_id', $hari);
    //     $builder->orWhere('penjadwalan_ruangan.hari_id', '@');
    //     $builder->groupEnd();
    //     $builder->where('sm.smr_id IS NULL');
    //     $builder->orderBy('ruangan_alias', 'ASC');
    //     return $builder->get()->getResultArray();
    // }

    public function semuaRuanganTerpakai()
    {
        if(session()->get('tanggal_pencarian_pemakaian_ruangan'))
        {
            $tanggal = session()->get('tanggal_pencarian_pemakaian_ruangan');
            $build = $this->db->query(
                "SELECT smr_nim_m, smr_hari, hari.hari_nama as nama_hari, smr_tanggal, smr_sesi, seminar_sesi.jam_alias as nama_sesi, smr_ruangan, seminar_ruangan.ruangan_alias as nama_ruangan, 'Seminar' AS jenis_pemakaian
                FROM seminar
                INNER JOIN hari ON seminar.smr_hari = hari.hari_id
                INNER JOIN seminar_sesi ON seminar.smr_sesi = seminar_sesi.seminar_s_id
                INNER JOIN seminar_ruangan ON seminar.smr_ruangan = seminar_ruangan.seminar_r_id
                WHERE 
                    smr_status = 5
                    and smr_tanggal = '".$tanggal."'
                UNION ALL 
                SELECT us_nim_m, us_hari, hari.hari_nama as nama_hari, us_tanggal, us_sesi, seminar_sesi.jam_alias as nama_sesi, us_ruangan, seminar_ruangan.ruangan_alias as nama_ruangan, 'Ujian Skripsi' AS jenis_pemakaian
                FROM ujian_skripsi 
                INNER JOIN hari ON ujian_skripsi.us_hari = hari.hari_id
                INNER JOIN seminar_sesi ON ujian_skripsi.us_sesi = seminar_sesi.seminar_s_id
                INNER JOIN seminar_ruangan ON ujian_skripsi.us_ruangan = seminar_ruangan.seminar_r_id
                WHERE 
                    us_status = 5
                    and us_tanggal = '".$tanggal."'");
            $result = $build->getResultArray();
        }else {
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
        }
        return $result;    
    }
}