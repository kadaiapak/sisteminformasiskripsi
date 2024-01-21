<?php

namespace App\Controllers;
use App\Models\UserLevelModel;


class UserLevel extends BaseController
{
    protected $userLevelModel;
    public function __construct()
    {
        helper('form');
        $this->userLevelModel = new UserLevelModel();
    }

    public function index()
    {
        $semuaUserLevel = $this->userLevelModel->findAll();
        $data = [
            'judul' => 'UserLevel',
            'semua_user_level' => $semuaUserLevel
        ];
        return view('user_level/v_user_level', $data);
    }
    
    public function tambah()
    {
        $data = [
            'judul' => 'Tambah User Level'
        ];
        return view('user_level/v_tambah_user_level', $data);
    }

    public function simpan()
    {
        if(!$this->validate([
            'user_level_nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Inputkan nama Level'
                ]
            ],
            'user_level_keterangan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tuliskan penjelasan tengtang user level ini'
                ]
            ],
        ])){
            return redirect()->back()->withInput();
        }
        $data = array(
            'user_level_nama' => $this->request->getVar('user_level_nama'),
            'user_level_keterangan' => $this->request->getVar('user_level_keterangan'),
            'user_level_status' => 1,
        );
        $this->userLevelModel->insert($data);
        return redirect()->to('/user_level')->with('sukses','Data berhasil disimpan!');
    }

    public function edit($id = '')
    {
        if($id == '') {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $data = [
            'judul' => 'Edit User Level',
            'user_level_by_id' => $this->userLevelModel->find($id)
        ];
        return view('user_level/v_edit_user_level', $data);
    }

    public function update($id = ''){
        if($id == ''){
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        if(!$this->validate([
            'user_level_nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Inputkan nama user_level'
                ]
            ],
            'user_level_keterangan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Inputkan email user_level'
                ]
            ]
        ])){
            return redirect()->back()->withInput();
        }

        $data = array(
            'user_level_nama' => $this->request->getVar('user_level_nama'),
            'user_level_keterangan' => $this->request->getVar('user_level_keterangan'),
            'user_level_status' => 1,
        );
        $this->userLevelModel->update($id, $data);
        return redirect()->to('/user_level')->with('sukses','Data berhasil diubah!');
    }

}
