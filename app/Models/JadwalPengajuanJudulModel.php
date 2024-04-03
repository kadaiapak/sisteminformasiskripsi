<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalPengajuanJudulModel extends Model
{
    protected $table = 'departemen_jadwal_pengajuan_judul';
    protected $primaryKey = 'jadwal_id';
    protected $allowedFields = [
    'departemen_id',
    'apakah_buka',
    'mulai_pengajuan_judul',
    'akhir_pengajuan_judul',
    'is_aktif',
    ];

    public function getAll()
    {   
        $builder = $this->db->table('departemen_jadwal_pengajuan_judul');
        $builder->select('departemen_jadwal_pengajuan_judul.*,departemen.departemen_nama as nama_departemen');
        $builder->join('departemen', 'departemen_jadwal_pengajuan_judul.departemen_id = departemen.departemen_id');
        $query = $builder->get();
        return $query->getResultArray(); 
    }

    public function getDetail($id)
    {   
        $builder = $this->db->table('departemen_jadwal_pengajuan_judul');
        $builder->select('departemen_jadwal_pengajuan_judul.*,departemen.departemen_nama as nama_departemen');
        $builder->join('departemen', 'departemen_jadwal_pengajuan_judul.departemen_id = departemen.departemen_id');
        $builder->where('jadwal_id', $id);
        $query = $builder->get();
        return $query->getRowArray(); 
    }

    public function getDetailByDepartemen($idDepartemen)
    {   
        $builder = $this->db->table('departemen_jadwal_pengajuan_judul');
        $builder->select('departemen_jadwal_pengajuan_judul.*,departemen.departemen_nama as nama_departemen');
        $builder->join('departemen', 'departemen_jadwal_pengajuan_judul.departemen_id = departemen.departemen_id');
        $builder->where('departemen_jadwal_pengajuan_judul.departemen_id', $idDepartemen);
        $query = $builder->get();
        return $query->getRowArray(); 
    }
}