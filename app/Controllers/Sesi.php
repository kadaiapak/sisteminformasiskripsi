<?php

namespace App\Controllers;
use App\Models\SesiModel;


class Sesi extends BaseController
{
    protected $sesiModel;
    public function __construct()
    {
        helper('form');
        $this->sesiModel = new SesiModel();
    }

    public function index()
    {
        $semuaSesi = $this->sesiModel->findAll();
        $data = [
            'judul' => 'Sesi',
            'semua_sesi' => $semuaSesi
        ];
        return view('sesi/v_sesi', $data);
    }
    
    public function tambah()
    {
        $data = [
            'judul' => 'Tambah Sesi'
        ];
        return view('sesi/v_tambah_sesi', $data);
    }

    public function simpan()
    {
        if(!$this->validate([
            'jam_alias' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Inputkan nama sesi'
                ]
            ]
        ])){
            return redirect()->back()->withInput();
        }
        $data = array(
            'jam_alias' => $this->request->getVar('jam_alias'),
            'status_sesi' => 1,
        );
        $this->sesiModel->insert($data);
        return redirect()->to('/sesi')->with('sukses','Data berhasil disimpan!');
    }

    public function aktif($id = '') 
    {
        if($id == '') {
            return redirect()->to('sesi')->with('gagal', 'Masukkan ID sesi');
        }
        $this->sesiModel->where('seminar_r_id', $id)->set(['sesi_status'] == 1)->update();
        return redirect()->to('sesi')->with('sukses', 'Status sesi berhasil diubah');
    }

    public function nonaktif($id = '') 
    {
        if($id == '') {
            return redirect()->to('sesi')->with('gagal', 'Masukkan ID sesi');
        }
        $this->sesiModel->where('seminar_r_id', $id)->set(['sesi_status'] == 0 )->update();
        return redirect()->to('sesi')->with('sukses', 'Status sesi berhasil diubah');

    }

    public function pemakaian_sesi()
    {
        $dataRuangan = $this->sesiModel->getDaftarPemakaianRuangan();
        $data = [
            'judul' => 'Daftar Pemakaian Ruangan'
        ];
        return view('sesi/v_pemakaian_sesi', $data);
    }
}
