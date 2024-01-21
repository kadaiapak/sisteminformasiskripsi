<?php

namespace App\Models;

use CodeIgniter\Model;

class PersyaratanModel extends Model
{
    protected $table = 'persyaratan';
    protected $primaryKey = 'persyaratan_id';
    protected $useTimestamps = true;
    protected $allowedFields = [
    'ps_nama',
    'ps_alias',
    'ps_keterangan',
    'ps_tipe_file',
    'ps_ukuran_file',
    'ps_status',
    ];
}