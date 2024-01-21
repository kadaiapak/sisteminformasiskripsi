<?php

namespace App\Models;

use CodeIgniter\Model;

class SesiModel extends Model
{
    protected $table = 'seminar_sesi';
    protected $primaryKey = 'smr_s_id';
    protected $allowedFields = [
    'smr_s_id',
    'jam_mulai',
    'jam_selesai',
    'jam_alias',
    'status_sesi'
];
}