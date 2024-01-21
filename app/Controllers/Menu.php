<?php

namespace App\Controllers;
use App\Models\MenuModel;


class Menu extends BaseController
{
    protected $menuModel;
    public function __construct()
    {
        helper('form');
        $this->menuModel = new MenuModel();
    }

    public function index()
    {
        $semuaMenu = $this->menuModel->findAll();
        $data = [
            'judul' => 'Menu',
            'semua_menu' => $semuaMenu
        ];
        return view('menu/v_menu', $data);
    }
    
    public function tambah()
    {
        $data = [
            'judul' => 'Tambah Menu'
        ];
        return view('menu/v_tambah_menu', $data);
    }

    public function simpan()
    {
        if(!$this->validate([
            'menu_nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Inputkan nama menu'
                ]
            ],
            'menu_url' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tuliskan URL menu'
                ]
            ]
        ])){
            return redirect()->back()->withInput();
        }
        $data = array(
            'menu_nama' => $this->request->getVar('menu_nama'),
            'menu_url' => $this->request->getVar('menu_url'),
            'menu_icon' => $this->request->getVar('menu_icon'),
            'is_aktif' => 1,
            'is_tampil' => 1,
        );
        $this->menuModel->insert($data);
        return redirect()->to('/menu')->with('sukses','Data berhasil disimpan!');
    }

    public function edit($id = '')
    {
        if($id == '') {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $data = [
            'judul' => 'Edit Menu',
            'menu_by_id' => $this->menuModel->find($id)
        ];
        return view('menu/v_edit_menu', $data);
    }

    public function update($id = ''){
        if($id == ''){
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        if(!$this->validate([
            'menu_nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Inputkan nama menu'
                ]
            ],
            'menu_email' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Inputkan email menu'
                ]
            ],
            'menu_website' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Inputkan website menu'
                ]
            ],
            'menu_kd_surat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Inputkan kode surat menu, contoh : /UN35.4.3/AK/'
                ]
            ],
            'menu_nm_kadep' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tuliskan Nama Kepala Menu'
                ]
            ],
            'menu_nip_kadep' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tuliskan NIP Kepala Menu'
                ]
            ],
        ])){
            return redirect()->back()->withInput();
        }

        $data = array(
            'menu_nama' => $this->request->getVar('menu_nama'),
            'menu_alias' => $this->request->getVar('menu_alias'),
            'menu_email' => $this->request->getVar('menu_email'),
            'menu_website' => $this->request->getVar('menu_website'),
            'menu_kd_surat' => $this->request->getVar('menu_kd_surat'),
            'menu_nm_kadep' => $this->request->getVar('menu_nm_kadep'),
            'menu_nip_kadep' => $this->request->getVar('menu_nip_kadep'),
            'menu_status' => 1,
        );
        $this->menuModel->update($id, $data);
        return redirect()->to('/menu')->with('sukses','Data berhasil diubah!');
    }

}
