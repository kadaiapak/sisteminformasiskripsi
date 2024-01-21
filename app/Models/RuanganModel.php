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
}