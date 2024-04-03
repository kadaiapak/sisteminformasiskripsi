<?php

namespace App\Controllers;
use App\Models\JadwalPengajuanJudulModel;


class JadwalPengajuanJudul extends BaseController
{
    protected $jadwalPengajuanJudulModel;
    public function __construct()
    {
        helper('form');
        $this->jadwalPengajuanJudulModel = new JadwalPengajuanJudulModel();
    }

    public function index()
    {
        $semuaJadwalDepartemen = $this->jadwalPengajuanJudulModel->getAll();
        $data = [
            'judul' => 'Jadwal Pengajuan Judul Skripsi Semua Departemen',
            'semua_jadwal_departemen' => $semuaJadwalDepartemen
        ];
        return view('jadwal_pengajuan_judul/v_jadwal', $data);
    }

    public function edit($id = null)
    {
        if($id != null) {
            $satu_jadwal = $this->jadwalPengajuanJudulModel->getDetail($id);
            if (!$satu_jadwal) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            } else {
                if($satu_jadwal['departemen_id'] != session()->get('departemen')){
                    throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
                }
                $data = [
                    'judul' => 'Edit Jadwal Pengajuan Judul',
                    'satu_jadwal' => $satu_jadwal,
                ];
                return view('jadwal_pengajuan_judul/v_edit_jadwal', $data);
            }   
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
    
    public function simpan_pembaruan(){
        if(!$this->validate([
            'apakah_buka' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih apakah pengajuan dibuka atau tidak'
                ]
            ],
            'mulai_pengajuan_judul' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih tanggal judul mulai diajukan'
                ]
            ],
            'akhir_pengajuan_judul' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih tanggal pengajuan judul ditutup'
                ]
            ],
        ])){
            return redirect()->back()->withInput();
        }
        $jadwal_id = $this->request->getVar('jadwal_id');
        $departemen_id = $this->request->getVar('departemen_id');
        if($departemen_id != session()->get('departemen')){
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $data = array(
            'departemen_id' => $departemen_id,
            'apakah_buka' => $this->request->getVar('apakah_buka'),
            'mulai_pengajuan_judul' => $this->request->getVar('mulai_pengajuan_judul'),
            'akhir_pengajuan_judul' => $this->request->getVar('akhir_pengajuan_judul'),
        );
        $this->jadwalPengajuanJudulModel->where('jadwal_id', $jadwal_id)->set($data)->update();
        return redirect()->to('/jadwal-pengajuan-judul')->with('sukses','Data berhasil diubah!');
    }
}
