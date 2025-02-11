<?php

namespace App\Controllers;
use App\Models\DepartemenModel;


class Departemen extends BaseController
{
    protected $departemenModel;
    public function __construct()
    {
        helper('form');
        $this->departemenModel = new DepartemenModel();
    }

    public function index()
    {
        $semuaDepartemen = $this->departemenModel->findAll();
        $data = [
            'judul' => 'Departemen',
            'semua_departemen' => $semuaDepartemen
        ];
        return view('departemen/v_departemen', $data);
    }
    
    public function tambah()
    {
        $semuaDepartemen = $this->departemenModel->getAllOnly();

        $data = [
            'judul' => 'Tambah Departemen',
            'semuaDepartemen' => $semuaDepartemen
        ];
        return view('departemen/v_tambah_departemen', $data);
    }

    public function simpan()
    {
        if(!$this->validate([
            'departemen_nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Inputkan nama departemen'
                ]
            ],
            'departemen_email' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Inputkan email departemen'
                ]
            ],
            'departemen_website' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Inputkan website departemen'
                ]
            ],
            'departemen_kd_surat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Inputkan kode surat departemen, contoh : /UN35.4.3/AK/'
                ]
            ],
            'departemen_nm_kadep' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tuliskan Nama Kepala Departemen'
                ]
            ],
            'departemen_nip_kadep' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tuliskan NIP Kepala Departemen'
                ]
            ],
        ])){
            return redirect()->back()->withInput();
        }
        $data = array(
            'departemen_kd' => $this->request->getVar('departemen_kd'),
            'departemen_nama' => $this->request->getVar('departemen_nama'),
            'departemen_alias' => $this->request->getVar('departemen_alias'),
            'departemen_email' => $this->request->getVar('departemen_email'),
            'departemen_website' => $this->request->getVar('departemen_website'),
            'departemen_kd_surat' => $this->request->getVar('departemen_kd_surat'),
            'departemen_nm_kadep' => $this->request->getVar('departemen_nm_kadep'),
            'departemen_nip_kadep' => $this->request->getVar('departemen_nip_kadep'),
            'judul_kop_surat' => $this->request->getVar('judul_kop_surat'),
            'jabatan_penanda_tangan' => $this->request->getVar('jabatan_penanda_tangan'),
            'nama_penanda_tangan' => $this->request->getVar('nama_penanda_tangan'),
            'nip_penanda_tangan' => $this->request->getVar('nip_penanda_tangan'),
            'dosen_yang_bisa_dipilih' => $this->request->getVar('dosen_yang_bisa_dipilih'),
            'departemen_status' => 1,
        );
        $this->departemenModel->insert($data);
        return redirect()->to('/departemen')->with('sukses','Data berhasil disimpan!');
    }

    public function edit($id = '')
    {
        if($id == '') {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $semuaDepartemen = $this->departemenModel->getAllOnly();
        $data = [
            'judul' => 'Edit Departemen',
            'departemen_by_id' => $this->departemenModel->find($id),
            'semuaDepartemen' => $semuaDepartemen
        ];
        return view('departemen/v_edit_departemen', $data);
    }

    public function update($id = ''){
        if($id == ''){
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        if(!$this->validate([
            'departemen_nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Inputkan nama departemen'
                ]
            ],
            'departemen_email' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Inputkan email departemen'
                ]
            ],
            'departemen_website' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Inputkan website departemen'
                ]
            ],
            'departemen_kd_surat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Inputkan kode surat departemen, contoh : /UN35.4.3/AK/'
                ]
            ],
            'departemen_nm_kadep' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tuliskan Nama Kepala Departemen'
                ]
            ],
            'departemen_nip_kadep' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tuliskan NIP Kepala Departemen'
                ]
            ],
        ])){
            return redirect()->back()->withInput();
        }

        $data = array(
            'departemen_kd' => $this->request->getVar('departemen_kd'),
            'departemen_nama' => $this->request->getVar('departemen_nama'),
            'departemen_alias' => $this->request->getVar('departemen_alias'),
            'departemen_email' => $this->request->getVar('departemen_email'),
            'departemen_website' => $this->request->getVar('departemen_website'),
            'departemen_kd_surat' => $this->request->getVar('departemen_kd_surat'),
            'departemen_nm_kadep' => $this->request->getVar('departemen_nm_kadep'),
            'departemen_nip_kadep' => $this->request->getVar('departemen_nip_kadep'),
            'judul_kop_surat' => $this->request->getVar('judul_kop_surat'),
            'jabatan_penanda_tangan' => $this->request->getVar('jabatan_penanda_tangan'),
            'nama_penanda_tangan' => $this->request->getVar('nama_penanda_tangan'),
            'nip_penanda_tangan' => $this->request->getVar('nip_penanda_tangan'),
            'dosen_yang_bisa_dipilih' => $this->request->getVar('dosen_yang_bisa_dipilih'),
            'departemen_status' => 1,
        );
        $this->departemenModel->update($id, $data);
        return redirect()->to('/departemen')->with('sukses','Data berhasil diubah!');
    }

    public function detail($id = '')
    {
        if($id == '') {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        // $detail = $this->departemenModel->getDetail($id);
        // echo '<pre>';
        // print_r($detail);   
        // echo '</pre>';
        // die;
        $data = [
            'judul' => 'Detail Departemen',
            'departemen_by_id' => $this->departemenModel->getDetail($id)
        ];
        return view('departemen/v_detail_departemen', $data);
    }

}
