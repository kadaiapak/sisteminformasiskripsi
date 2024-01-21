<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'user_id  ';
    protected $allowedFields = [
    'nama_asli',
    'nim',
    'username',
    'password',
    'user_foto',
    'useruuid',
    'departemen',
    'level',
    'terakhir_login',
    ];

    public function getAll()
    {
        $builder = $this->db->table('user');
        $builder->select('user.user_id, user.nama_asli, user.username, user.user_foto, user.is_aktif, user.is_login, user.terakhir_login,
        user_level.user_level_nama, departemen.departemen_nama');
        $builder->join('departemen','user.departemen = departemen.departemen_id', 'LEFT');
        $builder->join('user_level', 'user.level = user_level.user_level_id');
        $query = $builder->get();
        return $query->getResultArray(); 
    }

    public function getRekapUser()
    {
        $build = $this->db->query(
            'SELECT user.level, user_level.user_level_nama, COUNT(user_level.user_level_nama)AS total_user FROM user JOIN user_level ON user.level = user_level.user_level_id GROUP BY user.level');
        $result = $build->getResult();
        return $result;
    }


}