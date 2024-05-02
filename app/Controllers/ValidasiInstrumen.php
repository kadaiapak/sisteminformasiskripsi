<?php 
namespace App\Controllers;
use App\Models\DepartemenModel;
use App\Models\ValidasiInstrumenModel;
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
class ValidasiInstrumen extends BaseController
{
    protected $departemenModel;
    protected $validasiInstrumenModel;
    protected $profilModel;
    public function __construct()
    {
        helper('form');
        $this->departemenModel = new DepartemenModel();
        $this->validasiInstrumenModel = new ValidasiInstrumenModel();
        $this->profilModel = new ProfilModel();
    }

    // fungsi untuk melihat semua pengajuan by userid
    // akses oleh mahasiswa
    // GET /validasi-instrumen
    public function index()
    {
        $nim = session()->get('username');
        $status = $this->profilModel->cekIsVerified($nim);
        if($status == null){
            return redirect()->to('/profil/verifikasi')->with('gagal','Silahkan lengkapi data diri');
        }
        $semuaValidasiInstrumen = $this->validasiInstrumenModel->getAll($nim);
        $data = [
            'judul' => 'Surat Validasi Instrumen',
            'semua_validasi_instrumen' => $semuaValidasiInstrumen
        ];

        return view('validasi_instrumen/user/v_validasi_instrumen', $data);
    }

    // fungsi untuk menampilkan form tambah
    // akses oleh mahasiswa
    // GET /validasi-instrumen/tambah
    public function tambah()
    {
        $nim = session()->get('username');
        $semuaDepartemen = $this->departemenModel->findAll();
        $user = $this->profilModel->getDetail($nim);
        $data = [
            'judul' => 'Pengajuan Surat Validasi Instrumen',
            'semua_departemen' => $semuaDepartemen,
            'user' => $user
        ];

        return view('validasi_instrumen/user/form_tambah_validasi_instrumen', $data);
    }

    // fungsi untuk menyimpan pengajuan
    // akses oleh mahasiswa
    // POST /validasi-instrumen/tambah
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
            'status' => 1,
        );
        $this->validasiInstrumenModel->simpan($data);
        return redirect()->to('/validasi-instrumen')->with('sukses','Data berhasil disimpan!');
    }

    // fungsi untuk melihat detail pengajuan
    // akses oleh mahasiswa
    // POST /validasi-instrumen/detail/(:any)
    public function detail($UUIDPenelitian)
    {
        if($UUIDPenelitian != null) {
            $satu_penelitian = $this->validasiInstrumenModel->getDetail($UUIDPenelitian);
            if (!$satu_penelitian) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            } else {
                $data = [
                    'judul' => 'Detail Surat Validasi Instrumen',
                    'satu_penelitian' => $satu_penelitian,
                ];
                return view('validasi_instrumen/v_detail_validasi_instrumen', $data);
            }   
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    // untuk melihat edit pengajuan
    // akses oleh mahasiswa
    // GET /validasi-instrumen/edit/(:any)
    public function edit($UUIDPenelitian)
    {
        if($UUIDPenelitian != null) {
            $satu_penelitian = $this->validasiInstrumenModel->getDetail($UUIDPenelitian);
            if (!$satu_penelitian) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            } else {
                $semuaDepartemen = $this->departemenModel->findAll();
                $data = [
                    'judul' => 'Edit Validasi Instrumen',
                    'satu_penelitian' => $satu_penelitian,
                    'semua_departemen' => $semuaDepartemen
                ];
                return view('validasi_instrumen/user/form_edit_validasi_instrumen', $data);
            }   
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    // untuk menyimpan pembaruan data
    // akses oleh mahasiswa
    // PUT /validasi-instrumen/simpan-pembaruan
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
            'status' => 1,
        );

        $this->validasiInstrumenModel->where('uuid', $UUIDPenelitian)->set($data)->update();
        return redirect()->to('/validasi-instrumen')->with('sukses','Data berhasil disimpan!');
    }

    // melihat semua pengajuan
    // akses oleh admin departemen dan kadep
    // GET /validasi-instrumen/semua
    public function semua()
    {
        $level = session()->get('level');
        $departemen = session()->get('departemen');
        if($departemen == '0'){
            $departemen = null;
        }
        $semuaValidatorInstrumen = $this->validasiInstrumenModel->getAllByAdmin($departemen, $level);
        $data = [
            'judul' => 'Semua Pengajuan Validasi Instrumen',
            'semua_validasi_instrumen' => $semuaValidatorInstrumen
        ];
        return view('validasi_instrumen/admin/v_semua_validasi_instrumen', $data);
    }



    // melihat semua pengajuan yang disetujui
    // akses oleh admin departemen dan kadep
    // GET /validasi-instrumen/disetujui
    public function disetujui()
    {
        $level = session()->get('level');
        $departemen = session()->get('departemen');
        if($departemen == '0'){
            $departemen = null;
        }
        $semuaValidatorInstrumen = $this->validasiInstrumenModel->getAllByAdminYangDisetujui($departemen, $level);
        $data = [
            'judul' => 'Semua Pengajuan Validasi Instrumen',
            'semua_validasi_instrumen' => $semuaValidatorInstrumen
        ];
        return view('validasi_instrumen/admin/v_validasi_instrumen_disetujui', $data);
    }

    // melihat semua pengajuan surat izin yang ditolak
    // akses oleh admin departemen dan kadep
    // GET /validasi-instrumen/ditolak
    public function ditolak()
    {
        $level = session()->get('level');
        $departemen = session()->get('departemen');
        if($departemen == '0'){
            $departemen = null;
        }
        $semuaValidatorInstrumen = $this->validasiInstrumenModel->getAllByAdminYangDitolak($departemen, $level);
        $data = [
            'judul' => 'Semua Pengajuan Validasi Instrumen',
            'semua_validasi_instrumen' => $semuaValidatorInstrumen
        ];
        return view('validasi_instrumen/admin/v_validasi_instrumen_ditolak', $data);
    }

    // untuk edit validator instrumen
    // akses oleh admin departemen  
    // GET /validasi-instrumen/ditolak
    public function edit_admin($UUIDPenelitian)
    {
        if($UUIDPenelitian != null) {
            $satu_penelitian = $this->validasiInstrumenModel->getDetail($UUIDPenelitian);
            if (!$satu_penelitian) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            } else {
                $semuaDepartemen = $this->departemenModel->findAll();
                $data = [
                    'judul' => 'Edit Validasi Instrumen Oleh Admin',
                    'satu_penelitian' => $satu_penelitian,
                    'semua_departemen' => $semuaDepartemen
                ];
                return view('validasi_instrumen/admin/form_edit_validasi_instrumen', $data);
            }   
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    // untuk menyimpan pembaruan oleh admin
    // akses oleh admin departemen
    // POST /validasi-instrumen/admin-simpan-pembaruan
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
            'admin_edit' => session()->get('user_id'),
        );

        $this->validasiInstrumenModel->where('uuid', $UUIDPenelitian)->set($data)->update();
        return redirect()->to('/validasi-instrumen/semua')->with('sukses','Data berhasil disimpan!');
    }

    // untuk melihat detail data yang akan diverifikasi
    // akses oleh admin departemen dan kadep
    // GET /validasi-instrumen/detail-verifikasi/(:any)
    public function detail_verifikasi($UUIDPenelitian)
    {
        if($UUIDPenelitian != null) {
            $satu_penelitian = $this->validasiInstrumenModel->getDetail($UUIDPenelitian);
            if (!$satu_penelitian) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            } else {
                $data = [
                    'judul' => 'Detail Verifikasi Validasi Instrumen',
                    'satu_penelitian' => $satu_penelitian,
                ];
                return view('validasi_instrumen/admin/v_detail_verifikasi_validasi_instrumen', $data);
            }   
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    // proses penolakan izin penelitian
    // akses oleh admin departemen
    // POST /validasi-instrumen/tolak-admin/(:any)
    public function tolak_admin($UUIDPenelitian = null)
    {
        if($UUIDPenelitian != null) {
            $satu_penelitian = $this->validasiInstrumenModel->getDetail($UUIDPenelitian);
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
                $this->validasiInstrumenModel->where('uuid', $UUIDPenelitian)->set($data)->update();
                return redirect()->to('/validasi-instrumen/semua')->with('sukses','Pengajuan seminar ditolak!');
            }   
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    // penyetujuan surat oleh admin
    // akses oleh admin departemen
    // POST /validasi-instrumen/setujui-admin/(:any)
    public function setujui_admin($UUIDPenelitian)
    {
        if($UUIDPenelitian != null) {
            $satu_penelitian = $this->validasiInstrumenModel->getDetail($UUIDPenelitian);
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
                $this->validasiInstrumenModel->where('uuid', $UUIDPenelitian)->set($data)->update();
                return redirect()->to('/validasi-instrumen/semua')->with('sukses','Pengajuan izin observasi diterima oleh Admin!');
            }   
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    // proses penolakan izin penelitian
    // akses oleh kepala departemen
    // POST /validasi-instrumen/tolak-kadep/(:any)
    public function tolak_kadep($UUIDPenelitian)
    {
        if($UUIDPenelitian != null) {
            $satu_penelitian = $this->validasiInstrumenModel->getDetail($UUIDPenelitian);
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
                $this->validasiInstrumenModel->where('uuid', $UUIDPenelitian)->set($data)->update();
                return redirect()->to('/validasi-instrumen/semua')->with('sukses','Pengajuan seminar ditolak!');
            }   
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    // proses setujui izin penelitian
    // akses oleh kepala departemen
    // POST /validasi-instrumen/setujui-kadep/(:any)
    public function setujui_kadep($UUIDPenelitian)
    {
        if($UUIDPenelitian != null) {
            $satu_penelitian = $this->validasiInstrumenModel->getDetail($UUIDPenelitian);
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
                $this->validasiInstrumenModel->where('uuid', $UUIDPenelitian)->set($data)->update();
                return redirect()->to('/validasi-instrumen/semua')->with('sukses','Pengajuan izin observasi diterima oleh Admin!');
            }   
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

     // proses setujui izin penelitian
    // akses oleh kepala departemen
    // POST /validasi-instrumen/cetak
    public function cetak()
    { 
        // 
        $UUIDPenelitian = $this->request->getVar('uuid');
        if($UUIDPenelitian != null) {
            $satu_penelitian = $this->validasiInstrumenModel->getDetail($UUIDPenelitian);
            if (!$satu_penelitian) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            } else {
            $tahun = date('Y', strtotime($satu_penelitian['created_at']));
            $tanggal_seminar = tanggal_indo($satu_penelitian['created_at']);
            $tanggal_surat = tanggal_indo($satu_penelitian['updated_at']);
            $nomor_surat = $satu_penelitian['no_surat'] .'/'. $satu_penelitian['kd_surat'] .''. $tahun;
            $data = [   
                'judul' => 'Detail Surat Validasi Instrumen',
                'satu_penelitian' => $satu_penelitian,
                'nomor_surat' => $nomor_surat,
                'tanggal_surat' => $tanggal_surat,
                'tanggal_seminar' => $tanggal_seminar
            ];
            return view('validasi_instrumen/user/v_cetak_validasi_instrumen', $data);
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
            $satu_penelitian = $this->validasiInstrumenModel->getDetail($UUIDPenelitian);
            if (!$satu_penelitian) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            } else {
                $data = [
                    'judul' => 'Detail Validasi Instrumen',
                    'satu_penelitian' => $satu_penelitian,
                ];
                return view('validasi_instrumen/v_detail_validasi_instrumen', $data);
            }   
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    // function untuk membuat barcode yang akan di tempel di surat
    public function generate_qrcode($UUIDPenelitian = null)
    {
        $writer = new PngWriter();
        $qrCode = QrCode::create(base_url('validasi-instrumen/scan-barcode/'.$UUIDPenelitian))
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
            $satu_penelitian = $this->validasiInstrumenModel->getDetail($UUIDPenelitian);
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
                'title_pdf' => 'Surat Validasi Instrumen',
                'satu_penelitian' => $satu_penelitian,
                'tanggal_seminar' => $tanggal_seminar,
                'tanggal_surat' => $tanggal_surat,
                'nomor_surat' => $nomor_surat
                // 'logo_unp' => $path,
            );
            $filename = 'surat_validasi_instrumen'.$satu_penelitian['nama_pengajuan'];
            $html = view('validasi_instrumen/v_cetak_surat_validasi_instrumen', $data);
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