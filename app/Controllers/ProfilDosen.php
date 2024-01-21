<?php

namespace App\Controllers;
use App\Models\DosenModel;


class ProfilDosen extends BaseController
{
    protected $dosenModel;
    public function __construct()
    {
        helper('form');
        $this->dosenModel = new DosenModel();
    }

    public function index()
    {
        $username = session()->get('username');
        $detailProfil = $this->dosenModel->getDetail($username);
        // dd($detailProfil);
        $data = [  
            'judul' => 'Profil',
            'detail_profil' => $detailProfil
        ];
        return view('profil_dosen/v_profil_dosen', $data);
    }

    // akses oleh mahasiswa
    // digunakan untuk verifikasi awal mahasiswa yang baru login di aplikasi ini
    public function verifikasi($username = '')
    {
        $username = session()->get('username');
        if($username == '') {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $data_dosen = $this->dosenModel->getDetail($username);
        $data = [
            'judul' => 'Verifikasi Profil',
            'data_dosen' => $data_dosen,
        ];
        return view('profil_dosen/v_verifikasi_profil_dosen', $data);
    }
    
    // public function simpan()
    // {
    //     if(!$this->validate([
    //         'profil_nama' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => 'Inputkan nama profil'
    //             ]
    //         ],
    //         'profil_email' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => 'Inputkan email profil'
    //             ]
    //         ],
    //         'profil_website' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => 'Inputkan website profil'
    //             ]
    //         ],
    //         'profil_kd_surat' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => 'Inputkan kode surat profil, contoh : /UN35.4.3/AK/'
    //             ]
    //         ],
    //         'profil_nm_kadep' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => 'Tuliskan Nama Kepala Profil'
    //             ]
    //         ],
    //         'profil_nip_kadep' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => 'Tuliskan NIP Kepala Profil'
    //             ]
    //         ],
    //     ])){
    //         return redirect()->back()->withInput();
    //     }
    //     $data = array(
    //         'profil_nama' => $this->request->getVar('profil_nama'),
    //         'profil_alias' => $this->request->getVar('profil_alias'),
    //         'profil_email' => $this->request->getVar('profil_email'),
    //         'profil_website' => $this->request->getVar('profil_website'),
    //         'profil_kd_surat' => $this->request->getVar('profil_kd_surat'),
    //         'profil_nm_kadep' => $this->request->getVar('profil_nm_kadep'),
    //         'profil_nip_kadep' => $this->request->getVar('profil_nip_kadep'),
    //         'profil_status' => 1,
    //     );
    //     $this->profilModel->insert($data);
    //     return redirect()->to('/profil')->with('sukses','Data berhasil disimpan!');
    // }

    public function update_verifikasi()
    {
        if(!$this->validate([
            'nohp_baru' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'No HP kosong'
                ]
            ],
            'no_wa' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'No Whatsapp kosong'
                ]
            ],
            'email_baru' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tuliskan Email'
                ]
            ],
            'alamat_baru' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tuliskan Alamat Lengkap'
                ]
            ],
        ])){
            return redirect()->back()->withInput();
        }
        $username = session()->get('username');
        $data = array(
            'nohp_baru' => $this->request->getVar('nohp_baru'),
            'no_wa' => $this->request->getVar('no_wa'),
            'email_baru' => $this->request->getVar('email_baru'),
            'alamat_baru' => $this->request->getVar('alamat_baru'),
            'verifikasi' => 1
        );
        $this->dosenModel->updateVerifikasiProfil($data, $username);
        session()->set('verifikasi', 1);
        return redirect()->to('/dashboard')->with('sukses','Profil berhasil disimpan!');
    }
   
}
