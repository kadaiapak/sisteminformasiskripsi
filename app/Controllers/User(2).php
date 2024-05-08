<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\UserLevelModel;
use App\Models\DepartemenModel;


class User extends BaseController
{
    protected $userModel;
    protected $departemenModel;
    public function __construct()
    {
        helper('form');
        $this->userModel = new UserModel();
        $this->departemenModel = new DepartemenModel();
        $this->userLevelModel = new UserLevelModel();
    }

    public function index()
    {
        $semuaUser = $this->userModel->getAll();
        $rekapUser = $this->userModel->getRekapUser();
        $data = [
            'judul' => 'User',
            'rekap_user' => $rekapUser,
            'semua_user' => $semuaUser,
        ];
        return view('user/v_user', $data);
    }
    
    public function tambah()
    {   
        $semuaDepartemen = $this->departemenModel->findAll();
        $level = $this->userLevelModel->findAll();
        $data = [
            'judul' => 'Tambah User',
            'departemen' => $semuaDepartemen,
            'level' => $level
        ];
        return view('user/v_tambah_user', $data);
    }

    public function simpan()
    {
        if(!$this->validate([
            'nama_asli' => [
                'rules' => 'required|alpha_space',
                'errors' => [
                    'required' => 'Tuliskan Nama Lengkap',
                    'alpha_space' => 'Nama hanya boleh huruf dan spasi',
                ]
            ],
            'username' => [
                'rules' => 'required|alpha_numeric|is_unique[user.username]',
                'errors' => [
                    'required' => 'Inputkan email user',
                    'alpha_numeric' => 'Username hanya huruf dan angka tanpa spasi dan spesial karakter',
                    'is_unique' => 'Username sudah dipakai',
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[6]|cek_spasi',
                'errors' => [
                    'required' => 'Tuliskan Password',
                    'min_length' => 'Password tidak kuat',
                    'cek_spasi' => 'Password tidak boleh ada spasi'
                ]
            ],
            'passwordconf' => [
                'rules' => 'required|min_length[6]|matches[password]',
                'errors' => [
                    'required' => 'Tuliskan Konfirmasi Password',
                    'min_length' => 'Password tidak kuat',
                    'matches' => 'Password dan password konfirmasi tidak cocok',
                ]
            ],
            'departemen' => [
                'rules' => 'numeric',
                'errors' => [
                    'numeric' => 'Pilih departemen',
                ]
            ],
            'level' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih Level User'
                ]
            ],
        ])){
            return redirect()->back()->withInput();
        }
        $password = password_hash($this->request->getVar('password'), PASSWORD_BCRYPT);
        $data = array(
            'nama_asli' => $this->request->getVar('nama_asli'),
            'username' => $this->request->getVar('username'),
            'password' => $password,
            'user_foto' => 'no-photo.jpg',
            'departemen' => $this->request->getVar('departemen'),
            'level' => $this->request->getVar('level'),
            'is_aktif' => 1,
        );
        $this->userModel->insert($data);
        return redirect()->to('/user')->with('sukses','Data berhasil disimpan!');
    }

    public function edit($id = '')
    {
        if($id == '') {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $data = [
            'judul' => 'Edit User',
            'user_by_id' => $this->userModel->find($id)
        ];
        return view('user/v_edit_user', $data);
    }

    public function update($id = ''){
        if($id == ''){
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        if(!$this->validate([
            'user_nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Inputkan nama user'
                ]
            ],
            'user_email' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Inputkan email user'
                ]
            ],
            'user_website' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Inputkan website user'
                ]
            ],
            'user_kd_surat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Inputkan kode surat user, contoh : /UN35.4.3/AK/'
                ]
            ],
            'user_nm_kadep' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tuliskan Nama Kepala User'
                ]
            ],
            'user_nip_kadep' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tuliskan NIP Kepala User'
                ]
            ],
        ])){
            return redirect()->back()->withInput();
        }

        $data = array(
            'user_nama' => $this->request->getVar('user_nama'),
            'user_alias' => $this->request->getVar('user_alias'),
            'user_email' => $this->request->getVar('user_email'),
            'user_website' => $this->request->getVar('user_website'),
            'user_kd_surat' => $this->request->getVar('user_kd_surat'),
            'user_nm_kadep' => $this->request->getVar('user_nm_kadep'),
            'user_nip_kadep' => $this->request->getVar('user_nip_kadep'),
            'user_status' => 1,
        );
        $this->userModel->update($id, $data);
        return redirect()->to('/user')->with('sukses','Data berhasil diubah!');
    }

    // callback function untuk validation rules
    function cek_spasi($str)
    {
        $pattern = '/ /';
        $result = preg_match($pattern, $str);

        if ($result)
        {
            $this->form_validation->set_message('username_check', 'The %s field can not have a " "');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

}
