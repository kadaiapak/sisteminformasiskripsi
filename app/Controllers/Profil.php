<?php

namespace App\Controllers;
use App\Models\ProfilModel;
use App\Models\DepartemenModel;
use App\Models\ProdiModel;
use App\Models\JenjangModel;
use App\Models\ProgresSkripsiModel;

class Profil extends BaseController
{
    protected $profilModel;
    protected $departemenModel;
    protected $prodiModel;
    protected $jenjangModel;
    protected $progresSkripsiModel;
    public function __construct()
    {
        helper('form');
        $this->profilModel = new ProfilModel();
        $this->jenjangModel = new JenjangModel();
        $this->prodiModel = new ProdiModel();
        $this->departemenModel = new DepartemenModel();
        $this->progresSkripsiModel = new ProgresSkripsiModel();
    }

    public function index()
    {
        $username = session()->get('username');
        $status = $this->profilModel->cekIsVerified($username);
        if($status == null){
            return redirect()->to('/profil/verifikasi')->with('sukses','Login berhasil!, silahkan edit profil');
        }
        $detailProfil = $this->profilModel->getDetail($username);
        $data = [
            'judul' => 'Profil',
            'detail_profil' => $detailProfil
        ];
        return view('profil/v_profil', $data);
    }

    // akses oleh mahasiswa
    // digunakan untuk verifikasi awal mahasiswa yang baru login di aplikasi ini
    public function verifikasi()
    {
        $username = session()->get('username');
        if($username == '') {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $datamhsd = $this->getmhsapis($username);
        if($datamhsd->respon == 2) {
            $arrmhs = null;
        }else {
            $arrmhs = get_object_vars($datamhsd->data);
        }
        $prodi = $this->prodiModel->findAll();
        $departemen = $this->departemenModel->findAll();
        $jenjang = $this->jenjangModel->findAll();

        $data = [
            'judul' => 'Verifikasi Profil',
            'mahasiswa_api' => $arrmhs,
            'prodi' => $prodi,
            'departemen' => $departemen,
            'jenjang' => $jenjang
        ];
        return view('profil/v_verifikasi_profil', $data);
    }

    public function update_verifikasi()
    {
        if(!$this->validate([
            'prf_nim_portal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Inputkan NIM'
                ]
            ],
            'prf_nama_portal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tuliskan Nama Lengkap'
                ]
            ],
            'jk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis Kelamin kosong'
                ]
            ],
            'agama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Agama kosong'
                ]
            ],
            'tgl_lahir_portal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Lahir kosong'
                ]
            ],
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
            'email' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tuliskan Email'
                ]
            ],
            'alamat_lengkap' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tuliskan Alamat Lengkap'
                ]
            ],
            'departemen_input' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih Departemen'
                ]
            ],
            'prodi_input' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih Prodi'
                ]
            ],
            'jjp_input' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih Jenjang Pendidikan'
                ]
            ],
        ])){
            return redirect()->back()->withInput();
        }
        $username = session()->get('username');
        if($username == $this->request->getVar('prf_nim_portal')){;
        $data = array(
            'prf_nim_portal' => $this->request->getVar('prf_nim_portal'),
            'thn_msk_portal' => $this->request->getVar('thn_msk_portal'),
            'prf_nama_portal' => $this->request->getVar('prf_nama_portal'),
            'tmp_lahir_portal' => $this->request->getVar('tmp_lahir_portal'),
            'tgl_lahir_portal' => $this->request->getVar('tgl_lahir_portal'),
            'jk' => $this->request->getVar('jk'),
            'agama' => $this->request->getVar('agama'),
            'nohp_portal' => $this->request->getVar('nohp_portal'),
            'nohp_baru' => $this->request->getVar('nohp_baru'),
            'nowa' => $this->request->getVar('nowa'),
            'email' => $this->request->getVar('email'),
            'idpdpt' => $this->request->getVar('idpdpt'),
            'departemen_input' => $this->request->getVar('departemen_input'),
            'idprodi_portal' => $this->request->getVar('idprodi_portal'),
            'prodi_input' => $this->request->getVar('prodi_input'),
            'prodi_portal' => $this->request->getVar('prodi_portal'),
            'nama_jurusan_portal' => $this->request->getVar('nama_jurusan_portal'),
            'kd_jurusan_portal' => $this->request->getVar('kd_jurusan_portal'),
            'id_fakultas_portal' => $this->request->getVar('id_fakultas_portal'),
            'nama_fakultas_portal' => $this->request->getVar('nama_fakultas_portal'),
            'jjp_portal' => $this->request->getVar('jjp_portal'),
            'jjp_input' => $this->request->getVar('jjp_input'),
            'alamat_lengkap' => $this->request->getVar('alamat_lengkap'),
            'sudah_edit' => 1,
            'prf_status' => 1
        );
        $data_progres = array(
            'nim' => $this->request->getVar('prf_nim_portal'),
            'status' => 1,
        );
        $this->profilModel->updateVerifikasiProfil($data, $username);
        $this->progresSkripsiModel->insert($data_progres);
        session()->set('verifikasi_mahasiswa', 1);
        return redirect()->to('/profil')->with('sukses','Profil berhasil disimpan!');
        }else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    private function getmhsapis($nim)
    {
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_HTTPHEADER,array(
        'h2hid: 119009',
        'h2hkey: FpY6qZ3S',
        'h2hunicode: nIowYLmcNdMjWHfAgQTlrJqeSpVEsOXvGbzDPaFyuki',
        'nim: '.$nim,
        'Content-Type: application/json'
      ));
      curl_setopt($ch, CURLOPT_URL, 'https://wsvc.unp.ac.id/api/akademik/cekmhs');
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
      $output = curl_exec($ch);
      $header_data= curl_getinfo($ch);
      curl_close($ch);
      return json_decode($output);
    }

    public function update($id = ''){
        if($id == ''){
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        if(!$this->validate([
            'profil_nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Inputkan nama profil'
                ]
            ],
            'profil_email' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Inputkan email profil'
                ]
            ],
            'profil_website' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Inputkan website profil'
                ]
            ],
            'profil_kd_surat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Inputkan kode surat profil, contoh : /UN35.4.3/AK/'
                ]
            ],
            'profil_nm_kadep' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tuliskan Nama Kepala Profil'
                ]
            ],
            'profil_nip_kadep' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tuliskan NIP Kepala Profil'
                ]
            ],
        ])){
            return redirect()->back()->withInput();
        }

        $data = array(
            'profil_nama' => $this->request->getVar('profil_nama'),
            'profil_alias' => $this->request->getVar('profil_alias'),
            'profil_email' => $this->request->getVar('profil_email'),
            'profil_website' => $this->request->getVar('profil_website'),
            'profil_kd_surat' => $this->request->getVar('profil_kd_surat'),
            'profil_nm_kadep' => $this->request->getVar('profil_nm_kadep'),
            'profil_nip_kadep' => $this->request->getVar('profil_nip_kadep'),
            'profil_status' => 1,
        );
        $this->profilModel->update($id, $data);
        return redirect()->to('/profil')->with('sukses','Data berhasil diubah!');
    }

        // public function tambah()
    // {
    //     $data = [
    //         'judul' => 'Tambah Profil'
    //     ];
    //     return view('profil/v_tambah_profil', $data);
    // }

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
}
