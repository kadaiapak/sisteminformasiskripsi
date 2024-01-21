<?php

namespace App\Controllers;
use App\Models\PersyaratanSeminarModel;
use App\Models\DepartemenModel;
use App\Models\PersyaratanModel;


class PersyaratanSeminar extends BaseController
{
    protected $persyaratanSeminarModel;
    protected $departemenModel;
    protected $persyaratanModel;
    public function __construct()
    {
        helper('form');
        $this->persyaratanSeminarModel = new PersyaratanSeminarModel();
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
        return view('persyaratan_seminar/v_persyaratan_seminar', $data);
    }
    
    public function detail($idDepartemen)
    {
        $persyaratanDipakai = $this->persyaratanSeminarModel->getAllPersyartanSeminarDipakai($idDepartemen);
        $departemen = $this->departemenModel->find($idDepartemen);
        $semuaPersyaratan = $this->persyaratanModel->findAll();
        $data = [
            'judul' => 'Detail Persyaratan',
            'nama_departemen' => $departemen['departemen_nama'],
            'semua_persyaratan' => $semuaPersyaratan,
            'persyaratan_dipakai' => $persyaratanDipakai,
            'id_departemen' => $idDepartemen
        ];
        return view('persyaratan_seminar/v_detail_persyaratan_seminar', $data);
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
        $this->persyaratanSeminarModel->editPersyaratanSeminar($x, $id_departemen);  
        return redirect()->to("/persyaratan-seminar/detail/$id_departemen")->with('sukses','Data berhasil diubah!');
    }
}
