<?php

namespace App\Controllers;
use App\Models\AuthModel;
use App\Models\ProfilModel;
use App\Models\DosenModel;


class Auth extends BaseController
{
    protected $authModel;
    protected $profilModel;
    protected $dosenModel;
    public function __construct()
    {
        helper('form');
        $this->authModel = new AuthModel();
        $this->profilModel = new ProfilModel();
        $this->dosenModel = new DosenModel();
    }
    public function index()
    {
        return redirect()->to(site_url('/auth/login'));
    }

    public function login()
    {
        if(session('log')) {
            return redirect()->to(base_url('/dashboard'));
        }
        $data = [
            'judul' => 'Login',
        ];
        return view('auth/v_login', $data);
    }

    public function loginProcess()
    {
        if(!$this->validate([
            'username' => [
                'rules' => 'required|alpha_numeric',
                'errors' => [
                    'required' => 'username tidak boleh kosong',
                    'alpha_numeric' => 'Username hanya huruf dan angka tanpa spasi dan spesial karakter',
                ]
            ],
            'password' => [
                'rules' => 'required|cek_spasi',
                'errors' => [
                    'required' => 'password tidak boleh kosong',
                    'cek_spasi' => 'Password tidak boleh ada spasi'
                ]
            ],
            'login_level' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'pilih level login'
                ]
            ],
        ])){
            return redirect()->back()->withInput();
        }
        $login_level = $this->request->getVar('login_level');
        // jika login sebagai mahasiswa maka lakukan proses ini
        if($login_level == 'mahasiswa'){
            $username = $this->request->getVar('username');
            $cek = $this->authModel->login($username);
            if($cek){
                $password = $this->request->getVar('password');
                if(password_verify($password, $cek['password'])){
                    $verifikasi = $this->profilModel->cekIsVerified($username);
                    session()->set('log', true); 
                    session()->set('nama_asli', $cek['nama_asli']);
                    session()->set('username', $cek['username']);
                    session()->set('level', $cek['level']);
                    session()->set('user_foto', $cek['user_foto']);
                    session()->set('verifikasi_mahasiswa', $verifikasi);
                    session()->set('user_level_nama', $cek['user_level_nama']);
                    // ubah status menjadi online
                    $builder = $this->db->table('user');
                    $builder->set('is_login', '1');
                    $builder->where('username', $cek['username']);
                    $builder->update();

                    
                    return redirect()->to('/dashboard')->with('sukses','Login berhasil!');
                }else {
                    return redirect()->back()->with('gagal', 'Username atau Password salah!');   
                }
            }else {
                 return redirect()->back()->with('gagal', 'Username atau Password salah!');   
            }
        }else if($login_level == 'dosen'){
            $username = $this->request->getVar('username');
            $cekDosen = $this->authModel->loginDosen($username);
            if($cekDosen){
                $password = $this->request->getVar('password');
                if(password_verify($password, $cekDosen['password'])){
                    $status = $this->dosenModel->cekIsVerifiedDosen($cekDosen['username']);
                    session()->set('user_id', $cekDosen['user_id']);
                    session()->set('verifikasi', $status['verifikasi']);
                    session()->set('log', true);
                    session()->set('nama_asli', $cekDosen['nama_asli']);
                    session()->set('username', $cekDosen['username']);
                    session()->set('level', $cekDosen['level']);
                    session()->set('user_foto', $cekDosen['user_foto']);
                    session()->set('departemen', $cekDosen['departemen']);
                    session()->set('user_level_nama', $cekDosen['user_level_nama']);
                    // ubah status menjadi online
                    $builder = $this->db->table('user');
                    $builder->set('is_login', '1');
                    $builder->where('username', $cekDosen['username']);
                    $builder->update();

                    return redirect()->to('/dashboard')->with('sukses','Login berhasil!');
                }else {
                    return redirect()->back()->with('gagal', 'Username atau Password salah!');   
                }
            }else {
                 return redirect()->back()->with('gagal', 'Username atau Password salah!');   
            }
        }else if($login_level == 'admin'){
            $username = $this->request->getVar('username');
            $cek = $this->authModel->login($username);
            if($cek){
                $password = $this->request->getVar('password');
                if(password_verify($password, $cek['password'])){
                    session()->set('user_id', $cek['user_id']);
                    session()->set('log', true);
                    session()->set('nama_asli', $cek['nama_asli']);
                    session()->set('username', $cek['username']);
                    session()->set('level', $cek['level']);
                    session()->set('user_foto', $cek['user_foto']);
                    session()->set('departemen', $cek['departemen']);
                    session()->set('user_level_nama', $cek['user_level_nama']);
                    // ubah status menjadi online
                    $builder = $this->db->table('user');
                    $builder->set('is_login', '1');
                    $builder->where('username', $cek['username']);
                    $builder->update();
                    return redirect()->to('/dashboard')->with('sukses','Login berhasil!');
                }else {
                    return redirect()->back()->with('gagal', 'Username atau Password salah!');   
                }
            }else {
                 return redirect()->back()->with('gagal', 'Username atau Password salah!');   
            }
        }
        
    }

    public function logout()
    {
        date_default_timezone_set('ASIA/JAKARTA');
        $terakhir_login = date('Y-m-d H:i:s');
        $username = session()->get('username');
        $builder = $this->db->table('user');
        $builder->set('is_login', '0');
        $builder->set('terakhir_login', $terakhir_login);
        $builder->where('username', $username);
        $builder->update();
        session()->destroy();
        return redirect()->to('/auth/login');
    }
}
