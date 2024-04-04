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
        if($tanggal_sekarang > $tanggal_pemakaian )
        {
            return 'sudah lewat';
        }
        if($tanggal_sekarang <= $tanggal_pemakaian )
        {
            return $diff->days." Hari lagi";
        }
    }

    function countTotal($level){
        $total = countObservasiMatakuliah($level) + countObservasiPenelitian($level) + countPenelitian($level) + countValidasiInstrumen($level) + countValidatorInstrumen($level);
        return $total;
    }

    function countObservasiMatakuliah($level){
        $db =  \Config\Database::connect();
        $departemen = session()->get('departemen');
        $buildObservasiMatakuliah = $db->table('surat_izin_observasi_matakuliah');
        if($level == 7){
            $buildObservasiMatakuliah->where('status', 1);
        }elseif ($level == 4) {
            $buildObservasiMatakuliah->where('status', 3);
        }else {
            $buildObservasiMatakuliah->where('status', 0);
        }
        if($departemen != 0){
            $buildObservasiMatakuliah->where('departemen_pengajuan', $departemen);
        }
        return $buildObservasiMatakuliah->countAllResults();
    }

    function countObservasiPenelitian($level){
        $db =  \Config\Database::connect();
        $departemen = session()->get('departemen');
        $buildObservasiPenelitian = $db->table('surat_izin_observasi_penelitian');
        if($level == 7){
            $buildObservasiPenelitian->where('status', 1);
        }elseif ($level == 4) {
            $buildObservasiPenelitian->where('status', 3);
        }else {
            $buildObservasiPenelitian->where('status', 0);
        }
        if($departemen != 0){
            $buildObservasiPenelitian->where('departemen_pengajuan', $departemen);
        }
        return $buildObservasiPenelitian->countAllResults();
    }

    function countPenelitian($level)
    {
        $db =  \Config\Database::connect();
        $departemen = session()->get('departemen');
        $buildPenelitian = $db->table('surat_izin_penelitian');
        if($level == 7){
            $buildPenelitian->where('status', 1);
        }elseif ($level == 4) {
            $buildPenelitian->where('status', 3);
        }else {
            $buildPenelitian->where('status', 0);
        }
        if($departemen != 0){
            $buildPenelitian->where('departemen_pengajuan', $departemen);
        }
        return $buildPenelitian->countAllResults();
    }

    function countValidasiInstrumen($level)
    {
        $db =  \Config\Database::connect();
        $departemen = session()->get('departemen');
        $buildValidasiInstrumen = $db->table('surat_validasi_instrumen');
        if($level == 7){
            $buildValidasiInstrumen->where('status', 1);
        }elseif ($level == 4) {
            $buildValidasiInstrumen->where('status', 3);
        }else {
            $buildValidasiInstrumen->where('status', 0);
        }
        if($departemen != 0){
            $buildValidasiInstrumen->where('departemen_pengajuan', $departemen);
        }
        return $buildValidasiInstrumen->countAllResults();
    }

    function countValidatorInstrumen($level)
    {
        $db =  \Config\Database::connect();
        $departemen = session()->get('departemen');
        $buildValidatorInstrumen = $db->table('surat_validator_instrumen');
        if($level == 7){
            $buildValidatorInstrumen->where('status', 1);
        }elseif ($level == 4) {
            $buildValidatorInstrumen->where('status', 3);
        }else {
            $buildValidatorInstrumen->where('status', 0);
        }
        if($departemen != 0){
            $buildValidatorInstrumen->where('departemen_pengajuan', $departemen);
        }
        return $buildValidatorInstrumen->countAllResults();
    }
?>