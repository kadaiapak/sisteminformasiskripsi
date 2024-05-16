<?php

namespace App\Controllers;

use App\Models\SkripsiModel;

class MasterJudul extends BaseController
{
    protected $skripsiModel;
    public function __construct()
    {
        helper('form');
        $this->skripsiModel = new SkripsiModel();
    }

    public function index()
    {
        $semuaJudul = $this->skripsiModel->getAllByAdmin();
        $data = [
            'judul' => 'Data Master Judul Skripsi',
            'semuaJudul' => $semuaJudul
        ];
        return view('master_judul/v_master_judul', $data);
    }


    public function detail($UUIDSkripsi)
    {
        if($UUIDSkripsi != null) {
            $satuJudul = $this->skripsiModel->getDetailByUuidByAdmin($UUIDSkripsi);
            if (!$satuJudul) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            } else {
                $data = [
                    'judul' => 'Detail Judul Skripsi Mahasiswa',
                    'satuJudul' => $satuJudul,
                ];
                return view('master_judul/v_detail_master_judul', $data);
            }   
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function pengajuan_bermasalah()
    {
        $semuaJudulDouble = $this->skripsiModel->getAllJudulDouble();
         $data = [
            'judul' => 'Data Pengajuan Judul Bermasalah',
            'semuaJudulDouble' => $semuaJudulDouble
        ];
        return view('master_judul/v_pengajuan_bermasalah', $data);
    }

    public function detail_pengajuan_bermasalah($nim)
    {
        if($nim != null) {
            $satuJudul = $this->skripsiModel->getDetailByNim($nim);
            if (!$satuJudul) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            } else {
                $data = [
                    'judul' => 'Detail Judul Skripsi Mahasiswa',
                    'satuJudul' => $satuJudul,
                ];
                return view('master_judul/v_detail_pengajuan_bermasalah', $data);
            }   
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    // public function edit($nidn)
    // {
    //     if($nidn != null) {
    //         $satuDosen = $this->dosenModel->getDetail($nidn);
    //         if (!$satuDosen) {
    //             throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    //         } else {
    //             $semuaDepartemen = $this->departemenModel->find();

    //             $data = [
    //                 'judul' => 'Edit Master Dosen',
    //                 'satuDosen' => $satuDosen,
    //                 'semuaDepartemen' => $semuaDepartemen
    //             ];
    //             return view('master_dosen/v_edit_master_dosen', $data);
    //         }   
    //     } else {
    //         throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    //     }
    // }

    // public function update($nidn = ''){
    //     if($nidn == ''){
    //         throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    //     }
    //     if(!$this->validate([
    //         'nidn' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => 'Tuliskan NIDN'
    //             ]
    //         ],
    //         'peg_nip' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => 'Tuliskan NIP'
    //             ]
    //         ],
    //         'peg_nama' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => 'Tuliskan Nama'
    //             ]
    //         ],
    //         'peg_prodi' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => 'Pilih Prodi'
    //             ]
    //         ],
    //     ])){
    //         return redirect()->back()->withInput();
    //     }
    //     date_default_timezone_set('ASIA/JAKARTA');
    //     $tanggalEditAdmin = date('Y-m-d H:i:s');
    //     $data = array(
    //         'peg_gel_dep' => $this->request->getVar('peg_gel_dep'),
    //         'peg_nama' => $this->request->getVar('peg_nama'),
    //         'peg_gel_bel' => $this->request->getVar('peg_gel_bel'),
    //         'peg_status' => $this->request->getVar('peg_status'),
    //         'peg_bidang' => $this->request->getVar('peg_bidang'),
    //         'peg_pangkat' => $this->request->getVar('peg_pangkat'),
    //         'peg_golongan' => $this->request->getVar('peg_golongan'),
    //         'peg_jabatan' => $this->request->getVar('peg_jabatan'),
    //         'peg_tmp_lahir' => $this->request->getVar('peg_tmp_lahir'),
    //         'peg_tgl_lahir' => $this->request->getVar('peg_tgl_lahir'),
    //         'peg_sex' => $this->request->getVar('peg_sex'),
    //         'peg_agama' => $this->request->getVar('peg_agama'),
    //         'peg_prodi' => $this->request->getVar('peg_prodi'),
    //         'peg_pendidikan' => $this->request->getVar('peg_pendidikan'),
    //         'peg_tmt' => $this->request->getVar('peg_tmt'),
    //         'peg_no_sk' => $this->request->getVar('peg_no_sk'),
    //         'peg_kota' => $this->request->getVar('peg_kota'),
    //         'peg_prop' => $this->request->getVar('peg_prop'),
    //         'peg_kawin' => $this->request->getVar('peg_kawin'),
    //         'peg_telp' => $this->request->getVar('peg_telp'),
    //         'peg_hp' => $this->request->getVar('peg_hp'),
    //         'peg_email' => $this->request->getVar('peg_email'),
    //         'peg_alamat' => $this->request->getVar('peg_alamat'),
    //         'updated_at' => $tanggalEditAdmin
    //     );
    //     $this->dosenModel->update($nidn, $data);
    //     return redirect()->to('/master-dosen')->with('sukses','Data berhasil diubah!');
    // }

    // public function tambah()
    // {
    //     $semuaDepartemen = $this->departemenModel->findAll();
    //     $semuaStatus = $this->dosenModel->getAllStatus();
    //     $semuaPangkat = $this->dosenModel->getAllPangkat();
    //     $semuaGolongan = $this->dosenModel->getAllGolongan();
    //     $semuaJabatan = $this->dosenModel->getAllJabatan();
    //     $data = [
    //         'judul' => 'Tambah Master Data Dosen',
    //         'semuaDepartemen' => $semuaDepartemen,
    //         'semuaStatus' => $semuaStatus,
    //         'semuaPangkat' => $semuaPangkat,
    //         'semuaGolongan' => $semuaGolongan,
    //         'semuaJabatan' => $semuaJabatan
    //     ];

    //     return view('master_dosen/v_tambah_master_dosen', $data);
    // }

    // public function simpan(){
    //     if(!$this->validate([
    //         'nidn' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => 'Tuliskan NIDN'
    //             ]
    //         ],
    //         'peg_nip' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => 'Tuliskan NIP'
    //             ]
    //         ],
    //         'peg_nama' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => 'Tuliskan Nama'
    //             ]
    //         ],
    //         'peg_prodi' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => 'Pilih Prodi'
    //             ]
    //         ],
    //     ])){
    //         return redirect()->back()->withInput();
    //     }
    //     $data = array(
    //         'nidn' => $this->request->getVar('nidn'),
    //         'peg_nip' => $this->request->getVar('peg_nip'),
    //         'peg_gel_dep' => $this->request->getVar('peg_gel_dep'),
    //         'peg_nama' => $this->request->getVar('peg_nama'),
    //         'peg_gel_bel' => $this->request->getVar('peg_gel_bel'),
    //         'peg_status' => $this->request->getVar('peg_status'),
    //         'peg_bidang' => $this->request->getVar('peg_bidang'),
    //         'peg_pangkat' => $this->request->getVar('peg_pangkat'),
    //         'peg_golongan' => $this->request->getVar('peg_golongan'),
    //         'peg_jabatan' => $this->request->getVar('peg_jabatan'),
    //         'peg_tmp_lahir' => $this->request->getVar('peg_tmp_lahir'),
    //         'peg_tgl_lahir' => $this->request->getVar('peg_tgl_lahir'),
    //         'peg_sex' => $this->request->getVar('peg_sex'),
    //         'peg_agama' => $this->request->getVar('peg_agama'),
    //         'peg_prodi' => $this->request->getVar('peg_prodi'),
    //         'peg_pendidikan' => $this->request->getVar('peg_pendidikan'),
    //         'peg_tmt' => $this->request->getVar('peg_tmt'),
    //         'peg_no_sk' => $this->request->getVar('peg_no_sk'),
    //         'peg_kota' => $this->request->getVar('peg_kota'),
    //         'peg_prop' => $this->request->getVar('peg_prop'),
    //         'peg_kawin' => $this->request->getVar('peg_kawin'),
    //         'peg_telp' => $this->request->getVar('peg_telp'),
    //         'peg_hp' => $this->request->getVar('peg_hp'),
    //         'peg_email' => $this->request->getVar('peg_email'),
    //         'peg_alamat' => $this->request->getVar('peg_alamat'),
    //     );
        
    //     $this->dosenModel->insert($data);
    //     return redirect()->to('/master-dosen')->with('sukses','Data berhasil diubah!');
    // }
                
    // public function pengaturan_edit($nidn)
    // {
    //     if($nidn != null) {
    //         $satuDosen = $this->dosenModel->getDetail($nidn);
    //         if (!$satuDosen) {
    //             throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    //         } else {
    //             $semuaDepartemen = $this->departemenModel->find();

    //             $data = [
    //                 'judul' => 'Edit Master Dosen',
    //                 'satuDosen' => $satuDosen,
    //                 'semuaDepartemen' => $semuaDepartemen
    //             ];
    //             return view('master_dosen/v_pengaturan_edit_master_dosen', $data);
    //         }   
    //     } else {
    //         throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    //     }
    // }

    // public function pengaturan_update($nidn = ''){
    //     if($nidn == ''){
    //         throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    //     }
    //     if(!$this->validate([
    //         'nidn' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => 'Tuliskan NIDN'
    //             ]
    //         ],
    //         'peg_nama' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => 'Tuliskan Nama'
    //             ]
    //         ],
    //         'peg_prodi' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => 'Pilih Prodi'
    //             ]
    //         ],
    //     ])){
    //         return redirect()->back()->withInput();
    //     }
    //     date_default_timezone_set('ASIA/JAKARTA');
    //     $tanggalEditAdmin = date('Y-m-d H:i:s');
    //     $data = array(
    //         'peg_gel_dep' => $this->request->getVar('peg_gel_dep'),
    //         'peg_nama' => $this->request->getVar('peg_nama'),
    //         'peg_gel_bel' => $this->request->getVar('peg_gel_bel'),
    //         'peg_status' => $this->request->getVar('peg_status'),
    //         'peg_bidang' => $this->request->getVar('peg_bidang'),
    //         'peg_pangkat' => $this->request->getVar('peg_pangkat'),
    //         'peg_golongan' => $this->request->getVar('peg_golongan'),
    //         'peg_jabatan' => $this->request->getVar('peg_jabatan'),
    //         'peg_tmp_lahir' => $this->request->getVar('peg_tmp_lahir'),
    //         'peg_tgl_lahir' => $this->request->getVar('peg_tgl_lahir'),
    //         'peg_sex' => $this->request->getVar('peg_sex'),
    //         'peg_agama' => $this->request->getVar('peg_agama'),
    //         'peg_prodi' => $this->request->getVar('peg_prodi'),
    //         'peg_pendidikan' => $this->request->getVar('peg_pendidikan'),
    //         'peg_tmt' => $this->request->getVar('peg_tmt'),
    //         'peg_no_sk' => $this->request->getVar('peg_no_sk'),
    //         'peg_kota' => $this->request->getVar('peg_kota'),
    //         'peg_prop' => $this->request->getVar('peg_prop'),
    //         'peg_kawin' => $this->request->getVar('peg_kawin'),
    //         'peg_telp' => $this->request->getVar('peg_telp'),
    //         'peg_hp' => $this->request->getVar('peg_hp'),
    //         'peg_email' => $this->request->getVar('peg_email'),
    //         'peg_alamat' => $this->request->getVar('peg_alamat'),
    //         'updated_at' => $tanggalEditAdmin
    //     );
    //     $this->dosenModel->update($nidn, $data);
    //     return redirect()->to('/master-dosen/pengaturan')->with('sukses','Data berhasil diubah!');
    // }
}
