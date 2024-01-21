<?php

namespace App\Controllers;

use App\Models\SkripsiModel;
use App\Models\DosenModel;
use App\Models\HistoriModel;
use App\Models\BimbinganModel;


class Bimbingan extends BaseController
{
    protected $skripsiModel;
    protected $dosenModel;
    protected $historiModel;
    protected $bimbinganModel;

    public function __construct()
    {
        helper('form');
        $this->skripsiModel = new SkripsiModel();
        $this->bimbinganModel = new BimbinganModel();
        $this->dosenModel = new DosenModel();
        $this->historiModel = new HistoriModel();
    }

    // menampilkan semua mahasiswa yang bimbingan dengan dosen bersangkutan
    public function index()
    {
        $nidn = session()->get('username');
        $semuaSkripsiByDosen = $this->skripsiModel->getAllSkripsiByDosen($nidn);
        $semuaBimbinganbyDosen = $this->bimbinganModel->getAllBimbinganByDosen($nidn);
        $data = [
            'judul' => 'Bimbingan',
            'semua_bimbingan' => $semuaBimbinganbyDosen,
            'semua_skripsi' => $semuaSkripsiByDosen
        ];
        return view('bimbingan/v_bimbingan', $data);
    }

    public function tambah()
    {
        $UUIDSkripsi = session()->get('UUIDSkripsi');
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
            return redirect()->to(base_url('bimbingan/tambah-bimbingan'))->withInput();
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

    public function verifikasi_dosen($UUIDSkripsi = null)
    {
        if($UUIDSkripsi != null) {
            $semua_bimbingan = $this->bimbinganModel->getAllBimbinganPerMahasiswa($UUIDSkripsi);
            $judul_skripsi = $this->skripsiModel->getSkripsiById($UUIDSkripsi);
            if (!$semua_bimbingan || !$judul_skripsi) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            } else {
                $data = [
                    'judul' => 'Verifikasi Bimbingan',
                    'judul_skripsi' => $judul_skripsi,
                    'semua_bimbingan' => $semua_bimbingan,
                    'UUIDSkripsi' => $UUIDSkripsi,
                ];
                return view('bimbingan/v_verifikasi_bimbingan', $data);
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function diverifikasi_dosen($idBimbingan = null)
    {
        if($idBimbingan != null) {
            $data = [
                'is_verifikasi' => 1
            ];
            $this->bimbinganModel->update($idBimbingan, $data);
            $UUIDSkripsi = $this->request->getVar('UUIDSkripsi');
        return redirect()->to('/bimbingan/verifikasi-dosen/'.$UUIDSkripsi)->with('sukses','Data berhasil disimpan!');
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
}
