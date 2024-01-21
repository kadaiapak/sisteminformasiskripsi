<?php

namespace App\Models;

use CodeIgniter\Model;

class PenjadwalanRuanganModel extends Model
{
    protected $table = 'penjadwalan_ruangan';
    protected $primaryKey = 'penjadwalan_ruangan_id';
    protected $allowedFields = [
    'penjadwalan_ruangan_id',
    'departemen_id',
    'ruangan_id',
    'hari_id',
    'sesi_id',
    'tanggal',
    ];

    public function getJadwalRuangan()
    {
        $builder = $this->db->table('departemen');
        $builder->select('
        departemen.departemen_id,
        departemen.departemen_nama as nama_departemen,
        seminar_ruangan.ruangan_alias as nama_ruangan,
        hari.hari_nama as hari,
        seminar_sesi.jam_alias as sesi,
        penjadwalan_ruangan.penjadwalan_ruangan_id
       ');
        $builder->join('penjadwalan_ruangan', 'departemen.departemen_id = penjadwalan_ruangan.departemen_id');
        $builder->join('seminar_ruangan', 'penjadwalan_ruangan.ruangan_id = seminar_ruangan.seminar_r_id');
        $builder->join('hari', 'penjadwalan_ruangan.hari_id = hari.hari_id');
        $builder->join('seminar_sesi', 'penjadwalan_ruangan.sesi_id = seminar_sesi.seminar_s_id', 'left');
        $query = $builder->get();
        return $query->getResultArray(); 
    }

    public function getSingleJadwalRuangan($id = '')
    {
        $builder = $this->db->table('penjadwalan_ruangan');
        $builder->select('*');
        $builder->where('penjadwalan_ruangan_id', $id);
        $query = $builder->get();
        return $query->getRowArray(); 
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