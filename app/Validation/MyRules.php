<?php

namespace App\Validation;

class MyRules
{
    function cek_hari($value, string $params, array $data): bool
    {
        $tanggalhasil = date('D', strtotime($data['smr_tanggal']));
        $hari = $data['smr_hari'];
        if($hari == 1 && $tanggalhasil == 'Mon'){
            return TRUE;
        }elseif ($hari == 2 && $tanggalhasil == 'Tue') {
            return TRUE;
        }elseif ($hari == 3 && $tanggalhasil == 'Wed') {
            return TRUE;
        }elseif ($hari == 4 && $tanggalhasil == 'Thu') {
            return TRUE;
        }elseif ($hari == 5 && $tanggalhasil == 'Fri') {
            return TRUE;
        }elseif ($hari == 6 && $tanggalhasil == 'Sat') {
            return TRUE;
        }elseif ($hari == 7 && $tanggalhasil == 'Sun') {
            return TRUE;
        }else {
            return FALSE;
        }
    }

    function cek_ganti_hari($value, string $params, array $data): bool
    {
        $tanggalhasil = date('D', strtotime($data['smr_tanggal']));
        $hari = $data['smr_ganti_hari'];
        if($hari == 1 && $tanggalhasil == 'Mon'){
            return TRUE;
        }elseif ($hari == 2 && $tanggalhasil == 'Tue') {
            return TRUE;
        }elseif ($hari == 3 && $tanggalhasil == 'Wed') {
            return TRUE;
        }elseif ($hari == 4 && $tanggalhasil == 'Thu') {
            return TRUE;
        }elseif ($hari == 5 && $tanggalhasil == 'Fri') {
            return TRUE;
        }elseif ($hari == 6 && $tanggalhasil == 'Sat') {
            return TRUE;
        }elseif ($hari == 7 && $tanggalhasil == 'Sun') {
            return TRUE;
        }else {
            return FALSE;
        }
    }
}
