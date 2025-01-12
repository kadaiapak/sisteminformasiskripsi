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
    'tanggal_diproses',
    'perbaikan_judul',
    'tanggal_perbaikan_judul',
];

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

    // akses oleh admin dan superadmin
    // GET MasterJudul->index;
    // melihat semua judul yang diajukan oleh mahasiswa
    public function getAllByAdmin()
    {
        $builder = $this->db->table('skripsi');
        $builder->select('skripsi.*, 
        fip_dosen_pembimbing.nidn as d_pembimbing_nidn, fip_dosen_pembimbing.peg_gel_dep as d_pembimbing_peg_gel_dep, fip_dosen_pembimbing.peg_nama as d_pembimbing_peg_nama, fip_dosen_pembimbing.peg_gel_bel as d_pembimbing_peg_gel_bel,
        fip_dosen_pa.nidn as d_pa_nidn, fip_dosen_pa.peg_gel_dep as d_pa_peg_gel_dep, fip_dosen_pa.peg_nama as d_pa_peg_nama, fip_dosen_pa.peg_gel_bel as d_pa_peg_gel_bel,
        profil.departemen_input,
        departemen.departemen_nama as nama_departemen');
        $builder->join('fip_dosen as fip_dosen_pembimbing', 'fip_dosen_pembimbing.nidn = skripsi.dosen_pembimbing');
        $builder->join('fip_dosen as fip_dosen_pa', 'fip_dosen_pa.nidn = skripsi.dosen_pa');
        $builder->join('profil', 'skripsi.nim_mahasiswa = profil.prf_nim_portal');
        $builder->join('departemen', 'profil.departemen_input = departemen.departemen_id');
        $builder->orderBy('created_at', 'desc');
        $query = $builder->get();
        return $query->getResultArray(); 
    }

    // akses oleh admin dan superadmin
    // GET master-judul->pengajuan-bermasalah;
    // GET MasterJudul->pengajuan_bermasalah;
    // melihat semua pengajuan judul double
    public function getAllJudulDouble()
    {
        $build = $this->db->query(
            "SELECT nim_mahasiswa, nama_mahasiswa, departemen.departemen_nama as nama_departemen, COUNT(*) AS total_pengajuan
            FROM 
                skripsi
            INNER JOIN profil ON skripsi.nim_mahasiswa = profil.prf_nim_portal
            INNER JOIN departemen ON profil.departemen_input = departemen.departemen_id
            GROUP BY 
                nim_mahasiswa
            HAVING
                COUNT(*) > 1");
        $result = $build->getResultArray();
        return $result;
    }

    // akses oleh controller skripsi::semua_skripsi_export_excel
    public function getAllExportExcel($departemen = null, $periode_pengajuan = null, $tahun_pengajuan = null)
    {   
        $builder = $this->db->table('skripsi');
        $builder->select('skripsi.*, 
        fip_dosen_pembimbing.nidn as d_pembimbing_nidn, fip_dosen_pembimbing.peg_gel_dep as d_pembimbing_peg_gel_dep, fip_dosen_pembimbing.peg_nama as d_pembimbing_peg_nama, fip_dosen_pembimbing.peg_gel_bel as d_pembimbing_peg_gel_bel,
        fip_dosen_pa.nidn as d_pa_nidn, fip_dosen_pa.peg_gel_dep as d_pa_peg_gel_dep, fip_dosen_pa.peg_nama as d_pa_peg_nama, fip_dosen_pa.peg_gel_bel as d_pa_peg_gel_bel,
        profil.departemen_input');
        $builder->join('fip_dosen as fip_dosen_pembimbing', 'fip_dosen_pembimbing.nidn = skripsi.dosen_pembimbing');
        $builder->join('fip_dosen as fip_dosen_pa', 'fip_dosen_pa.nidn = skripsi.dosen_pa');
        $builder->join('profil', 'skripsi.nim_mahasiswa = profil.prf_nim_portal');

        if($departemen && $departemen != 0){
            $builder->where('profil.departemen_input', $departemen);
        }
        if($periode_pengajuan != ""){
            $builder->where('periode_pengajuan', $periode_pengajuan);
        }
        if($tahun_pengajuan != ""){
            $builder->where('tahun_pengajuan', $tahun_pengajuan);
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

    // digunakan oleh route MasterJudul::detail()
    // untuk melihat detail skripsi yang diajukan
    public function getDetailByUuidByAdmin($id = null)
    {
        $builder = $this->db->table('skripsi');
        $builder->select('skripsi.*, 
        fip_dosen_pembimbing.nidn as d_pembimbing_nidn, fip_dosen_pembimbing.peg_gel_dep as d_pembimbing_peg_gel_dep, fip_dosen_pembimbing.peg_nama as d_pembimbing_peg_nama, fip_dosen_pembimbing.peg_gel_bel as d_pembimbing_peg_gel_bel,
        fip_dosen_pa.nidn as d_pa_nidn, fip_dosen_pa.peg_gel_dep as d_pa_peg_gel_dep, fip_dosen_pa.peg_nama as d_pa_peg_nama, fip_dosen_pa.peg_gel_bel as d_pa_peg_gel_bel,
        profil.departemen_input, departemen.departemen_nama as nama_departemen');
        $builder->join('fip_dosen as fip_dosen_pembimbing', 'fip_dosen_pembimbing.nidn = skripsi.dosen_pembimbing');
        $builder->join('fip_dosen as fip_dosen_pa', 'fip_dosen_pa.nidn = skripsi.dosen_pa');
        $builder->join('profil', 'skripsi.nim_mahasiswa = profil.prf_nim_portal');
        $builder->join('departemen', 'profil.departemen_input = departemen.departemen_id');
        $builder->where('skripsi_uuid', $id);
        $query = $builder->get();
        return $query->getRowArray(); 
    }

    // digunakan untuk melihat detail skripsi yang pengajuan judulnya lebih dari satu
    // GET master-judul/detail/($nim)
    // Controller MasterJudul/detail($nim)
    public function getDetailByNim($nim = null)
    {
        $builder = $this->db->table('skripsi');
        $builder->select('skripsi.*, 
        fip_dosen_pembimbing.nidn as d_pembimbing_nidn, fip_dosen_pembimbing.peg_gel_dep as d_pembimbing_peg_gel_dep, fip_dosen_pembimbing.peg_nama as d_pembimbing_peg_nama, fip_dosen_pembimbing.peg_gel_bel as d_pembimbing_peg_gel_bel,
        fip_dosen_pa.nidn as d_pa_nidn, fip_dosen_pa.peg_gel_dep as d_pa_peg_gel_dep, fip_dosen_pa.peg_nama as d_pa_peg_nama, fip_dosen_pa.peg_gel_bel as d_pa_peg_gel_bel,
        profil.departemen_input, departemen.departemen_nama as nama_departemen');
        $builder->join('fip_dosen as fip_dosen_pembimbing', 'fip_dosen_pembimbing.nidn = skripsi.dosen_pembimbing');
        $builder->join('fip_dosen as fip_dosen_pa', 'fip_dosen_pa.nidn = skripsi.dosen_pa');
        $builder->join('profil', 'skripsi.nim_mahasiswa = profil.prf_nim_portal');
        $builder->join('departemen', 'profil.departemen_input = departemen.departemen_id');
        $builder->where('skripsi.nim_mahasiswa', $nim);
        $builder->orderBy('status_pengajuan_skripsi', 'asc');
        $query = $builder->get();
        return $query->getResultArray(); 
    }

     // digunakan oleh route Skripsi::perbaikan_judul()
    // untuk melihat detail skripsi yang akan di perbaiki judulnya
    public function getDetailPerbaikanJudul($id = null, $nim = null)
    {
        $builder = $this->db->table('skripsi');
        $builder->select('*');
        $builder->where('skripsi_uuid', $id);
        $builder->where('status_pengajuan_skripsi', '3');
        $builder->where('nim_mahasiswa', $nim);
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
        $builderdua->set('dosen_pembimbing', $data['dosen_pembimbing']);
        $builderdua->set('dosen_pa', $data['dosen_pa']);
        $builderdua->set('tanggal_diproses', $data['tanggal_diproses']);
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

    // digunakan oleh route Dosen::detail()
    // untuk melihat detail skripsi yang diajukan
    public function getAllMahasiswaByDosenPa($nidn = null)
    {
        $builder = $this->db->table('skripsi');
        $builder->select('skripsi.*, 
        fip_dosen_pembimbing.nidn as d_pembimbing_nidn, fip_dosen_pembimbing.peg_gel_dep as d_pembimbing_peg_gel_dep, fip_dosen_pembimbing.peg_nama as d_pembimbing_peg_nama, fip_dosen_pembimbing.peg_gel_bel as d_pembimbing_peg_gel_bel,
        fip_dosen_pa.nidn as d_pa_nidn, fip_dosen_pa.peg_gel_dep as d_pa_peg_gel_dep, fip_dosen_pa.peg_nama as d_pa_peg_nama, fip_dosen_pa.peg_gel_bel as d_pa_peg_gel_bel,
        profil.departemen_input, departemen.departemen_nama as nama_departemen');
        $builder->join('fip_dosen as fip_dosen_pembimbing', 'fip_dosen_pembimbing.nidn = skripsi.dosen_pembimbing');
        $builder->join('fip_dosen as fip_dosen_pa', 'fip_dosen_pa.nidn = skripsi.dosen_pa');
        $builder->join('profil', 'skripsi.nim_mahasiswa = profil.prf_nim_portal');
        $builder->join('departemen', 'profil.departemen_input = departemen.departemen_id');
        $builder->where('dosen_pa', $nidn);
        $query = $builder->get();
        return $query->getResultArray(); 
    }

    // digunakan oleh route Dosen::detail()
    // untuk melihat detail skripsi yang diajukan
    public function getAllMahasiswaByDosenPembimbing($nidn = null)
    {
        $builder = $this->db->table('skripsi');
        $builder->select('skripsi.*, 
        fip_dosen_pembimbing.nidn as d_pembimbing_nidn, fip_dosen_pembimbing.peg_gel_dep as d_pembimbing_peg_gel_dep, fip_dosen_pembimbing.peg_nama as d_pembimbing_peg_nama, fip_dosen_pembimbing.peg_gel_bel as d_pembimbing_peg_gel_bel,
        fip_dosen_pa.nidn as d_pa_nidn, fip_dosen_pa.peg_gel_dep as d_pa_peg_gel_dep, fip_dosen_pa.peg_nama as d_pa_peg_nama, fip_dosen_pa.peg_gel_bel as d_pa_peg_gel_bel,
        profil.departemen_input, departemen.departemen_nama as nama_departemen');
        $builder->join('fip_dosen as fip_dosen_pembimbing', 'fip_dosen_pembimbing.nidn = skripsi.dosen_pembimbing');
        $builder->join('fip_dosen as fip_dosen_pa', 'fip_dosen_pa.nidn = skripsi.dosen_pa');
        $builder->join('profil', 'skripsi.nim_mahasiswa = profil.prf_nim_portal');
        $builder->join('departemen', 'profil.departemen_input = departemen.departemen_id');
        $builder->where('dosen_pembimbing', $nidn);
        $query = $builder->get();
        return $query->getResultArray(); 
    }

    // digunakan oleh route Dosen::detail()
    // untuk melihat detail skripsi yang diajukan
    public function getAllMahasiswaByDosenPengujiSatu($nidn = null)
    {
        $builder = $this->db->table('skripsi');
        $builder->select('skripsi.*, 
        fip_dosen_pembimbing.nidn as d_pembimbing_nidn, fip_dosen_pembimbing.peg_gel_dep as d_pembimbing_peg_gel_dep, fip_dosen_pembimbing.peg_nama as d_pembimbing_peg_nama, fip_dosen_pembimbing.peg_gel_bel as d_pembimbing_peg_gel_bel,
        fip_dosen_pa.nidn as d_pa_nidn, fip_dosen_pa.peg_gel_dep as d_pa_peg_gel_dep, fip_dosen_pa.peg_nama as d_pa_peg_nama, fip_dosen_pa.peg_gel_bel as d_pa_peg_gel_bel,
        profil.departemen_input, departemen.departemen_nama as nama_departemen');
        $builder->join('fip_dosen as fip_dosen_pembimbing', 'fip_dosen_pembimbing.nidn = skripsi.dosen_pembimbing');
        $builder->join('fip_dosen as fip_dosen_pa', 'fip_dosen_pa.nidn = skripsi.dosen_pa');
        $builder->join('profil', 'skripsi.nim_mahasiswa = profil.prf_nim_portal');
        $builder->join('departemen', 'profil.departemen_input = departemen.departemen_id');
        $builder->where('penguji_satu', $nidn);
        $query = $builder->get();
        return $query->getResultArray(); 
    }

    // digunakan oleh route Dosen::detail()
    // untuk melihat detail skripsi yang diajukan
    public function getAllMahasiswaByDosenPengujiDua($nidn = null)
    {
        $builder = $this->db->table('skripsi');
        $builder->select('skripsi.*, 
        fip_dosen_pembimbing.nidn as d_pembimbing_nidn, fip_dosen_pembimbing.peg_gel_dep as d_pembimbing_peg_gel_dep, fip_dosen_pembimbing.peg_nama as d_pembimbing_peg_nama, fip_dosen_pembimbing.peg_gel_bel as d_pembimbing_peg_gel_bel,
        fip_dosen_pa.nidn as d_pa_nidn, fip_dosen_pa.peg_gel_dep as d_pa_peg_gel_dep, fip_dosen_pa.peg_nama as d_pa_peg_nama, fip_dosen_pa.peg_gel_bel as d_pa_peg_gel_bel,
        profil.departemen_input, departemen.departemen_nama as nama_departemen');
        $builder->join('fip_dosen as fip_dosen_pembimbing', 'fip_dosen_pembimbing.nidn = skripsi.dosen_pembimbing');
        $builder->join('fip_dosen as fip_dosen_pa', 'fip_dosen_pa.nidn = skripsi.dosen_pa');
        $builder->join('profil', 'skripsi.nim_mahasiswa = profil.prf_nim_portal');
        $builder->join('departemen', 'profil.departemen_input = departemen.departemen_id');
        $builder->where('penguji_dua', $nidn);
        $query = $builder->get();
        return $query->getResultArray(); 
    }
}