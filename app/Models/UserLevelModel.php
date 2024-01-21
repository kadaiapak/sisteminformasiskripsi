<?php

namespace App\Models;

use CodeIgniter\Model;

class UserLevelModel extends Model
{
    protected $table = 'user_level';
    protected $primaryKey = 'user_level_id  ';
    protected $useTimestamps = true;
    protected $allowedFields = [
    'user_level_nama',
    'user_level_alias',
    'user_level_keterangan',
    'user_level_status',
    ];
}