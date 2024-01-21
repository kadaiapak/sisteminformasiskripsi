<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Ujian Skripsi</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Detail Ujian Skripsi</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <!-- < ?= validation_list_errors(); ?> -->
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
                                <label class="control-label col-md-3 col-sm-3" for="dosen_pembimbing">Nama Pembimbing</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input readonly type="text" value="<?= $satu_ujian['d_pembimbing_peg_gel_dep']; ?><?= ($satu_ujian['d_pembimbing_peg_gel_dep'] != '' ? '.' : '' ); ?><?= $satu_ujian['d_pembimbing_peg_nama']; ?>, <?= $satu_ujian['d_pembimbing_peg_gel_bel']; ?>" name="nim_mahasiswa" class="form-control" id="nim_mahasiswa">
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="dosen_pa">Dosen Pa</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input readonly type="text" value="<?= $satu_ujian['d_pa_peg_gel_dep']; ?><?= ($satu_ujian['d_pa_peg_gel_dep'] != '' ? '.' : '' ); ?><?= $satu_ujian['d_pa_peg_nama']; ?>, <?= $satu_ujian['d_pa_peg_gel_bel']; ?>" name="dosen_pa" class="form-control" id="dosen_pa">
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="penguji_satu">Nama Penguji 1</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <?php if($satu_ujian['d_penguji_satu_peg_nama'] != null){ ?>
                                        <input readonly type="text" value="<?= $satu_ujian['d_penguji_satu_peg_gel_dep']; ?><?= $satu_ujian['d_penguji_satu_peg_gel_dep'] != '' ? '.' : ''; ?><?= $satu_ujian['d_penguji_satu_peg_nama']; ?>, <?= $satu_ujian['d_penguji_satu_peg_gel_bel']; ?>" name="penguji_satu" class="form-control" id="penguji_satu">
                                    <?php }else { ?>
                                        <input readonly type="text" value="" name="penguji_satu" class="form-control" id="penguji_satu">
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="penguji_dua">Nama Penguji 2</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <?php if($satu_ujian['d_penguji_dua_peg_nama'] != null){ ?>
                                        <input readonly type="text" value="<?= $satu_ujian['d_penguji_dua_peg_gel_dep']; ?><?= $satu_ujian['d_penguji_dua_peg_gel_dep'] != '' ? '.' : ''; ?><?= $satu_ujian['d_penguji_dua_peg_nama']; ?>, <?= $satu_ujian['d_penguji_dua_peg_gel_bel']; ?>" name="penguji_dua" class="form-control" id="penguji_dua">
                                    <?php }else { ?>
                                        <input readonly type="text" value="" name="penguji_dua" class="form-control" id="penguji_dua">
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                    <label class="control-label col-md-3 col-sm-3" for="judul_skripsi">Judul Skripsi</label>
                                    <div class="col-md-9 col-sm-9 ">
                                        <textarea readonly class="form-control" rows="3" name="judul_skripsi" id="judul_skripsi" placeholder="Isikan judul skripsi"><?= $satu_ujian['judul_skripsi']; ?></textarea>
                                    </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="us_hari">Hari</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input readonly type="text" value="<?= $satu_ujian['us_hari'] == 1 ? 'Senin' : ($satu_ujian['us_hari'] == 2 ? 'Selasa' : ($satu_ujian['us_hari'] == 3 ? 'Rabu' : ($satu_ujian['us_hari'] == 4 ? 'Kamis' : ($satu_ujian['us_hari'] == 5 ? 'Jumat' : ($satu_ujian == 6 ? 'Sabtu' : ($satu_ujian == 7 ? 'Minggu' : '')))))); ?>" name="nim_mahasiswa" class="form-control" id="nim_mahasiswa">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="us_sesi">Sesi</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input readonly type="text" value="<?= $satu_ujian['ujian_skripsi_sesi_alias']; ?>" name="us_sesi" class="form-control" id="us_sesi">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="us_ruangan">Ruangan</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input readonly type="text" value="<?= $satu_ujian['ujian_skripsi_ruangan_alias']; ?>" name="nim_mahasiswa" class="form-control" id="nim_mahasiswa">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="no_surat">Nomor Surat</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input readonly type="text" value="<?= $satu_ujian['nomor_surat']; ?>" name="no_surat" class="form-control" id="no_surat">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="us_status">Status Pengajuan Ujian Skripsi</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <?= ($satu_ujian['us_status'] == 1 ? "<span class='badge badge-warning'>Belum diproses Admin</span>" : ($satu_ujian['us_status'] == 2 ? "<span class='badge badge-danger'>Ujian Skripsi ditolak Admin</span>" : ($satu_ujian['us_status'] == 3 ? "<span class='badge badge-success'>Menunggu Proses Kadep</span>" : ($satu_ujian['us_status'] == 4 ? "<span class='badge badge-danger'>Ujian Skripsi ditolak Kadep</span>" : ($satu_ujian['us_status'] == 5 ? "<span class='badge badge-success'>Ujian Skripsi disetujui Kadep</span>" : null))))); ?>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
