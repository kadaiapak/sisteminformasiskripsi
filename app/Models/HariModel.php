<?php

namespace App\Models;

use CodeIgniter\Model;

class HariModel extends Model
{
    protected $table = 'hari';
    protected $primaryKey = 'hari_id';

    protected $allowedFields = [
    'hari_id',
    'hari_nama',
];

  public function getAllHari()
  {
    $builder = $this->db->table('hari');
    $builder->select('hari.*');
    $builder->orderBy('hari_id','ASC');
    $result = $builder->get();
    return $result->getResultArray();
  }

  public function getHariDepartemen()
  {
    $builder = $this->db->table('hari');
    $builder->select('hari.*');
    $result = $builder->get();
    return $result->getResultArray();
  }

  // public function getHariDepartemen($idDepartemen = null)
  // {
  //   $builder = $this->db->table('hari');
  //   $builder->select('hari.*');
  //   $builder->join('penjadwalan_ruangan','hari.hari_id = penjadwalan_ruangan.hari_id');
  //   $builder->where('penjadwalan_ruangan.departemen_id', $idDepartemen);
  //   $builder->distinct();
  //   $result = $builder->get();
  //   return $result->getResultArray();
  // }
}