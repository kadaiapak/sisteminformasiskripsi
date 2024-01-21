<?php

namespace App\Controllers;
use App\Models\UjianSkripsiModel;
use App\Models\SkripsiModel;
use App\Models\SesiModel;
use App\Models\RuanganModel;
use App\Models\ProfilModel;
use App\Models\PersyaratanUjianModel;
use App\Models\HariModel;
use App\Models\MahasiswaStatusSkripsiModel;
use App\Models\FilePersyaratanUjianModel;
use App\Models\DosenModel;
use App\Models\NilaiSkripsiModel;

class UjianSkripsi extends BaseController
{
    protected $skripsiModel;
    protected $ujianSkripsiModel;
    protected $sesiModel;
    protected $ruanganModel;
    protected $persyaratanUjianModel;
    protected $profilModel;
    protected $hariModel;
    protected $mahasiswaStatusSkripsiModel;
    protected $filePersyaratanUjianModel;
    protected $dosenModel;
    protected $nilaiSkripsiModel;

    public function __construct()
    {
        helper('form');
        $this->ujianSkripsiModel = new UjianSkripsiModel();
        $this->skripsiModel = new SkripsiModel();
        $this->sesiModel = new SesiModel();
        $this->ruanganModel = new RuanganModel();
        $this->persyaratanUjianModel = new PersyaratanUjianModel();
        $this->profilModel = new ProfilModel();
        $this->hariModel= new HariModel();
        $this->mahasiswaStatusSkripsiModel = new MahasiswaStatusSkripsiModel();
        $this->filePersyaratanUjianModel = new FilePersyaratanUjianModel();
        $this->dosenModel = new DosenModel();
        $this->nilaiSkripsiModel = new NilaiSkripsiModel();
    }

    // menampilkan semua skripsi yang akan di verifikasi oleh admin dan kadep
    // akses oleh admin departemen dan kadep
    // routes : /ujian-skripsi/semua-ujian'
    public function semua_ujian()
    {
        $level = session()->get('level');
        $departemen = session()->get('departemen');
        $semuaUjianSkripsi = $this->ujianSkripsiModel->getAll($nim = null, $level, $departemen);
        $data = [
            'judul' => 'Ujian Skripsi',
            'semua_ujian' => $semuaUjianSkripsi
        ];
        return view('ujian_skripsi/v_semua_ujian_skripsi', $data);
    }

    // digunakan oleh mahasiswa untuk pengajuan jadwal ujian skripsi
    // aksees oleh mahasiswa
    // routes : '/ujian-skripsi/ajukan'
    public function tambah()
    {
        $UUIDSkripsi = session()->get('UUIDSkripsi');
        $nim = session()->get('username');
        $nama = session()->get('nama_asli');
        $getDepartemen = $this->profilModel->getDepartemen($nim);
        $persyaratanUjian = $this->persyaratanUjianModel->getAllPersyaratanUjianOlehMahasiswa($getDepartemen['departemen_input']);
        $judulDiterima = $this->skripsiModel->getJudulDiterima($UUIDSkripsi);
        $sesi = $this->sesiModel->findAll();
        $ruangan = $this->ruanganModel->getRuanganDepartemen($getDepartemen);
        $hari = $this->hariModel->getHariDepartemen($getDepartemen);
        $data = [
            'judul' => 'Ujian Skripsi',
            'nim' => $nim,
            'nama' => $nama,
            'sesi' => $sesi,
            'ruangan' => $ruangan,
            'hari' => $hari,
            'UUIDSkripsi' => $UUIDSkripsi,
            'judul_diterima' => $judulDiterima,
            'persyaratan_seminar' => $persyaratanUjian,
            // 'dosen' => $this->dosenModel->getAll(),
        ];
        return view('ujian_skripsi/v_tambah_ujian_skripsi', $data);
    }

    // digunakan oleh mahasiswa untuk menyimpan ujian skripsi yang baru ditambahkan
    // akses oleh mahasiswa
    // routes : /ujian-skripsi/(:any)/simpan
    public function simpan($UUIDSkripsi)
    {
        $aturan_dua = [
            'us_nim_m' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'inputkan nim'
                        ]
                ],
            'us_hari' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Pilih hari ujian'
                        ]
                    ],
            'us_tanggal' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Pilih tanggal ujian'
                        ]
                    ],
            'us_sesi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih sesi ujian'
                ]
            ],
            'us_ruangan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Pilih ruangan ujian'
                    ]
                ],
            ];
            $nim = session()->get('username');
            $getDepartemen = $this->profilModel->getDepartemen($nim);
            $persyaratanUjian = $this->persyaratanUjianModel->getAllPersyaratanUjianOlehMahasiswa($getDepartemen['departemen_input']);
            foreach($persyaratanUjian as $pu)
            {
                $id = $pu['persyaratan_id'];
                $alias = $pu['ps_alias'];
                $nama = $pu['ps_nama'];
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
        foreach ($persyaratanUjian as $pu) {
            $id = $pu['persyaratan_id'];
            $alias = $pu['ps_alias'];
            $namaasli = $pu['ps_nama'];
            $alias2 = $this->request->getFile($id);
            echo "Nama file: ".$alias2->getName();
            $alias2->move('./upload/ujian_skripsi');
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
            'us_nim_m' => $this->request->getVar('us_nim_m'),
            'us_s_uuid' => $UUIDSkripsi,
            'us_hari' => $this->request->getVar('us_hari'),
            'us_tanggal' => $this->request->getVar('us_tanggal'),
            'us_sesi' => $this->request->getVar('us_sesi'),
            'us_ruangan' => $this->request->getVar('us_ruangan'),
            'us_status' => 1,
            'sedang_diproses' => 0,
            'us_is_deleted' => 0
        );
        $dataStatus = array(
            'status' => 4
        );
        $this->ujianSkripsiModel->simpanUjian($data, $persyaratan);
        $this->mahasiswaStatusSkripsiModel->where('nim', $this->request->getVar('us_nim_m'))->set($dataStatus)->update();
        return redirect()->to('/skripsi')->with('sukses','Data berhasil disimpan!');
    }

    // controller ini digunakan untuk menampilkan semua pengajuan ujian skripsi yang akan diverifikasi oleh admin dan kadep
    // akses oleh admin departemen dan kadep
    // routes : /ujian-skripsi/verifikasi/(:any)/(:num)
    public function verifikasi($UUIDUjian, $idUjian)
    {
        if($UUIDUjian != null) {
            $satu_ujian_skripsi = $this->ujianSkripsiModel->getDetail($UUIDUjian);
            if (!$satu_ujian_skripsi) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            } else {
                $departemen = session()->get('departemen');
                $level = session()->get('level');
                $persyaratan = $this->filePersyaratanUjianModel->getDetailPersyaratan($idUjian);
                $data = [
                    'judul' => 'Edit Skripsi',
                    'satu_ujian' => $satu_ujian_skripsi,
                    'dosen' => $this->dosenModel->getAll($departemen),
                    'persyaratan' => $persyaratan,
                    'idUjian' => $idUjian,
                    'level' => $level
                ];
                return view('ujian_skripsi/v_verifikasi_ujian_skripsi', $data);
            }   
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    // controller ini digunakan oleh level admin untuk melakukan verifikasi ujian
    // akses oleh admin departemen
    // routes : /ujian-skripsi/(:any)/verifikasi_admin
    public function verifikasi_admin($UUIDUjian)
    {
        if($UUIDUjian != null) {
            $satu_ujian = $this->ujianSkripsiModel->getDetail($UUIDUjian);
            if (!$satu_ujian) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            } else {
                if(!$this->validate([
                    'nomor_surat' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Tuliskan nomor surat untuk surat undangan ujian'
                        ]
                    ]
                ])){
                    session()->setFlashdata('gagal', 'Silahkan tuliskan nomor surat untuk undangan sempro kepada dosen penguji');
                    return redirect()->back()->withInput();
                }
                date_default_timezone_set('ASIA/JAKARTA');
                $tanggal_diproses_admin = date('Y-m-d H:i:s');
                $data = array(
                    'us_status' => '3',
                    'nomor_surat' => $this->request->getVar('nomor_surat'),
                    'user_verifikator' => session()->get('user_id'),
                    'tanggal_diproses_admin' => $tanggal_diproses_admin,
                    'sedang_diproses' => 1,
                );
                $idUjian = $this->request->getVar('idUjian');
                $update = $this->ujianSkripsiModel->verifikasiUjian($UUIDUjian, $data);
                if(!$update){
                    return redirect()->to('/ujian-skripsi/verifikasi/'.$UUIDUjian.'/'.$idUjian)->with('gagal','Hanya boleh satu seminar yang disetujui!!');
                }
                return redirect()->to('/ujian-skripsi/verifikasi/'.$UUIDUjian.'/'.$idUjian)->with('sukses','Pengajuan seminar diterima oleh Admin!');
            }   
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

     // controller ini digunakan oleh admin untuk menolak pengajuan seminar
    //   akses oleh admin departemen
    // routes : /ujian-skripsi/(:any)/tolak_admin
    public function tolak_admin($UUIDUjian = null)
    {
        if($UUIDUjian != null) {
            $satu_ujian = $this->ujianSkripsiModel->getDetail($UUIDUjian);
            if (!$satu_ujian) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            } else {
                if(!$this->validate([
                    'us_pesan_admin' => [
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
                    'us_pesan_admin' => $this->request->getVar('us_pesan_admin'),
                    'us_status' => '2',
                    'user_verifikator' => session()->get('user_id'),
                    'tanggal_diproses_admin' => $tanggal_diproses_admin,
                    'sedang_diproses' => 0
                );
                $idUjian = $this->request->getVar('idUjian');
                $this->ujianSkripsiModel->where('us_uuid', $UUIDUjian)->set($data)->update();
                return redirect()->to('/ujian-skripsi/verifikasi/'.$UUIDUjian.'/'.$idUjian)->with('sukses','Pengajuan seminar ditolak!');
            }   
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    // digunakan oleh admin untuk membatalkan verifikasi atau membatalkan penolakan terhadap ujian skripsi yang di ajukan mahasiswa
    // akses oleh admin departemen
    // routes : /ujian-skripsi/(:any)/kembalikan_status
    public function kembalikan_status($UUIDUjian)
    {
        if($UUIDUjian != null) {
            $satu_ujian = $this->ujianSkripsiModel->getDetail($UUIDUjian);
            if (!$satu_ujian) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            } else {
                $data = array(
                    'us_status' => '1',
                    'us_pesan_admin' => null,
                    'user_verifikator' => session()->get('user_id'),
                    'tanggal_diproses_admin' => null,
                    'sedang_diproses' => 0,
                    'nomor_surat' => null
                );
                $this->ujianSkripsiModel->where('us_uuid', $UUIDUjian)->set($data)->update();
                $idUjian = $this->request->getVar('idUjian');
                return redirect()->to('/ujian-skripsi/verifikasi/'.$UUIDUjian.'/'.$idUjian)->with('sukses','Status sudah dikembalikan ke proses oleh Admin!');
            }   
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    // controller ini digunakan oleh level kadep untuk melakukan verifikasi seminar
    // akses oleh kadep
    // routes : /ujian-skripsi/(:any)/verifikasi_kadep
    public function verifikasi_kadep($UUIDUjian)
    {
        if($UUIDUjian != null) {
            $satu_ujian = $this->ujianSkripsiModel->getDetail($UUIDUjian);
            if (!$satu_ujian) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            } else {
                date_default_timezone_set('ASIA/JAKARTA');
                $tanggal_diproses_kadep = date('Y-m-d H:i:s');
                $data = array(
                    'us_status' => '5',
                    'tanggal_diproses_kadep' => $tanggal_diproses_kadep,
                    'kadep_verifikator' => session()->get('user_id'),
                );
                $this->ujianSkripsiModel->where('us_uuid', $UUIDUjian)->set($data)->update();
                return redirect()->to('/ujian-skripsi/semua-ujian')->with('sukses','Pengajuan seminar diterima oleh Kadep!');
            }   
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    // controller ini digunakan oleh kadep untuk menolak pengajuan seminar
    // akses oleh kadep
    // routes : /ujian-skripsi/(:any)/tolak_kadep
    public function tolak_kadep($UUIDUjian = null)
    {
        if($UUIDUjian != null) {
            $satu_ujian = $this->ujianSkripsiModel->getDetail($UUIDUjian);
            if (!$satu_ujian) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            } else {
                if(!$this->validate([
                    'us_pesan_kadep' => [
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
                    'us_pesan_kadep' => $this->request->getVar('us_pesan_kadep'),
                    'us_status' => '4',
                    'tanggal_diproses_kadep' => $tanggal_diproses_kadep,
                    'sedang_diproses' => 0,
                    'kadep_verifikator' => session()->get('user_id')
                );
                $this->ujianSkripsiModel->where('us_uuid', $UUIDUjian)->set($data)->update();
                return redirect()->to('/ujian-skripsi/semua-ujian')->with('sukses','Pengajuan ujian ditolak Kadep!');
        }   
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    //   public function penguji()
    //   {
    //     $level = session()->get('level');
    //     $departemen = session()->get('departemen');
    //     $semuaUjianSkripsi = $this->ujianSkripsiModel->getAll($nim = null, $level, $departemen);
    //     $data = [
    //         'judul' => 'Penguji Ujian Skripsi',
    //         'semua_ujian' => $semuaUjianSkripsi
    //     ];
    //     return view('ujian_skripsi/v_penguji_ujian_skripsi', $data);
    //   }

    // menampilkan semua ujian skripsi akan di proses oleh dosen, baik itu menghadiri, input nilai oleh dosen, dan pengisian berita_acara
    // akses oleh dosen
    // routes : /ujian-skripsi/pembimbing
    public function pembimbing()
    {
        $nidn = session()->get('username');
        $semuaUjianSkripsiByDosen = $this->ujianSkripsiModel->getAllUjianSkripsiByDosen($nidn);
        $data = [
            'judul' => 'Pembimbing Ujian Skripsi',
            'semua_ujian_skripsi' => $semuaUjianSkripsiByDosen
        ];
        return view('ujian_skripsi/v_pembimbing_ujian_skripsi', $data);
    }

    // digunakan untuk menampilkan view penginputan nilai oleh dosen penguji satu, penguji dua maupun pembimbing
    // akses oleh dosen
    // routes : /ujian-skripsi/input-nilai/(:any)
    public function input_nilai($UUIDUjian)
    {
    if($UUIDUjian != null) {
        $satu_ujian = $this->ujianSkripsiModel->getDetail($UUIDUjian);
        if (!$satu_ujian) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        } else {
            $data = [
            'judul' => 'Input Nilai Ujian Skripsi',
            'satu_ujian' => $satu_ujian
            ];
            return view('ujian_skripsi/v_input_nilai_ujian_skripsi', $data);
        }   
    } else {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }
    }

    // digunakan untuk menampilkan view edit nilai oleh dosen penguji satu, penguji dua maupun pembimbing
    // akses oleh dosen
    // routes : /ujian-skripsi/edit-nilai/(:any)
    public function edit_nilai($UUIDUjian)
    {
    if($UUIDUjian != null) {
        $nidn = session()->get('username');
        $satu_ujian = $this->ujianSkripsiModel->getDetail($UUIDUjian);
        $satu_nilai = $this->nilaiSkripsiModel->getDetailNilaiByDosen($UUIDUjian, $nidn);
        if (!$satu_ujian || !$satu_nilai) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        } else {
            $data = [
            'judul' => 'Input Nilai Ujian Skripsi',
            'satu_ujian' => $satu_ujian,
            'satu_nilai' => $satu_nilai,
            ];
            return view('ujian_skripsi/v_edit_nilai_ujian_skripsi', $data);
        }   
    } else {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }
    }

    // digunakan untuk proses simpan nilai ujian yang sudah di INPUT oleh penguji satu, dua maupun pembimbing
    // akses oleh dosen
    // routes : /ujian-skripsi/(:any)/simpan-nilai
    public function simpan_nilai($UUIDUjian)
    {
        if(!$this->validate([
            'perumusan_masalah' => [
                'rules' => 'required|less_than_equal_to[100]',
                'errors' => [
                    'required' => 'Tuliskan nilai',
                    'less_than_equal_to' => 'Inputkan nilai antara 1 sampai 100'
                    ]
                ],
            'perumusan_masalah_bobot' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tuliskan bobot'
                    ]
                    ],
            'tinjauan_pustaka' => [
                'rules' => 'required|less_than_equal_to[100]',
                'errors' => [
                    'required' => 'Tuliskan nilai',
                    'less_than_equal_to' => 'Inputkan nilai antara 1 sampai 100'
                ]
                ],
                'tinjauan_pustaka_bobot' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tuliskan bobot'
                    ]
                ],
                'pengumpulan_data' => [
                    'rules' => 'required|less_than_equal_to[100]',
                    'errors' => [
                        'required' => 'Tuliskan nilai',
                        'less_than_equal_to' => 'Inputkan nilai antara 1 sampai 100'
                    ]
                ],
                'pengumpulan_data_bobot' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tuliskan bobot'
                    ]
                ],
                'kesesuaian_desain' => [
                    'rules' => 'required|less_than_equal_to[100]',
                    'errors' => [
                        'required' => 'Tuliskan nilai',
                        'less_than_equal_to' => 'Inputkan nilai antara 1 sampai 100'
                    ]
                ],
                'kesesuaian_desain_bobot' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tuliskan bobot'
                    ]
                ],
                'kerangka_konseptual' => [
                    'rules' => 'required|less_than_equal_to[100]',
                    'errors' => [
                        'required' => 'Tuliskan nilai',
                        'less_than_equal_to' => 'Inputkan nilai antara 1 sampai 100'
                    ]
                ],
                'kerangka_konseptual_bobot' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tuliskan bobot'
                    ]
                ],
                'logika_penulisan' => [
                    'rules' => 'required|less_than_equal_to[100]',
                    'errors' => [
                        'required' => 'Tuliskan nilai',
                        'less_than_equal_to' => 'Inputkan nilai antara 1 sampai 100'
                    ]
                ],
                'logika_penulisan_bobot' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tuliskan bobot'
                    ]
                ],
                'orisinalitas' => [
                    'rules' => 'required|less_than_equal_to[100]',
                    'errors' => [
                        'required' => 'Tuliskan nilai',
                        'less_than_equal_to' => 'Inputkan nilai antara 1 sampai 100'
                    ]
                ],
                'orisinalitas_bobot' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tuliskan bobot'
                    ]
                ],
                'kesimpulan_dan_saran' => [
                    'rules' => 'required|less_than_equal_to[100]',
                    'errors' => [
                        'required' => 'Tuliskan nilai',
                        'less_than_equal_to' => 'Inputkan nilai antara 1 sampai 100'
                    ]
                ],
                'kesimpulan_dan_saran_bobot' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tuliskan bobot'
                    ]
                ],
                'penyajian' => [
                    'rules' => 'required|less_than_equal_to[100]',
                    'errors' => [
                        'required' => 'Tuliskan nilai',
                        'less_than_equal_to' => 'Inputkan nilai antara 1 sampai 100'
                    ]
                ],
                'penyajian_bobot' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tuliskan bobot'
                    ]
                ],
                'mempertahankan_skripsi' => [
                    'rules' => 'required|less_than_equal_to[100]',
                    'errors' => [
                        'required' => 'Tuliskan nilai',
                        'less_than_equal_to' => 'Inputkan nilai antara 1 sampai 100'
                    ]
                ],
                'mempertahankan_skripsi_bobot' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tuliskan bobot'
                    ]
                ],
        ])){    
            session()->setFlashdata('gagal', 'Silahkan tuliskan alasan penolakan');
            return redirect()->back()->withInput();
        }

        $pembimbing = $this->request->getVar('nidn_dosen_pembimbing');
        $penguji_satu = $this->request->getVar('nidn_penguji_satu');
        $penguji_dua = $this->request->getVar('nidn_penguji_dua');
        $nidn_user_login = session()->get('username');
        if($nidn_user_login == $pembimbing) {
            $role_user_penilai = 'Pembimbing';
            $urutan = 1;
            $data_update = array(
                'nilai_p' => 1
            );
        }elseif($nidn_user_login == $penguji_satu){
            $role_user_penilai = 'Penguji Satu';
            $urutan = 2;
            $data_update = array(
                'nilai_p_satu' => 1
            );
        }elseif ($nidn_user_login == $penguji_dua) {
            $role_user_penilai = 'Penguji Dua';
            $urutan = 3;
            $data_update = array(
                'nilai_p_dua' => 1
            );
        }
        $data = array(
            'ujian_skripsi_uuid' => $UUIDUjian,
            'user_penilai' => $nidn_user_login,
            'role_user_penilai' => $role_user_penilai,
            'urutan' => $urutan,
            'perumusan_masalah' => $this->request->getVar('perumusan_masalah'),
            'perumusan_masalah_bobot' => $this->request->getVar('perumusan_masalah_bobot'),
            'perumusan_masalah_total' => $this->request->getVar('perumusan_masalah_total'),
            'tinjauan_pustaka' => $this->request->getVar('tinjauan_pustaka'),
            'tinjauan_pustaka_bobot' => $this->request->getVar('tinjauan_pustaka_bobot'),
            'tinjauan_pustaka_total' => $this->request->getVar('tinjauan_pustaka_total'),
            'pengumpulan_data' => $this->request->getVar('pengumpulan_data'),
            'pengumpulan_data_bobot' => $this->request->getVar('pengumpulan_data_bobot'),
            'pengumpulan_data_total' => $this->request->getVar('pengumpulan_data_total'),
            'kesesuaian_desain' => $this->request->getVar('kesesuaian_desain'),
            'kesesuaian_desain_bobot' => $this->request->getVar('kesesuaian_desain_bobot'),
            'kesesuaian_desain_total' => $this->request->getVar('kesesuaian_desain_total'),
            'kerangka_konseptual' => $this->request->getVar('kerangka_konseptual'),
            'kerangka_konseptual_bobot' => $this->request->getVar('kerangka_konseptual_bobot'),
            'kerangka_konseptual_total' => $this->request->getVar('kerangka_konseptual_total'),
            'logika_penulisan' => $this->request->getVar('logika_penulisan'),
            'logika_penulisan_bobot' => $this->request->getVar('logika_penulisan_bobot'),
            'logika_penulisan_total' => $this->request->getVar('logika_penulisan_total'),
            'orisinalitas' => $this->request->getVar('orisinalitas'),
            'orisinalitas_bobot' => $this->request->getVar('orisinalitas_bobot'),
            'orisinalitas_total' => $this->request->getVar('orisinalitas_total'),
            'kesimpulan_dan_saran' => $this->request->getVar('kesimpulan_dan_saran'),
            'kesimpulan_dan_saran_bobot' => $this->request->getVar('kesimpulan_dan_saran_bobot'),
            'kesimpulan_dan_saran_total' => $this->request->getVar('kesimpulan_dan_saran_total'),
            'penyajian' => $this->request->getVar('penyajian'),
            'penyajian_bobot' => $this->request->getVar('penyajian_bobot'),
            'penyajian_total' => $this->request->getVar('penyajian_total'),
            'mempertahankan_skripsi' => $this->request->getVar('mempertahankan_skripsi'),
            'mempertahankan_skripsi_bobot' => $this->request->getVar('mempertahankan_skripsi_bobot'),
            'mempertahankan_skripsi_total' => $this->request->getVar('mempertahankan_skripsi_total'),
            'jumlah' => $this->request->getVar('jumlah_total'),
            'nilai_akhir' => $this->request->getVar('nilai_akhir'),
            'status_nilai' => 0,
        );
        $this->nilaiSkripsiModel->insert($data);
        $this->ujianSkripsiModel->where('us_uuid', $UUIDUjian)->set($data_update)->update();
        return redirect()->to('/ujian-skripsi/pembimbing')->with('sukses','Pengajuan seminar diterima oleh Kadep!');
    }

    // digunakan untuk proses simpan nilai ujian yang sudah di EDIT oleh penguji satu, dua maupun pembimbing
    // akses oleh dosen
    // routes : /ujian-skripsi/(:any)/simpan-edit
    public function simpan_edit($UUIDUjian)
    {
        if(!$this->validate([
            'perumusan_masalah' => [
                'rules' => 'required|less_than_equal_to[100]',
                'errors' => [
                    'required' => 'Tuliskan nilai',
                    'less_than_equal_to' => 'Inputkan nilai antara 1 sampai 100'
                    ]
                ],
            'perumusan_masalah_bobot' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tuliskan bobot'
                    ]
                    ],
            'tinjauan_pustaka' => [
                'rules' => 'required|less_than_equal_to[100]',
                'errors' => [
                    'required' => 'Tuliskan nilai',
                    'less_than_equal_to' => 'Inputkan nilai antara 1 sampai 100'
                ]
                ],
                'tinjauan_pustaka_bobot' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tuliskan bobot'
                    ]
                ],
                'pengumpulan_data' => [
                    'rules' => 'required|less_than_equal_to[100]',
                    'errors' => [
                        'required' => 'Tuliskan nilai',
                        'less_than_equal_to' => 'Inputkan nilai antara 1 sampai 100'
                    ]
                ],
                'pengumpulan_data_bobot' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tuliskan bobot'
                    ]
                ],
                'kesesuaian_desain' => [
                    'rules' => 'required|less_than_equal_to[100]',
                    'errors' => [
                        'required' => 'Tuliskan nilai',
                        'less_than_equal_to' => 'Inputkan nilai antara 1 sampai 100'
                    ]
                ],
                'kesesuaian_desain_bobot' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tuliskan bobot'
                    ]
                ],
                'kerangka_konseptual' => [
                    'rules' => 'required|less_than_equal_to[100]',
                    'errors' => [
                        'required' => 'Tuliskan nilai',
                        'less_than_equal_to' => 'Inputkan nilai antara 1 sampai 100'
                    ]
                ],
                'kerangka_konseptual_bobot' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tuliskan bobot'
                    ]
                ],
                'logika_penulisan' => [
                    'rules' => 'required|less_than_equal_to[100]',
                    'errors' => [
                        'required' => 'Tuliskan nilai',
                        'less_than_equal_to' => 'Inputkan nilai antara 1 sampai 100'
                    ]
                ],
                'logika_penulisan_bobot' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tuliskan bobot'
                    ]
                ],
                'orisinalitas' => [
                    'rules' => 'required|less_than_equal_to[100]',
                    'errors' => [
                        'required' => 'Tuliskan nilai',
                        'less_than_equal_to' => 'Inputkan nilai antara 1 sampai 100'
                    ]
                ],
                'orisinalitas_bobot' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tuliskan bobot'
                    ]
                ],
                'kesimpulan_dan_saran' => [
                    'rules' => 'required|less_than_equal_to[100]',
                    'errors' => [
                        'required' => 'Tuliskan nilai',
                        'less_than_equal_to' => 'Inputkan nilai antara 1 sampai 100'
                    ]
                ],
                'kesimpulan_dan_saran_bobot' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tuliskan bobot'
                    ]
                ],
                'penyajian' => [
                    'rules' => 'required|less_than_equal_to[100]',
                    'errors' => [
                        'required' => 'Tuliskan nilai',
                        'less_than_equal_to' => 'Inputkan nilai antara 1 sampai 100'
                    ]
                ],
                'penyajian_bobot' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tuliskan bobot'
                    ]
                ],
                'mempertahankan_skripsi' => [
                    'rules' => 'required|less_than_equal_to[100]',
                    'errors' => [
                        'required' => 'Tuliskan nilai',
                        'less_than_equal_to' => 'Inputkan nilai antara 1 sampai 100'
                    ]
                ],
                'mempertahankan_skripsi_bobot' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tuliskan bobot'
                    ]
                ],
        ])){    
            session()->setFlashdata('gagal', 'Silahkan tuliskan alasan penolakan');
            return redirect()->back()->withInput();
        }

        $nidn_user_login = session()->get('username');
        $data = array(
            'perumusan_masalah' => $this->request->getVar('perumusan_masalah'),
            'perumusan_masalah_bobot' => $this->request->getVar('perumusan_masalah_bobot'),
            'perumusan_masalah_total' => $this->request->getVar('perumusan_masalah_total'),
            'tinjauan_pustaka' => $this->request->getVar('tinjauan_pustaka'),
            'tinjauan_pustaka_bobot' => $this->request->getVar('tinjauan_pustaka_bobot'),
            'tinjauan_pustaka_total' => $this->request->getVar('tinjauan_pustaka_total'),
            'pengumpulan_data' => $this->request->getVar('pengumpulan_data'),
            'pengumpulan_data_bobot' => $this->request->getVar('pengumpulan_data_bobot'),
            'pengumpulan_data_total' => $this->request->getVar('pengumpulan_data_total'),
            'kesesuaian_desain' => $this->request->getVar('kesesuaian_desain'),
            'kesesuaian_desain_bobot' => $this->request->getVar('kesesuaian_desain_bobot'),
            'kesesuaian_desain_total' => $this->request->getVar('kesesuaian_desain_total'),
            'kerangka_konseptual' => $this->request->getVar('kerangka_konseptual'),
            'kerangka_konseptual_bobot' => $this->request->getVar('kerangka_konseptual_bobot'),
            'kerangka_konseptual_total' => $this->request->getVar('kerangka_konseptual_total'),
            'logika_penulisan' => $this->request->getVar('logika_penulisan'),
            'logika_penulisan_bobot' => $this->request->getVar('logika_penulisan_bobot'),
            'logika_penulisan_total' => $this->request->getVar('logika_penulisan_total'),
            'orisinalitas' => $this->request->getVar('orisinalitas'),
            'orisinalitas_bobot' => $this->request->getVar('orisinalitas_bobot'),
            'orisinalitas_total' => $this->request->getVar('orisinalitas_total'),
            'kesimpulan_dan_saran' => $this->request->getVar('kesimpulan_dan_saran'),
            'kesimpulan_dan_saran_bobot' => $this->request->getVar('kesimpulan_dan_saran_bobot'),
            'kesimpulan_dan_saran_total' => $this->request->getVar('kesimpulan_dan_saran_total'),
            'penyajian' => $this->request->getVar('penyajian'),
            'penyajian_bobot' => $this->request->getVar('penyajian_bobot'),
            'penyajian_total' => $this->request->getVar('penyajian_total'),
            'mempertahankan_skripsi' => $this->request->getVar('mempertahankan_skripsi'),
            'mempertahankan_skripsi_bobot' => $this->request->getVar('mempertahankan_skripsi_bobot'),
            'mempertahankan_skripsi_total' => $this->request->getVar('mempertahankan_skripsi_total'),
            'jumlah' => $this->request->getVar('jumlah_total'),
            'nilai_akhir' => $this->request->getVar('nilai_akhir'),
            'status_nilai' => 1,
        );
        $nilai_ujian_where = array(
            'ujian_skripsi_uuid' => $UUIDUjian,
            'user_penilai' => $nidn_user_login
        );
        $this->nilaiSkripsiModel->where($nilai_ujian_where)->set($data)->update();
        return redirect()->to('/ujian-skripsi/pembimbing')->with('sukses','Pengajuan seminar diterima oleh Kadep!');
    }

    public function berita_acara($UUIDUjian)
    {
        if($UUIDUjian != null) {
            $satu_ujian = $this->ujianSkripsiModel->getDetail($UUIDUjian);
            $semua_nilai = $this->nilaiSkripsiModel->getNilaiByUjianId($UUIDUjian);
            if (!$satu_ujian || count($semua_nilai) != 3) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            } else {
                $value = array_sum(array_column($semua_nilai,'nilai_akhir'));
                $rata = $value/3;
                $round_rata = round($rata, 2);
                $round_rata_huruf  = $round_rata >= 85 ? 'A' : ($round_rata >= 80 ? 'A-' : ($round_rata >= 75 ? 'B+' : ($round_rata >= 70 ? 'B' : ($round_rata >= 65 ? 'B-' : ($round_rata <= 64 ? 'C' : null)))));
                $data = [
                'judul' => 'Berita Acara Ujian Skripsi',
                'satu_ujian' => $satu_ujian,
                'semua_nilai' => $semua_nilai,
                'total' => $value,
                'rata' => $round_rata,
                'round_rata_huruf' => $round_rata_huruf,
                ];
                return view('ujian_skripsi/v_berita_acara_ujian_skripsi', $data);
            }   
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function simpan_berita_acara()
    {
        $data = array(
            'berita_acara' => 1,
            'total_p' => $this->request->getVar('nilai_p'),
            'total_p_satu' => $this->request->getVar('nilai_p_satu'),
            'total_p_dua' => $this->request->getVar('nilai_p_dua'),
            'rata_rata_angka' => $this->request->getVar('rata_rata_angka'),
            'rata_rata_huruf' => $this->request->getVar('rata_rata_huruf'),
        );
        $this->ujianSkripsiModel->where('us_uuid', $this->request->getVar('us_uuid'))->set($data)->update();
        return redirect()->to('/ujian-skripsi/pembimbing')->with('sukses','Berita Acara Sudah di Upload!');
    }
}
