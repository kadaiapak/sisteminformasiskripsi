<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Lembar Berita Acara Ujian Skripsi</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
            <?php if(session()->getFlashdata('sukses')) : ?>
                <div class="alert alert-success alert-dismissible " role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong>Sukses!</strong> <?= session()->getFlashdata('sukses'); ?>.
                </div>
            <?php endif; ?>
            <?php if(session()->getFlashdata('gagal')) : ?>
                <div class="alert alert-danger alert-dismissible " role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong>Gagal!</strong> <?= session()->getFlashdata('gagal'); ?>.
                </div>
            <?php endif; ?>
            </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="x_panel">
                        <!-- <div class="x_title">
                            <h2>Detail Ujian Skripsi</h2>
                            <div class="clearfix"></div>
                        </div> -->
                        <div class="x_content">
                            <br />
                            <div class="row">
                                <!-- ini card coba -->
                                <div class="col-lg-12 col-md-12" style="border: 2px solid #E6E9ED; height: 60px; display: flex; align-items: center; justify-content: center; margin-bottom: 20px;">
                                    <div style="font-size: 30px;">BERITA ACARA UJIAN SKRIPSI/ TUGAS AKHIR</div>
                                </div>
                                <!-- ini card coba -->
                                <div class="col-lg-6 col-md-6 col-sm 12">
                                    <h6>Pada hari ini:</h6>
                                    <br />
                                    <div class="form-group row ">
                                        <label class="control-label col-md-3 col-sm-3" for="us_hari">Hari</label>
                                        <div class="col-md-9 col-sm-9 ">
                                            <input readonly type="text" value="<?= $satu_ujian['us_hari'] == 1 ? 'Senin' : ($satu_ujian['us_hari'] == 2 ? 'Selasa' : ($satu_ujian['us_hari'] == 3 ? 'Rabu' : ($satu_ujian['us_hari'] == 4 ? 'Kamias' : ($satu_ujian['us_hari'] == 5 ? 'Jumat' : ($satu_ujian['us_hari'] == 6 ? 'Sabtu' : ($satu_ujian['us_hari'] == 7 ? 'Minggu' : null)))))); ?>" class="form-control" id="us_hari" name="us_hari">
                                        </div>
                                    </div>
                                    <div class="form-group row ">
                                        <label class="control-label col-md-3 col-sm-3" for="us_tanggal">Tanggal</label>
                                        <div class="col-md-9 col-sm-9 ">
                                            <input readonly type="text" value="<?= $satu_ujian['us_tanggal']; ?>" name="us_tanggal" class="form-control" id="us_tanggal">
                                        </div>
                                    </div>
                                    <div class="form-group row ">
                                        <label class="control-label col-md-3 col-sm-3" for="ujian_sesi_alias">Pukul</label>
                                        <div class="col-md-9 col-sm-9 ">
                                            <input readonly type="text" value="<?= $satu_ujian['ujian_skripsi_sesi_alias']; ?>" name="ujian_sesi_alias" class="form-control" id="ujian_sesi_alias">
                                        </div>
                                    </div>
                                    <br />
                                    <h6>Telah dilaksanakan ujian skripsi/ tugas akhir atas nama:</h6>
                                    <br />
                                    <div class="form-group row ">
                                        <label class="control-label col-md-3 col-sm-3" for="us_nim_m">NIM</label>
                                        <div class="col-md-9 col-sm-9 ">
                                            <input readonly type="text" value="<?= $satu_ujian['us_nim_m']; ?>" name="us_nim_m" class="form-control" id="us_nim_m">
                                        </div>
                                    </div>
                                    <div class="form-group row ">
                                        <label class="control-label col-md-3 col-sm-3" for="nama_mahasiswa">Nama Mahasiswa</label>
                                        <div class="col-md-9 col-sm-9 ">
                                            <input readonly type="text" value="<?= $satu_ujian['nama_mahasiswa']; ?>" class="form-control" id="nama_mahasiswa" name="nama_mahasiswa">
                                        </div>
                                    </div> 
                                    <div class="form-group row ">
                                        <label class="control-label col-md-3 col-sm-3" for="nohp_baru">No Telp</label>
                                        <div class="col-md-9 col-sm-9 ">
                                            <input readonly type="text" value="<?= $satu_ujian['nohp_baru']; ?>" class="form-control" id="nohp_baru" name="nohp_baru">
                                        </div>
                                    </div> 
                                    <div class="form-group row ">
                                        <label class="control-label col-md-3 col-sm-3" for="prodi_portal">Departemen</label>
                                        <div class="col-md-9 col-sm-9 ">
                                            <input readonly type="text" value="<?= $satu_ujian['prodi_portal']; ?>" class="form-control" id="prodi_portal" name="prodi_portal">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3 col-sm-3" for="judul_skripsi">Judul Skripsi</label>
                                        <div class="col-md-9 col-sm-9 ">
                                            <textarea readonly class="form-control" rows="3" name="judul_skripsi" id="judul_skripsi" placeholder="Isikan judul skripsi"><?= $satu_ujian['judul_skripsi']; ?></textarea>
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label class="control-label col-md-3 col-sm-3" for="deskripsi_skripsi">Deskripsi Skripsi</label>
                                        <div class="col-md-9 col-sm-9 ">
                                            <textarea readonly class="form-control" rows="3" name="deskripsi_skripsi" id="deskripsi_skripsi" placeholder="Isikan judul skripsi"><?= $satu_ujian['deskripsi_skripsi']; ?></textarea>
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label class="control-label col-lg-3 col-md-3 col-sm-3" for="dosen_pa">Nama Dosen PA</label>
                                        <div class="col-lg-5 col-md-5 col-sm-12">
                                            <input readonly type="text" value="<?= $satu_ujian['d_pa_peg_gel_dep']; ?><?= ($satu_ujian['d_pa_peg_gel_dep'] != '' ? '. ' : '' ); ?><?= $satu_ujian['d_pa_peg_nama']; ?>, <?= $satu_ujian['d_pa_peg_gel_bel']; ?>" name="dosen_pa" class="form-control" id="dosen_pa">
                                        </div>
                                        <div class="col-lg-1 col-md-1 col-sm-12">
                                            <label class="control-label" for="nidn_dosen_pa">NIDN</label>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12">
                                            <input readonly type="text" value="<?= $satu_ujian['d_pa_nidn']; ?>" name="nidn_dosen_pa" class="form-control" id="nidn_dosen_pa">
                                        </div>
                                    </div>
                                    <div class="form-group row ">
                                        <label class="control-label col-lg-3 col-md-3 col-sm-3" for="dosen_pembimbing">Nama Dosen Pembimbing</label>
                                        <div class="col-lg-5 col-md-5 col-sm-12 ">
                                            <input readonly type="text" value="<?= $satu_ujian['d_pembimbing_peg_gel_dep']; ?><?= ($satu_ujian['d_pembimbing_peg_gel_dep'] != '' ? '. ' : '' ); ?><?= $satu_ujian['d_pembimbing_peg_nama']; ?>, <?= $satu_ujian['d_pembimbing_peg_gel_bel']; ?>" name="dosen_pembimbing" class="form-control" id="dosen_pembimbing">
                                        </div>
                                        <div class="col-lg-1 col-md-1 col-sm-12">
                                            <label class="control-label" for="nidn_dosen_pembimbing">NIDN</label>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12">
                                            <input readonly type="text" value="<?= $satu_ujian['d_pembimbing_nidn']; ?>" name="nidn_dosen_pembimbing" class="form-control" id="nidn_dosen_pembimbing">
                                        </div>
                                    </div>
                                    <div class="form-group row ">
                                        <label class="control-label col-lg-3 col-md-3 col-sm-3" for="penguji_satu">Penguji Satu</label>
                                        <div class="col-lg-5 col-md-5 col-sm-12">
                                            <input readonly type="text" value="<?= $satu_ujian['d_penguji_satu_peg_gel_dep']; ?><?= ($satu_ujian['d_penguji_satu_peg_gel_dep'] != '' ? '. ' : '' ); ?><?= $satu_ujian['d_penguji_satu_peg_nama']; ?>, <?= $satu_ujian['d_penguji_satu_peg_gel_bel']; ?>" name="penguji_satu" class="form-control" id="penguji_satu">
                                        </div>
                                        <div class="col-lg-1 col-md-1 col-sm-12">
                                            <label class="control-label" for="nidn_penguji_satu">NIDN</label>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12">
                                            <input readonly type="text" value="<?= $satu_ujian['penguji_satu']; ?>" name="nidn_penguji_satu" class="form-control" id="nidn_penguji_satu">
                                        </div>
                                    </div>
                                    <div class="form-group row ">
                                        <label class="control-label col-lg-3 col-md-3 col-sm-3" for="penguji_dua">Penguji Dua</label>
                                        <div class="col-lg-5 col-md-5 col-sm-12">
                                            <input readonly type="text" value="<?= $satu_ujian['d_penguji_dua_peg_gel_dep']; ?><?= ($satu_ujian['d_penguji_dua_peg_gel_dep'] != '' ? '. ' : '' ); ?><?= $satu_ujian['d_penguji_dua_peg_nama']; ?>, <?= $satu_ujian['d_penguji_dua_peg_gel_bel']; ?>" name="penguji_dua" class="form-control" id="penguji_dua">
                                        </div>
                                        <div class="col-lg-1 col-md-1 col-sm-12">
                                            <label class="control-label" for="nidn_penguji_dua">NIDN</label>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12">
                                            <input readonly type="text" value="<?= $satu_ujian['penguji_dua']; ?>" name="nidn_penguji_dua" class="form-control" id="nidn_penguji_dua">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row ">
                                        <label class="control-label col-md-3 col-sm-3" for="ujian_ruangan_alias">Ruangan</label>
                                        <div class="col-md-9 col-sm-9 ">
                                            <input readonly type="text" value="<?= $satu_ujian['ujian_skripsi_ruangan_alias']; ?>" name="ujian_ruangan_alias" class="form-control" id="ujian_ruangan_alias">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm 12">
                                    <h6>Rekapitulasi Nilai Ujian</h6>
                                    <br />
                                    <div class="row" style="border-bottom: 2px solid #E6E9ED;">
                                        <div class="col-lg-1 col-md-1">
                                            <h6>No</h6>
                                        </div>
                                        <div class="col-lg-5 col-md-5">
                                            <h6>Nama Penguji</h6>
                                        </div>
                                        <div class="col-lg-4 col-md-4">
                                            <h6>Jabatan</h6>
                                        </div>
                                        <div class="col-lg-2 col-md-2">
                                            <h6>Nilai</h6>
                                        </div>
                                    </div>
                                    <br />
                                    <?php $no = 1; ?>
                                    <?php foreach ($semua_nilai as $sn) { ?>
                                        <div class="row">
                                        <div class="col-lg-1 col-md-1">
                                            <h6><?= $no; ?></h6>
                                        </div>
                                        <div class="col-lg-5 col-md-5">
                                            <h6><?= $sn['d_peg_gel_dep']; ?><?= ($sn['d_peg_gel_dep'] != '' ? '. ' : '' ); ?><?= $sn['d_peg_nama']; ?>, <?= $sn['d_peg_gel_bel']; ?></h6>
                                        </div>
                                        <div class="col-lg-4 col-md-4">
                                            <h6><?= $sn['role_user_penilai']; ?></h6>
                                        </div>
                                        <div class="col-lg-2 col-md-2">
                                            <h6><?= $sn['nilai_akhir']; ?></h6>
                                        </div>
                                    </div>
                                    <br />
                                    <?php $no++ ?>
                                    <?php } ?>
                                    <div class="row" style="border-top: 2px solid #E6E9ED; padding-top: 10px;">
                                        <div class="col-lg-1 col-md-1">
                                        </div>
                                        <div class="col-lg-5 col-md-5">
                                        </div>
                                        <div class="col-lg-4 col-md-4">
                                            <h6>Jumlah</h6>
                                        </div>
                                        <div class="col-lg-2 col-md-2">
                                            <h6><?= $total; ?></h6>
                                        </div>
                                    </div>
                                    <br />
                                    <div class="row">
                                        <div class="col-lg-1 col-md-1">
                                        </div>
                                        <div class="col-lg-5 col-md-5">
                                        </div>
                                        <div class="col-lg-4 col-md-4">
                                            <h6>Rata - Rata</h6>
                                        </div>
                                        <div class="col-lg-2 col-md-2">
                                            <h6><?= $rata; ?></h6>
                                        </div>
                                    </div>
                                    <br />
                                    <div class="form-group row">
                                        <h6 class="col-lg-3 col-md-3 col-sm-3" style="font-weight: bold;">NILAI AKHIR</h6>
                                        <h6 class="col-lg-4 col-md-4 col-sm-3" style="font-weight: bold; font-size: 40px;"><?= $round_rata_huruf; ?></h6>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3 col-md-3">
                                            <li style="list-style: none;">85 - 100 = A</li>
                                            <li style="list-style: none;">80 - 84  = A-</li>
                                            <li style="list-style: none;">75 - 79  = B+</li>
                                            <li style="list-style: none;">70 - 74  = B</li>
                                            <li style="list-style: none;">65 - 69  = B-</li>
                                            <li style="list-style: none;">   < 64  = C</li>
                                        </div>
                                        <div class="col-lg-7 col-md-7">
                                            <li style="list-style: none;">NB : Nilai Bersih</li>
                                            <li style="list-style: none;">Rumus : Nilai Akhir = E (Nilai x Bobot) /10</li>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        console.log('test');
    })
</script>
<?= $this->endSection(); ?>
