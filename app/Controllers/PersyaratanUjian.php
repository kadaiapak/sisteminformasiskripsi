<?php

namespace App\Controllers;
use App\Models\PersyaratanUjianModel;
use App\Models\DepartemenModel;
use App\Models\PersyaratanModel;


class PersyaratanUjian extends BaseController
{
    protected $persyaratanUjianModel;
    protected $departemenModel;
    protected $persyaratanModel;
    public function __construct()
    {
        helper('form');
        $this->persyaratanUjianModel = new PersyaratanUjianModel();
        $this->departemenModel = new DepartemenModel();
        $this->persyaratanModel = new PersyaratanModel();
    }

    public function index()
    {
        $semuaDepartemen = $this->departemenModel->findAll();
        $data = [
            'judul' => 'Persyaratan',
            'semua_departemen' => $semuaDepartemen,
        ];
        return view('persyaratan_ujian/v_persyaratan_ujian', $data);
    }

    public function detail($idDepartemen)
    {
        $persyaratanDipakai = $this->persyaratanUjianModel->getAllPersyartanUjianDipakai($idDepartemen);
        $departemen = $this->departemenModel->find($idDepartemen);
        $semuaPersyaratan = $this->persyaratanModel->findAll();
        $data = [
            'judul' => 'Detail Persyaratan',
            'nama_departemen' => $departemen['departemen_nama'],
            'semua_persyaratan' => $semuaPersyaratan,
            'persyaratan_dipakai' => $persyaratanDipakai,
            'id_departemen' => $idDepartemen
        ];
        return view('persyaratan_ujian/v_detail_persyaratan_ujian', $data);
    }

    public function simpan_edit()
    {
        $id_departemen = $this->request->getVar('id_departemen');
        $dasar = $this->request->getVar();
        $x = array();
        foreach ($dasar as $key => $value) {
            $editKey = explode('_', $key);
            if($editKey['0'] == 'dipakai'){
                $x[$editKey['1']] = $value;
            }
        }
        $this->persyaratanUjianModel->editPersyaratanUjian($x, $id_departemen);  
        return redirect()->to("/persyaratan-ujian/detail/$id_departemen")->with('sukses','Data berhasil diubah!');
    }
}
