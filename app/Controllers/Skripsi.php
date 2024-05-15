<?php

namespace App\Controllers;

use App\Models\SkripsiModel;
use App\Models\BimbinganModel;
use App\Models\SeminarModel;
use App\Models\DosenModel;
use App\Models\HistoriModel;
use App\Models\ProfilModel;
use App\Models\UjianSkripsiModel;
use App\Models\MahasiswaStatusSkripsiModel;
use App\Models\MengikutiSeminarModel;
use App\Models\ProgresSkripsiModel;
use App\Models\JadwalPengajuanJudulModel;
use App\Models\HistoriJudulSkripsiModel;

// library untuk export excel
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Skripsi extends BaseController
{
    protected $skripsiModel;
    protected $bimbinganModel;
    protected $seminarModel;
    protected $dosenModel;
    protected $historiModel;
    protected $profilModel;
    protected $ujianSkripsiModel;
    protected $mahasiswaStatusSkripsiModel;
    protected $mengikutiSeminarModel;
    protected $progresSkripsiModel;
    protected $jadwalPengajuanJudulModel;
    protected $historiJudulSkripsiModel;

    public function __construct()
    {
        helper('form');
        $this->skripsiModel = new SkripsiModel();
        $this->bimbinganModel = new BimbinganModel();
        $this->seminarModel = new SeminarModel();
        $this->dosenModel = new DosenModel();
        $this->historiModel = new HistoriModel();
        $this->profilModel = new ProfilModel();
        $this->ujianSkripsiModel = new UjianSkripsiModel();
        $this->mahasiswaStatusSkripsiModel = new MahasiswaStatusSkripsiModel();
        $this->mengikutiSeminarModel = new MengikutiSeminarModel(); 
        $this->progresSkripsiModel = new ProgresSkripsiModel(); 
        $this->jadwalPengajuanJudulModel = new JadwalPengajuanJudulModel();
        $this->historiJudulSkripsiModel = new HistoriJudulSkripsiModel();
    }

    // digunakan oleh mahasiswa untuk melihat skripsi mereka
    public function index()
    {
        $nim = session()->get('username');
        $status = $this->profilModel->cekIsVerified($nim);
        if($status == null){
            return redirect()->to('/profil/verifikasi')->with('gagal','Silahkan lengkapi data diri');
        }
        $getDepartemen = $this->profilModel->getDepartemen($nim);
        $jadwal_pengajuan_judul = $this->jadwalPengajuanJudulModel->getDetailByDepartemen($getDepartemen);
        // cek apakah pendaftaran judul dibuka
        if ($jadwal_pengajuan_judul['apakah_buka'] == 0) {
            $apakah_buka = false;
        } else {
            if(date('Y-m-d H:i:s') < $jadwal_pengajuan_judul['mulai_pengajuan_judul']){
                $apakah_buka = false;
            }elseif (date('Y-m-d H:i:s') > $jadwal_pengajuan_judul['akhir_pengajuan_judul']) {
                $apakah_buka = false;
            }else {
                $apakah_buka = true;
            }
        }
        // akhir dari cek apakah pendaftaran judul dibuka
        $mengikuti_seminar = $this->mengikutiSeminarModel->getAll($nim);
        $semuaSkripsi = $this->skripsiModel->getAll($nim);
        $status_pengajuan_skripsi = array_column($semuaSkripsi, 'status_pengajuan_skripsi');
        $adaJudulDiterima = in_array('3', $status_pengajuan_skripsi);
        $semuaBimbingan = $this->bimbinganModel->getAll($nim);
        $status_bimbingan = array_column($semuaBimbingan, 'is_verifikasi');
        $adaBimbinganYangBelumDiVerifikasi = in_array('0', $status_bimbingan);
        $semuaSeminar = $this->seminarModel->getAll($nim, null, null);
        $status_proses_seminar = array_column($semuaSeminar, 'sedang_diproses');
        $status_seminar = array_column($semuaSeminar, 'smr_status');
        $seminarSudahDisetujui = in_array('5', $status_seminar);
        $seminarSelesaiProses = in_array('0', $status_proses_seminar);
        $seminarSedangProses = in_array('1', $status_proses_seminar);
        $semuaUjian = $this->ujianSkripsiModel->getAll($nim, null, null);
        $status_berita_acara_ujian = array_column($semuaUjian, 'berita_acara');
        $adaUjianSelesaiBeritaAcara = in_array('1', $status_berita_acara_ujian);
        $historiJudulSkripsi = $this->historiJudulSkripsiModel->getDetail($nim);
        // cek idSkripsi untuk melaukan bimbingan
        $UUIDSkripsi = $this->skripsiModel->getUUIDSkripsi($nim);
        // judul
            // progress adalah judul jika belum ada pernah mengajukan judul, dan belum ada judul yang sudah di acc
            $progressAdalahJudul = count($semuaSkripsi) == 0 || !$adaJudulDiterima;
            // form judul selalu terbuka
            // judul bisa duajukan jika belum pernah mengjukan judul atau tidak ada judul yang sudah di acc atau sedang menunggu proses
            $bisaTambahJudul = count($semuaSkripsi) == 0 || !$adaJudulDiterima ;
        // akhir dari judul
        // bimbingan
            // progress adalah bimbingan jika ada judul yang sudah di acc
            $progressAdalahBimbingan = $adaJudulDiterima;
            // form bimbingan terbuka jika ada judul yang sudah di acc
            $formBimbinganTerbuka = $adaJudulDiterima;
            // bisa tambah bimbingan jika ada judul yang sudah di acc
            $bisaTambahBimbingan = $adaJudulDiterima;
        // akhir dari bimbingan

        // seminar
            // progress sekarang adalah seminar jika sudah pernah bimbingan
            $progressAdalahSeminar = count($semuaBimbingan) > 0 && !$adaBimbinganYangBelumDiVerifikasi;
            // form seminar terbuka jika sudah pernah bimbingan dan semua bimbingan sudah di acc dosen 
            $formSeminarTerbuka = count($semuaBimbingan) > 0 && !$adaBimbinganYangBelumDiVerifikasi;
            // bisa tambah seminar jika belum pernah mengajukan seminar dan tidak ada seminar yang sedang dalam proses
            $bisaTambahSeminar = count($semuaSeminar) == 0 || ( $seminarSelesaiProses && !$seminarSedangProses);
        // akhir seminar

        // ujian
            // progress adalah ujian jika sudah ada semninar yang disetujui kadep
            $progressAdalahUjian = $seminarSudahDisetujui;
            // form seminar terbuka jika sudah ada seminar yang disetujui kadep
            $formUjianTerbuka = $seminarSudahDisetujui;
        // akhir dari ujian

        // final
            $progressAdalahFinal = $adaUjianSelesaiBeritaAcara;
        // akhir dari final
        if($UUIDSkripsi != null) {
            $UUIDSkripsiFinal = $UUIDSkripsi->skripsi_uuid; 
            session()->set('UUIDSkripsi', $UUIDSkripsi->skripsi_uuid);
        }else {
            $UUIDSkripsiFinal = false;
            session()->remove('UUIDSkripsi');
        }
        // akhir dari cek idSkripsi
        $data = [
            'judul' => 'Skripsi',
            'semua_skripsi' => $semuaSkripsi,
            'semua_bimbingan' => $semuaBimbingan,
            'semua_seminar' => $semuaSeminar,
            'semua_ujian' => $semuaUjian,
            'UUIDSkripsi' => $UUIDSkripsiFinal,
            'progressAdalahJudul' => $progressAdalahJudul,
            'apakah_buka_judul' => $apakah_buka,
            'bisaTambahJudul' => $bisaTambahJudul,
            'progressAdalahBimbingan' => $progressAdalahBimbingan,
            'progressAdalahSeminar' => $progressAdalahSeminar,
            'progressAdalahUjian' => $progressAdalahUjian,
            'formBimbinganTerbuka' => $formBimbinganTerbuka,
            'formSeminarTerbuka' => $formSeminarTerbuka,
            'formUjianTerbuka' => $formUjianTerbuka,
            'bisaTambahBimbingan' => $bisaTambahBimbingan,
            'bisaTambahSeminar' => $bisaTambahSeminar,
            'progressAdalahFinal' => $progressAdalahFinal,
            'mengikuti_seminar' => $mengikuti_seminar,
            'historiJudulSkripsi' => $historiJudulSkripsi
        ];
        return view('skripsi/v_skripsi', $data);
    }

    public function ajukan_judul()
    {
        $nim = session()->get('username');
        $getDepartemen = $this->profilModel->getDepartemen($nim);
        $departemen = $getDepartemen['departemen_input'];
        $data = [
            'judul' => 'Ajukan Skripsi',
            'nim' => session()->get('username'),
            'nama' => session()->get('nama_asli'),
            'dosen' => $this->dosenModel->getAll($departemen),
        ];
        return view('skripsi/v_ajukan_judul', $data);
    }

    public function simpan_judul()
    {
        if(!$this->validate([
            'periode_pengajuan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'pilih periode pengajuan'
                ]
            ],
            'tahun_pengajuan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'tahun pengajuan tidak boleh kosong'
                ]
            ],
            'judul_skripsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'judul skripsi tidak boleh kosong'
                ]
            ],
            'deskripsi_skripsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'deskripsisi tidak boleh kosong'
                ]
            ],
            'konsentrasi_bidang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'konsentrasi bidang tidak boleh kosong'
                ]
            ],
            'nama_dosen_pa' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'pilih Dosen PA'
                ]
            ],
            'nama_pembimbing' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'pilih Dosen pembimbing'
                ]
            ],
            'data_dukung' => [
                'rules' => 'max_size[data_dukung,1024]|ext_in[data_dukung,pdf]',
                'errors' => [
                    'uploaded' => 'masukkan data dukung',
                    'max_size' => 'ukuran file terlalu besar',
                    'ext_in' => 'file yang anda pilih bukan pdf'
                ]
            ]
        ])){
            return redirect()->to(base_url('skripsi/ajukan-judul'))->withInput();
        }
        $data_dukung = $this->request->getFile('data_dukung');

        //generate nama sampul random
        // dd($data_dukung->getError());
        if($data_dukung->getError() != 4) {
            echo "Nama file: ".$data_dukung->getName();
            $data_dukung->move('./upload/data_dukung');
            $nama_data_dukung = $data_dukung->getName();
        }else {
            $nama_data_dukung = null;
        }
        $data = array(
            'nama_mahasiswa' => $this->request->getVar('nama_mahasiswa'),
            'nim_mahasiswa' => $this->request->getVar('nim_mahasiswa'),
            'periode_pengajuan' => $this->request->getVar('periode_pengajuan'),
            'tahun_pengajuan' => $this->request->getVar('tahun_pengajuan'),
            'judul_skripsi' => $this->request->getVar('judul_skripsi'),
            'deskripsi_skripsi' => $this->request->getVar('deskripsi_skripsi'),
            'konsentrasi_bidang' => $this->request->getVar('konsentrasi_bidang'),
            'dosen_pembimbing' => $this->request->getVar('nama_pembimbing'),
            'dosen_pa' => $this->request->getVar('nama_dosen_pa'),
            'data_dukung' => $nama_data_dukung,
            'status_pengajuan_skripsi' => 1,
        );

        $data_progres = array(
            'status' => 2,
        );
        $this->progresSkripsiModel->where('nim', $this->request->getVar('nim_mahasiswa'))->set($data_progres)->update();
        $this->skripsiModel->simpanSkripsi($data);
        $skripsi_id = $this->skripsiModel->getInsertID();
        $this->historiModel->save([
            'histori_skripsi_id' => $skripsi_id,
            'histori_nim' => $this->request->getVar('nim_mahasiswa'),
            'histori_status' => 1,
            'histori_keterangan' => 'pengajuan judul'
        ]);
            return redirect()->to('/skripsi')->with('sukses','Data berhasil disimpan!');
    }

    public function edit_skripsi($id = null)
    {
        if($id != null) {
            $single_skripsi = $this->skripsiModel->find($id);
            if (!$single_skripsi) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            } else {
                $nim = session()->get('username');
                $getDepartemen = $this->profilModel->getDepartemen($nim);
                $departemenArray = get_object_vars($getDepartemen);
                $departemen = $departemenArray['departemen_input'];
                $data = [
                    'judul' => 'Edit Skripsi',
                    'single_skripsi' => $single_skripsi,
                    'dosen' => $this->dosenModel->getAll($departemen),
                ];
                return view('skripsi/v_edit_skripsi', $data);
            }   
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function update_skripsi($id=null)
    {
        if(!$this->validate([
            'periode_pengajuan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'pilih periode pengajuan'
                ]
            ],
            'tahun_pengajuan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'tahun pengajuan tidak boleh kosong'
                ]
            ],
            'judul_skripsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'judul skripsi tidak boleh kosong'
                ]
            ],
            'deskripsi_skripsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'deskripsisi tidak boleh kosong'
                ]
            ],
            'konsentrasi_bidang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'konsentrasi bidang tidak boleh kosong'
                ]
            ],
            'dosen_pembimbing' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'pilih Dosen pembimbing'
                ]
            ],
            'dosen_pa' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'pilih Dosen PA'
                ]
            ],
            'data_dukung' => [
                'rules' => 'uploaded[data_dukung]|max_size[data_dukung,1024]|ext_in[data_dukung,pdf]',
                'errors' => [
                    'uploaded' => 'masukkan data dukung',
                    'max_size' => 'ukuran file terlalu besar',
                    'ext_in' => 'file yang anda pilih bukan pdf'
                ]
            ]
        ])){
            return redirect()->back()->withInput();
        }
        $data_dukung = $this->request->getFile('data_dukung');
        echo "Nama file: ".$data_dukung->getName();
        $data_dukung->move('./upload/data_dukung');
        $nama_data_dukung = $data_dukung->getName();
        $data = [
            'nama_mahasiswa' => $this->request->getVar('nama_mahasiswa'),
            'nim_mahasiswa' => $this->request->getVar('nim_mahasiswa'),
            'periode_pengajuan' => $this->request->getVar('periode_pengajuan'),
            'tahun_pengajuan' => $this->request->getVar('tahun_pengajuan'),
            'judul_skripsi' => $this->request->getVar('judul_skripsi'),
            'deskripsi_skripsi' => $this->request->getVar('deskripsi_skripsi'),
            'konsentrasi_bidang' => $this->request->getVar('konsentrasi_bidang'),
            'nama_pembimbing' => $this->request->getVar('nama_pembimbing'),
            'nama_dosen_pa' => $this->request->getVar('nama_dosen_pa'),
            'status_pengajuan_skripsi' => 1,
        ];
        $this->skripsiModel->update($id, $data);
        return redirect()->to('/skripsi')->with('sukses','Data berhasil diubah!');
    }

    public function upload_skripsi()
    {
        $data = [
            'judul' => 'Upload Skripsi',
            'nim' => session()->get('username'),
            'nama' => session()->get('nama_asli')
        ];
        return view('skripsi/v_upload_skripsi', $data);
    }
    
    // menampilkan list semua skripsi yang akan di acc oleh kadep 
    // skripsi yang ditampilkan berdasarkan departemen
    public function semua_skripsi()
    {
        $departemen = session()->get('departemen');
        $semuaSkripsi = $this->skripsiModel->getAll(null, $departemen);
        $data = [
            'judul' => 'Skripsi',
            'semua_skripsi' => $semuaSkripsi
        ];
        return view('skripsi/v_semua_skripsi_oleh_kadep', $data);
    }

    // export excel semua judul skripsi yang sedang di ajukan
    // akses oleh kadep
    public function semua_skripsi_export_excel()
    {
        $departemen = session()->get('departemen');
        $periode_pengajuan = $this->request->getVar('periode_pengajuan');
        $tahun_pengajuan = $this->request->getVar('tahun_pengajuan');
        $semuaSkripsi = $this->skripsiModel->getAllExportExcel($departemen, $periode_pengajuan, $tahun_pengajuan);
        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();
        $activeWorksheet->setCellValue('A1', 'Rekap Pengajuan Judul Skripsi');
        $activeWorksheet->mergeCells('A1:L1');
        $activeWorksheet->getStyle('A1')->getFont()->setBold(true);
        $activeWorksheet->setCellValue('A3', 'No');
        $activeWorksheet->setCellValue('B3', 'Tanggal Pengajuan');
        $activeWorksheet->setCellValue('C3', 'Nama Mahasiswa');
        $activeWorksheet->setCellValue('D3', 'NIM');
        $activeWorksheet->setCellValue('E3', 'Periode Pengajuan');
        $activeWorksheet->setCellValue('F3', 'Tahun Pengajuan');
        $activeWorksheet->setCellValue('G3', 'Judul Skripsi');
        $activeWorksheet->setCellValue('H3', 'Deskripsi Skripsi');
        $activeWorksheet->setCellValue('I3', 'Konsentrasi Bidang');
        $activeWorksheet->setCellValue('J3', 'Dosen Pembimbing');
        $activeWorksheet->setCellValue('K3', 'Dosen PA');
        $activeWorksheet->setCellValue('L3', 'Status Pengajuan');

        $column = 4;
        foreach ($semuaSkripsi as $ss) {
            $activeWorksheet->setCellValue('A'.$column ,($column-3));
            $activeWorksheet->setCellValue('B'.$column , (date('d-m-Y', strtotime($ss['created_at']))));
            $activeWorksheet->setCellValue('C'.$column , $ss['nama_mahasiswa']);
            $activeWorksheet->setCellValue('D'.$column , $ss['nim_mahasiswa']);
            $activeWorksheet->setCellValue('E'.$column , ($ss['periode_pengajuan'] == 1 ? 'Januari - Juni' : 'Juli - Desember'));
            $activeWorksheet->setCellValue('F'.$column , $ss['tahun_pengajuan']);
            $activeWorksheet->setCellValue('G'.$column , $ss['judul_skripsi']);
            $activeWorksheet->setCellValue('H'.$column , $ss['deskripsi_skripsi']);
            $activeWorksheet->setCellValue('I'.$column , $ss['konsentrasi_bidang']);
            $activeWorksheet->setCellValue('J'.$column , $ss['d_pembimbing_peg_gel_dep'].' '.$ss['d_pembimbing_peg_nama'].''.$ss['d_pembimbing_peg_gel_bel']);
            $activeWorksheet->setCellValue('K'.$column , $ss['d_pa_peg_gel_dep'].' '.$ss['d_pa_peg_nama'].''.$ss['d_pa_peg_gel_bel']);
            $activeWorksheet->setCellValue('L'.$column , ($ss['status_pengajuan_skripsi'] == 1 ? 'Menunggu proses' : ($ss['status_pengajuan_skripsi'] == 2 ? 'Judul ditolak' : ($ss['status_pengajuan_skripsi'] == 3 ? 'Judul disetujui' : ''))));
            $column++;
        }

        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ];
        $activeWorksheet->getStyle('A3:L'.($column-1))->applyFromArray($styleArray);

        $activeWorksheet->getDefaultRowDimension()->setRowHeight(-1);
        $activeWorksheet->getStyle('F:H')->getAlignment()->setWrapText(true);
        $activeWorksheet->getColumnDimension('F')->setWidth(60);
        $activeWorksheet->getColumnDimension('G')->setWidth(60);
        $activeWorksheet->getColumnDimension('H')->setWidth(40);

        $activeWorksheet->getColumnDimension('A')->setAutoSize(true);
        $activeWorksheet->getColumnDimension('B')->setAutoSize(true);
        $activeWorksheet->getColumnDimension('C')->setAutoSize(true);
        $activeWorksheet->getColumnDimension('D')->setAutoSize(true);
        $activeWorksheet->getColumnDimension('E')->setAutoSize(true);
        $activeWorksheet->getColumnDimension('I')->setAutoSize(true);
        $activeWorksheet->getColumnDimension('J')->setAutoSize(true);
        $activeWorksheet->getColumnDimension('K')->setAutoSize(true);
        $activeWorksheet->getColumnDimension('L')->setAutoSize(true);


        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=laporan_pengajuan_judul_skripsi.xlsx');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit();
    }

    public function proses_skripsi_oleh_kadep($id=null)
    {
        if($id != null) {
            $departemen = session()->get('departemen');
            $single_skripsi = $this->skripsiModel->getDetail($id, $departemen);
            if (!$single_skripsi) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            } else {
                $departemen = session()->get('departemen');
                $data = [
                    'judul' => 'Edit Skripsi',
                    'single_skripsi' => $single_skripsi,
                    'dosen' => $this->dosenModel->getAll($departemen),
                ];
                return view('skripsi/v_proses_skripsi_oleh_kadep', $data);
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function update_skripsi_oleh_kadep($id=null)
    {
        if(isset($_POST['setujui_judul'])){
            if(!$this->validate([
                'dosen_pembimbing' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'pilih Dosen pembimbing'
                    ]
                ],
                'dosen_pa' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'pilih Dosen PA'
                    ]
                ],
            ])){
                return redirect()->back()->withInput();
            }
            date_default_timezone_set('ASIA/JAKARTA');
            $tanggal_diproses_admin = date('Y-m-d H:i:s');
            $data = [
                'dosen_pembimbing' => $this->request->getVar('dosen_pembimbing'),
                'dosen_pa' => $this->request->getVar('dosen_pa'),
                'status_pengajuan_skripsi' => 3,
                'tanggal_diproses' => $tanggal_diproses_admin,
                'nim_mahasiswa' => $this->request->getVar('nim_mahasiswa')
            ];

            $data_progres = array(
                'status' => 3,
            );

            $data_histori_judul = array(
                'skripsi_uuid' => $this->request->getVar('skripsi_uuid'),
                'nim_mahasiswa' => $this->request->getVar('nim_mahasiswa'),
                'nama_mahasiswa' => $this->request->getVar('nama_mahasiswa'),
                'periode_pengajuan' => $this->request->getVar('periode_pengajuan'),
                'tahun_pengajuan' => $this->request->getVar('tahun_pengajuan'),
                'judul_skripsi' => $this->request->getVar('judul_skripsi'),
                'deskripsi_skripsi' => $this->request->getVar('deskripsi_skripsi'),
                'konsentrasi_bidang' => $this->request->getVar('konsentrasi_bidang'),
                'dosen_pembimbing' => $this->request->getVar('dosen_pembimbing'),
                'dosen_pa' => $this->request->getVar('dosen_pa'),
            );
            $this->progresSkripsiModel->where('nim', $this->request->getVar('nim_mahasiswa'))->set($data_progres)->update();
            $this->skripsiModel->setujuiJudul($id, $data);
            $dataStatus = array(
                'status' => 2
            );
            $this->mahasiswaStatusSkripsiModel->where('nim', $this->request->getVar('nim_mahasiswa'))->set($dataStatus)->update();
            $this->historiJudulSkripsiModel->simpanHistoriJudulSkripsi($data_histori_judul);
            return redirect()->to('/skripsi/semua_skripsi')->with('sukses','Data berhasil diubah!');
        } else if (isset($_POST['tolak_judul'])) {
            if(!$this->validate([
                'pesan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tuliskan alasan penolakan'
                    ]
                ]
            ])){
                return redirect()->back()->withInput();
            }
            date_default_timezone_set('ASIA/JAKARTA');
            $tanggal_diproses_admin = date('Y-m-d H:i:s');
            $data = array(
                'status_pengajuan_skripsi' => '2',
                'pesan' => $this->request->getVar('pesan'),
                'tanggal_diproses' => $tanggal_diproses_admin
            );
            $this->skripsiModel->update($id, $data);
            return redirect()->to('/skripsi/semua_skripsi')->with('sukses','Data berhasil diubah!');
        }else if (isset($_POST['batalkan_penolakan'])) {
            date_default_timezone_set('ASIA/JAKARTA');
            $tanggal_diproses_admin = date('Y-m-d H:i:s');
            $data = array(
                'status_pengajuan_skripsi' => '1',
                'tanggal_diproses' => $tanggal_diproses_admin,
                'pesan' => null
            );
            $this->skripsiModel->update($id, $data);
            return redirect()->to('/skripsi/semua_skripsi')->with('sukses','Data berhasil diubah!');
        } else if (isset($_POST['batalkan_verifikasi'])) {
            date_default_timezone_set('ASIA/JAKARTA');
            $tanggal_diproses_admin = date('Y-m-d H:i:s');
            $data = array(
                'status_pengajuan_skripsi' => '1',
                'tanggal_diproses' => $tanggal_diproses_admin
            );
            $this->skripsiModel->update($id, $data);
            return redirect()->to('/skripsi/semua_skripsi')->with('sukses','Data berhasil diubah!');
        }
    }

    public function perbaikan_judul($id = null)
    {
        if($id != null) {
            $nim = session()->get('username');
            $singleSkripsi = $this->skripsiModel->getDetailPerbaikanJudul($id, $nim);
            if (!$singleSkripsi) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            } else {
                $departemen = session()->get('departemen');
                $data = [
                    'judul' => 'Edit Skripsi',
                    'singleSkripsi' => $singleSkripsi,
                    'dosen' => $this->dosenModel->getAll($departemen),
                ];
                return view('skripsi/v_perbaikan_judul', $data);
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function simpan_perbaikan_judul($id)
    {
        if($id != null) {
            $nim = session()->get('username');
            $singleSkripsi = $this->skripsiModel->getDetailPerbaikanJudul($id, $nim);
            if (!$singleSkripsi) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            } else {
                if(!$this->validate([
                    'judul_skripsi' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'judul skripsi tidak boleh kosong'
                        ]
                    ],
                    'deskripsi_skripsi' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'deskripsisi tidak boleh kosong'
                        ]
                    ],
                    'konsentrasi_bidang' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'konsentrasi bidang tidak boleh kosong'
                        ]
                    ],
                ])){
                    return redirect()->back()->withInput();
                }
                date_default_timezone_set('ASIA/JAKARTA');
                $data = [
                    'judul_skripsi' => $this->request->getVar('judul_skripsi'),
                    'deskripsi_skripsi' => $this->request->getVar('deskripsi_skripsi'),
                    'konsentrasi_bidang' => $this->request->getVar('konsentrasi_bidang'),
                    'perbaikan_judul' => 1,
                    'tanggal_perbaikan_judul' => date('Y-m-d H:i:s'),
                ];
                $data_histori_judul_skripsi = [
                    'skripsi_uuid' => $id,
                    'nama_mahasiswa' => $singleSkripsi['nama_mahasiswa'],
                    'nim_mahasiswa' => $singleSkripsi['nim_mahasiswa'],
                    'periode_pengajuan' => $singleSkripsi['periode_pengajuan'],
                    'tahun_pengajuan' => $singleSkripsi['tahun_pengajuan'],
                    'judul_skripsi' => $this->request->getVar('judul_skripsi'),
                    'deskripsi_skripsi' => $this->request->getVar('deskripsi_skripsi'),
                    'konsentrasi_bidang' => $this->request->getVar('konsentrasi_bidang'),
                    'dosen_pembimbing' => $singleSkripsi['dosen_pembimbing'],
                    'dosen_pa' => $singleSkripsi['dosen_pa'],
                ];
                $this->skripsiModel->update($id, $data);
                $this->historiJudulSkripsiModel->insert($data_histori_judul_skripsi);
                return redirect()->to('/skripsi')->with('sukses','Data berhasil diubah!');
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
}
