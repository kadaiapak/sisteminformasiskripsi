<?php

namespace App\Controllers;

use App\Models\ProfilModel;
use App\Models\ProgresSkripsiModel;

class Mahasiswa extends BaseController
{
    protected $profilModel;
    protected $progresSkripsiModel;
    public function __construct()
    {
        $this->profilModel = new ProfilModel();
        $this->progresSkripsiModel = new ProgresSkripsiModel();
    }

    public function index()
    {
        $semuaMahasiswa = $this->progresSkripsiModel->getAll();
        $data = [
            'judul' => 'Data Mahasiswa',
            'semua_mahasiswa' => $semuaMahasiswa
        ];
        return view('mahasiswa/v_mahasiswa', $data);
    }
   
}
