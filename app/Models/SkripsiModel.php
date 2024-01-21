<?php

namespace App\Models;

use CodeIgniter\Model;

class SkripsiModel extends Model
{
    protected $table = 'skripsi';
    protected $primaryKey = 'skripsi_uuid';

    protected $useTimestamps = true;
    protected $allowedFields = [
    'nama_mahasiswa',
    'nim_mahasiswa',
    'periode_pengajuan',
    'tahun_pengajuan',
    'judul_skripsi',
    'slug_judul',
    'deskripsi_skripsi',
    'konsentrasi_bidang',
    'dosen_pembimbing',
    'dosen_pa',
    'penguji_satu',
    'penguji_dua',
    'data_dukung',
    'status_pengajuan_skripsi',
    'status_keseluruhan',
    'catatan',
    'pesan',
    'tanggal_diproses'];

    // akses oleh controller skripsi::semua_skripsi
    public function getAll($nim = null, $departemen = null)
    {   
        $builder = $this->db->table('skripsi');
        $builder->select('skripsi.*, 
        fip_dosen_pembimbing.nidn as d_pembimbing_nidn, fip_dosen_pembimbing.peg_gel_dep as d_pembimbing_peg_gel_dep, fip_dosen_pembimbing.peg_nama as d_pembimbing_peg_nama, fip_dosen_pembimbing.peg_gel_bel as d_pembimbing_peg_gel_bel,
        fip_dosen_pa.nidn as d_pa_nidn, fip_dosen_pa.peg_gel_dep as d_pa_peg_gel_dep, fip_dosen_pa.peg_nama as d_pa_peg_nama, fip_dosen_pa.peg_gel_bel as d_pa_peg_gel_bel,
        profil.departemen_input');
        $builder->join('fip_dosen as fip_dosen_pembimbing', 'fip_dosen_pembimbing.nidn = skripsi.dosen_pembimbing');
        $builder->join('fip_dosen as fip_dosen_pa', 'fip_dosen_pa.nidn = skripsi.dosen_pa');
        $builder->join('profil', 'skripsi.nim_mahasiswa = profil.prf_nim_portal');
        if($nim) {
            $builder->where('nim_mahasiswa', $nim);
        }
        if($departemen && $departemen != 0){
            $builder->where('profil.departemen_input', $departemen);
        }
        $builder->groupStart();
        $builder->where('status_pengajuan_skripsi', '1');
        $builder->orWhere('status_pengajuan_skripsi', '2');
        $builder->orWhere('status_pengajuan_skripsi', '3');
        $builder->orWhere('status_pengajuan_skripsi', '4');
        $builder->orWhere('status_pengajuan_skripsi', '5');
        $builder->orWhere('status_pengajuan_skripsi', '6');
        $builder->groupEnd();
        $builder->orderBy('status_pengajuan_skripsi', 'desc');
        $query = $builder->get();
        return $query->getResultArray(); 
    }

    // akses oleh controller skripsi::semua_skripsi
    public function getAllSkripsiByDosen($nidn = null)
    {   
        $builder = $this->db->table('skripsi');
        $builder->select('skripsi.*, 
        fip_dosen_pembimbing.nidn as d_pembimbing_nidn, fip_dosen_pembimbing.peg_gel_dep as d_pembimbing_peg_gel_dep, fip_dosen_pembimbing.peg_nama as d_pembimbing_peg_nama, fip_dosen_pembimbing.peg_gel_bel as d_pembimbing_peg_gel_bel,
        fip_dosen_pa.nidn as d_pa_nidn, fip_dosen_pa.peg_gel_dep as d_pa_peg_gel_dep, fip_dosen_pa.peg_nama as d_pa_peg_nama, fip_dosen_pa.peg_gel_bel as d_pa_peg_gel_bel,
        profil.departemen_input, profil.prodi_portal');
        $builder->join('fip_dosen as fip_dosen_pembimbing', 'fip_dosen_pembimbing.nidn = skripsi.dosen_pembimbing');
        $builder->join('fip_dosen as fip_dosen_pa', 'fip_dosen_pa.nidn = skripsi.dosen_pa');
        $builder->join('profil', 'skripsi.nim_mahasiswa = profil.prf_nim_portal');
        if($nidn) {
            $builder->where('dosen_pembimbing', $nidn);
        }
        $builder->groupStart();
        $builder->where('status_pengajuan_skripsi', '3');
        $builder->orWhere('status_pengajuan_skripsi', '4');
        $builder->orWhere('status_pengajuan_skripsi', '5');
        $builder->orWhere('status_pengajuan_skripsi', '6');
        $builder->groupEnd();
        $builder->orderBy('status_pengajuan_skripsi', 'asc');
        $query = $builder->get();
        return $query->getResultArray(); 
    }

    // digunakan oleh route Skripsi::proses_skripsi_oleh_kadep()
    // untuk melihat detail skripsi yang akan di verifikasi
    public function getDetail($id = null, $departemen = null)
    {
        $builder = $this->db->table('skripsi');
        $builder->select('skripsi.*, 
        fip_dosen_pembimbing.nidn as d_pembimbing_nidn, fip_dosen_pembimbing.peg_gel_dep as d_pembimbing_peg_gel_dep, fip_dosen_pembimbing.peg_nama as d_pembimbing_peg_nama, fip_dosen_pembimbing.peg_gel_bel as d_pembimbing_peg_gel_bel,
        fip_dosen_pa.nidn as d_pa_nidn, fip_dosen_pa.peg_gel_dep as d_pa_peg_gel_dep, fip_dosen_pa.peg_nama as d_pa_peg_nama, fip_dosen_pa.peg_gel_bel as d_pa_peg_gel_bel,
        profil.departemen_input');
        $builder->join('fip_dosen as fip_dosen_pembimbing', 'fip_dosen_pembimbing.nidn = skripsi.dosen_pembimbing');
        $builder->join('fip_dosen as fip_dosen_pa', 'fip_dosen_pa.nidn = skripsi.dosen_pa');
        $builder->join('profil', 'skripsi.nim_mahasiswa = profil.prf_nim_portal');
        if($id) {   
            $builder->where('skripsi_uuid', $id);
        }
        if($departemen && $departemen != 0){
            $builder->where('profil.departemen_input', $departemen);
        }
        $builder->groupStart();
        $builder->where('status_pengajuan_skripsi', '1');
        $builder->orWhere('status_pengajuan_skripsi', '2');
        $builder->orWhere('status_pengajuan_skripsi', '3');
        $builder->orWhere('status_pengajuan_skripsi', '4');
        $builder->orWhere('status_pengajuan_skripsi', '5');
        $builder->orWhere('status_pengajuan_skripsi', '6');
        $builder->groupEnd();
        $builder->orderBy('status_pengajuan_skripsi', 'asc');
        $query = $builder->get();
        return $query->getRowArray(); 
    }

    // used by Skripsi -> simpan_judul();
    public function simpanSkripsi($data)
    {
        date_default_timezone_set('ASIA/JAKARTA');
        $data['created_at'] = date('Y-m-d H:i:s');
        $builder = $this->db->table('skripsi');
        $builder->set('skripsi_uuid','UUID()', FALSE);
        $builder->insert($data);

        $builderdua = $this->db->table('mahasiswa_status_skripsi');
        $builderdua->select('mss_id');
        $builderdua->where('nim', $data['nim_mahasiswa']);
        $hasil = $builderdua->get();
        $total = count($hasil->getResultArray());
        if($total == 0)
        {
            $datamahasiswa = array(
                'nim' => $data['nim_mahasiswa'],
                'status' => 1
            );
            $buildertiga = $this->db->table('mahasiswa_status_skripsi');
            $buildertiga->insert($datamahasiswa);
        }
    }

    // used by skripsi->update_skripsi_oleh_kadep->setujui_skripsi
    public function setujuiJudul($id = null, $data = null)
    {
        $builder = $this->db->table('skripsi');
        $builder->set('status_pengajuan_skripsi', '2');
        $builder->set('pesan', 'salah satu judul saudara sudah di acc');
        $builder->where('nim_mahasiswa', $data['nim_mahasiswa']);
        $builder->update();

        
        $builderdua = $this->db->table('skripsi');
        $builderdua->set('status_pengajuan_skripsi', '3');
        $builderdua->set('pesan', '');
        $builderdua->where('skripsi_uuid', $id);
        $builderdua->update();
       
    }

    // used by skripsi->index
    // used by seminar->tambah
    public function getJudulDiterima($UUIDSkripsi = null)
    {   
        $builder = $this->db->table('skripsi');
        $builder->select('skripsi.*, 
        fip_dosen_pembimbing.nidn as d_pembimbing_nidn, fip_dosen_pembimbing.peg_gel_dep as d_pembimbing_peg_gel_dep, fip_dosen_pembimbing.peg_nama as d_pembimbing_peg_nama, fip_dosen_pembimbing.peg_gel_bel as d_pembimbing_peg_gel_bel,
        fip_dosen_pa.nidn as d_pa_nidn, fip_dosen_pa.peg_gel_dep as d_pa_peg_gel_dep, fip_dosen_pa.peg_nama as d_pa_peg_nama, fip_dosen_pa.peg_gel_bel as d_pa_peg_gel_bel,');
        $builder->join('fip_dosen as fip_dosen_pembimbing', 'fip_dosen_pembimbing.nidn = skripsi.dosen_pembimbing');
        $builder->join('fip_dosen as fip_dosen_pa', 'fip_dosen_pa.nidn = skripsi.dosen_pa');
        if($UUIDSkripsi) {
            $builder->where('skripsi_uuid', $UUIDSkripsi);
        }
        $builder->groupStart();
        $builder->where('status_pengajuan_skripsi', '1');
        $builder->orWhere('status_pengajuan_skripsi', '2');
        $builder->orWhere('status_pengajuan_skripsi', '3');
        $builder->orWhere('status_pengajuan_skripsi', '4');
        $builder->orWhere('status_pengajuan_skripsi', '5');
        $builder->groupEnd();
        $query = $builder->get();
        return $query->getFirstRow(); 
    }

    public function getUUIDSkripsi($nim = null)
    {
        $builder = $this->db->table('skripsi');
        $builder->select('skripsi_uuid');
        $builder->where('nim_mahasiswa', $nim);
        $builder->groupStart();
        $builder->where('status_pengajuan_skripsi', 3);
        $builder->orWhere('status_pengajuan_skripsi', 4);
        $builder->orWhere('status_pengajuan_skripsi', 5);
        $builder->orWhere('status_pengajuan_skripsi', 6);
        $builder->groupEnd();
        $query = $builder->get();
        return $query->getRow();
    }
    
    // used by Skripsi -> index();
    public function getStatusSkripsi($nim)
    {
        $builder = $this->db->table('skripsi');
        $builder->select('skripsi.status_pengajuan_skripsi');
        $builder->where('nim_mahasiswa', $nim);
        $builder->orderBy('created_at', 'desc');
        $query = $builder->get();
        return $query->getRow();
    }

    // used by Skripsi -> index();
    public function cekBisaTambahSkripsi()
    {
        $nim  = session()->get('username');
        $builder = $this->db->table('skripsi');
        $builder->where('nim_mahasiswa', $nim);
        $builder->groupStart();
        $builder->where('status_pengajuan_skripsi', '1');
        $builder->orWhere('status_pengajuan_skripsi', '3');
        $builder->orWhere('status_pengajuan_skripsi', '4');
        $builder->orWhere('status_pengajuan_skripsi', '5');
        $builder->groupEnd();
        $query = $builder->get();
        return $query->getNumRows();
    }

    public function getSkripsiById($UUIDSkripsi)
    {
        $builder = $this->db->table('skripsi');
        $builder->select('skripsi.judul_skripsi');
        $builder->where('skripsi_uuid', $UUIDSkripsi);
        $query = $builder->get();
        return $query->getRowArray(); 
    }
   
    
}