<?php 
namespace App\Controllers;
use App\Models\IzinObservasiPenelitianModel;
use App\Models\DepartemenModel;
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
class IzinObservasiPenelitian extends BaseController
{
    protected $izinObservasiPenelitianModel;
    protected $departemenModel;
    protected $profilModel;
    public function __construct()
    {
        helper('form');
        $this->izinObservasiPenelitianModel = new IzinObservasiPenelitianModel();
        $this->departemenModel = new DepartemenModel();
        $this->profilModel = new ProfilModel();
    }

    public function index()
    {
        $nim = session()->get('username');
        $status = $this->profilModel->cekIsVerified($nim);
        if($status == null){
            return redirect()->to('/profil/verifikasi')->with('gagal','Silahkan lengkapi data diri');
        }
        $semuaSuratIzinObservasiPenelitian = $this->izinObservasiPenelitianModel->getAll($nim);
        $data = [
            'judul' => 'Surat Izin Observasi Penelitian',
            'semua_izin_observasi_penelitian' => $semuaSuratIzinObservasiPenelitian
        ];

        return view('izin_observasi_penelitian/v_izin_observasi_penelitian', $data);
    }

    public function tambah()
    {
        $nim = session()->get('username');
        $user = $this->profilModel->getDetail($nim);
        $semuaDepartemen = $this->departemenModel->findAll();
        $data = [
            'judul' => 'Pengajuan Surat Izin Observasi Penelian',
            'semua_departemen' => $semuaDepartemen,
            'user' => $user
        ];

        return view('izin_observasi_penelitian/v_tambah_izin_observasi_penelitian', $data);
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
                'rules' => 'required|alpha_space',
                'errors' => [
                    'required' => 'Tuliskan Nama Lengkap',
                    'alpha_space' => 'Nama hanya boleh huruf dan spasi',
                ]
            ],
            'tujuan_surat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tuliskan Tujuan Surat',
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
            'departemen_pengajuan' => $this->request->getVar('departemen_pengajuan'),
            'judul' => $this->request->getVar('judul'),
            'tujuan_surat' => $this->request->getVar('tujuan_surat'),
            'status' => 1,
        );
        $this->izinObservasiPenelitianModel->simpan($data);
        return redirect()->to('/izin-observasi-penelitian')->with('sukses','Data berhasil disimpan!');
    }

    public function semua()
    {
        $level = session()->get('level');
        $departemen = session()->get('departemen');
        if($departemen == '0'){
            $departemen = null;
        }
        $semuaIzinObservasiPenelitian = $this->izinObservasiPenelitianModel->getAllByAdmin($departemen, $level);
        $data = [
            'judul' => 'Semua Pengajuan Izin Observasi Penelitian',
            'semua_izin_observasi_penelitian' => $semuaIzinObservasiPenelitian
        ];
        return view('izin_observasi_penelitian/v_semua_izin_observasi_penelitian', $data);
    }

    // melihat semua pengajuan surat izin observasi yang disetujui
    public function disetujui()
    {
        $level = session()->get('level');
        $departemen = session()->get('departemen');
        if($departemen == '0'){
            $departemen = null;
        }
        $semuaIzinObservasiPenelitian = $this->izinObservasiPenelitianModel->getAllByAdminYangDisetujui($departemen, $level);
        $data = [
            'judul' => 'Semua Pengajuan Izin Observasi Penelitian',
            'semua_izin_observasi_penelitian' => $semuaIzinObservasiPenelitian
        ];
        return view('izin_observasi_penelitian/v_izin_observasi_penelitian_disetujui', $data);
    }

    // melihat semua pengajuan surat izin observasi yang ditolak
    public function ditolak()
    {
        $level = session()->get('level');
        $departemen = session()->get('departemen');
        if($departemen == '0'){
            $departemen = null;
        }
        $semuaIzinObservasiPenelitian = $this->izinObservasiPenelitianModel->getAllByAdminYangDitolak($departemen, $level);
        $data = [
            'judul' => 'Semua Pengajuan Izin Observasi Penelitian',
            'semua_izin_observasi_penelitian' => $semuaIzinObservasiPenelitian
        ];
        return view('izin_observasi_penelitian/v_izin_observasi_penelitian_ditolak', $data);
    }

    public function detail_verifikasi($UUIDObservasi)
    {
        if($UUIDObservasi != null) {
            $satu_observasi = $this->izinObservasiPenelitianModel->getDetail($UUIDObservasi);
            if (!$satu_observasi) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            } else {
                $data = [
                    'judul' => 'Detail Verifikasi Izin Observasi Penelitian',
                    'satu_observasi' => $satu_observasi,
                ];
                return view('izin_observasi_penelitian/v_detail_verifikasi_izin_observasi_penelitian', $data);
            }   
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function setujui_admin($UUIDObservasi)
    {
        if($UUIDObservasi != null) {
            $satu_observasi = $this->izinObservasiPenelitianModel->getDetail($UUIDObservasi);
            if (!$satu_observasi) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            } else {
                date_default_timezone_set('ASIA/JAKARTA');
                $tanggal_diproses_admin = date('Y-m-d H:i:s');
                $data = array(
                    'status' => '3',
                    'no_surat' => $this->request->getVar('no_surat'),
                    'tanggal_diproses_admin' => $tanggal_diproses_admin,
                );
                $this->izinObservasiPenelitianModel->where('uuid', $UUIDObservasi)->set($data)->update();
                return redirect()->to('/izin-observasi-penelitian/semua')->with('sukses','Pengajuan izin observasi diterima oleh Admin!');
            }   
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function tolak_admin($UUIDObservasi = null)
    {
        if($UUIDObservasi != null) {
            $satu_observasi = $this->izinObservasiPenelitianModel->getDetail($UUIDObservasi);
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
                $this->izinObservasiPenelitianModel->where('uuid', $UUIDObservasi)->set($data)->update();
                return redirect()->to('/izin-observasi-penelitian/semua')->with('sukses','Pengajuan seminar ditolak!');
            }   
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function setujui_kadep($UUIDObservasi)
    {
        if($UUIDObservasi != null) {
            $satu_observasi = $this->izinObservasiPenelitianModel->getDetail($UUIDObservasi);
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
                $this->izinObservasiPenelitianModel->where('uuid', $UUIDObservasi)->set($data)->update();
                return redirect()->to('/izin-observasi-penelitian/semua')->with('sukses','Pengajuan izin observasi diterima oleh Admin!');
            }   
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function tolak_kadep($UUIDObservasi)
    {
        if($UUIDObservasi != null) {
            $satu_observasi = $this->izinObservasiPenelitianModel->getDetail($UUIDObservasi);
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
                $this->izinObservasiPenelitianModel->where('uuid', $UUIDObservasi)->set($data)->update();
                return redirect()->to('/izin-observasi-penelitian/semua')->with('sukses','Pengajuan seminar ditolak!');
            }   
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function print_surat($UUIDObservasi)
    {
        if($UUIDObservasi != null) {
            $satu_observasi = $this->izinObservasiPenelitianModel->getDetail($UUIDObservasi);
            if (!$satu_observasi) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            } else {
            $options = new Options();
            $dompdf = new Dompdf($options);
            $tanggal_seminar = tanggal_indo($satu_observasi['created_at']);
            $tanggal_surat = tanggal_indo($satu_observasi['updated_at']);
            $data = array(
                'title_pdf' => 'Surat Izin Observasi Penelitian',
                'satu_observasi' => $satu_observasi,
                'tanggal_seminar' => $tanggal_seminar,
                'tanggal_surat' => $tanggal_surat,
                // 'logo_unp' => $path,
            );
            $filename = 'surat_izin_observasi_penelitian'.$satu_observasi['nama_pengajuan'];
            $html = view('izin_observasi_penelitian/v_cetak_surat_izin_observasi_penelitian', $data);
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

    public function generate_qrcode($UUIDObservasi = null)
    {
        $writer = new PngWriter();
        $qrCode = QrCode::create(base_url('izin-observasi-penelitian/detail-izin-observasi/'.$UUIDObservasi))
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

    public function detail_izin_observasi($UUIDObservasi)
    {
        if($UUIDObservasi != null) {
            $satu_observasi = $this->izinObservasiPenelitianModel->getDetail($UUIDObservasi);
            if (!$satu_observasi) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            } else {
                $data = [
                    'judul' => 'Detail Izin Observasi Penelitian',
                    'satu_observasi' => $satu_observasi,
                ];
                return view('izin_observasi_penelitian/v_detail_izin_observasi_penelitian', $data);
            }   
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
}

?>