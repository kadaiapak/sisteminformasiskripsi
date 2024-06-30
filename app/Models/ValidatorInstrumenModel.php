<?php 

namespace App\Models;

use CodeIgniter\Model;

class ValidatorInstrumenModel extends Model
{
    protected $table = 'surat_validator_instrumen';
    protected $primaryKey = 'uuid';

    protected $useTimestamps = true;
    protected $allowedFields = [
        'uuid',
        'user_pengajuan',
        'nama_pengajuan',
        'nim_pengajuan',
        'departemen_pengajuan',
        'judul',
        'dosen_validator_satu',
        'nama_dosen_validator_satu',
        'bidang_dosen_validator_satu',
        'dosen_validator_dua',
        'nama_dosen_validator_dua',
        'bidang_dosen_validator_dua',
        'dosen_validator_tiga',
        'nama_dosen_validator_tiga',
        'bidang_dosen_validator_tiga',
        'pesan',
        'status',
        'no_surat',
        'tanggal_diproses_admin',
        'qr_code',
    ];

    public function getAll($nim = null) 
    {
        $builder = $this->db->table('surat_validator_instrumen');
        $builder->select('surat_validator_instrumen.*, departemen.departemen_nama as nama_departemen');
        $builder->join('departemen', 'surat_validator_instrumen.departemen_pengajuan = departemen.departemen_id');
        $builder->where('user_pengajuan', $nim);
        $builder->orderBy('created_at', 'asc');
        $query = $builder->get();
        return $query->getResultArray();
    }

       public function simpan($data = null)
    {
        date_default_timezone_set('ASIA/JAKARTA');
        $data['created_at'] = date('Y-m-d H:i:s');
        $builder = $this->db->table('surat_validator_instrumen');
        $builder->set('uuid', 'UUID()', FALSE);
        $builder->insert($data);
    }

  

    public function getAllByAdmin($departemen = null, $level = null) 
    {
        $builder = $this->db->table('surat_validator_instrumen');
        $builder->select('surat_validator_instrumen.*, departemen.departemen_nama as nama_departemen');
        $builder->join('departemen', 'surat_validator_instrumen.departemen_pengajuan = departemen.departemen_id');
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
        $builder = $this->db->table('surat_validator_instrumen');
        $builder->select('surat_validator_instrumen.*, departemen.departemen_nama as nama_departemen');
        $builder->join('departemen', 'surat_validator_instrumen.departemen_pengajuan = departemen.departemen_id');
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
        $builder = $this->db->table('surat_validator_instrumen');
        $builder->select('surat_validator_instrumen.*,departemen.departemen_nama as nama_departemen');
        $builder->join('departemen', 'surat_validator_instrumen.departemen_pengajuan = departemen.departemen_id');
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
        $builder = $this->db->table('surat_validator_instrumen');
        $builder->select('surat_validator_instrumen.*,departemen.departemen_nama as nama_departemen');
        $builder->join('departemen', 'surat_validator_instrumen.departemen_pengajuan = departemen.departemen_id');
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

    public function getDetail($UUIDValidator = null)
    {
        $builder = $this->db->table('surat_validator_instrumen');
        $builder->select('surat_validator_instrumen.*, 
        departemen.departemen_nama as nama_departemen, departemen.departemen_kd_surat as kd_surat, departemen.departemen_email as email_departemen, departemen.departemen_website as website_departemen, departemen.departemen_nm_kadep as nama_kadep_departemen, departemen.departemen_nip_kadep as nip_kadep_departemen');
        $builder->join('departemen', 'surat_validator_instrumen.departemen_pengajuan = departemen.departemen_id');
        $builder->where('uuid', $UUIDValidator);
        $query = $builder->get();
        return $query->getRowArray();
    }
 
}

?>