<?php 

namespace App\Models;

use CodeIgniter\Model;

class IzinPenelitianModel extends Model
{
    protected $table = 'surat_izin_penelitian';
    protected $primaryKey = 'uuid';

    protected $useTimestamps = true;
    protected $allowedFields = [
        'sip_id',
        'uuid',
        'user_pengajuan',
        'nama_pengajuan',
        'nim_pengajuan',
        'departemen_pengajuan',
        'judul',
        'tujuan_surat',
        'tempat_penelitian',
        'alamat_tempat_penelitian',
        'tanggal_mulai',
        'tanggal_selesai',
        'objek_penelitian',
        'pesan',
        'status',
        'admin_edit',
        'no_surat',
        'tanggal_diproses_admin',
        'qr_code',
        'deleted_at',
    ];

    public function getAll($nim = null) 
    {
        $builder = $this->db->table('surat_izin_penelitian');
        $builder->select('surat_izin_penelitian.*, departemen.departemen_nama as nama_departemen');
        $builder->join('departemen', 'surat_izin_penelitian.departemen_pengajuan = departemen.departemen_id');
        $builder->where('user_pengajuan', $nim);
        $builder->orderBy('created_at', 'asc');
        $query = $builder->get();
        return $query->getResultArray();
    }

       public function simpan($data = null, $nama = null)
    {
        date_default_timezone_set('ASIA/JAKARTA');
        $data['created_at'] = date('Y-m-d H:i:s');
        $builder = $this->db->table('surat_izin_penelitian');
        $builder->set('uuid', 'UUID()', FALSE);
        $builder->insert($data);
        
        $insert_id = $this->db->insertID();
        $builderdua = $this->db->table('file_syarat_surat_izin_penelitian');
        $file_upload = array();
        foreach ($nama as $nm) {
            $file_uploaddua = array(
                'sip_id' => $insert_id,
                'persyaratan_id' => $nm['persyaratan_id'],
                'judul' => $nm['judul'],
                'judul_alias' => $nm['judul_alias'],
                'nama_file' => $nm['nama_file']
            );
            array_push($file_upload, $file_uploaddua);
        }
        if(count($file_upload) != 0){
            $builderdua->insertBatch($file_upload);
        }
    }

    // backup jika fitur simpan error setelah di update
    // public function simpan($data = null)
    // {
    //     date_default_timezone_set('ASIA/JAKARTA');
    //     $data['created_at'] = date('Y-m-d H:i:s');
    //     $builder = $this->db->table('surat_izin_penelitian');
    //     $builder->set('uuid', 'UUID()', FALSE);
    //     $builder->insert($data);
    // }

    public function getAllByAdmin($departemen = null, $level = null) 
    {
        $builder = $this->db->table('surat_izin_penelitian');
        $builder->select('surat_izin_penelitian.*, departemen.departemen_nama as nama_departemen');
        $builder->join('departemen', 'surat_izin_penelitian.departemen_pengajuan = departemen.departemen_id');
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
        $builder->orderBy('created_at', 'desc');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getAllByAdminYangDisetujui($departemen = null, $level = null) 
    {
        $builder = $this->db->table('surat_izin_penelitian');
        $builder->select('surat_izin_penelitian.*, departemen.departemen_nama as nama_departemen');
        $builder->join('departemen', 'surat_izin_penelitian.departemen_pengajuan = departemen.departemen_id');
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
        $builder = $this->db->table('surat_izin_penelitian');
        $builder->select('surat_izin_penelitian.*,departemen.departemen_nama as nama_departemen');
        $builder->join('departemen', 'surat_izin_penelitian.departemen_pengajuan = departemen.departemen_id');
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
        $builder = $this->db->table('surat_izin_penelitian');
        $builder->select('surat_izin_penelitian.*,departemen.departemen_nama as nama_departemen');
        $builder->join('departemen', 'surat_izin_penelitian.departemen_pengajuan = departemen.departemen_id');
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
        $builder = $this->db->table('surat_izin_penelitian');
        $builder->select('surat_izin_penelitian.*, 
        departemen.departemen_nama as nama_departemen, departemen.departemen_kd_surat as kd_surat, departemen.departemen_email as email_departemen, departemen.departemen_website as website_departemen, departemen.departemen_nm_kadep as nama_kadep_departemen, departemen.departemen_nip_kadep as nip_kadep_departemen');
        $builder->join('departemen', 'surat_izin_penelitian.departemen_pengajuan = departemen.departemen_id');
        $builder->where('uuid', $UUIDValidator);
        $query = $builder->get();
        return $query->getRowArray();
    }

    public function getDetailForCetak($UUIDObservasi = null)
    {
        $builder = $this->db->table('surat_izin_penelitian sip');
        $builder->select('sip.no_surat, sip.tujuan_surat, sip.alamat_tempat_penelitian, sip.nama_pengajuan, sip.nim_pengajuan, sip.judul, sip.tempat_penelitian, sip.tanggal_mulai, tanggal_selesai, sip.objek_penelitian, sip.created_at, sip.updated_at, sip.qr_code,
        departemen.departemen_nama as nama_departemen, departemen.departemen_email as email_departemen, departemen.departemen_website as website_departemen, departemen.departemen_kd_surat as kd_surat, departemen.judul_kop_surat as judul_kop_surat, departemen.jabatan_penanda_tangan as jabatan_penanda_tangan, departemen.nama_penanda_tangan as nama_penanda_tangan, departemen.nip_penanda_tangan as nip_penanda_tangan');
        $builder->join('departemen', 'sip.departemen_pengajuan = departemen.departemen_id');
        $builder->where('uuid', $UUIDObservasi);
        $query = $builder->get();
        return $query->getRowArray();
    }
 
}

?>