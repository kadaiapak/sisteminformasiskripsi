<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'user_id';

    protected $useTimestamps = true;
    protected $allowedFields = ['nama_asli',
    'username',
    'password',
    'user_foto',
    'user_uuid',
    'level',
    'terakhir_login'];

    public function login($username)
    {
        $builder = $this->db->table('user');
        $builder->select('user.*,user_level.user_level_nama');
        $builder->join('user_level', 'user_level.user_level_id = user.level');
        $builder->where('username', $username);
        $query = $builder->get();
        return $query->getRowArray(); 

        // return $this->db->table('user')->where([
        //     'username' => $username
        // ])->get()->getRowArray();
    }
    public function loginDosen($username)
    {
        $builder = $this->db->table('user');
        $builder->select('user.*,user_level.user_level_nama');
        $builder->join('user_level', 'user.level = user_level.user_level_id');
        $builder->where('username', $username);
        $builder->where('level', '5');
        $query = $builder->get();
        return $query->getRowArray(); 

        // return $this->db->table('user')->where([
        //     'username' => $username,
        //     'level' => '5'
        // ])->get()->getRowArray();
    }
}