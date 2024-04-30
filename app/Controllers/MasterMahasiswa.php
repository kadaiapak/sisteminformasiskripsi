<?php

namespace App\Controllers;

use App\Models\ProfilModel;
// use App\Models\ProgresSkripsiModel;

// model untuk detail mahasiswa
// use App\Models\MengikutiSeminarModel;
// use App\Models\SkripsiModel;
// use App\Models\BimbinganModel;
// use App\Models\SeminarModel;
// use App\Models\UjianSkripsiModel;
// model untuk detail seminar
// use App\Models\FilePersyaratanSeminarModel;

class MasterMahasiswa extends BaseController
{
    protected $profilModel;
    // protected $progresSkripsiModel;
    // protected $mengikutiSeminarModel;
    // protected $skripsiModel;
    // protected $bimbinganModel;
    // protected $seminarModel;
    // protected $ujianSkripsiModel;
    // protected $filePersyaratanSeminarModel;

    public function __construct()
    {
        helper('form');
        $this->profilModel = new ProfilModel();
        // $this->progresSkripsiModel = new ProgresSkripsiModel();
        // $this->mengikutiSeminarModel = new MengikutiSeminarModel();
        // $this->skripsiModel = new SkripsiModel();
        // $this->bimbinganModel = new BimbinganModel();
        // $this->seminarModel = new SeminarModel();
        // $this->ujianSkripsiModel = new UjianSkripsiModel();
        // $this->filePersyaratanSeminarModel = new FilePersyaratanSeminarModel();
    }

    public function index()
    {
        $semuaMahasiswa = $this->profilModel->getAll();
        $data = [
            'judul' => 'Data Master Mahasiswa',
            'semuaMahasiswa' => $semuaMahasiswa
        ];
        return view('master_mahasiswa/v_master_mahasiswa', $data);
    }

    public function bermasalah_idpdpt()
    {
        $semuaMahasiswa = $this->profilModel->getNullDepartemen();
        $data = [
            'judul' => 'Data Master Mahasiswa',
            'semuaMahasiswa' => $semuaMahasiswa
        ];
        return view('master_mahasiswa/v_master_mahasiswa_bermasalah_idpdpt', $data);
    }

    public function detail($nim)
    {
        if($nim != null) {
            $satuMahasiswa = $this->profilModel->getDetailMahasiswa($nim);
            if (!$satuMahasiswa) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            } else {
                $data = [
                    'judul' => 'Detail Master Mahasiswa',
                    'satuMahasiswa' => $satuMahasiswa,
                ];
                return view('master_mahasiswa/v_detail_master_mahasiswa', $data);
            }   
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function edit($nim)
    {
        if($nim != null) {
            $satuMahasiswa = $this->profilModel->getDetailUntukEditMahasiswa($nim);
            if (!$satuMahasiswa) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            } else {
                $data = [
                    'judul' => 'Detail Master Mahasiswa',
                    'satuMahasiswa' => $satuMahasiswa,
                ];
                return view('master_mahasiswa/v_edit_master_mahasiswa', $data);
            }   
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function update($nim = ''){
        if($nim == ''){
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        if(!$this->validate([
            'idpdpt' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tuliskan IDPDPT'
                ]
            ],
        ])){
            return redirect()->back()->withInput();
        }
        date_default_timezone_set('ASIA/JAKARTA');
        $tanggalEditAdmin = date('Y-m-d H:i:s');
        $data = array(
            'idpdpt' => $this->request->getVar('idpdpt'),
            'edit_by_admin' => 1,
            'tanggal_edit_admin' => $tanggalEditAdmin,
        );
        $this->profilModel->update($nim, $data);
        return redirect()->to('/master-mahasiswa')->with('sukses','Data berhasil diubah!');
    }
}
