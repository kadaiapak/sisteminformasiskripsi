<?php

namespace App\Controllers;
use App\Models\RuanganModel;
use App\Models\PenjadwalanRuanganModel;


class Ruangan extends BaseController
{
    protected $ruanganModel;
    public function __construct()
    {
        helper('form');
        $this->ruanganModel = new RuanganModel();
        $this->penjadwalanRuanganModel = new PenjadwalanRuanganModel();
    }

    public function index()
    {
        $semuaRuangan = $this->ruanganModel->findAll();
        $data = [
            'judul' => 'Ruangan',
            'semua_ruangan' => $semuaRuangan
        ];
        return view('ruangan/v_ruangan', $data);
    }
    
    public function tambah()
    {
        $data = [
            'judul' => 'Tambah Ruangan'
        ];
        return view('ruangan/v_tambah_ruangan', $data);
    }

    public function simpan()
    {
        if(!$this->validate([
            'ruangan_alias' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Inputkan nama ruangan'
                ]
            ],
            'ruangan_keterangan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jelaskan lokasi ruangan'
                ]
            ]
        ])){
            return redirect()->back()->withInput();
        }
        $data = array(
            'ruangan_alias' => $this->request->getVar('ruangan_alias'),
            'ruangan_keterangan' => $this->request->getVar('ruangan_keterangan'),
            'ruangan_status' => 1,
        );
        $this->ruanganModel->insert($data);
        return redirect()->to('/ruangan')->with('sukses','Data berhasil disimpan!');
    }

    public function aktif($id = '') 
    {
        if($id == '') {
            return redirect()->to('ruangan')->with('gagal', 'Masukkan ID ruangan');
        }
        $this->ruanganModel->where('seminar_r_id', $id)->set(['ruangan_status'] == 1)->update();
        return redirect()->to('ruangan')->with('sukses', 'Status ruangan berhasil diubah');
    }

    public function nonaktif($id = '') 
    {
        if($id == '') {
            return redirect()->to('ruangan')->with('gagal', 'Masukkan ID ruangan');
        }
        $this->ruanganModel->where('seminar_r_id', $id)->set(['ruangan_status'] == 0 )->update();
        return redirect()->to('ruangan')->with('sukses', 'Status ruangan berhasil diubah');

    }

    public function pemakaian_ruangan()
    {
        $data = [
            'judul' => 'Daftar Pemakaian Ruangan'
        ];
        return view('ruangan/v_pemakaian_ruangan', $data);
    }

    
}
