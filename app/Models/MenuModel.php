<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model
{
    protected $table = 'menu';
    protected $primaryKey = 'menu_id';
    protected $allowedFields = [
    'menu_nama',
    'menu_url',
    'menu_icon',
    'menu_level',
    'menu_main_menu',
    'menu_pemisah',
    'is_aktif',
    'is_tampil',
    ];
}