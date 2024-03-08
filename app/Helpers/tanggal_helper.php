<?php 
    function tanggal_indo($tanggal)
    {
        switch (date('m', strtotime($tanggal))) {
            case '01':
                $bulan = 'Januari';
                break;
            case '02':
                $bulan = 'Februari';
                break;
            case '03':
                $bulan = 'Maret';
                break;
            case '04':
                $bulan = 'April';
                break;
            case '05':
                $bulan = 'Mei';
                break;
            case '06':
                $bulan = 'Juni';
                break;
            case '07':
                $bulan = 'Juli';
                break;
            case '08':
                $bulan = 'Agustus';
                break;
            case '09':
                $bulan = 'September';
                break;
            case '10':
                $bulan = 'Oktober';
                break;
            case '11':
                $bulan = 'November';
                break;
            case '12':
                $bulan = 'Desember';
                break;
            default:
            $bulan = 'Tidak diketahui';
                break;
        }
        return date('d', strtotime($tanggal)).' '.$bulan.' '.date('Y', strtotime($tanggal));
    }

    function perbedaan_hari($tanggal)
    {
        $tanggal_sekarang = new DateTime();
        $tanggal_pemakaian = new DateTime($tanggal);
        $diff = date_diff($tanggal_sekarang, $tanggal_pemakaian);
        return $diff->days." Hari lagi";
    }

    function countTotal(){
        $db =  \Config\Database::connect();
        $departemen = session()->get('departemen');
        $buildObservasiMatakuliah = $db->table('surat_izin_observasi_matakuliah');
        $buildObservasiMatakuliah->where('status', 1);
        if($departemen != 0){
            $buildObservasiMatakuliah->where('departemen_pengajuan', $departemen);
        }
        $observasiMatakuliah = $buildObservasiMatakuliah->countAllResults();

        $buildObservasiPenelitian = $db->table('surat_izin_observasi_penelitian');
        $buildObservasiPenelitian->where('status', 1);
        if($departemen != 0){
            $buildObservasiPenelitian->where('departemen_pengajuan', $departemen);
        }
        $observasiPenelitian = $buildObservasiPenelitian->countAllResults();

        $buildPenelitian = $db->table('surat_izin_penelitian');
        $buildPenelitian->where('status', 1);
        if($departemen != 0){
            $buildPenelitian->where('departemen_pengajuan', $departemen);
        }
        $penelitian = $buildPenelitian->countAllResults();

        $buildValidasiInstrumen = $db->table('surat_validasi_instrumen');
        $buildValidasiInstrumen->where('status', 1);
        if($departemen != 0){
            $buildValidasiInstrumen->where('departemen_pengajuan', $departemen);
        }
        $validasiInstrumen = $buildValidasiInstrumen->countAllResults();

        $buildValidatorInstrumen = $db->table('surat_validator_instrumen');
        $buildValidatorInstrumen->where('status', 1);
        if($departemen != 0){
            $buildValidatorInstrumen->where('departemen_pengajuan', $departemen);
        }
        $validatorInstrumen = $buildValidatorInstrumen->countAllResults();

        $total = $observasiMatakuliah +  $observasiPenelitian + $penelitian + $validasiInstrumen + $validatorInstrumen;
        return $total;
    }

    function countObservasiMatakuliah(){
        $db =  \Config\Database::connect();
        $departemen = session()->get('departemen');
        $buildObservasiMatakuliah = $db->table('surat_izin_observasi_matakuliah');
        $buildObservasiMatakuliah->where('status', 1);
        if($departemen != 0){
            $buildObservasiMatakuliah->where('departemen_pengajuan', $departemen);
        }
        return $buildObservasiMatakuliah->countAllResults();
    }

    function countObservasiPenelitian(){
        $db =  \Config\Database::connect();
        $departemen = session()->get('departemen');
        $buildObservasiPenelitian = $db->table('surat_izin_observasi_penelitian');
        $buildObservasiPenelitian->where('status', 1);
        if($departemen != 0){
            $buildObservasiPenelitian->where('departemen_pengajuan', $departemen);
        }
        return $buildObservasiPenelitian->countAllResults();
    }

    function countPenelitian()
    {
        $db =  \Config\Database::connect();
        $departemen = session()->get('departemen');
        $buildPenelitian = $db->table('surat_izin_penelitian');
        $buildPenelitian->where('status', 1);
        if($departemen != 0){
            $buildPenelitian->where('departemen_pengajuan', $departemen);
        }
        return $buildPenelitian->countAllResults();
    }

    function countValidasiInstrumen()
    {
        $db =  \Config\Database::connect();
        $departemen = session()->get('departemen');
        $buildValidasiInstrumen = $db->table('surat_validasi_instrumen');
        $buildValidasiInstrumen->where('status', 1);
        if($departemen != 0){
            $buildValidasiInstrumen->where('departemen_pengajuan', $departemen);
        }
        return $buildValidasiInstrumen->countAllResults();
    }

    function countValidatorInstrumen()
    {
        $db =  \Config\Database::connect();
        $departemen = session()->get('departemen');
        $buildValidatorInstrumen = $db->table('surat_validator_instrumen');
        $buildValidatorInstrumen->where('status', 1);
        if($departemen != 0){
            $buildValidatorInstrumen->where('departemen_pengajuan', $departemen);
        }
        return $buildValidatorInstrumen->countAllResults();
    }
?>