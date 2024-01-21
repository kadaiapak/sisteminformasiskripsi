<?php

namespace App\Models;

use CodeIgniter\Model;

class MahasiswaStatusSkripsiModel extends Model
{
    protected $table = 'mahasiswa_status_skripsi';
    protected $primaryKey = 'mss_id';
    protected $allowedFields = [
    'mss_id',
    'nim',
    'status',
];
}