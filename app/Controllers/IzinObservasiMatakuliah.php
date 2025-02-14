<?php 
namespace App\Controllers;
use App\Models\IzinObservasiMatakuliahModel;
use App\Models\DepartemenModel;
use App\Models\ProfilModel;
use App\Models\AnggotaObservasiMatakuliahModel;

use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Writer\ValidationException;


use Dompdf\Dompdf;
use Dompdf\Options;
class IzinObservasiMatakuliah extends BaseController
{
    protected $izinObservasiMatakuliahModel;
    protected $departemenModel;
    protected $profilModel;
    protected $anggotaObservasiMatakuliahModel;
    public function __construct()
    {
        helper('form');
        $this->izinObservasiMatakuliahModel = new IzinObservasiMatakuliahModel();
        $this->departemenModel = new DepartemenModel();
        $this->profilModel = new ProfilModel();
        $this->anggotaObservasiMatakuliahModel = new AnggotaObservasiMatakuliahModel();
    }

    // menampilkan semua pengajuan surat izin observasi matakuliah yang telah di buat
    // akses oleh mahasiswa
    // GET /izin-observasi-matakuliah
    public function index()
    {
        $nim = session()->get('username');
        $status = $this->profilModel->cekIsVerified($nim);
        if($status == null){
            return redirect()->to('/profil/verifikasi')->with('gagal','Silahkan lengkapi data diri');
        }
        $semuaSuratIzinObservasiMatakuliah = $this->izinObservasiMatakuliahModel->getAll($nim);
        $data = [
            'judul' => 'Surat Izin Observasi Matakuliah',
            'semua_izin_observasi_matakuliah' => $semuaSuratIzinObservasiMatakuliah
        ];

        return view('izin_observasi_matakuliah/user/v_izin_observasi_matakuliah', $data);
    }

    // fungsi untuk melihat semua surat izin observasi matakuliah yang sudah disetujui
    // akses oleh admin departemen
    // GET /izin-observasi-matakuliah/selesai
    public function selesai()
    {
        $level = session()->get('level');
        $departemen = session()->get('departemen');
        if($departemen == '0'){
            $departemen = null;
        }
        $semuaSuratIzinObservasiMatakuliahSelesai = $this->izinObservasiMatakuliahModel->getAllByAdminYangSelesai($departemen, $level);
        $data = [
            'judul' => 'Semua Pengajuan Izin Observasi Matakuliah Selesai',
            'semuaSuratIzinObservasiMatakuliahSelesai' => $semuaSuratIzinObservasiMatakuliahSelesai
        ];
        return view('izin_observasi_matakuliah/v_semua_izin_observasi_matakuliah_selesai', $data);
    }

    // menampilkan form tambah pengajuan surat izin observasi matakuliah
    // akses oleh mahasiswa
    // GET /izin-observasi-matakuliah/tambah
    public function tambah()
    {
        $nim = session()->get('username');
        $semuaDepartemen = $this->departemenModel->findAll();
        $user = $this->profilModel->getDetail($nim);
        $data = [
            'judul' => 'Pengajuan Surat Izin Observasi Penelian',
            'semua_departemen' => $semuaDepartemen,
            'user' => $user
        ];
        return view('izin_observasi_matakuliah/user/form_tambah_izin_observasi_matakuliah', $data);
    }

    // menyimpan pengajuan izin observasi matakuliah yang telah dibuat oleh mahasiswa
    // akses oleh mahasiswa
    // POST /izin-observasi-matakuliah/simpan
    public function simpan()
    {
        if(!$this->validate([
            'nim_pengajuan' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Tuliskan NIM',
                    'numeric' => 'NIM hanya boleh angka',
                ]
            ],
            'nama_pengajuan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tuliskan Nama Lengkap',
                ]
            ],
            'jenis_kelamin' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih Jenis Kelamin',
                ]
            ],
            'departemen_pengajuan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih Departemen',
                ]
            ],
            'tujuan_surat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tuliskan Tujuan Surat',
                ]
            ],
            'tempat_observasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tuliskan Tempat Observasi',
                ]
            ],
            'alamat_tempat_observasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tuliskan Alamat Tempat Observasi',
                ]
            ],
            'tujuan_observasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tuliskan Tujuan Observasi',
                ]
            ],
            'matakuliah' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tuliskan Matakuliah',
                ]
            ],
            'tanggal_mulai' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tuliskan Kapan dimulai observasi',
                ]
            ],
            'tanggal_selesai' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tuliskan Kapan selesai observasi',
                ]
            ],
        ])){
            return redirect()->back()->withInput();
        }

        $data = array(
            'user_pengajuan' => session()->get('username'),
            'nama_pengajuan' => $this->request->getVar('nama_pengajuan'),
            'nim_pengajuan' => $this->request->getVar('nim_pengajuan'),
            'jk_pengajuan' => $this->request->getVar('jenis_kelamin'),
            'departemen_pengajuan' => $this->request->getVar('departemen_pengajuan'),
            'tujuan_surat' => $this->request->getVar('tujuan_surat'),
            'tempat_observasi' => $this->request->getVar('tempat_observasi'),
            'alamat_tempat_observasi' => $this->request->getVar('alamat_tempat_observasi'),
            'tujuan_observasi' => $this->request->getVar('tujuan_observasi'),
            'matakuliah' => $this->request->getVar('matakuliah'),
            'tanggal_mulai' => $this->request->getVar('tanggal_mulai'),
            'tanggal_selesai' => $this->request->getVar('tanggal_selesai'),
            'status' => 1,
        );
        $data_anggota = $this->request->getVar('data');
        
        $this->izinObservasiMatakuliahModel->simpan($data, $data_anggota);
        return redirect()->to('/izin-observasi-matakuliah')->with('sukses','Data berhasil disimpan!');
    }

    // untuk edit menampilkan detail surat izin validator observasi matakuliah yang akan diedit
    // akses oleh mahasiswa
    // GET /izin-observasi-matakuliah/edit/:id
    public function edit($UUIDObservasi)
    {
        if($UUIDObservasi != null) {
            $satu_observasi = $this->izinObservasiMatakuliahModel->getDetail($UUIDObservasi);
            if (!$satu_observasi) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            } else {
                $idObservasi = $satu_observasi['surat_izin_observasi_matakuliah_id'];
                $data_anggota = $this->anggotaObservasiMatakuliahModel->getAllByObservasiId($idObservasi);
                $data = [
                    'judul' => 'Edit Surat Izin Observasi Matakuliah',
                    'satu_observasi' => $satu_observasi,
                    'anggota' => $data_anggota,
                ];
                return view('izin_observasi_matakuliah/user/v_edit_izin_observasi_matakuliah', $data);
            }   
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    // untuk edit data pengajuan oleh mahasiswa
    // akses oleh mahasiswa
    // GET /izin-observasi-maakuliah/edit-pengajuan/:id
    public function edit_pengajuan($UUIDObservasi)
    {
        if($UUIDObservasi != null) {
            $satu_observasi = $this->izinObservasiMatakuliahModel->getDetail($UUIDObservasi);
            if (!$satu_observasi) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            } else {
                $semuaDepartemen = $this->departemenModel->findAll();
                $data = [
                    'judul' => 'Edit Data Surat Izin Observasi Matakuliah',
                    'satu_observasi' => $satu_observasi,
                    'semua_departemen' => $semuaDepartemen
                ];
                return view('izin_observasi_matakuliah/user/form_edit_pengajuan_izin_observasi_matakuliah', $data);
            }   
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    // untuk menyimpan pembaruan data izin observasi matakuliah yang dibuat oleh mahasiswa
    // akses oleh mahasiswa
    // PUT /izin-observasi-matakuliah/simpan-pembaruan-pengajuan
    public function simpan_pembaruan_pengajuan()
    {
        if(!$this->validate([
            'nim_pengajuan' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Tuliskan NIM',
                ]
            ],
            'nama_pengajuan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tuliskan Nama Lengkap',
                ]
            ],
            'jk_pengajuan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih jenis kelamin',
                ]
            ],
            'tujuan_surat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tuliskan Tujuan Surat',
                ]
            ],
            'tempat_observasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tulis tempat observasi',
                ]
            ],
            'alamat_tempat_observasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tulis alamat tempat observasi',
                ]
            ],
            'tujuan_observasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tuliskan tujuan observasi',
                ]
            ],
            'matakuliah' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tuliskan Matakuliah',
                ]
            ],
            'tanggal_mulai' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tuliskan Kapan dimulai observasi',
                ]
            ],
            'tanggal_selesai' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tuliskan Kapan selesai observasi',
                ]
            ],
        ])){
            return redirect()->back()->withInput();
        }

        $UUIDObservasi = $this->request->getVar('uuid');
        $data = array(
            'jk_pengajuan' => $this->request->getVar('jk_pengajuan'),
            'tujuan_surat' => $this->request->getVar('tujuan_surat'),
            'tempat_observasi' => $this->request->getVar('tempat_observasi'),
            'alamat_tempat_observasi' => $this->request->getVar('alamat_tempat_observasi'),
            'tujuan_observasi' => $this->request->getVar('tujuan_observasi'),
            'matakuliah' => $this->request->getVar('matakuliah'),
            'tanggal_mulai' => $this->request->getVar('tanggal_mulai'),
            'tanggal_selesai' => $this->request->getVar('tanggal_selesai'),
            'status' => 1,
        );

        $this->izinObservasiMatakuliahModel->where('uuid', $UUIDObservasi)->set($data)->update();
        return redirect()->to('/izin-observasi-matakuliah/edit/'.$UUIDObservasi)->with('sukses','Data berhasil disimpan!');
    }

    // untuk menyimpan pembaruan data anggota observasi matakuliah yang dibuat oleh mahasiswa
    // akses oleh mahasiswa
    // PPUT /izin-observasi-matakuliah/simpan-pembaruan-anggota
    public function simpan_pembaruan_anggota()
    {   
        $id_anggota = $this->request->getVar('id_anggota');
        $id_observasi = $this->request->getVar('id_observasi');
        $UUIDObservasi = $this->request->getVar('UUIDObservasi');
       
        $data = array(
            'nim_anggota' => $this->request->getVar('nim_anggota'),
            'nama_anggota' => $this->request->getVar('nama_anggota'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
        );

        $where = array(
            'anggota_observasi_matakuliah_id' => $id_anggota,
            'id_izin_observasi' => $id_observasi
        );
        $this->anggotaObservasiMatakuliahModel->where($where)->set($data)->update();
        return redirect()->to('/izin-observasi-matakuliah/edit/'.$UUIDObservasi)->with('sukses','Data berhasil disimpan!');
    }

    // untuk menghapus jumlah anggota izin observasi matakuliah yang dibuat oleh mahasiswa
    // akses oleh mahasiswa
    // DELETE /izin-observasi-matakuliah/hapus-anggota/:id
    public function hapus_anggota($id)
    {
        $where = array(
            'anggota_observasi_matakuliah_id' => $id,
            'id_izin_observasi' => $this->request->getVar('id_observasi'),
        );
        $UUIDObservasi = $this->request->getVar('UUIDObservasi');
        $this->anggotaObservasiMatakuliahModel->delete($where);
        if(session()->get('level') == 6){
            return redirect()->to('/izin-observasi-matakuliah/edit/'.$UUIDObservasi)->with('sukses','Data berhasil disimpan!');
        }else {
            return redirect()->to('/izin-observasi-matakuliah/edit-admin/'.$UUIDObservasi)->with('sukses','Data berhasil disimpan!');
        }
    }

    // untuk menambah anggota pengajuan izin observasi matakuliah
    // akses oleh mahasiswa
    // POST /izin-observasi-matakuliah/tambah-anggota
    public function tambah_anggota()
    {
        $UUIDObservasi = $this->request->getVar('UUIDObservasi');
        $idSuratIzin = $this->request->getVar('id_observasi');
        $satu_observasi = $this->izinObservasiMatakuliahModel->getDetailByUUIDandId($UUIDObservasi, $idSuratIzin);
            if (!$satu_observasi) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            } else {
                if(!$this->validate([
                    'nama_anggota' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Tuliskan Nama Lengkap',
                        ]
                    ],
                    'nim_anggota' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Tuliskan NIM',
                        ]
                    ],
                    'jenis_kelamin' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Pilih Jenis Kelamin',
                        ]
                    ],
                ])){
                    return redirect()->back()->withInput();
                }
        
                $data = array(
                    'nim_anggota' => $this->request->getVar('nim_anggota'),
                    'nama_anggota' => $this->request->getVar('nama_anggota'),
                    'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
                    'id_izin_observasi' => $idSuratIzin
                );
                $this->anggotaObservasiMatakuliahModel->insert($data);
                return redirect()->to('/izin-observasi-matakuliah/edit/'.$UUIDObservasi)->with('sukses','Data berhasil disimpan!');
            } 
    }

    // untuk melihat semua pengajuan surat izin observasi matakuliah berdasarkan level dan departemen admins
    // akses oleh admin departemen dan kepala departemen
    // GET /izin-observasi-matakuliah/semua
    public function semua()
    {
        $level = session()->get('level');
        $departemen = session()->get('departemen');
        if($departemen == '0'){
            $departemen = null;
        }
        $semuaIzinObservasiMatakuliah = $this->izinObservasiMatakuliahModel->getAllByAdmin($departemen, $level);
        $data = [
            'judul' => 'Semua Pengajuan Surat Izin Observasi Matakuliah',
            'semua_izin_observasi_matakuliah' => $semuaIzinObservasiMatakuliah
        ];
        return view('izin_observasi_matakuliah/admin/v_semua_izin_observasi_matakuliah', $data);
    }

    public function cetak()
    { 
        // 
        $UUIDObservasi = $this->request->getVar('uuid');
        if($UUIDObservasi != null) {
            $satu_observasi = $this->izinObservasiMatakuliahModel->getDetail($UUIDObservasi);
            if (!$satu_observasi) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            } else {
            $tahun = date('Y', strtotime($satu_observasi['created_at']));
            $tanggal_seminar = tanggal_indo($satu_observasi['created_at']);
            $tanggal_surat = tanggal_indo($satu_observasi['updated_at']);
            $nomor_surat = $satu_observasi['no_surat'] .'/'. $satu_observasi['kd_surat'] .''. $tahun;
            $idObservasi = $satu_observasi['surat_izin_observasi_matakuliah_id'];
            $data_anggota = $this->anggotaObservasiMatakuliahModel->getAllByObservasiId($idObservasi);
            $data = [   
                'judul' => 'Detail Surat Izin Observasi Matakuliah',
                'satu_observasi' => $satu_observasi,
                'anggota' => $data_anggota,
                'nomor_surat' => $nomor_surat,
                'tanggal_surat' => $tanggal_surat,
                'tanggal_seminar' => $tanggal_seminar
            ];
            return view('izin_observasi_matakuliah/user/v_cetak_observasi_matakuliah', $data);
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    // untuk edit pengajuan surat
    // akses oleh admin
    // GET /izin-observasi-matakuliah/edit-admin/(id)  
    public function edit_admin($UUIDObservasi)
    {
        if($UUIDObservasi != null) {
            $satu_observasi = $this->izinObservasiMatakuliahModel->getDetail($UUIDObservasi);
            if (!$satu_observasi) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            } else {
                $idObservasi = $satu_observasi['surat_izin_observasi_matakuliah_id'];
                $data_anggota = $this->anggotaObservasiMatakuliahModel->getAllByObservasiId($idObservasi);
                $data = [
                    'judul' => 'Edit Surat Izin Observasi Matakuliah Oleh Admin',
                    'satu_observasi' => $satu_observasi,
                    'anggota' => $data_anggota
                ];
                return view('izin_observasi_matakuliah/admin/v_edit_admin_izin_observasi_matakuliah', $data);
            }   
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    // untuk edit data pengajuan oleh admin
    // akses oleh admin
    // GET /izin-observasi-maakuliah/admin-edit-pengajuan/:id
    public function admin_edit_pengajuan($UUIDObservasi)
    {
        if($UUIDObservasi != null) {
            $satu_observasi = $this->izinObservasiMatakuliahModel->getDetail($UUIDObservasi);
            if (!$satu_observasi) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            } else {
                $semuaDepartemen = $this->departemenModel->findAll();
                $data = [
                    'judul' => 'Edit Data Surat Izin Observasi Matakuliah',
                    'satu_observasi' => $satu_observasi,
                    'semua_departemen' => $semuaDepartemen
                ];
                return view('izin_observasi_matakuliah/admin/form_edit_pengajuan_izin_observasi_matakuliah', $data);
            }   
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    // untuk menyimpan data updated
    // akses oleh admin
    // PUT /izin-observasi-matakuliah/admin-simpan-pembaruan-pengajuan
    public function admin_simpan_pembaruan_pengajuan()
    {
        if(!$this->validate([
            'jk_pengajuan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih jenis kelamin',
                ]
            ],
            'tujuan_surat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tuliskan Tujuan Surat',
                ]
            ],
            'tempat_observasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tulis tempat observasi',
                ]
            ],
            'alamat_tempat_observasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tulis alamat tempat observasi',
                ]
            ],
            'tujuan_observasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tuliskan Tujuan Observasi',
                ]
            ],
            'matakuliah' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tuliskan Matakuliah',
                ]
            ],
            'tanggal_mulai' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tuliskan Kapan dimulai observasi',
                ]
            ],
            'tanggal_selesai' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tuliskan Kapan selesai observasi',
                ]
            ],
        ])){
            return redirect()->back()->withInput();
        }

        $UUIDObservasi = $this->request->getVar('uuid');
        $data = array(
            'admin_edit' => session()->get('user_id'),
            'jk_pengajuan' => $this->request->getVar('jk_pengajuan'),
            'tujuan_surat' => $this->request->getVar('tujuan_surat'),
            'tempat_observasi' => $this->request->getVar('tempat_observasi'),
            'alamat_tempat_observasi' => $this->request->getVar('alamat_tempat_observasi'),
            'tujuan_observasi' => $this->request->getVar('tujuan_observasi'),
            'matakuliah' => $this->request->getVar('matakuliah'),
            'tanggal_mulai' => $this->request->getVar('tanggal_mulai'),
            'tanggal_selesai' => $this->request->getVar('tanggal_selesai'),
            'status' => 1,
        );

        $this->izinObservasiMatakuliahModel->where('uuid', $UUIDObservasi)->set($data)->update();
        return redirect()->to('/izin-observasi-matakuliah/edit-admin/'.$UUIDObservasi)->with('sukses','Data berhasil disimpan!');
    }

    // untuk menyimpan update anggota
    // akses oleh admin
    // PPUT /izin-observasi-matakuliah/admin-simpan-pembaruan-anggota
    public function admin_simpan_pembaruan_anggota()
    {   
        $id_anggota = $this->request->getVar('id_anggota');
        $id_observasi = $this->request->getVar('id_observasi');
        $UUIDObservasi = $this->request->getVar('UUIDObservasi');
       
        $data = array(
            'nim_anggota' => $this->request->getVar('nim_anggota'),
            'nama_anggota' => $this->request->getVar('nama_anggota'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
        );

        $where = array(
            'anggota_observasi_matakuliah_id' => $id_anggota,
            'id_izin_observasi' => $id_observasi
        );
        $this->anggotaObservasiMatakuliahModel->where($where)->set($data)->update();
        return redirect()->to('/izin-observasi-matakuliah/edit-admin/'.$UUIDObservasi)->with('sukses','Data berhasil disimpan!');
    }

    // melihat semua pengajuan disetujui
    // akses oleh admin
    // GET /izin-observasi-matakuliah/disetujui
    public function disetujui()
    {
        $level = session()->get('level');
        $departemen = session()->get('departemen');
        if($departemen == '0'){
            $departemen = null;
        }
        $semuaIzinObservasiMatakuliah = $this->izinObservasiMatakuliahModel->getAllByAdminYangDisetujui($departemen, $level);
        $data = [
            'judul' => 'Semua Pengajuan Surat Izin Observasi Matakuliah',
            'semua_izin_observasi_matakuliah' => $semuaIzinObservasiMatakuliah
        ];
        return view('izin_observasi_matakuliah/admin/v_izin_observasi_matakuliah_disetujui', $data);
    }

    // melihat semua pengajuan ditolak
    // akses oleh admin
    // izin-observasi-penelitian/ditolak
    public function ditolak()
    {
        $level = session()->get('level');
        $departemen = session()->get('departemen');
        if($departemen == '0'){
            $departemen = null;
        }
        $semuaIzinObservasiMatakuliah = $this->izinObservasiMatakuliahModel->getAllByAdminYangDitolak($departemen, $level);
        $data = [
            'judul' => 'Semua Pengajuan Surat Izin Observasi Matakuliah',
            'semua_izin_observasi_matakuliah' => $semuaIzinObservasiMatakuliah
        ];
        return view('izin_observasi_matakuliah/admin/v_izin_observasi_matakuliah_ditolak', $data);
    }

    // melihat detail data yang akan diverifikasi
    // akses oleh admin
    // GET izin-observasi-penelitian/detail-verifikasi/id
    public function detail_verifikasi($UUIDObservasi)
    {
        if($UUIDObservasi != null) {
            $satu_observasi = $this->izinObservasiMatakuliahModel->getDetail($UUIDObservasi);
            if (!$satu_observasi) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            } else {
                $idObservasi = $satu_observasi['surat_izin_observasi_matakuliah_id'];
                $data_anggota = $this->anggotaObservasiMatakuliahModel->getAllByObservasiId($idObservasi);
                $data = [
                    'judul' => 'Detail Verifikasi Surat Izin Observasi Matakuliah',
                    'satu_observasi' => $satu_observasi,
                    'anggota' => $data_anggota
                ];
                return view('izin_observasi_matakuliah/admin/v_detail_verifikasi_izin_observasi_matakuliah', $data);
            }   
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
    
    // proses tolak oleh admin
    // akses oleh admin
    // POST /izin-observasi-matakuliah/tolak-admin
    public function tolak_admin($UUIDObservasi = null)
    {
        if($UUIDObservasi != null) {
            $satu_observasi = $this->izinObservasiMatakuliahModel->getDetail($UUIDObservasi);
            if (!$satu_observasi) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            } else {
                if(!$this->validate([
                    'pesan' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Tuliskan pesan penolakan'
                        ]
                    ]
                ])){
                    session()->setFlashdata('gagal', 'Silahkan tuliskan alasan penolakan');
                    return redirect()->back()->withInput();
                }
                date_default_timezone_set('ASIA/JAKARTA');
                $tanggal_diproses_admin = date('Y-m-d H:i:s');
                $data = array(
                    'pesan' => $this->request->getVar('pesan'),
                    'status' => '2',
                    'tanggal_diproses_admin' => $tanggal_diproses_admin,
                );
                $this->izinObservasiMatakuliahModel->where('uuid', $UUIDObservasi)->set($data)->update();
                return redirect()->to('/izin-observasi-matakuliah/semua')->with('sukses','Pengajuan Surat Izin Observasi Matakuliah ditolak!');
            }   
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    // proses setujui oleh admin
    // akses oleh admin
    // POST /izin-observasi-matakuliah/setujui-admin
    public function setujui_admin($UUIDObservasi)
    {
        if($UUIDObservasi != null) {
            $satu_observasi = $this->izinObservasiMatakuliahModel->getDetail($UUIDObservasi);
            if (!$satu_observasi) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            } else {
                if(!$this->validate([
                    'no_surat' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Tuliskan nomor surat'
                        ]
                    ]
                ])){
                    session()->setFlashdata('gagal', 'Silahkan tuliskan alasan penolakan');
                    return redirect()->back()->withInput();
                }
                date_default_timezone_set('ASIA/JAKARTA');
                $tanggal_diproses_admin = date('Y-m-d H:i:s');
                $data = array(
                    'status' => '3',
                    'no_surat' => $this->request->getVar('no_surat'),
                    'tanggal_diproses_admin' => $tanggal_diproses_admin,
                );
                $this->izinObservasiMatakuliahModel->where('uuid', $UUIDObservasi)->set($data)->update();
                return redirect()->to('/izin-observasi-matakuliah/semua')->with('sukses','Pengajuan izin observasi diterima oleh Admin!');
            }   
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    // proses tolak oleh kadep
    // akses oleh admin
    // POST /izin-observasi-matakuliah/tolak-kadep
    public function tolak_kadep($UUIDObservasi)
    {
        if($UUIDObservasi != null) {
            $satu_observasi = $this->izinObservasiMatakuliahModel->getDetail($UUIDObservasi);
            if (!$satu_observasi) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            } else {
                if(!$this->validate([
                    'pesan' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Tuliskan pesan penolakan'
                        ]
                    ]
                ])){
                    session()->setFlashdata('gagal', 'Silahkan tuliskan alasan penolakan');
                    return redirect()->back()->withInput();
                }
                date_default_timezone_set('ASIA/JAKARTA');
                $tanggal_diproses_admin = date('Y-m-d H:i:s');
                $data = array(
                    'pesan' => $this->request->getVar('pesan'),
                    'status' => '4',
                    'tanggal_diproses_admin' => $tanggal_diproses_admin,
                );
                $this->izinObservasiMatakuliahModel->where('uuid', $UUIDObservasi)->set($data)->update();
                return redirect()->to('/izin-observasi-matakuliah/semua')->with('sukses','Pengajuan izin observasi matakuliah ditolak!');
            }   
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    // proses tolak oleh kadep
    // akses oleh kadep
    // POST /izin-observasi-matakuliah/setujui-kadep
    public function setujui_kadep($UUIDObservasi)
    {
        if($UUIDObservasi != null) {
            $satu_observasi = $this->izinObservasiMatakuliahModel->getDetail($UUIDObservasi);
            if (!$satu_observasi) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            } else {
                $generate_qrcode = $this->generate_qrcode($UUIDObservasi);
                date_default_timezone_set('ASIA/JAKARTA');
                $tanggal_diproses_admin = date('Y-m-d H:i:s');
                $data = array(
                    'status' => '5',
                    'tanggal_diproses_admin' => $tanggal_diproses_admin,
                    'qr_code' => $generate_qrcode
                );
                $this->izinObservasiMatakuliahModel->where('uuid', $UUIDObservasi)->set($data)->update();
                return redirect()->to('/izin-observasi-matakuliah/semua')->with('sukses','Pengajuan izin observasi diterima oleh Admin!');
            }   
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    // fungsi untuk membuat barcode dan ditempel pada surat
    // akses oleh fungsi setujui kadep
    // POST /izin-observasi-matakuliah/setujui-kadep
    public function generate_qrcode($UUIDObservasi = null)
    {
        $writer = new PngWriter();
        $qrCode = QrCode::create(base_url('izin-observasi-matakuliah/scan-barcode/'.$UUIDObservasi))
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(ErrorCorrectionLevel::Low)
            ->setSize(300)
            ->setMargin(10)
            ->setRoundBlockSizeMode(RoundBlockSizeMode::Margin)
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));

            // Create generic logo
            $logo = Logo::create('logo_unp_barcode.png')
            ->setResizeToWidth(50);

            // Create generic label
            $label = Label::create('')
            ->setTextColor(new Color(255, 0, 0));

            $result = $writer->write($qrCode, $logo, $label);

            // Generate a data URI to include image data inline (i.e. inside an <img> tag)
            $qr = $result->getDataUri();

            return $qr;
    }

    public function scan_barcode($UUIDObservasi)
    {
        if($UUIDObservasi != null) {
            $satu_observasi = $this->izinObservasiMatakuliahModel->getDetail($UUIDObservasi);
            if (!$satu_observasi) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            } else {
                $idObservasi = $satu_observasi['surat_izin_observasi_matakuliah_id'];
                $data_anggota = $this->anggotaObservasiMatakuliahModel->getAllByObservasiId($idObservasi);
                $data = [
                    'judul' => 'Detail Surat Izin Observasi Matakuliah',
                    'satu_observasi' => $satu_observasi,
                    'anggota' => $data_anggota,
                ];
                return view('izin_observasi_matakuliah/v_detail_izin_observasi_matakuliah', $data);
            }   
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

     public function print_surat($UUIDObservasi)
    {
        if($UUIDObservasi != null) {
            $satu_observasi = $this->izinObservasiMatakuliahModel->getDetailForCetak($UUIDObservasi);
            if (!$satu_observasi) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            } else {
            $options = new Options();
            $dompdf = new Dompdf($options);
            $tahun = date('Y', strtotime($satu_observasi['created_at']));
            $tanggal_seminar = tanggal_indo($satu_observasi['created_at']);
            $tanggal_surat = tanggal_indo($satu_observasi['updated_at']);
            $nomor_surat = $satu_observasi['no_surat'] .'/'. $satu_observasi['kd_surat'] .''. $tahun;
            $idObservasi = $satu_observasi['surat_izin_observasi_matakuliah_id'];
            $data_anggota = $this->anggotaObservasiMatakuliahModel->getAllByObservasiId($idObservasi);
            
            $data = array(
                'title_pdf' => 'Surat Izin Observasi Matakuliah',
                'satu_observasi' => $satu_observasi,
                'tanggal_seminar' => $tanggal_seminar,
                'tanggal_surat' => $tanggal_surat,
                'nomor_surat' => $nomor_surat,
                'anggota' => $data_anggota
            );
            $filename = 'surat_izin_observasi_matakuliah'.$satu_observasi['nama_pengajuan'];
            $html = view('izin_observasi_matakuliah/user/v_cetak_surat_izin_observasi_matakuliah', $data);
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4','portrait');
            $dompdf->render();
            $dompdf->stream($filename, array("Attachment" => false));
            exit();
            }   
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }


    public function detail($UUIDObservasi)
    {
        if($UUIDObservasi != null) {
            $satu_observasi = $this->izinObservasiMatakuliahModel->getDetail($UUIDObservasi);
            if (!$satu_observasi) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            } else {
                $idObservasi = $satu_observasi['surat_izin_observasi_matakuliah_id'];
                $data_anggota = $this->anggotaObservasiMatakuliahModel->getAllByObservasiId($idObservasi);
                $data = [
                    'judul' => 'Detail Surat Izin Observasi Matakuliah',
                    'satu_observasi' => $satu_observasi,
                    'anggota' => $data_anggota,
                ];
                return view('izin_observasi_matakuliah/v_detail_izin_observasi_matakuliah', $data);
            }   
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    

   

   
    

    

   


   

    

   

   
    

    
}

?>