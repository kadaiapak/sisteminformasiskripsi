<?php

namespace App\Models;

use CodeIgniter\Model;

class DashboardModel extends Model
{
    public function totalSuratBelumDiproses()
    {
        $departemen = session()->get('departemen');
        $buildObservasiMatakuliah = $this->db->table('surat_izin_observasi_matakuliah');
        $buildObservasiMatakuliah->where('status', 1);
        if($departemen != 0){
            $buildObservasiMatakuliah->where('departemen_pengajuan', $departemen);
        }
        $observasiMatakuliah = $buildObservasiMatakuliah->countAllResults();

        $buildObservasiPenelitian = $this->db->table('surat_izin_observasi_penelitian');
        $buildObservasiPenelitian->where('status', 1);
        if($departemen != 0){
            $buildObservasiPenelitian->where('departemen_pengajuan', $departemen);
        }
        $observasiPenelitian = $buildObservasiPenelitian->countAllResults();

        $buildPenelitian = $this->db->table('surat_izin_penelitian');
        $buildPenelitian->where('status', 1);
        if($departemen != 0){
            $buildPenelitian->where('departemen_pengajuan', $departemen);
        }
        $penelitian = $buildPenelitian->countAllResults();

        $buildValidasiInstrumen = $this->db->table('surat_validasi_instrumen');
        $buildValidasiInstrumen->where('status', 1);
        if($departemen != 0){
            $buildValidasiInstrumen->where('departemen_pengajuan', $departemen);
        }
        $validasiInstrumen = $buildValidasiInstrumen->countAllResults();

        $buildValidatorInstrumen = $this->db->table('surat_validator_instrumen');
        $buildValidatorInstrumen->where('status', 1);
        if($departemen != 0){
            $buildValidatorInstrumen->where('departemen_pengajuan', $departemen);
        }
        $validatorInstrumen = $buildValidatorInstrumen->countAllResults();

        $total = $observasiMatakuliah +  $observasiPenelitian + $penelitian + $validasiInstrumen + $validatorInstrumen;
        return $total;

    }

    public function totalSuratMasukHariIni()
    {
        $hariIni = date('d');
        $departemen = session()->get('departemen');
        $buildObservasiMatakuliah = $this->db->table('surat_izin_observasi_matakuliah');
        $buildObservasiMatakuliah->where('status', 1);
        $buildObservasiMatakuliah->where('DAY(created_at)', $hariIni);
        if($departemen != 0){
            $buildObservasiMatakuliah->where('departemen_pengajuan', $departemen);
        }
        $observasiMatakuliah = $buildObservasiMatakuliah->countAllResults();

        $buildObservasiPenelitian = $this->db->table('surat_izin_observasi_penelitian');
        $buildObservasiPenelitian->where('status', 1);
        $buildObservasiPenelitian->where('DAY(created_at)', $hariIni);
        if($departemen != 0){
            $buildObservasiPenelitian->where('departemen_pengajuan', $departemen);
        }
        $observasiPenelitian = $buildObservasiPenelitian->countAllResults();

        $buildPenelitian = $this->db->table('surat_izin_penelitian');
        $buildPenelitian->where('status', 1);
        $buildPenelitian->where('DAY(created_at)', $hariIni);
        if($departemen != 0){
            $buildPenelitian->where('departemen_pengajuan', $departemen);
        }
        $penelitian = $buildPenelitian->countAllResults();

        $buildValidasiInstrumen = $this->db->table('surat_validasi_instrumen');
        $buildValidasiInstrumen->where('status', 1);
        $buildValidasiInstrumen->where('DAY(created_at)', $hariIni);
        if($departemen != 0){
            $buildValidasiInstrumen->where('departemen_pengajuan', $departemen);
        }
        $validasiInstrumen = $buildValidasiInstrumen->countAllResults();

        $buildValidatorInstrumen = $this->db->table('surat_validator_instrumen');
        $buildValidatorInstrumen->where('status', 1);
        $buildValidatorInstrumen->where('DAY(created_at)', $hariIni);
        if($departemen != 0){
            $buildValidatorInstrumen->where('departemen_pengajuan', $departemen);
        }
        $validatorInstrumen = $buildValidatorInstrumen->countAllResults();

        $total = $observasiMatakuliah +  $observasiPenelitian + $penelitian + $validasiInstrumen + $validatorInstrumen;
        return $total;
    }

    // public function hitungSuratMasukHariIni()
    // {

    //     $hariIni = date('d');
    //     $build = $this->db->query(
    //         "SELECT DAY(kunjungan_nama),
    //         COUNT(kunjungan_nama) as total_pengunjung
    //         FROM kunjungan
    //         GROUP BY DAY(kunjungan_nama)");
    //     $result = $build->getRowArray();
    //     return $result;
    // }     

    // public function totalBerita()
    // {
    //     return $this->db->table('berita')->countAll();
    // }
    // public function totalAgenda()
    // {
    //     return $this->db->table('agenda')->countAll();
    // }
}