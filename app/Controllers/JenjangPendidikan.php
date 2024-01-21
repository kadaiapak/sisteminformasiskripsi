<?php

namespace App\Controllers;
use App\Models\JenjangModel;

class Jenjang extends BaseController
{
    protected $jenjangPendidikanModel;
    public function __construct()
    {
        helper('form');
        $this->jenjangModel = new JenjangModel();
    }

    public function index()
    {
        $semuaProdi = $this->prodiModel->findAll();
        $data = [
            'judul' => 'Prodi',
            'semua_prodi' => $semuaProdi
        ];
        return view('prodi/v_prodi', $data);
    }
    
    public function tambah()
    {
        $semuaDepartemen = $this->departemenModel->findAll();
        $data = [
            'judul' => 'Tambah Prodi',
            'departemen' => $semuaDepartemen,
        ];
        return view('prodi/v_tambah_prodi', $data);
    }

    public function simpan()
    {
        if(!$this->validate([
            'prodi_nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Inputkan nama prodi'
                ]
            ],
            'prd_jp' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih Jenjang Pendidikan'
                ]
            ],
            'dep_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih Departemen'
                ]
            ],
        ])){
            return redirect()->back()->withInput();
        }
        $data = array(
            'prd_nama' => $this->request->getVar('prd_nama'),
            'prd_jp' => $this->request->getVar('prd_jp'),
            'dep_id' => $this->request->getVar('dep_id'),
            'prd_status' => 1
        );
        $this->prodiModel->insert($data);
        return redirect()->to('/prodi')->with('sukses','Data berhasil disimpan!');
    }

    public function edit($id = '')
    {
        if($id == '') {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $data = [
            'judul' => 'Edit Prodi',
            'prodi_by_id' => $this->prodiModel->find($id)
        ];
        return view('prodi/v_edit_prodi', $data);
    }

    public function update($id = ''){
        if($id == ''){
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        if(!$this->validate([
            'prodi_nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Inputkan nama prodi'
                ]
            ],
            'prodi_email' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Inputkan email prodi'
                ]
            ],
            'prodi_website' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Inputkan website prodi'
                ]
            ],
            'prodi_kd_surat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Inputkan kode surat prodi, contoh : /UN35.4.3/AK/'
                ]
            ],
            'prodi_nm_kadep' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tuliskan Nama Kepala Prodi'
                ]
            ],
            'prodi_nip_kadep' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tuliskan NIP Kepala Prodi'
                ]
            ],
        ])){
            return redirect()->back()->withInput();
        }

        $data = array(
            'prodi_nama' => $this->request->getVar('prodi_nama'),
            'prodi_alias' => $this->request->getVar('prodi_alias'),
            'prodi_email' => $this->request->getVar('prodi_email'),
            'prodi_website' => $this->request->getVar('prodi_website'),
            'prodi_kd_surat' => $this->request->getVar('prodi_kd_surat'),
            'prodi_nm_kadep' => $this->request->getVar('prodi_nm_kadep'),
            'prodi_nip_kadep' => $this->request->getVar('prodi_nip_kadep'),
            'prodi_status' => 1,
        );
        $this->prodiModel->update($id, $data);
        return redirect()->to('/prodi')->with('sukses','Data berhasil diubah!');
    }

}
