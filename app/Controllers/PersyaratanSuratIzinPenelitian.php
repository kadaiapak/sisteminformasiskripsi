<?php

namespace App\Controllers;
use App\Models\PersyaratanSuratIzinPenelitianModel;
use App\Models\DepartemenModel;
use App\Models\PersyaratanModel;


class PersyaratanSuratIzinPenelitian extends BaseController
{
    protected $persyaratanSuratIzinPenelitianModel;
    protected $departemenModel;
    protected $persyaratanModel;
    public function __construct()
    {
        helper('form');
        $this->persyaratanSuratIzinPenelitianModel = new PersyaratanSuratIzinPenelitianModel();
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
        return view('persyaratan_surat_izin_penelitian/v_persyaratan_surat_izin_penelitian', $data);
    }
    
    public function detail($idDepartemen)
    {
        $persyaratanDipakai = $this->persyaratanSuratIzinPenelitianModel->getAllPersyartanSeminarDipakai($idDepartemen);
        $departemen = $this->departemenModel->find($idDepartemen);
        $semuaPersyaratan = $this->persyaratanModel->findAll();
        $data = [
            'judul' => 'Detail Persyaratan',
            'nama_departemen' => $departemen['departemen_nama'],
            'semua_persyaratan' => $semuaPersyaratan,
            'persyaratan_dipakai' => $persyaratanDipakai,
            'id_departemen' => $idDepartemen
        ];
        return view('persyaratan_surat_izin_penelitian/v_detail_persyaratan_surat_izin_penelitian', $data);
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
        $this->persyaratanSuratIzinPenelitianModel->editPersyaratanSuratIzinPenelitian($x, $id_departemen);  
        return redirect()->to("/persyaratan-surat-izin-penelitian/detail/$id_departemen")->with('sukses','Data berhasil diubah!');
    }
}
