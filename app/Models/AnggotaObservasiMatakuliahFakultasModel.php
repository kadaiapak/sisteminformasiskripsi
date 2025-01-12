<?php 

namespace App\Models;

use CodeIgniter\Model;

class AnggotaObservasiMatakuliahFakultasModel extends Model
{
    protected $table = 'anggota_observasi_matakuliah_fakultas';
    protected $primaryKey = 'anggota_observasi_matakuliah_id';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'id_izin_observasi',
        'nim_anggota',
        'nama_anggota',
        'jenis_kelamin',
    ];
   public function getAllByObservasiId($id)
   {
    $builder = $this->db->table('anggota_observasi_matakuliah_fakultas');
    $builder->select('*');
    $builder->where('id_izin_observasi', $id);
    $hasil = $builder->get();
    return $hasil->getResultArray();
    }
}

?>