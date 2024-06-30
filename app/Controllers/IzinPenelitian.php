<?php 
namespace App\Controllers;
use App\Models\DepartemenModel;
use App\Models\IzinPenelitianModel;
use App\Models\ProfilModel;

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
class IzinPenelitian extends BaseController
{
    protected $departemenModel;
    protected $izinPenelitianModel;
    protected $profilModel;
    public function __construct()
    {
        helper('form');
        $this->departemenModel = new DepartemenModel();
        $this->izinPenelitianModel = new IzinPenelitianModel();
        $this->profilModel = new ProfilModel();
    }

    // fungsi untuk melihat semua pengajuan by userid
    // akses oleh mahasiswa
    // GET /izin-penelitian
    public function index()
    {
        $nim = session()->get('username');
        $status = $this->profilModel->cekIsVerified($nim);
        if($status == null){
            return redirect()->to('/profil/verifikasi')->with('gagal','Silahkan lengkapi data diri');
        }
        $semuaIzinPenelitian = $this->izinPenelitianModel->getAll($nim);
        $data = [
            'judul' => 'Surat Izin Penelitian',
            'semua_izin_penelitian' => $semuaIzinPenelitian
        ];

        return view('izin_penelitian/user/v_izin_penelitian', $data);
    }

    // fungsi untuk melihat semua surat izin penelitian yang sudah disetujui
    // akses oleh admin departemen
    // GET /izin-penelitian/selesai
    public function selesai()
    {
        $level = session()->get('level');
        $departemen = session()->get('departemen');
        if($departemen == '0'){
            $departemen = null;
        }
        $semuaIzinPenelitianSelesai = $this->izinPenelitianModel->getAllByAdminYangSelesai($departemen, $level);
        $data = [
            'judul' => 'Semua Pengajuan Izin Penelitian Selesai',
            'semuaIzinPenelitianSelesai' => $semuaIzinPenelitianSelesai
        ];
        return view('izin_penelitian/admin/v_semua_izin_penelitian_selesai', $data);
    }

    // fungsi untuk menampilkan form tambah
    // akses oleh mahasiswa
    // GET /izin-penelitian/tambah
    public function tambah()
    {
        $nim = session()->get('username');
        $semuaDepartemen = $this->departemenModel->findAll();
        $user = $this->profilModel->getDetail($nim);
        $data = [
            'judul' => 'Pengajuan Surat Izin Penelitian',
            'semua_departemen' => $semuaDepartemen,
            'user' => $user
        ];

        return view('izin_penelitian/user/form_tambah_izin_penelitian', $data);
    }

    // fungsi untuk menyimpan pengajuan
    // akses oleh mahasiswa
    // POST /izin-penelitian/tambah
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
            'departemen_pengajuan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih Departemen',
                ]
            ],
            'judul' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tuliskan Judul',
                ]
            ],
            'tujuan_surat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tuliskan kepada siapa surat ditujukan',
                ]
            ],
            'tempat_penelitian' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tuliskan tempat penelitian',
                ]
            ],
            'alamat_tempat_penelitian' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tuliskan alamat tempat',
                ]
            ],
            'tanggal_mulai' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tuliskan tanggal mulai',
                ]
            ],
            'tanggal_selesai' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tuliskan tanggal selesai penelitian',
                ]
            ],
            'objek_penelitian' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tuliskan objek penelitian',
                ]
            ],
        ])){
            return redirect()->back()->withInput();
        }
       
        $data = array(
            'user_pengajuan' => session()->get('username'),
            'nama_pengajuan' => $this->request->getVar('nama_pengajuan'),
            'nim_pengajuan' => $this->request->getVar('nim_pengajuan'),
            'departemen_pengajuan' => $this->request->getVar('departemen_pengajuan'),
            'judul' => $this->request->getVar('judul'),
            'tujuan_surat' => $this->request->getVar('tujuan_surat'),
            'tempat_penelitian' => $this->request->getVar('tempat_penelitian'),
            'alamat_tempat_penelitian' => $this->request->getVar('alamat_tempat_penelitian'),
            'tanggal_mulai' => $this->request->getVar('tanggal_mulai'),
            'tanggal_selesai' => $this->request->getVar('tanggal_selesai'),
            'objek_penelitian' => $this->request->getVar('objek_penelitian'),
            'status' => 1,
        );
        $this->izinPenelitianModel->simpan($data);
        return redirect()->to('/izin-penelitian')->with('sukses','Data berhasil disimpan!');
    }

    // fungsi untuk melihat detail pengajuan
    // akses oleh mahasiswa
    // POST /izin-penelitian/detail/(:any)
    public function detail($UUIDPenelitian)
    {
        if($UUIDPenelitian != null) {
            $satu_penelitian = $this->izinPenelitianModel->getDetail($UUIDPenelitian);
            if (!$satu_penelitian) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            } else {
                $data = [
                    'judul' => 'Detail Surat Izin Penelitian',
                    'satu_penelitian' => $satu_penelitian,
                ];
                return view('izin_penelitian/v_detail_izin_penelitian', $data);
            }   
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    // untuk melihat edit pengajuan
    // akses oleh mahasiswa
    // GET /izin-penelitian/edit/(:any)
    public function edit($UUIDPenelitian)
    {
        if($UUIDPenelitian != null) {
            $satu_penelitian = $this->izinPenelitianModel->getDetail($UUIDPenelitian);
            if (!$satu_penelitian) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            } else {
                $semuaDepartemen = $this->departemenModel->findAll();
                $data = [
                    'judul' => 'Edit Izin Izin Penelitian',
                    'satu_penelitian' => $satu_penelitian,
                    'semua_departemen' => $semuaDepartemen
                ];
                return view('izin_penelitian/user/form_edit_izin_penelitian', $data);
            }   
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    // untuk menyimpan pembaruan data
    // akses oleh mahasiswa
    // PUT /izin-penelitian/simpan-pembaruan
    public function simpan_pembaruan()
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
            'departemen_pengajuan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih Departemen',
                ]
            ],
            'judul' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tulis Judul',
                ]
            ],
            'tujuan_surat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tuliskan Tujuan Surat',
                ]
            ],
            'tempat_penelitian' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tulis tempat penelitian',
                ]
            ],
            'alamat_tempat_penelitian' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tulis alamat tempat penelitian',
                ]
            ],
            'objek_penelitian' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tuliskan objek penelitian',
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

        $UUIDPenelitian = $this->request->getVar('uuid');
       
        $data = array(
            'user_pengajuan' => session()->get('username'),
            'nama_pengajuan' => $this->request->getVar('nama_pengajuan'),
            'nim_pengajuan' => $this->request->getVar('nim_pengajuan'),
            'departemen_pengajuan' => $this->request->getVar('departemen_pengajuan'),
            'judul' => $this->request->getVar('judul'),
            'tujuan_surat' => $this->request->getVar('tujuan_surat'),
            'tempat_penelitian' => $this->request->getVar('tempat_penelitian'),
            'alamat_tempat_penelitian' => $this->request->getVar('alamat_tempat_penelitian'),
            'objek_penelitian' => $this->request->getVar('objek_penelitian'),
            'tanggal_mulai' => $this->request->getVar('tanggal_mulai'),
            'tanggal_selesai' => $this->request->getVar('tanggal_selesai'),
            'status' => 1,
        );

        $this->izinPenelitianModel->where('uuid', $UUIDPenelitian)->set($data)->update();
        return redirect()->to('/izin-penelitian')->with('sukses','Data berhasil disimpan!');
    }

    // melihat semua pengajuan
    // akses oleh admin departemen dan kadep
    // GET /izin-penelitian/semua
    public function semua()
    {
        $level = session()->get('level');
        $departemen = session()->get('departemen');
        if($departemen == '0'){
            $departemen = null;
        }
        $semuaValidatorInstrumen = $this->izinPenelitianModel->getAllByAdmin($departemen, $level);
        $data = [
            'judul' => 'Semua Pengajuan Izin Penelitian',
            'semua_izin_penelitian' => $semuaValidatorInstrumen
        ];
        return view('izin_penelitian/admin/v_semua_izin_penelitian', $data);
    }



    // melihat semua pengajuan yang disetujui
    // akses oleh admin departemen dan kadep
    // GET /izin-penelitian/disetujui
    public function disetujui()
    {
        $level = session()->get('level');
        $departemen = session()->get('departemen');
        if($departemen == '0'){
            $departemen = null;
        }
        $semuaValidatorInstrumen = $this->izinPenelitianModel->getAllByAdminYangDisetujui($departemen, $level);
        $data = [
            'judul' => 'Semua Pengajuan Izin Penelitian',
            'semua_izin_penelitian' => $semuaValidatorInstrumen
        ];
        return view('izin_penelitian/admin/v_izin_penelitian_disetujui', $data);
    }

    // melihat semua pengajuan surat izin yang ditolak
    // akses oleh admin departemen dan kadep
    // GET /izin-penelitian/ditolak
    public function ditolak()
    {
        $level = session()->get('level');
        $departemen = session()->get('departemen');
        if($departemen == '0'){
            $departemen = null;
        }
        $semuaValidatorInstrumen = $this->izinPenelitianModel->getAllByAdminYangDitolak($departemen, $level);
        $data = [
            'judul' => 'Semua Pengajuan Izin Penelitian',
            'semua_izin_penelitian' => $semuaValidatorInstrumen
        ];
        return view('izin_penelitian/admin/v_izin_penelitian_ditolak', $data);
    }

    // untuk edit validator instrumen
    // akses oleh admin departemen  
    // GET /izin-penelitian/ditolak
    public function edit_admin($UUIDPenelitian)
    {
        if($UUIDPenelitian != null) {
            $satu_penelitian = $this->izinPenelitianModel->getDetail($UUIDPenelitian);
            if (!$satu_penelitian) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            } else {
                $semuaDepartemen = $this->departemenModel->findAll();
                $data = [
                    'judul' => 'Edit Izin Izin Penelitian Oleh Admin',
                    'satu_penelitian' => $satu_penelitian,
                    'semua_departemen' => $semuaDepartemen
                ];
                return view('izin_penelitian/admin/form_edit_izin_penelitian', $data);
            }   
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    // untuk menyimpan pembaruan oleh admin
    // akses oleh admin departemen
    // POST /izin-penelitian/admin-simpan-pembaruan
    public function simpan_pembaruan_admin()
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
            'departemen_pengajuan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih Departemen',
                ]
            ],
            'judul' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tulis Judul',
                ]
            ],
            'tujuan_surat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tuliskan Tujuan Surat',
                ]
            ],
            'tempat_penelitian' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tulis tempat penelitian',
                ]
            ],
            'alamat_tempat_penelitian' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tulis alamat tempat penelitian',
                ]
            ],
            'objek_penelitian' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tuliskan objek penelitian',
                ]
            ],
            'tanggal_mulai' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tuliskan Kapan dimulai penelitian',
                ]
            ],
            'tanggal_selesai' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tuliskan Kapan selesai penelitian',
                ]
            ],
        ])){
            return redirect()->back()->withInput();
        }

        $UUIDPenelitian = $this->request->getVar('uuid');
        $data = array(
            'nama_pengajuan' => $this->request->getVar('nama_pengajuan'),
            'nim_pengajuan' => $this->request->getVar('nim_pengajuan'),
            'departemen_pengajuan' => $this->request->getVar('departemen_pengajuan'),
            'judul' => $this->request->getVar('judul'),
            'tujuan_surat' => $this->request->getVar('tujuan_surat'),
            'tempat_penelitian' => $this->request->getVar('tempat_penelitian'),
            'alamat_tempat_penelitian' => $this->request->getVar('alamat_tempat_penelitian'),
            'objek_penelitian' => $this->request->getVar('objek_penelitian'),
            'tanggal_mulai' => $this->request->getVar('tanggal_mulai'),
            'tanggal_selesai' => $this->request->getVar('tanggal_selesai'),
        );


        $this->izinPenelitianModel->where('uuid', $UUIDPenelitian)->set($data)->update();
        return redirect()->to('/izin-penelitian/semua')->with('sukses','Data berhasil disimpan!');
    }

    // untuk melihat detail data yang akan diverifikasi
    // akses oleh admin departemen dan kadep
    // GET /izin-penelitian/detail-verifikasi/(:any)
    public function detail_verifikasi($UUIDPenelitian)
    {
        if($UUIDPenelitian != null) {
            $satu_penelitian = $this->izinPenelitianModel->getDetail($UUIDPenelitian);
            if (!$satu_penelitian) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            } else {
                $data = [
                    'judul' => 'Detail Verifikasi Izin Penelitian',
                    'satu_penelitian' => $satu_penelitian,
                ];
                return view('izin_penelitian/admin/v_detail_verifikasi_izin_penelitian', $data);
            }   
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    // proses penolakan izin penelitian
    // akses oleh admin departemen
    // POST /izin-penelitian/tolak-admin/(:any)
    public function tolak_admin($UUIDPenelitian = null)
    {
        if($UUIDPenelitian != null) {
            $satu_penelitian = $this->izinPenelitianModel->getDetail($UUIDPenelitian);
            if (!$satu_penelitian) {
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
                $this->izinPenelitianModel->where('uuid', $UUIDPenelitian)->set($data)->update();
                return redirect()->to('/izin-penelitian/semua')->with('sukses','Pengajuan seminar ditolak!');
            }   
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    // penyetujuan surat oleh admin
    // akses oleh admin departemen
    // POST /izin-penelitian/setujui-admin/(:any)
    public function setujui_admin($UUIDPenelitian)
    {
        if($UUIDPenelitian != null) {
            $satu_penelitian = $this->izinPenelitianModel->getDetail($UUIDPenelitian);
            if (!$satu_penelitian) {
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
                    session()->setFlashdata('gagal', 'Silahkan tuliskan nomor surat');
                    return redirect()->back()->withInput();
                }
                date_default_timezone_set('ASIA/JAKARTA');
                $tanggal_diproses_admin = date('Y-m-d H:i:s');
                $data = array(
                    'status' => '3',
                    'no_surat' => $this->request->getVar('no_surat'),
                    'tanggal_diproses_admin' => $tanggal_diproses_admin,
                );
                $this->izinPenelitianModel->where('uuid', $UUIDPenelitian)->set($data)->update();
                return redirect()->to('/izin-penelitian/semua')->with('sukses','Pengajuan izin observasi diterima oleh Admin!');
            }   
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    // proses penolakan izin penelitian
    // akses oleh kepala departemen
    // POST /izin-penelitian/tolak-kadep/(:any)
    public function tolak_kadep($UUIDPenelitian)
    {
        if($UUIDPenelitian != null) {
            $satu_penelitian = $this->izinPenelitianModel->getDetail($UUIDPenelitian);
            if (!$satu_penelitian) {
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
                $this->izinPenelitianModel->where('uuid', $UUIDPenelitian)->set($data)->update();
                return redirect()->to('/izin-penelitian/semua')->with('sukses','Pengajuan seminar ditolak!');
            }   
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    // proses setujui izin penelitian
    // akses oleh kepala departemen
    // POST /izin-penelitian/setujui-kadep/(:any)
    public function setujui_kadep($UUIDPenelitian)
    {
        if($UUIDPenelitian != null) {
            $satu_penelitian = $this->izinPenelitianModel->getDetail($UUIDPenelitian);
            if (!$satu_penelitian) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            } else {
                $generate_qrcode = $this->generate_qrcode($UUIDPenelitian);
                date_default_timezone_set('ASIA/JAKARTA');
                $tanggal_diproses_admin = date('Y-m-d H:i:s');
                $data = array(
                    'status' => '5',
                    'tanggal_diproses_admin' => $tanggal_diproses_admin,
                    'qr_code' => $generate_qrcode
                );
                $this->izinPenelitianModel->where('uuid', $UUIDPenelitian)->set($data)->update();
                return redirect()->to('/izin-penelitian/semua')->with('sukses','Pengajuan izin observasi diterima oleh Admin!');
            }   
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

     // proses setujui izin penelitian
    // akses oleh kepala departemen
    // POST /izin-penelitian/cetak
    public function cetak()
    { 
        // 
        $UUIDPenelitian = $this->request->getVar('uuid');
        if($UUIDPenelitian != null) {
            $satu_penelitian = $this->izinPenelitianModel->getDetail($UUIDPenelitian);
            if (!$satu_penelitian) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            } else {
            $tahun = date('Y', strtotime($satu_penelitian['created_at']));
            $tanggal_seminar = tanggal_indo($satu_penelitian['created_at']);
            $tanggal_surat = tanggal_indo($satu_penelitian['updated_at']);
            $nomor_surat = $satu_penelitian['no_surat'] .'/'. $satu_penelitian['kd_surat'] .''. $tahun;
            $data = [   
                'judul' => 'Detail Surat Izin Penelitian',
                'satu_penelitian' => $satu_penelitian,
                'nomor_surat' => $nomor_surat,
                'tanggal_surat' => $tanggal_surat,
                'tanggal_seminar' => $tanggal_seminar
            ];
            return view('izin_penelitian/user/v_cetak_izin_penelitian', $data);
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

      // untuk melihat detail validator instrumen yang digunakan oleh mahasiswa
    // akses oleh mahasiswa
    public function scan_barcode($UUIDPenelitian)
    {
        if($UUIDPenelitian != null) {
            $satu_penelitian = $this->izinPenelitianModel->getDetail($UUIDPenelitian);
            if (!$satu_penelitian) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            } else {
                $data = [
                    'judul' => 'Detail Izin Izin Penelitian',
                    'satu_penelitian' => $satu_penelitian,
                ];
                return view('izin_penelitian/v_detail_izin_penelitian', $data);
            }   
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    // function untuk membuat barcode yang akan di tempel di surat
    public function generate_qrcode($UUIDPenelitian = null)
    {
        $writer = new PngWriter();
        $qrCode = QrCode::create(base_url('izin-penelitian/scan-barcode/'.$UUIDPenelitian))
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(ErrorCorrectionLevel::Low)
            ->setSize(300)
            ->setMargin(10)
            ->setRoundBlockSizeMode(RoundBlockSizeMode::Margin)
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));

            // Create generic logo
            $logo = Logo::create('logo_untuk_barcode.png')
            ->setResizeToWidth(50)
            ->setPunchoutBackground(true)
            ;

            // Create generic label
            $label = Label::create('')
            ->setTextColor(new Color(255, 0, 0));

            $result = $writer->write($qrCode, $logo, $label);

            // Generate a data URI to include image data inline (i.e. inside an <img> tag)
            $qr = $result->getDataUri();

            return $qr;
    }


   

    // ------------------------------------------------------------

  

    

   

   



    


 

    
    

    

   


   
    
    public function print_surat($UUIDPenelitian)
    {
        if($UUIDPenelitian != null) {
            $satu_penelitian = $this->izinPenelitianModel->getDetail($UUIDPenelitian);
            if (!$satu_penelitian) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            } else {
            $options = new Options();
            $dompdf = new Dompdf($options);
            $tahun = date('Y', strtotime($satu_penelitian['created_at']));
            $nomor_surat = $satu_penelitian['no_surat'] .'/'. $satu_penelitian['kd_surat'] .''. $tahun;
            $tanggal_seminar = tanggal_indo($satu_penelitian['created_at']);
            $tanggal_surat = tanggal_indo($satu_penelitian['updated_at']);
            $data = array(
                'title_pdf' => 'Surat Izin Penelitian',
                'satu_penelitian' => $satu_penelitian,
                'tanggal_seminar' => $tanggal_seminar,
                'tanggal_surat' => $tanggal_surat,
                'nomor_surat' => $nomor_surat
                // 'logo_unp' => $path,
            );
            $filename = 'surat_izin_penelitian'.$satu_penelitian['nama_pengajuan'];
            $html = view('izin_penelitian/v_cetak_surat_izin_penelitian', $data);
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

    
}

?>