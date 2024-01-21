<?php

namespace App\Models;

use CodeIgniter\Model;

class PersyaratanUjianModel extends Model
{
    protected $table = 'departemen_syarat_ujian';
    protected $primaryKey = 'dsu_id';
    protected $allowedFields = [
    'departemen_id',
    'persyaratan_id',
    'wajib',
    ];

    public function getAllPersyartanUjianDipakai($idDepartemen)
    {
        $build = $this->db->query("SELECT psy.persyaratan_id, psy.ps_nama,psy.ps_keterangan, psy.ps_tipe_file, psy.ps_ukuran_file, ps2.wajib,
            CASE ps2.wajib
                WHEN 1 THEN 'Ya'
                WHEN 0 THEN 'Tidak'
                ELSE NULL
            END AS wajib,
            CASE 
                WHEN ps2.departemen_nama IS NULL THEN
                    NULL
                ELSE
                    'dipakai'
            END AS dipakai
            FROM 
                (SELECT psy.persyaratan_id, dsu.dsu_id, dpt.departemen_nama, dsu.wajib
                FROM persyaratan psy
                LEFT JOIN departemen_syarat_ujian dsu ON psy.persyaratan_id = dsu.persyaratan_id
                LEFT JOIN departemen dpt ON dsu.departemen_id = dpt.departemen_id
                WHERE dsu.departemen_id = $idDepartemen) ps2
            RIGHT JOIN persyaratan psy ON ps2.persyaratan_id = psy.persyaratan_id
            ");
        $result = $build->getResultArray(); 
        return $result;

    }

    public function editPersyaratanUjian($nilai = null, $id_departemen = '')
    {
        $builder = $this->db->table('departemen_syarat_ujian');
        $builder->where('departemen_id', $id_departemen);
        $builder->delete();
        foreach ($nilai as $key => $value) {
            if($value == 1) {
                $data = [
                    'departemen_id' => $id_departemen,
                    'persyaratan_id' => $key
                ];
                $builder = $this->db->table('departemen_syarat_ujian');
                $builder->insert($data);
            }
        }
    }
   
    public function getAllPersyaratanUjianOlehMahasiswa($idDepartemen)
    {
        $build = $this->db->query("SELECT psy.persyaratan_id, psy.ps_nama, psy.ps_alias,psy.ps_keterangan,psy.ps_tipe_file,psy.ps_ukuran_file, dsu.wajib
                FROM persyaratan psy
                JOIN departemen_syarat_ujian dsu ON psy.persyaratan_id = dsu.persyaratan_id
                WHERE dsu.departemen_id = $idDepartemen
                AND psy.ps_status = 1");
        $result = $build->getResultArray();
        return $result;
    }
}