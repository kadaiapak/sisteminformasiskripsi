<?php

namespace App\Controllers;

use App\Models\ProfilModel;

class Mahasiswa extends BaseController
{
    protected $profilModel;
    public function __construct()
    {
        $this->profilModel = new ProfilModel();

    }

    public function index()
    {
        $semuaMahasiswa = $this->profilModel->getAll();
        $data = [
            'judul' => 'Data Mahasiswa',
            'semua_mahasiswa' => $semuaMahasiswa
        ];
        return view('mahasiswa/v_mahasiswa', $data);
    }
   
}
