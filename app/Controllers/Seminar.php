<?php

namespace App\Controllers;

use App\Models\SeminarModel;
use App\Models\SkripsiModel;
use App\Models\SesiModel;
use App\Models\RuanganModel;
use App\Models\ProfilModel;
use App\Models\DosenModel;
use App\Models\PersyaratanSeminarModel;
use App\Models\FilePersyaratanSeminarModel;
use App\Models\HariModel;
use App\Models\MahasiswaStatusSkripsiModel;
use App\Models\MengikutiSeminarModel;
use App\Models\ProgresSkripsiModel;

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

use DateTime;
class Seminar extends BaseController
{
    protected $skripsiModel;
    protected $seminarModel;
    protected $sesiModel;
    protected $ruanganModel;
    protected $profilModel;
    protected $dosenModel;
    protected $persyaratanSeminarModel;
    protected $filePersyaratanSeminarModel;
    protected $hariModel;
    protected $mahasiswaStatusSkripsiModel;
    protected $mengikutiSeminarModel;
    protected $progresSkripsiModel;

    public function __construct()
    {
        helper('form');
        $this->seminarModel = new SeminarModel();
        $this->skripsiModel = new SkripsiModel();
        $this->sesiModel = new SesiModel();
        $this->ruanganModel = new RuanganModel();
        $this->profilModel = new ProfilModel();
        $this->dosenModel = new DosenModel();
        $this->persyaratanSeminarModel = new PersyaratanSeminarModel();
        $this->filePersyaratanSeminarModel = new FilePersyaratanSeminarModel();
        $this->hariModel = new HariModel();
        $this->mahasiswaStatusSkripsiModel = new MahasiswaStatusSkripsiModel();
        $this->mengikutiSeminarModel = new MengikutiSeminarModel();
        $this->progresSkripsiModel = new ProgresSkripsiModel();
    }

   // menampilkan semua seminar mahasiswa pembimbing penguji satu penguji dua dengan dosen bersangkutan
   public function index()
   {
       $nidn = session()->get('username');
       $semuaSeminar = $this->seminarModel->getAllSeminarByDosen($nidn);
       $data = [
           'judul' => 'Data Bimbingan',
           'semua_seminar' => $semuaSeminar,
       ];
       return view('seminar/v_seminar', $data);
   }

    public function semua_seminar()
    {
        $level = session()->get('level');
        $departemen = session()->get('departemen');
        if($departemen == '0'){
            $departemen = null;
        }
        $semuaSeminar = $this->seminarModel->getAll($nim = null, $level, $departemen);
        $data = [
            'judul' => 'Seminar',
            'semua_seminar' => $semuaSeminar
        ];
        return view('seminar/v_semua_seminar', $data);
    }

    public function tambah()
    {
        $UUIDSkripsi = session()->get('UUIDSkripsi');
        $nim = session()->get('username');
        $nama = session()->get('nama_asli');
        $getDepartemen = $this->profilModel->getDepartemen($nim);
        $persyaratanSeminar = $this->persyaratanSeminarModel->getAllPersyaratanSeminarOlehMahasiswa($getDepartemen['departemen_input']);
        $judulDiterima = $this->skripsiModel->getJudulDiterima($UUIDSkripsi);
        $sesi = $this->sesiModel->findAll();
        $ruangan = $this->ruanganModel->getRuanganDepartemen($getDepartemen);
        $hari = $this->hariModel->getHariDepartemen($getDepartemen);
            $data = [
            'judul' => 'Seminar Proposal',
            'hari' => $hari,
            'nim' => $nim,
            'nama' => $nama,
            'sesi' => $sesi,
            'ruangan' => $ruangan,
            'UUIDSkripsi' => $UUIDSkripsi,
            'judul_diterima' => $judulDiterima,
            'persyaratan_seminar' => $persyaratanSeminar,
        ];
        return view('seminar/v_tambah_seminar', $data);
    }

    public function simpan($UUIDSkripsi)
    {
        $aturan_dua = [
            'smr_nim_m' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'inputkan nim'
                        ]
                ],
            'smr_hari' => [
                        'rules' => 'required|cek_hari[smr_hari, smr_tanggal]',
                        'errors' => [
                            'required' => 'Pilih hari seminar',
                            'cek_hari' => 'Hari dan tanggal yang dipilih tidak sesuai'
                        ]
                    ],
            'smr_tanggal' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Pilih tanggal seminar',
                        ]
                    ],
            'smr_sesi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih sesi seminar'
                ]
            ],
            'smr_ruangan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Pilih ruangan seminar'
                    ]
                ],
            ];

        $nim = session()->get('username');
        $getDepartemen = $this->profilModel->getDepartemen($nim);
        $persyaratanSeminar = $this->persyaratanSeminarModel->getAllPersyaratanSeminarOlehMahasiswa($getDepartemen['departemen_input']);
        foreach ($persyaratanSeminar as $ps) {
            $id = $ps['persyaratan_id'];
            $alias = $ps['ps_alias'];
            $nama = $ps['ps_nama'];
            $aturan_dua[$id] = array(
                'rules' => "uploaded[$id]",
                'errors' => [
                    'uploaded' => "Inputkan File $nama",
                ]
                );
        }
        $validate = $this->validate($aturan_dua);
        if(!$validate) {
            return redirect()->back()->withInput();
        }
        $persyaratan = array();
        foreach ($persyaratanSeminar as $ps) {
            $id = $ps['persyaratan_id'];
            $alias = $ps['ps_alias'];
            $namaasli = $ps['ps_nama'];
            $alias2 = $this->request->getFile($id);
            echo "Nama file: ".$alias2->getName();
            $alias2->move('./upload/seminar');
            $alias2 = $alias2->getName();
            $nama = [
                'persyaratan_id' => $id,
                'judul' => $namaasli,
                'judul_alias' => $alias,
                'nama_file' =>$alias2,
            ];
            array_push($persyaratan, $nama);
        }
        $data = array(
            'smr_nim_m' => $this->request->getVar('smr_nim_m'),
            'smr_s_uuid' => $UUIDSkripsi,
            'smr_hari' => $this->request->getVar('smr_hari'),
            'smr_tanggal' => $this->request->getVar('smr_tanggal'),
            'smr_sesi' => $this->request->getVar('smr_sesi'),
            'smr_ruangan' => $this->request->getVar('smr_ruangan'),
            'smr_status' => 1,
            'sedang_diproses' => 0,
            'smr_is_deleted' => 0
        );
        $dataStatus = array(
            'status' => 3
        );
        $data_progres = array(
            'status' => 5,
        );
        $this->progresSkripsiModel->where('nim', $nim)->set($data_progres)->update();
        $this->seminarModel->simpanSeminar($data, $persyaratan);
        $this->mahasiswaStatusSkripsiModel->where('nim', $this->request->getVar('smr_nim_m'))->set($dataStatus)->update();
        return redirect()->to('/skripsi')->with('sukses','Data berhasil disimpan!');
    }

    // digunakan oleh fitur select2 pada saat menambahkan seminar
    // untuk memilih hari seminar secara dinamis
    public function getHari ()
    {
        $hari = $this->hariModel->findAll();
        // Menyusun data untuk response ke Select2
        $data = [];
        foreach ($hari as $h) {
            $data[] = [
                'id' => $h['hari_id'],
                'text' => $h['hari_nama']
            ];
        }
        return $this->response->setJSON($data);
    }

    public function getRuangan()
    {  
        $nim = session()->get('username');
        $getDepartemen = $this->profilModel->getDepartemen($nim);
        $hari = $this->request->getVar('hari');
        // Ambil parameter query dari Select2
        $search = $this->request->getVar('search');

        // Query untuk mendapatkan produk berdasarkan pencarian
        if ($search) {
            // $products = $productModel->like('name', $search)->findAll();
            // $products = $this->ruanganModel->getAllRuangan($search);
            $ruangan = $this->ruanganModel->getRuanganUntukPengajuanSeminar($search, $hari, $getDepartemen);
        } else {
            $ruangan = $this->ruanganModel->getRuanganUntukPengajuanSeminar(null, $hari, $getDepartemen);
        }
        // Menyusun data untuk response ke Select2
        $data = [];
        foreach ($ruangan as $r) {
            $data[] = [
                'id' => $r['ruangan_id'],
                'text' => $r['ruangan_alias']
            ];
        }

        // Mengirimkan response JSON
        return $this->response->setJSON($data);
    }

    public function getRuanganBisaDipakai()
    {  
        $departemen = session()->get('departemen');
        $tanggal = $this->request->getVar('tanggal');
        $namaHari = date('l', strtotime($tanggal));
        $idHari = $this->mencariIdHari($namaHari);
        $formattedDate = $this->convertDateFormat($tanggal);

        // Ambil parameter query dari Select2
        $search = $this->request->getVar('search');
        // Query untuk mendapatkan produk berdasarkan pencarian
        if ($search) {
            $ruangan = $this->ruanganModel->getRuanganBisaDipakaiUntukPengajuanSeminar($search, $idHari, $departemen, $formattedDate);
        } else {
            $ruangan = $this->ruanganModel->getRuanganBisaDipakaiUntukPengajuanSeminar(null, $idHari, $departemen, $formattedDate);
        }

        // Menyusun data untuk response ke Select2
        $data = [];

        // echo '<pre>';
        // print_r($ruangan);
        // echo '</pre>';
        // die;
        foreach ($ruangan as $r) {
            $data[] = [
                'id' => $r['seminar_r_id'],
                'text' => $r['ruangan_alias']
            ];
        }
        // Mengirimkan response JSON
        return $this->response->setJSON($data);
    }

    public function getSesiBisaDipakai()
    {  
        $departemen = session()->get('departemen');
        $tanggal = $this->request->getVar('tanggal');
        $idRuangan = $this->request->getVar('ruangan');
        // echo '<pre>';
        // print_r($departemen);
        // print_r($tanggal);
        // print_r($ruangan);
        // echo '</pre>';
        // die;
        $namaHari = date('l', strtotime($tanggal));
        $idHari = $this->mencariIdHari($namaHari);
        $formattedDate = $this->convertDateFormat($tanggal);

        // Query untuk mendapatkan produk berdasarkan pencarian
        $sesi = $this->ruanganModel->getSesiBisaDipakaiUntukPengajuanSeminar($idHari, $departemen, $formattedDate, $idRuangan);

        // Menyusun data untuk response ke Select2
        $data = [];

        foreach ($sesi as $s) {
            $data[] = [
                'id' => $s['seminar_s_id'],
                'text' => $s['jam_alias']
            ];
        }
        // Mengirimkan response JSON
        return $this->response->setJSON($data);
    }

    function mencariIdHari($hari){
        switch ($hari) {
            case 'Monday':
                $idHari = '1';
                break;
            case 'Tuesday':
                $idHari = '2';
                break;
            case 'Wednesday':
                $idHari = '3';
                break;
            case 'Thursday':
                $idHari = '4';
                break;
            case 'Friday':
                $idHari = '5';
                break;
            case 'Saturday':
                $idHari = '6';
                break;
            case 'Sunday':
                $idHari = '7';
                break;
            default:
            $idHari = NULL;
                break;
        }

        return $idHari;
    }
    
    function convertDateFormat($dateString) {
        $dateObject = DateTime::createFromFormat('d-m-Y', $dateString);
        return $dateObject->format('Y-m-d'); // Mengembalikan dalam format yyyy-mm-dd
    }

    public function mengikuti_seminar()
    {  
        $ruangan = $this->ruanganModel->getAllRuangan();
        $hari = $this->hariModel->getAllHari();
        $data = [
            'judul' => 'Seminar Proposal',
            'hari' => $hari,
            'ruangan' => $ruangan,
        ];
        return view('seminar/v_mengikuti_seminar', $data);
    }

    public function simpan_mengikuti_seminar()
    {
        if(!$this->validate([
            'nim_pengikut' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tuliskan nim saudara'
                ]
            ],
            'nim_diikuti' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tuliskan nim mahasiswa yang saudara ikuti seminarnya'
                ]
            ],
            'nama_diikuti' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tuliskan nama mahasiswa yang saudara ikuti seminarnya'
                ]
            ],
            'dosen_pembimbing_diikuti' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tuliskan nama dosen pembimbing yang saudara ikuti seminarnya'
                ]
            ],
            'judul_skripsi_diikuti' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Isikan judul skripsi mahasiswa yang saudara ikuti seminarnya'
                ]
            ],
            'hari_mengikuti' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih hari saudara mengikuti seminar'
                ]
            ],
            'tanggal_mengikuti' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih tanggal saudara mengikuti seminar'
                ]
            ],
            'ruangan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih ruangan tempat saudara mengikuti seminar'
                ]
            ],
            'foto_selfi' => [
                'rules' => 'uploaded[foto_selfi]|max_size[foto_selfi,1024]|is_image[foto_selfi]',
                'errors' => [
                    'uploaded' => 'masukkan data dukung',
                    'max_size' => 'ukuran file terlalu besar',
                    'is_image' => 'file yang anda pilih bukan gambar'
                ]
            ]
        ])){
            return redirect()->to(base_url('/skripsi'))->withInput();
        }
        $foto_selfi = $this->request->getFile('foto_selfi');
        $nama_foto = $foto_selfi->getRandomName();
        $foto_selfi->move('./upload/mengikuti_seminar', $nama_foto);
        $data = array(
            'nim_pengikut' => $this->request->getVar('nim_pengikut'),
            'nim_diikuti' => $this->request->getVar('nim_diikuti'),
            'nama_diikuti' => $this->request->getVar('nama_diikuti'),
            'dosen_pembimbing_diikuti' => $this->request->getVar('dosen_pembimbing_diikuti'),
            'judul_skripsi_diikuti' => $this->request->getVar('judul_skripsi_diikuti'),
            'hari_mengikuti' => $this->request->getVar('hari_mengikuti'),
            'tanggal_mengikuti' => $this->request->getVar('tanggal_mengikuti'),
            'ruangan' => $this->request->getVar('ruangan'),
            'status' => 1,
            'foto_selfi' => $nama_foto,
        );
        $this->mengikutiSeminarModel->simpanMengikutiSeminar($data);
        return redirect()->to('/skripsi')->with('sukses','Data berhasil disimpan!');
    }

    public function detail($UUIDSeminar, $idSeminar)
    {
        if($UUIDSeminar != null) {
            $satu_seminar = $this->seminarModel->getDetail($UUIDSeminar);
            if (!$satu_seminar) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            } else {
                
                $persyaratan = $this->filePersyaratanSeminarModel->getDetailPersyaratan($idSeminar);
                $data = [
                    'judul' => 'Edit Skripsi',
                    'satu_seminar' => $satu_seminar,
                    'persyaratan' => $persyaratan
                ];
                return view('seminar/v_detail_seminar', $data);
            }   
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    // controller ini digunakan untuk admin melihat detail seminar yang akan diverifikasi
    public function verifikasi($UUIDSeminar, $idSeminar)
    {
        if($UUIDSeminar != null) {
            $satu_seminar = $this->seminarModel->getDetail($UUIDSeminar);
            if (!$satu_seminar) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            } else {
                $departemen = session()->get('departemen');
                $level = session()->get('level');
                $persyaratan = $this->filePersyaratanSeminarModel->getDetailPersyaratan($idSeminar);
                $sesi = $this->sesiModel->findAll();

                $data = [
                    'judul' => 'Verifikasi Seminar',
                    'satu_seminar' => $satu_seminar,
                    'level' => $level,
                    'dosen' => $this->dosenModel->getAll($departemen),
                    'persyaratan' => $persyaratan,
                    'idSeminar' => $idSeminar,
                    'sesi' => $sesi,
                ];
                return view('seminar/v_verifikasi_seminar', $data);
            }   
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    // controller ini digunakan oleh admin untuk mengganti jadwal seminar yang diajukan mahasiswa
    public function ganti_jadwal_oleh_admin($UUIDSeminar)
    {
        if($UUIDSeminar != null) {
            $satu_seminar = $this->seminarModel->getDetail($UUIDSeminar);
            if (!$satu_seminar) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            } else {
                if(!$this->validate([
                    'smr_ganti_tanggal' => [
                                'rules' => 'required',
                                'errors' => [
                                    'required' => 'Pilih tanggal seminar',
                                ]
                    ],
                    'smr_sesi' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Pilih sesi seminar'
                        ]
                    ],
                    'smr_ruangan' => [
                            'rules' => 'required',
                            'errors' => [
                                'required' => 'Pilih ruangan seminar'
                            ]
                    ],
                ])){
                    session()->setFlashdata('gagal', 'Isikan data penggantian jadwal dengan lengkap');
                    return redirect()->back()->withInput();
                }

                $tanggal = $this->request->getVar('smr_ganti_tanggal');
                $namaHari = date('l', strtotime($tanggal));
                $idHari = $this->mencariIdHari($namaHari);
                $formattedDate = $this->convertDateFormat($tanggal);

                $data_seminar = array(
                    'smr_hari' => $idHari,
                    'smr_tanggal' => $formattedDate,
                    'smr_sesi' => $this->request->getVar('smr_sesi'),
                    'smr_ruangan' => $this->request->getVar('smr_ruangan'),
                );
                $idSeminar = $this->request->getVar('idSeminar');
                $this->seminarModel->where('smr_uuid', $UUIDSeminar)->set($data_seminar)->update();
                    return redirect()->to('/seminar/verifikasi/'.$UUIDSeminar.'/'.$idSeminar)->with('sukses','Perubahan jadwal dan ruangan seminar berhasil');
            }   
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    // controller ini digunakan oleh admin untuk menolak pengajuan seminar
    public function tolak_admin($UUIDSeminar = null)
    {
        if($UUIDSeminar != null) {
            $satu_seminar = $this->seminarModel->getDetail($UUIDSeminar);
            if (!$satu_seminar) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            } else {
                if(!$this->validate([
                    'smr_pesan_admin' => [
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
                    'smr_pesan_admin' => $this->request->getVar('smr_pesan_admin'),
                    'smr_status' => '2',
                    'user_verifikator' => session()->get('user_id'),
                    'tanggal_diproses_admin' => $tanggal_diproses_admin,
                    'sedang_diproses' => 0
                );
                $idSeminar = $this->request->getVar('idSeminar');
                $this->seminarModel->where('smr_uuid', $UUIDSeminar)->set($data)->update();
                return redirect()->to('/seminar/verifikasi/'.$UUIDSeminar.'/'.$idSeminar)->with('sukses','Pengajuan seminar ditolak!');
            }   
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    // controller ini digunakan oleh level admin untuk melakukan verifikasi seminar
    public function verifikasi_admin($UUIDSeminar)
    {
        if($UUIDSeminar != null) {
            $satu_seminar = $this->seminarModel->getDetail($UUIDSeminar);
            if (!$satu_seminar) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            } else {
                if(!$this->validate([
                    'nomor_surat' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Tuliskan nomor surat untuk surat undangan sempro'
                        ]
                    ]
                ])){
                    session()->setFlashdata('gagal', 'Silahkan tuliskan nomor surat untuk undangan sempro kepada dosen penguji');
                    return redirect()->back()->withInput();
                }
                date_default_timezone_set('ASIA/JAKARTA');
                $tanggal_diproses_admin = date('Y-m-d H:i:s');
                $data = array(
                    'smr_status' => '3',
                    'nomor_surat' => $this->request->getVar('nomor_surat'),
                    'user_verifikator' => session()->get('user_id'),
                    'tanggal_diproses_admin' => $tanggal_diproses_admin,
                    'sedang_diproses' => 1,
                );
                $data_progres = array(
                    'status' => 6,
                );
                $this->progresSkripsiModel->where('nim',  $this->request->getVar('nim'))->set($data_progres)->update();
                $idSeminar = $this->request->getVar('idSeminar');
                $update = $this->seminarModel->verifikasiSeminar($UUIDSeminar, $data);
                if(!$update){
                    return redirect()->to('/seminar/verifikasi/'.$UUIDSeminar.'/'.$idSeminar)->with('gagal','Hanya boleh satu seminar yang disetujui!!');
                }
                return redirect()->to('/seminar/verifikasi/'.$UUIDSeminar.'/'.$idSeminar)->with('sukses','Pengajuan seminar diterima oleh Admin!');
            }   
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function kembalikan_status($UUIDSeminar)
    {
        if($UUIDSeminar != null) {
            $satu_seminar = $this->seminarModel->getDetail($UUIDSeminar);
            if (!$satu_seminar) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            } else {
                $data = array(
                    'smr_status' => '1',
                    'smr_pesan_admin' => null,
                    'user_verifikator' => session()->get('user_id'),
                    'tanggal_diproses_admin' => null,
                    'sedang_diproses' => 0,
                    'nomor_surat' => null
                );
                $this->seminarModel->where('smr_uuid', $UUIDSeminar)->set($data)->update();
                $idSeminar = $this->request->getVar('idSeminar');
                return redirect()->to('/seminar/verifikasi/'.$UUIDSeminar.'/'.$idSeminar)->with('sukses','Status sudah dikembalikan ke proses oleh Admin!');
            }   
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

       // controller ini digunakan oleh level admin untuk melakukan verifikasi seminar
       public function verifikasi_kadep($UUIDSeminar)
       {
           if($UUIDSeminar != null) {
               $satu_seminar = $this->seminarModel->getDetail($UUIDSeminar);
               if (!$satu_seminar) {
                   throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
               } else {
                   if(!$this->validate([
                       'penguji_satu' => [
                           'rules' => 'required',
                           'errors' => [
                               'required' => 'Pilih penguji satu'
                           ]
                       ],
                       'penguji_dua' => [
                           'rules' => 'required',
                           'errors' => [
                               'required' => 'Pilih penguji dua'
                           ]
                       ],
                   ])){
                       // dd($this->request->getVar());
                       session()->setFlashdata('gagal', 'Silahkan pilih penguji satu dan dua');
                       return redirect()->back()->withInput();
                   }

                   $generate_qrcode = $this->generate_qrcode($UUIDSeminar);
                   date_default_timezone_set('ASIA/JAKARTA');
                   $tanggal_diproses_kadep = date('Y-m-d H:i:s');
                   $data = array(
                       'smr_status' => '5',
                       'tanggal_diproses_kadep' => $tanggal_diproses_kadep,
                       'penguji_satu' => $this->request->getVar('penguji_satu'),
                       'penguji_dua' => $this->request->getVar('penguji_dua'),
                       'kadep_verifikator' => session()->get('user_id'),
                       'qr_code' => $generate_qrcode
                   );
                    $data_progres = array(
                        'status' => 7,
                    );
                    $this->progresSkripsiModel->where('nim',  $this->request->getVar('nim'))->set($data_progres)->update();
                   $this->seminarModel->where('smr_uuid', $UUIDSeminar)->set($data)->update();
                   return redirect()->to('/seminar/semua-seminar')->with('sukses','Pengajuan seminar diterima oleh Kadep!');
               }   
           } else {
               throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
           }
       }

     // controller ini digunakan oleh kadep untuk menolak pengajuan seminar
     public function tolak_kadep($UUIDSeminar = null)
     {
         if($UUIDSeminar != null) {
             $satu_seminar = $this->seminarModel->getDetail($UUIDSeminar);
             if (!$satu_seminar) {
                 throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
             } else {
                 if(!$this->validate([
                     'smr_pesan_kadep' => [
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
                 $tanggal_diproses_kadep = date('Y-m-d H:i:s');
                 $data = array(
                     'smr_pesan_kadep' => $this->request->getVar('smr_pesan_kadep'),
                     'smr_status' => '4',
                     'tanggal_diproses_kadep' => $tanggal_diproses_kadep,
                     'sedang_diproses' => 0,
                     'kadep_verifikator' => session()->get('user_id')
                 );
                 $this->seminarModel->where('smr_uuid', $UUIDSeminar)->set($data)->update();
                 return redirect()->to('/seminar/semua-seminar')->with('sukses','Pengajuan seminar ditolak Kadep!');
            }   
         } else {
             throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
         }
     }

    public function print_surat($UUIDSeminar)
    {
        if($UUIDSeminar != null) {
            $satu_seminar = $this->seminarModel->getDetailSurat($UUIDSeminar);
            if (!$satu_seminar) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            } else {
            // $path  = base64_encode(file_get_contents(base_url('template/unp.png'))) ;
            // $type = pathinfo($path, PATHINFO_EXTENSION);
            // $data = file_get_contents($path);
            // $base64 = 'data:image/'.$type.';base64,'.base64_encode($data); 
            $options = new Options();
            $dompdf = new Dompdf($options);
            $tanggal_seminar = tanggal_indo($satu_seminar['smr_tanggal']);
            $tanggal_surat = tanggal_indo($satu_seminar['tanggal_diproses_kadep']);
            $data = array(
                'title_pdf' => 'Surat Izin Seminar',
                'satu_seminar' => $satu_seminar,
                'tanggal_seminar' => $tanggal_seminar,
                'tanggal_surat' => $tanggal_surat,
                // 'logo_unp' => $path,
            );
            $filename = 'surat_udangan_sempro_'.$satu_seminar['nama_mahasiswa'];
            $html = view('seminar/v_cetak_surat_seminar', $data);
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

    public function generate_qrcode($UUIDSeminar)
    {
        $writer = new PngWriter();
        $qrCode = QrCode::create(base_url('seminar/detail-seminar/'.$UUIDSeminar))
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

    public function detail_seminar($UUIDSeminar)
    {
        if($UUIDSeminar != null) {
            $satu_seminar = $this->seminarModel->getDetail($UUIDSeminar);
            if (!$satu_seminar) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            } else {
                $data = [
                    'judul' => 'Detail Seminar',
                    'satu_seminar' => $satu_seminar,
                ];
                return view('seminar/v_detail_seminar_barcode', $data);
            }   
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
}
