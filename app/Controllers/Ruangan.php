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

    // untuk lihat ruangan terpakai
    // akses oleh mahasiswa, admin departemen, dan kepala departemen
    // GET /daftar-ruangan-terpakai  
    public function daftar_ruangan_terpakai()
    {
        $semuaRuanganTerpakai = $this->ruanganModel->semuaRuanganTerpakai();
        $data = [
            'judul' => 'Daftar Ruangan Terpakai',
            'semua_ruangan_terpakai' => $semuaRuanganTerpakai
        ];
        return view('ruangan/v_ruangan_terpakai', $data);
    }

    // untuk lihat pencarian ruangan berdasarkan tanggal
    // akses oleh mahasiswa, admin departemen, dan kepala departemen
    // GET /ruangan/cari
    public function cari()
    {
        $tanggal_pencarian_pemakaian_ruangan = $this->request->getVar('tanggal');
        session()->set('tanggal_pencarian_pemakaian_ruangan', $tanggal_pencarian_pemakaian_ruangan);
        return redirect()->to('daftar-ruangan-terpakai');
    }

    // untuk hapus pencarian ruangan berdasarkan tanggal
    // akses oleh mahasiswa, admin departemen, dan kepala departemen
    // GET /ruangan/hapus-cari
    public function hapus_cari()
    {
        session()->remove('tanggal_pencarian_pemakaian_ruangan');
        return redirect()->to('daftar-ruangan-terpakai');   
    }
}
