<?php

namespace App\Controllers;
use App\Models\PenjadwalanRuanganModel;
use App\Models\DepartemenModel;
use App\Models\RuanganModel;
use App\Models\SesiModel;


class PenjadwalanRuangan extends BaseController
{
    protected $penjadwalanRuanganModel;
    protected $departemenModel;
    protected $ruanganModel;
    protected $sesiModel;
    public function __construct()
    {
        helper('form');
        $this->penjadwalanRuanganModel = new PenjadwalanRuanganModel();
        $this->departemenModel = new DepartemenModel();
        $this->ruanganModel = new RuanganModel();
        $this->sesiModel = new SesiModel();
    }

    public function index()
    {
         $penjadwalan_ruangan = $this->penjadwalanRuanganModel->getJadwalRuangan();
        $data = [
            'judul' => 'Persyaratan',
            'penjadwalan_ruangan' => $penjadwalan_ruangan,
        ];
        return view('penjadwalan_ruangan/v_penjadwalan_ruangan', $data);
    }

    public function edit($id = '')
    {
        if($id == '') {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $satuJadwal = $this->penjadwalanRuanganModel->getSingleJadwalRuangan($id);
        $semuaRuangan = $this->ruanganModel->findAll();
        $semuaDepartemen = $this->departemenModel->findAll();
        $semuaSesi = $this->sesiModel->findAll();
        $data = [
            'judul' => 'Edit Penjadwalan Ruangan',
            'satu_jadwal' => $satuJadwal,
            'ruangan' => $semuaRuangan,
            'departemen' => $semuaDepartemen,
            'sesi' => $semuaSesi
        ];
        return view('penjadwalan_ruangan/v_edit_penjadwalan_ruangan', $data);
    }

    public function tambah()
    {
        $semuaRuangan = $this->ruanganModel->findAll();
        $semuaDepartemen = $this->departemenModel->findAll();
        $semuaSesi = $this->sesiModel->findAll();
        $data = [
            'judul' => 'Tambah Penjadwalan Ruangan',
            'ruangan' => $semuaRuangan,
            'departemen' => $semuaDepartemen,
            'sesi' => $semuaSesi
        ];
        return view('penjadwalan_ruangan/v_tambah_penjadwalan_ruangan', $data);
    }

    public function update($id)
    {
        if(!$this->validate([
            'departemen_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih departemen'
                ]
            ],      
            'ruangan_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih ruangan'
                ]
            ],      
            'hari_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih hari'
                ]
            ],      
            'sesi_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih sesi'
                ]
            ]
        ])){
            return redirect()->back()->withInput();
        }
        $sesi = $this->request->getVar('sesi_id');
        if($sesi ==  0 ){
            $sesidua= null;
        }else {
            $sesidua = $sesi;
        }
        dd($sesidua);
        $data = array(
            'departemen_id' => $this->request->getVar('departemen_id'),
            'ruangan_id' => $this->request->getVar('ruangan_id'),
            'hari_id' => $this->request->getVar('hari_id'),
            'sesi_id' => $sesidua,
        );
        $this->penjadwalanRuanganModel->insert($data);
        return redirect()->to('/ruangan/penjadwalan-ruangan')->with('sukses','Data berhasil disimpan!');
    }

    public function simpan()
    {
        if(!$this->validate([
            'departemen_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih departemen'
                ]
            ],      
            'ruangan_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih ruangan'
                ]
            ],      
            'hari_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih hari'
                ]
            ],      
            'sesi_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih sesi'
                ]
            ]
        ])){
            return redirect()->back()->withInput();
        }
        $sesi = $this->request->getVar('sesi_id');
        if($sesi ==  0 ){
            $sesidua= null;
        }else {
            $sesidua = $sesi;
        }
        $data = array(
            'departemen_id' => $this->request->getVar('departemen_id'),
            'ruangan_id' => $this->request->getVar('ruangan_id'),
            'hari_id' => $this->request->getVar('hari_id'),
            'sesi_id' => $sesidua,
        );
        $this->penjadwalanRuanganModel->insert($data);
        return redirect()->to('/ruangan/penjadwalan-ruangan')->with('sukses','Data berhasil disimpan!');
    }

    // public function penjadwalan_ruangan()
    // {
    // $penjadwalan_ruangan = $this->penjadwalanRuanganModel->getJadwalRuangan();
    // dd($penjadwalan_ruangan);
    //     $data = [
    //         'judul' => 'Penjawdalan Ruangan'
    //     ];
    //     return view('ruangan/v_penjadwalan_ruangan', $data);
    // }
    
    // public function detail($idDepartemen)
    // {
    //     $persyaratanDipakai = $this->persyaratanSeminarModel->getAllPersyartanSeminarDipakai($idDepartemen);
    //     $departemen = $this->departemenModel->find($idDepartemen);
    //     $semuaPersyaratan = $this->persyaratanModel->findAll();
    //     $data = [
    //         'judul' => 'Detail Persyaratan',
    //         'nama_departemen' => $departemen['departemen_nama'],
    //         'semua_persyaratan' => $semuaPersyaratan,
    //         'persyaratan_dipakai' => $persyaratanDipakai,
    //         'id_departemen' => $idDepartemen
    //     ];
    //     return view('persyaratan_seminar/v_detail_persyaratan_seminar', $data);
    // }

    
}
