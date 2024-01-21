<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdiModel extends Model
{
    protected $table = 'prodi';
    protected $primaryKey = 'prodi_id  ';
    protected $useTimestamps = true;
    protected $allowedFields = [
    'prodi_nama',
    'prodi_jp',
    'dep_id',
    'created_by',
    ];
}