<?php 
namespace App\Controllers;
use App\Models\DepartemenModel;
use App\Models\ValidatorInstrumenModel;
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
class ValidatorInstrumen extends BaseController
{
    protected $departemenModel;
    protected $validatorInstrumenModel;
    protected $profilModel;
    public function __construct()
    {
        helper('form');
        $this->departemenModel = new DepartemenModel();
        $this->validatorInstrumenModel = new ValidatorInstrumenModel();
        $this->profilModel = new ProfilModel();
    }

    public function index()
    {
        $nim = session()->get('username');
        $status = $this->profilModel->cekIsVerified($nim);
        if($status == null){
            return redirect()->to('/profil/verifikasi')->with('gagal','Silahkan lengkapi data diri');
        }
        $semuaSuratValidatorInstrumen = $this->validatorInstrumenModel->getAll($nim);
        $data = [
            'judul' => 'Validator Instrumen',
            'semua_validator_instrumen' => $semuaSuratValidatorInstrumen
        ];
        return view('validator_instrumen/v_validator_instrumen', $data);
    }

    // fungsi untuk melihat semua surat validator instrumen yang sudah disetujui
    // akses oleh admin departemen
    // GET /validator-instrumen/selesai
    public function selesai()
    {
        $level = session()->get('level');
        $departemen = session()->get('departemen');
        if($departemen == '0'){
            $departemen = null;
        }
        $semuaSuratValidatorInstrumen = $this->validatorInstrumenModel->getAllByAdminYangSelesai($departemen, $level);
        $data = [
            'judul' => 'Semua Pengajuan Izin Observasi Penelitian Selesai',
            'semuaSuratValidatorInstrumen' => $semuaSuratValidatorInstrumen
        ];
        return view('validator_instrumen/v_semua_validator_instrumen_selesai', $data);
    }

    public function tambah()
    {
        $nim = session()->get('username');
        $user = $this->profilModel->getDetail($nim);
        $data = [
            'judul' => 'Pengajuan Surat Validator Instrumen',
            'user' => $user
        ];
        return view('validator_instrumen/v_tambah_validator_instrumen', $data);
    }

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
        ])){
            return redirect()->back()->withInput();
        }
        
        $data = array(
            'user_pengajuan' => session()->get('username'),
            'nama_pengajuan' => $this->request->getVar('nama_pengajuan'),
            'nim_pengajuan' => $this->request->getVar('nim_pengajuan'),
            'judul' => $this->request->getVar('judul'),
            'departemen_pengajuan' => $this->request->getVar('departemen_pengajuan'),
            'nama_dosen_validator_satu' => $this->request->getVar('nama_dosen_validator_satu'),
            'bidang_dosen_validator_satu' => $this->request->getVar('bidang_dosen_validator_satu'),
            'nama_dosen_validator_dua' => $this->request->getVar('nama_dosen_validator_dua'),
            'bidang_dosen_validator_dua' => $this->request->getVar('bidang_dosen_validator_dua'),
            'nama_dosen_validator_tiga' => $this->request->getVar('nama_dosen_validator_tiga'),
            'bidang_dosen_validator_tiga' => $this->request->getVar('bidang_dosen_validator_tiga'),
            'status' => 1,
        );
        $this->validatorInstrumenModel->simpan($data);
        return redirect()->to('/validator-instrumen')->with('sukses','Data berhasil disimpan!');
    }

    // untuk melihat detail validator instrumen yang digunakan oleh mahasiswa
    // akses oleh mahasiswa
    public function edit($UUIDInstrumen)
    {
        if($UUIDInstrumen != null) {
            $satu_instrumen = $this->validatorInstrumenModel->getDetail($UUIDInstrumen);
            if (!$satu_instrumen) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            } else {
                $semuaDepartemen = $this->departemenModel->findAll();
                $data = [
                    'judul' => 'Edit Pengajuan Validator Instrumen',
                    'satu_instrumen' => $satu_instrumen,
                    'semua_departemen' => $semuaDepartemen
                ];
                return view('validator_instrumen/v_edit_validator_instrumen', $data);
            }   
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    // untuk menyimpan pembaruan validator instrumen yang dibuat oleh mahasiswa
    // akses oleh mahasiswa
    public function simpan_pembaruan()
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
                'rules' => 'required|alpha_space',
                'errors' => [
                    'required' => 'Tuliskan Nama Lengkap',
                    'alpha_space' => 'Nama hanya boleh huruf dan spasi',
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
        ])){
            return redirect()->back()->withInput();
        }

        $UUIDInstrumen = $this->request->getVar('UUIDInstrumen');
       
        $data = array(
            'user_pengajuan' => session()->get('username'),
            'nama_pengajuan' => $this->request->getVar('nama_pengajuan'),
            'nim_pengajuan' => $this->request->getVar('nim_pengajuan'),
            'judul' => $this->request->getVar('judul'),
            'departemen_pengajuan' => $this->request->getVar('departemen_pengajuan'),
            'nama_dosen_validator_satu' => $this->request->getVar('nama_dosen_validator_satu'),
            'bidang_dosen_validator_satu' => $this->request->getVar('bidang_dosen_validator_satu'),
            'nama_dosen_validator_dua' => $this->request->getVar('nama_dosen_validator_dua'),
            'bidang_dosen_validator_dua' => $this->request->getVar('bidang_dosen_validator_dua'),
            'nama_dosen_validator_tiga' => $this->request->getVar('nama_dosen_validator_tiga'),
            'bidang_dosen_validator_tiga' => $this->request->getVar('bidang_dosen_validator_tiga'),
            'status' => 1,
        );

        $this->validatorInstrumenModel->where('uuid', $UUIDInstrumen)->set($data)->update();
        return redirect()->to('/validator-instrumen')->with('sukses','Data berhasil disimpan!');
    }

    // untuk melihat detail validator instrumen yang digunakan oleh mahasiswa
    // akses oleh mahasiswa
    public function detail_validator_instrumen($UUIDInstrumen)
    {
        if($UUIDInstrumen != null) {
            $satu_instrumen = $this->validatorInstrumenModel->getDetail($UUIDInstrumen);
            if (!$satu_instrumen) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            } else {
                $data = [
                    'judul' => 'Detail Surat Izin Validator Instrumen',
                    'satu_instrumen' => $satu_instrumen,
                ];
                return view('validator_instrumen/v_detail_validator_instrumen', $data);
            }   
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    // melihat semua pengajuan surat validator instrumen
    // akses oleh admin departemen dan kadep
    public function semua()
    {
        $level = session()->get('level');
        $departemen = session()->get('departemen');
        if($departemen == '0'){
            $departemen = null;
        }
        $semuaValidatorInstrumen = $this->validatorInstrumenModel->getAllByAdmin($departemen, $level);
        $data = [
            'judul' => 'Semua Pengajuan Validator Instrumen',
            'semua_validator_instrumen' => $semuaValidatorInstrumen
        ];
        return view('validator_instrumen/v_semua_validator_instrumen', $data);
    }

    // untuk edit validator instrumen
    // akses oleh admin departemen  
     public function edit_admin($UUIDInstrumen)
     {
         if($UUIDInstrumen != null) {
             $satu_instrumen = $this->validatorInstrumenModel->getDetail($UUIDInstrumen);
             if (!$satu_instrumen) {
                 throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
             } else {
                 $semuaDepartemen = $this->departemenModel->findAll();
                 $data = [
                     'judul' => 'Edit Izin Validator Instrumen Oleh Admin',
                     'satu_instrumen' => $satu_instrumen,
                     'semua_departemen' => $semuaDepartemen
                 ];
                 return view('validator_instrumen/v_edit_admin_validator_instrumen', $data);
             }   
         } else {
             throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
         }
     }

    // untuk menyimpan pembaruan validator instrumen yang dibuat oleh mahasiswa
    // akses oleh admin departemen
    public function simpan_pembaruan_admin()
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
                'rules' => 'required|alpha_space',
                'errors' => [
                    'required' => 'Tuliskan Nama Lengkap',
                    'alpha_space' => 'Nama hanya boleh huruf dan spasi',
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
        ])){
            return redirect()->back()->withInput();
        }

        $UUIDInstrumen = $this->request->getVar('UUIDInstrumen');
       
        $data = array(
            'judul' => $this->request->getVar('judul'),
            'nama_dosen_validator_satu' => $this->request->getVar('nama_dosen_validator_satu'),
            'bidang_dosen_validator_satu' => $this->request->getVar('bidang_dosen_validator_satu'),
            'nama_dosen_validator_dua' => $this->request->getVar('nama_dosen_validator_dua'),
            'bidang_dosen_validator_dua' => $this->request->getVar('bidang_dosen_validator_dua'),
            'nama_dosen_validator_tiga' => $this->request->getVar('nama_dosen_validator_tiga'),
            'bidang_dosen_validator_tiga' => $this->request->getVar('bidang_dosen_validator_tiga'),
            'status' => 1,
        );

        $this->validatorInstrumenModel->where('uuid', $UUIDInstrumen)->set($data)->update();
        return redirect()->to('/validator-instrumen/semua')->with('sukses','Data berhasil disimpan!');
    }

    // melihat semua pengajuan surat izin observasi yang disetujui
    // akses oleh admin departemen dan kadep
    public function disetujui()
    {
        $level = session()->get('level');
        $departemen = session()->get('departemen');
        if($departemen == '0'){
            $departemen = null;
        }
        $semuaValidatorInstrumen = $this->validatorInstrumenModel->getAllByAdminYangDisetujui($departemen, $level);
        $data = [
            'judul' => 'Validator Instrumen Disetujui',
            'semua_validator_instrumen' => $semuaValidatorInstrumen
        ];
        return view('validator_instrumen/v_validator_instrumen_disetujui', $data);
    }

    // melihat semua pengajuan surat izin observasi yang ditolak
    // akses oleh admin departemen dan kadep
    public function ditolak()
    {
        $level = session()->get('level');
        $departemen = session()->get('departemen');
        if($departemen == '0'){
            $departemen = null;
        }
        $semuaValidatorInstrumen = $this->validatorInstrumenModel->getAllByAdminYangDitolak($departemen, $level);
        $data = [
            'judul' => 'Validator Instrumen Ditolak',
            'semua_validator_instrumen' => $semuaValidatorInstrumen
        ];
        return view('validator_instrumen/v_validator_instrumen_ditolak', $data);
    }

    // untuk melihat detail validator instrumen dan melakukan verifikasi
    // akses oleh admin departemen dan kadep
    public function detail_verifikasi($UUIDInstrumen)
    {
        if($UUIDInstrumen != null) {
            $satu_instrumen = $this->validatorInstrumenModel->getDetail($UUIDInstrumen);
            if (!$satu_instrumen) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            } else {
                $data = [
                    'judul' => 'Detail Verifikasi Validator Instrumen',
                    'satu_instrumen' => $satu_instrumen,
                ];
                return view('validator_instrumen/v_detail_verifikasi_validator_instrumen', $data);
            }   
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    // proses penolakan surat validator instrumen yang diajukan oleh mahasiswa
    // akses oleh admin departemen
    public function tolak_admin($UUIDInstrumen = null)
    {
        if($UUIDInstrumen != null) {
            $satu_instrumen = $this->validatorInstrumenModel->getDetail($UUIDInstrumen);
            if (!$satu_instrumen) {
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
                $this->validatorInstrumenModel->where('uuid', $UUIDInstrumen)->set($data)->update();
                return redirect()->to('/validator-instrumen/semua')->with('sukses','Pengajuan seminar ditolak!');
            }   
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }


    // penyetujuan surat validator instrumen yang dibuat oleh mahasiswa
    // akses oleh admin departemen
    public function setujui_admin($UUIDInstrumen)
    {
        if($UUIDInstrumen != null) {
            $satu_instrumen = $this->validatorInstrumenModel->getDetail($UUIDInstrumen);
            if (!$satu_instrumen) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            } else {
                date_default_timezone_set('ASIA/JAKARTA');
                $tanggal_diproses_admin = date('Y-m-d H:i:s');
                $data = array(
                    'status' => '3',
                    'no_surat' => $this->request->getVar('no_surat'),
                    'tanggal_diproses_admin' => $tanggal_diproses_admin,
                );
                $this->validatorInstrumenModel->where('uuid', $UUIDInstrumen)->set($data)->update();
                return redirect()->to('/validator-instrumen/semua')->with('sukses','Pengajuan izin observasi diterima oleh Admin!');
            }   
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function tolak_kadep($UUIDInstrumen)
    {
        if($UUIDInstrumen != null) {
            $satu_instrumen = $this->validatorInstrumenModel->getDetail($UUIDInstrumen);
            if (!$satu_instrumen) {
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
                $this->validatorInstrumenModel->where('uuid', $UUIDInstrumen)->set($data)->update();
                return redirect()->to('/validator-instrumen/semua')->with('sukses','Pengajuan seminar ditolak!');
            }   
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
    

    public function setujui_kadep($UUIDInstrumen)
    {
        if($UUIDInstrumen != null) {
            $satu_instrumen = $this->validatorInstrumenModel->getDetail($UUIDInstrumen);
            if (!$satu_instrumen) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            } else {
                $generate_qrcode = $this->generate_qrcode($UUIDInstrumen);
                date_default_timezone_set('ASIA/JAKARTA');
                $tanggal_diproses_admin = date('Y-m-d H:i:s');
                $data = array(
                    'status' => '5',
                    'tanggal_diproses_admin' => $tanggal_diproses_admin,
                    'qr_code' => $generate_qrcode
                );
                $this->validatorInstrumenModel->where('uuid', $UUIDInstrumen)->set($data)->update();
                return redirect()->to('/validator-instrumen/semua')->with('sukses','Pengajuan izin observasi diterima oleh Admin!');
            }   
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function generate_qrcode($UUIDInstrumen = null)
    {
        $writer = new PngWriter();
        $qrCode = QrCode::create(base_url('validator-instrumen/detail-validator-instrumen/'.$UUIDInstrumen))
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

    
    public function print_surat($UUIDInstrumen)
    {
        if($UUIDInstrumen != null) {
            $satu_instrumen = $this->validatorInstrumenModel->getDetail($UUIDInstrumen);
            if (!$satu_instrumen) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            } else {
            $options = new Options();
            $dompdf = new Dompdf($options);
            $tahun = date('Y', strtotime($satu_instrumen['created_at']));
            $nomor_surat = $satu_instrumen['no_surat'] .'/'. $satu_instrumen['kd_surat'] .''. $tahun;
            $tanggal_seminar = tanggal_indo($satu_instrumen['created_at']);
            $tanggal_surat = tanggal_indo($satu_instrumen['updated_at']);
            $data = array(
                'title_pdf' => 'Surat Validator Instrumen',
                'satu_instrumen' => $satu_instrumen,
                'tanggal_seminar' => $tanggal_seminar,
                'tanggal_surat' => $tanggal_surat,
                'nomor_surat' => $nomor_surat
                // 'logo_unp' => $path,
            );
            $filename = 'surat_validator_instrumen'.$satu_instrumen['nama_pengajuan'];
            $html = view('validator_instrumen/v_cetak_surat_validator_instrumen', $data);
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