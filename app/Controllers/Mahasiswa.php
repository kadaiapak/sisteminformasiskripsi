<?php

namespace App\Controllers;

use App\Models\ProfilModel;
use App\Models\ProgresSkripsiModel;

// model untuk detail mahasiswa
use App\Models\MengikutiSeminarModel;
use App\Models\SkripsiModel;
use App\Models\BimbinganModel;
use App\Models\SeminarModel;
use App\Models\UjianSkripsiModel;
// model untuk detail seminar
use App\Models\FilePersyaratanSeminarModel;

class Mahasiswa extends BaseController
{
    protected $profilModel;
    protected $progresSkripsiModel;
    protected $mengikutiSeminarModel;
    protected $skripsiModel;
    protected $bimbinganModel;
    protected $seminarModel;
    protected $ujianSkripsiModel;
    protected $filePersyaratanSeminarModel;

    public function __construct()
    {
        $this->profilModel = new ProfilModel();
        $this->progresSkripsiModel = new ProgresSkripsiModel();
        $this->mengikutiSeminarModel = new MengikutiSeminarModel();
        $this->skripsiModel = new SkripsiModel();
        $this->bimbinganModel = new BimbinganModel();
        $this->seminarModel = new SeminarModel();
        $this->ujianSkripsiModel = new UjianSkripsiModel();
        $this->filePersyaratanSeminarModel = new FilePersyaratanSeminarModel();
    }

    public function index()
    {
        $departemen = session()->get('departemen');
        $semuaMahasiswa = $this->progresSkripsiModel->getAll($departemen);
        $data = [
            'judul' => 'Data Mahasiswa',
            'semua_mahasiswa' => $semuaMahasiswa
        ];
        return view('mahasiswa/v_mahasiswa', $data);
    }

    // digunakan oleh mahasiswa untuk melihat skripsi mereka
    public function detail_skripsi($nim)
    {
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
        ];
        return view('mahasiswa/v_detail_skripsi_mahasiswa', $data);
    }

    public function detail_seminar($UUIDSeminar, $idSeminar)
    {
        if($UUIDSeminar != null) {
            $satu_seminar = $this->seminarModel->getDetail($UUIDSeminar);
            if (!$satu_seminar) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            } else {
                $persyaratan = $this->filePersyaratanSeminarModel->getDetailPersyaratan($idSeminar);
                $data = [
                    'judul' => 'Detail Seminar Mahasiswa',
                    'satu_seminar' => $satu_seminar,
                    'persyaratan' => $persyaratan
                ];
                return view('mahasiswa/v_detail_seminar_mahasiswa', $data);
            }   
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function detail_ujian_skripsi($UUIDSkripsi)
    {
        if($UUIDSkripsi != null) {
            $satu_skripsi = $this->ujianSkripsiModel->getDetailByKadep($UUIDSkripsi);
            if (!$satu_skripsi) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            } else {
                $data = [
                    'judul' => 'Detail Seminar Mahasiswa',
                    'satu_skripsi' => $satu_skripsi,
                    'persyaratan' => null
                ];
                return view('mahasiswa/v_detail_ujian_skripsi_mahasiswa', $data);
            }   
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
}
