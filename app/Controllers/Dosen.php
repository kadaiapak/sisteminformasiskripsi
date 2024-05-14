<?php

namespace App\Controllers;

use App\Models\SkripsiModel;
use App\Models\DosenModel;

class Dosen extends BaseController
{
    protected $skripsiModel;
    protected $dosenModel;
    public function __construct()
    {
        $this->skripsiModel = new SkripsiModel();
        $this->dosenModel = new DosenModel();
    }

    public function index()
    {
        $departemen = session()->get('departemen');
        $semuaDosen = $this->dosenModel->getAll($departemen);
        $data = [
            'judul' => 'Dosen Pembimbing',
            'semua_dosen' => $semuaDosen
        ];
        return view('dosen_pembimbing/v_dosen_pembimbing', $data);
    }
   
}
