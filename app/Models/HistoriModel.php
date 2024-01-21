<?php

namespace App\Models;

use CodeIgniter\Model;

class HistoriModel extends Model
{
    protected $table = 'histori_skripsi';
    protected $primaryKey = 'hostori_id';

    protected $useTimestamps = true;
    protected $allowedFields = [
    'histori_skripsi_id',
    'histori_nim',
    'histori_status',
    'histori_keterangan',
    'dilihat',
  ];

  

}