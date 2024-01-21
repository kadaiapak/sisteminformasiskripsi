<?php

namespace App\Controllers;
use App\Models\PersyaratanModel;


class Persyaratan extends BaseController
{
    protected $persyaratanModel;
    public function __construct()
    {
        helper('form');
        $this->persyaratanModel = new PersyaratanModel();
    }

    public function index()
    {
        $semuaPersyaratan = $this->persyaratanModel->findAll();
        $data = [
            'judul' => 'Persyaratan',
            'semua_persyaratan' => $semuaPersyaratan
        ];
        return view('persyaratan/v_persyaratan', $data);
    }
    
    public function tambah()
    {
        $data = [
            'judul' => 'Tambah Persyaratan'
        ];
        return view('persyaratan/v_tambah_persyaratan', $data);
    }

    public function simpan()
    {
        if(!$this->validate([
            'ps_nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tuliskan nama persyaratan'
                ]
            ],
            'ps_keterangan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jelaskan persyaratan yang dimaksud'
                ]
            ],
            'ps_tipe_file' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih tipe persyaratan'
                ]
            ],
            'ps_ukuran_file' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih ukuran file persyaratan'
                ]
            ]
        ])){
            return redirect()->back()->withInput();
        }
        $ps_alias = $this->alias($this->request->getVar('ps_nama'));
        $data = array(
            'ps_nama' => $this->request->getVar('ps_nama'),
            'ps_alias' => $ps_alias,
            'ps_keterangan' => $this->request->getVar('ps_keterangan'),
            'ps_tipe_file' => $this->request->getVar('ps_tipe_file'),
            'ps_ukuran_file' => $this->request->getVar('ps_ukuran_file'),
            'ps_status' => 1,
        );
        $this->persyaratanModel->insert($data);
        return redirect()->to('/persyaratan')->with('sukses','Data berhasil disimpan!');
    }

    // digunakan untuk membuat persyaratan_alias
    function alias($input){
        $string = preg_replace('/[^\da-z ]/i', '', $input);
        $string = str_replace(' ', '_', $string); // Replaces all spaces with hyphens.
        $string = strtolower($string); // Replaces all spaces with hyphens.
        return $string; // Replaces multiple hyphens with single one.
    }
}
