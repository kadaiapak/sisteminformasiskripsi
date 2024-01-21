<?php

namespace App\Models;

use CodeIgniter\Model;

class DepartemenModel extends Model
{
    protected $table = 'departemen';
    protected $primaryKey = 'departemen_id';
    protected $allowedFields = [
    'departemen_nama',
    'departemen_alias',
    'departemen_email',
    'departemen_website',
    'departemen_nm_kadep',
    'departemen_kd_surat',
    'departemen_nip_kadep',
    'departemen_status',
    ];
}