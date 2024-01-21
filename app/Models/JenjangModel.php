<?php

namespace App\Models;

use CodeIgniter\Model;

class JenjangModel extends Model
{
    protected $table = 'jenjang_pendidikan';
    protected $primaryKey = 'jp_id  ';
    protected $allowedFields = [
    'jp_nama',
    'jp_status',
    ];
}