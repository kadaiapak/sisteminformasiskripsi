<?php 

namespace App\Models;

use CodeIgniter\Model;

class IzinObservasiMatakuliahFakultasModel extends Model
{
    protected $table = 'surat_izin_observasi_matakuliah_fakultas';
    protected $primaryKey = 'surat_izin_observasi_matakuliah_id';

    protected $useTimestamps = true;
    protected $allowedFields = [
        'surat_izin_observasi_matakuliah_id',
        'uuid',
        'user_pengajuan',
        'nama_pengajuan',
        'jk_pengajuan',
        'nim_pengajuan',
        'departemen_pengajuan',
        'tujuan_surat',
        'tempat_observasi',
        'alamat_tempat_observasi',
        'tujuan_observasi',
        'matakuliah',
        'tanggal_mulai',
        'tanggal_selesai',
        'pesan',
        'status',
        'admin_edit',
        'no_surat',
        'tanggal_diproses_admin',
        'qr_code',
        'deleted_at'
    ];

    // menampilkan semua pengajuan surat izin observasi matakuliah yang telah di buat
    // akses oleh mahasiswa
    // akses oleh contoller izinObservasiMatakuliahFakultas dan method index()
    public function getAll($nim = null) 
    {
        $builder = $this->db->table('surat_izin_observasi_matakuliah_fakultas');
        $builder->select('surat_izin_observasi_matakuliah_fakultas.*, departemen.departemen_nama as nama_departemen');
        $builder->join('departemen', 'surat_izin_observasi_matakuliah_fakultas.departemen_pengajuan = departemen.departemen_id');
        $builder->where('user_pengajuan', $nim);
        $builder->orderBy('created_at', 'desc');
        $query = $builder->get();
        return $query->getResultArray();
    }

    // menyimpan pengajuan izin observasi matakuliah yang telah dibuat oleh mahasiswa
    // akses oleh mahasiswa
    // akses oleh contoller izinObservasiMatakuliahFakultas dan method simpan()
       public function simpan($data = null, $data_anggota = null)
    {
        date_default_timezone_set('ASIA/JAKARTA');
        $data['created_at'] = date('Y-m-d H:i:s');
        $builder = $this->db->table('surat_izin_observasi_matakuliah_fakultas');
        $builder->set('uuid', 'UUID()', FALSE);
        $builder->insert($data);
        $observasiId = $this->db->insertID();
        if(count($data_anggota) == 1 && $data_anggota[1]['nim_anggota'] == "" && $data_anggota[1]['nama_anggota'] == "") {
            return; 
        }else {
            foreach ($data_anggota as $key => $value) {
                $data_anggota[$key]['id_izin_observasi'] = $observasiId;
            }
            $builder2 = $this->db->table('anggota_observasi_matakuliah_fakultas');
            $builder2->insertBatch($data_anggota);
        }
    }


    // menlihat detail izin observasi matakuliah yang telah dibuat oleh mahasiswa
    // akses oleh mahasiswa
    // akses oleh contoller izinObservasiMatakuliahFakultas dan method edit(), edit_pengajuan, cetak(), edit_admin(), admin_edit_pengajuan($UUIDObservasi), detail_verifikasi($UUIDObservasi)
    // ,tolak_admin($UUIDObservasi = null), setujui_admin($UUIDObservasi), scan_barcode($UUIDObservasi), print_surat($UUIDObservasi), detail($UUIDObservasi)

    // mahasiswa :: controller IzinObservasiMatakuliah method detail_izin_observasi_matakuliah // route izin-observasi-matakuliah/detail-izin-observasi-matakuliah/$1
    // admin :: controller IzinObservasiMatakuliah method edit_admin(id) // route izin-observasi-matakuliah/edit-admin/id
    public function getDetail($UUIDObservasi = null)
    {
        $builder = $this->db->table('surat_izin_observasi_matakuliah_fakultas');
        $builder->select('surat_izin_observasi_matakuliah_fakultas.*, 
        dosen_pembimbing.nidn as d_pembimbing_nidn, dosen_pembimbing.peg_gel_dep as d_pembimbing_peg_gel_dep, dosen_pembimbing.peg_nama as d_pembimbing_peg_nama, dosen_pembimbing.peg_gel_bel as d_pembimbing_peg_gel_bel,
        departemen.departemen_nama as nama_departemen, departemen.departemen_kd_surat as kd_surat, departemen.departemen_email as email_departemen, departemen.departemen_website as website_departemen, departemen.departemen_nm_kadep as nama_kadep_departemen, departemen.departemen_nip_kadep as nip_kadep_departemen,
        anggota_observasi_matakuliah_fakultas.nim_anggota as nim_anggota, anggota_observasi_matakuliah_fakultas.nama_anggota as nama_anggota, anggota_observasi_matakuliah_fakultas.jenis_kelamin as jenis_kelamin');
        $builder->join('departemen', 'surat_izin_observasi_matakuliah_fakultas.departemen_pengajuan = departemen.departemen_id');
        $builder->join('anggota_observasi_matakuliah_fakultas', 'surat_izin_observasi_matakuliah_fakultas.surat_izin_observasi_matakuliah_id = anggota_observasi_matakuliah_fakultas.id_izin_observasi', 'left');
        $builder->join('fip_dosen as dosen_pembimbing', 'dosen_pembimbing.nidn = surat_izin_observasi_matakuliah_fakultas.dosen_pembimbing');
        $builder->where('uuid', $UUIDObservasi);
        $query = $builder->get();
        return $query->getRowArray();
    }

    // mengganti dosen pembimbing oleh mahasiswa dan admin
    // akses oleh mahasiswa dan admin
    // akses oleh contoller izinObservasiMatakuliahFakultas dan method ganti_dosen_pembimbing(), ganti_dosen_pembimbing_oleh_admin()
    public function gantiDosenPembimbingByMahasiswa($UUIDObservasi = null, $nim = null, $dosenPembimbingPengganti = null)
    {
        $builder = $this->db->table('surat_izin_observasi_matakuliah_fakultas');
        $builder->set('dosen_pembimbing', $dosenPembimbingPengganti);
        $builder->where('uuid', $UUIDObservasi);
        $builder->where('nim_pengajuan', $nim);
        $builder->update();
    }


    // digunakan untuk mengecek apakah ada izin observasi dengan ID dan UUID berikut
    // conroller IzinObservasiMatakuliahFakultas method tambah_anggota()
    public function getDetailByUUIDandId($UUIDObservasi = null, $idSuratIzin = null)
    {
        $builder = $this->db->table('surat_izin_observasi_matakuliah_fakultas');
        $builder->select('');
        $builder->where('uuid', $UUIDObservasi);
        $builder->where('surat_izin_observasi_matakuliah_id', $idSuratIzin);
        $query = $builder->get();
        return $query->getRowArray();
    }

    // digunakan untuk mengambil semua data by admin
    // controller IzinObservasiMatakuliah method semua()
    public function getAllByAdmin($departemen = null, $level = null) 
    {
        $builder = $this->db->table('surat_izin_observasi_matakuliah_fakultas');
        $builder->select('surat_izin_observasi_matakuliah_fakultas.*, departemen.departemen_nama as nama_departemen');
        $builder->join('departemen', 'surat_izin_observasi_matakuliah_fakultas.departemen_pengajuan = departemen.departemen_id');
        if($departemen != null){
        $builder->where('departemen_pengajuan', $departemen);
        }
        if($level != null && $level == 7){
            $builder->groupStart();
            $builder->where('status', '1');
            $builder->groupEnd();
        }
        if($level != null && $level == 4){
            $builder->groupStart();
            $builder->where('status', '3');
            $builder->groupEnd();
        }
        $builder->orderBy('created_at', 'asc');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getAllByAdminYangDisetujui($departemen = null, $level = null) 
    {
        $builder = $this->db->table('surat_izin_observasi_matakuliah_fakultas');
        $builder->select('surat_izin_observasi_matakuliah_fakultas.*, departemen.departemen_nama as nama_departemen');
        $builder->join('departemen', 'surat_izin_observasi_matakuliah_fakultas.departemen_pengajuan = departemen.departemen_id');
        if($departemen != null){
        $builder->where('departemen_pengajuan', $departemen);
        }
        if($level != null && $level == 7){
            $builder->groupStart();
            $builder->orWhere('status', '3');
            $builder->groupEnd();
        }
        if($level != null && $level == 4){
            $builder->groupStart();
            $builder->orWhere('status', '5');
            $builder->groupEnd();
        }
        $builder->orderBy('created_at', 'asc');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getAllByAdminYangDitolak($departemen = null, $level = null) 
    {
        $builder = $this->db->table('surat_izin_observasi_matakuliah_fakultas');
        $builder->select('surat_izin_observasi_matakuliah_fakultas.*,departemen.departemen_nama as nama_departemen');
        $builder->join('departemen', 'surat_izin_observasi_matakuliah_fakultas.departemen_pengajuan = departemen.departemen_id');
        if($departemen != null){
        $builder->where('departemen_pengajuan', $departemen);
        }
        if($level != null && $level == 7){
            $builder->groupStart();
            $builder->orWhere('status', '2');
            $builder->groupEnd();
        }
        if($level != null && $level == 4){
            $builder->groupStart();
            $builder->orWhere('status', '4');
            $builder->groupEnd();
        }
        $builder->orderBy('created_at', 'asc');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getAllByAdminYangSelesai($departemen = null, $level = null) 
    {
        $builder = $this->db->table('surat_izin_observasi_matakuliah_fakultas');
        $builder->select('surat_izin_observasi_matakuliah_fakultas.*,departemen.departemen_nama as nama_departemen');
        $builder->join('departemen', 'surat_izin_observasi_matakuliah_fakultas.departemen_pengajuan = departemen.departemen_id');
        if($departemen != null){
        $builder->where('departemen_pengajuan', $departemen);
        }
        $builder->groupStart();
        $builder->orWhere('status', '5');
        $builder->groupEnd();
        $builder->orderBy('created_at', 'desc');
        $query = $builder->get();
        return $query->getResultArray();
    }
}

?>