<?php

namespace App\Controllers;

class Dashboard extends BaseController
{

    public function __construct()
    {
    }

    public function index()
    {
        if(session()->get('verifikasi') == '0' && session()->get('level') == '5') 
        {
            return redirect()->to('/profil-dosen/verifikasi')->with('sukses','Login berhasil!, silahkan edit profil');
        }
        if(session()->get('verifikasi_mahasiswa') == null && session()->get('level') == '6')
        {
            return redirect()->to('/profil/verifikasi')->with('sukses','Login berhasil!, silahkan edit profil');
        }
        if(session()->get('level') == '1'){
            $view = 'dashboard/v_superadmin_dashboard';
            $data = [
                'judul' => 'Dashboard Super Admin'
            ];
        }
        if(session()->get('level') == '2'){
            $view = 'dashboard/v_admin_dashboard';
            $data = [
                'judul' => 'Dashboard Admin'
            ];
        }
        if(session()->get('level') == '3'){
            $view = 'dashboard/v_dekan_dashboard';
            $data = [
                'judul' => 'Dashboard Dekan / Wakil Dekan'
            ];
        }
        if(session()->get('level') == '4'){
            $view = 'dashboard/v_kadep_dashboard';
            $data = [
                'judul' => 'Dashboard Kepala Departemen'
            ];
        }
        if(session()->get('level') == '5'){
            $view = 'dashboard/v_dosen_dashboard';
            $data = [
                'judul' => 'Dashboard Dosen'
            ];
        }
        if(session()->get('level') == '6'){
            $view = 'dashboard/v_mahasiswa_dashboard';
            $data = [
                'judul' => 'Dashboard Mahasiswa'
            ];
        }
        if(session()->get('level') == '7'){
            $view = 'dashboard/v_admindepartemen_dashboard';
            $data = [
                'judul' => 'Dashboard Admin Departemen'
            ];
        }
        return view($view, $data);
    }

    // public function index()
    // {
    //     $nim = session()->get('username');
    //     $semuaBimbingan = $this->bimbinganModel->getAll($nim);
    //     $data = [
    //         'judul' => 'Skripsi',
    //         'semua_bimbingan' => $semuaBimbingan
    //     ];
    //     return view('skripsi/v_skripsi', $data);
    // }

    public function tambah($UUIDSkripsi)
    {
        $data = [
            'judul' => 'Buat Bimbingan',
            'nim' => session()->get('username'),
            'nama' => session()->get('nama_asli'),
            'UUIDSkripsi' => $UUIDSkripsi
            // 'dosen' => $this->dosenModel->getAll(),
        ];
        return view('bimbingan/v_tambah_bimbingan', $data);
    }

    public function simpan($UUIDSkripsi)
    {
        if(!$this->validate([
            'bb_waktu' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'pilih waktu bimbingan'
                ]
            ],
            'bb_subjek' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'tuliskan subjek bimbingan'
                ]
            ],
            'bb_isi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'tuliskan keterangan perbaikan'
                ]
            ],
            'bb_data_dukung' => [
                'rules' => 'max_size[bb_data_dukung,2048]|ext_in[bb_data_dukung,pdf]',
                'errors' => [
                    'max_size' => 'ukuran file terlalu besar',
                    'ext_in' => 'file yang anda pilih bukan pdf'
                ]
            ]
        ])){
            return redirect()->to(base_url('skripsi/tambah-bimbingan'))->withInput();
        }
        
        $nim = session()->get('username');
        $data_dukung = $this->request->getFile('bb_data_dukung');
        if($data_dukung->getError() != 4) {
            echo "Nama file: ".$data_dukung->getName();
            $data_dukung->move('./upload/data_dukung');
            $nama_data_dukung = $data_dukung->getName();
        }else {
            $nama_data_dukung = null;
        }
        $data = array(
            'bb_nim' => $nim,
            'bb_waktu' => $this->request->getVar('bb_waktu'),
            'bb_skripsi_uuid' => $UUIDSkripsi,
            'bb_subjek' => $this->request->getVar('bb_subjek'),
            'bb_isi' => $this->request->getVar('bb_isi'),
            'bb_data_dukung' => $nama_data_dukung,
            'is_verifikasi' => 0,
        );
        $this->bimbinganModel->tambahBimbingan($data);
        return redirect()->to('/skripsi')->with('sukses','Data berhasil disimpan!');
    }
}
