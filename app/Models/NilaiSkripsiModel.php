<?php

namespace App\Models;

use CodeIgniter\Model;

class NilaiSkripsiModel extends Model
{
    protected $table = 'nilai_ujian_skripsi';
    protected $primaryKey = 'id';

    protected $useTimestamps = true;
    protected $allowedFields = [
    'id',
    'ujian_skripsi_uuid',
    'user_penilai',
    'role_user_penilai',
    'urutan',
    'perumusan_masalah',
    'perumusan_masalah_bobot',
    'perumusan_masalah_total',
    'tinjauan_pustaka',
    'tinjauan_pustaka_bobot',
    'tinjauan_pustaka_total',
    'pengumpulan_data',
    'pengumpulan_data_bobot',
    'pengumpulan_data_total',
    'kesesuaian_desain',
    'kesesuaian_desain_bobot',
    'kesesuaian_desain_total',
    'kerangka_konseptual',
    'kerangka_konseptual_bobot',
    'kerangka_konseptual_total',
    'logika_penulisan',
    'logika_penulisan_bobot',
    'logika_penulisan_total',
    'orisinalitas',
    'orisinalitas_bobot',
    'orisinalitas_total',
    'kesimpulan_dan_saran',
    'kesimpulan_dan_saran_bobot',
    'kesimpulan_dan_saran_total',
    'penyajian',
    'penyajian_bobot',
    'penyajian_total',
    'mempertahankan_skripsi',
    'mempertahankan_skripsi_bobot',
    'mempertahankan_skripsi_total',
    'jumlah',
    'nilai_akhir',
    'status_nilai',
];

public function getNilaiByUjianId($UUIDUjian = null)
    {
        $builder = $this->db->table('nilai_ujian_skripsi');
        $builder->select('nilai_ujian_skripsi.*, fip_dosen_pa.nidn as d_nidn, fip_dosen_pa.peg_gel_dep as d_peg_gel_dep, fip_dosen_pa.peg_nama as d_peg_nama, fip_dosen_pa.peg_gel_bel as d_peg_gel_bel,');
        $builder->join('fip_dosen as fip_dosen_pa', 'fip_dosen_pa.nidn = nilai_ujian_skripsi.user_penilai');
        $builder->where('ujian_skripsi_uuid', $UUIDUjian);
        $builder->orderBy('urutan', 'asc');
        $hasil = $builder->get();
        return $hasil->getResultArray();
    }

    public function getDetailNilaiByDosen($UUIDUjian = null, $nidn = null)
    {
        $builder = $this->db->table('nilai_ujian_skripsi');
        $builder->select('*');
        $builder->where('ujian_skripsi_uuid', $UUIDUjian);
        $builder->where('user_penilai', $nidn);
        $hasil = $builder->get();
        return $hasil->getRowArray();
    }
} 