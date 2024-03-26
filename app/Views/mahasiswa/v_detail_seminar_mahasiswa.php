<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Data Mahasiswa</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Detail Seminar Proposal</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <!-- < ?= validation_list_errors(); ?> -->
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="smr_nim_m">NIM</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input readonly type="text" value="<?= $satu_seminar->smr_nim_m; ?>" name="smr_nim_m" class="form-control" id="smr_nim_m">
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="nama_mahasiswa">Nama Mahasiswa</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input readonly type="text" value="<?= $satu_seminar->nama_mahasiswa; ?>" class="form-control" id="nama_mahasiswa" name="nama_mahasiswa">
                                </div>
                            </div>  
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="dosen_pembimbing">Nama Pembimbing</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input readonly type="text" value="<?= $satu_seminar->d_pembimbing_peg_gel_dep; ?><?= ($satu_seminar->d_pembimbing_peg_gel_dep != '' ? '.' : '' ); ?><?= $satu_seminar->d_pembimbing_peg_nama; ?>, <?= $satu_seminar->d_pembimbing_peg_gel_bel; ?>" name="nim_mahasiswa" class="form-control" id="nim_mahasiswa">
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="dosen_pembimbing">Dosen Pa</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input readonly type="text" value="<?= $satu_seminar->d_pa_peg_gel_dep; ?><?= ($satu_seminar->d_pa_peg_gel_dep != '' ? '.' : '' ); ?><?= $satu_seminar->d_pa_peg_nama; ?>, <?= $satu_seminar->d_pa_peg_gel_bel; ?>" name="nim_mahasiswa" class="form-control" id="nim_mahasiswa">
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="dosen_pembimbing">Nama Penguji 1</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <?php if($satu_seminar->d_penguji_satu_peg_nama != null){ ?>
                                        <input readonly type="text" value="<?= $satu_seminar->d_penguji_satu_peg_gel_dep; ?><?= $satu_seminar->d_penguji_satu_peg_gel_dep != '' ? '.' : ''; ?><?= $satu_seminar->d_penguji_satu_peg_nama; ?>, <?= $satu_seminar->d_penguji_satu_peg_gel_bel; ?>" name="nim_mahasiswa" class="form-control" id="nim_mahasiswa">
                                    <?php }else { ?>
                                        <input readonly type="text" value="" name="nim_mahasiswa" class="form-control" id="nim_mahasiswa">
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="dosen_pembimbing">Nama Penguji 2</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <?php if($satu_seminar->d_penguji_dua_peg_nama != null){ ?>
                                        <input readonly type="text" value="<?= $satu_seminar->d_penguji_dua_peg_gel_dep; ?><?= $satu_seminar->d_penguji_dua_peg_gel_dep != '' ? '.' : ''; ?><?= $satu_seminar->d_penguji_dua_peg_nama; ?>, <?= $satu_seminar->d_penguji_dua_peg_gel_bel; ?>" name="nim_mahasiswa" class="form-control" id="nim_mahasiswa">
                                    <?php }else { ?>
                                        <input readonly type="text" value="" name="nim_mahasiswa" class="form-control" id="nim_mahasiswa">
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                    <label class="control-label col-md-3 col-sm-3" for="judul_skripsi">Judul Skripsi</label>
                                    <div class="col-md-9 col-sm-9 ">
                                        <textarea readonly class="form-control" rows="3" name="judul_skripsi" id="judul_skripsi" placeholder="Isikan judul skripsi"><?= $satu_seminar->judul_skripsi; ?></textarea>
                                    </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="smr_hari">Hari</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input readonly type="text" value="<?= $satu_seminar->smr_hari == 1 ? 'Senin' : ($satu_seminar->smr_hari == 2 ? 'Selasa' : ($satu_seminar->smr_hari == 3 ? 'Rabu' : ($satu_seminar->smr_hari == 4 ? 'Kamis' : ($satu_seminar->smr_hari == 5 ? 'Jumat' : ($satu_seminar == 6 ? 'Sabtu' : ($satu_seminar == 7 ? 'Minggu' : '')))))); ?>" name="nim_mahasiswa" class="form-control" id="nim_mahasiswa">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="smr_sesi">Sesi</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input readonly type="text" value="<?= $satu_seminar->seminar_sesi_alias; ?>" name="nim_mahasiswa" class="form-control" id="nim_mahasiswa">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="smr_hari">Ruangan</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input readonly type="text" value="<?= $satu_seminar->seminar_ruangan_alias; ?>" name="nim_mahasiswa" class="form-control" id="nim_mahasiswa">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="smr_hari">Nomor Surat</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input readonly type="text" value="<?= $satu_seminar->nomor_surat; ?>" name="nim_mahasiswa" class="form-control" id="nim_mahasiswa">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="smr_status">Status Pengajuan Seminar</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <?= ($satu_seminar->smr_status == 1 ? "<span class='badge badge-warning'>Belum diproses Admin</span>" : ($satu_seminar->smr_status == 2 ? "<span class='badge badge-danger'>Seminar ditolak Admin</span>" : ($satu_seminar->smr_status == 3 ? "<span class='badge badge-success'>Menunggu Proses Kadep</span>" : ($satu_seminar->smr_status == 4 ? "<span class='badge badge-danger'>Seminar ditolak Kadep</span>" : ($satu_seminar->smr_status == 5 ? "<span class='badge badge-success'>Seminar disetujui Kadep</span>" : null))))); ?>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Persyaratan </h2>
                        <div class="clearfix"></div>
                    </div>
                    <?php if($persyaratan != null) {?>
                        <div class="x_content">
                            <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                                <?php $n = 1; ?>
                                <?php foreach ($persyaratan as $ps) { ?>
                                    <li class="nav-item">
                                        <a class="nav-link <?= $n == 1 ? 'active' : ''; ?>" id="b<?= $ps['persyaratan_id'] ?>-tab" data-toggle="tab" href="#b<?= $ps['persyaratan_id'] ?>" role="tab" aria-controls="b<?= $ps['persyaratan_id'] ?>" aria-selected="true"><?= $ps['judul']; ?></a>
                                    </li>
                                    <?php $n++; ?>
                                <?php } ?>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <?php $no = 1; ?>
                                <?php foreach ($persyaratan as $ps) { ?>
                                <div class="tab-pane fade <?= $no == 1 ? 'show active' : null; ?> " id="b<?= $ps['persyaratan_id'] ?>" role="tabpanel" aria-labelledby="b<?= $ps['persyaratan_id'] ?>-tab">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 ">
                                            <!-- <div class="x_panel">
                                                <div class="x_content">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="card-box table-responsive">
                                                                    <iframe src="/upload/seminar/< ?= $ps['nama_file']; ?>" frameborder="0" style="width: 100%; height: 100%; display: block;"></iframe>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> -->
                                            <div class="card" style="margin: 0; padding: 0; overflow: hidden; height: 75%;">
                                                <div class="card-body" >
                                                    <iframe src="/upload/seminar/<?= $ps['nama_file']; ?>" id="myframe" frameborder="0" style="width: 100%; height: 500px; display: block;"></iframe>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php $no++ ?>
                                <?php } ?>
                                <!-- akhir dari tab untuk pengajuan judul skripsi -->
                            </div>
                        </div>
                    <?php }else { ?>
                        <h4>Tidak ada Persyaratan</h4>
                    <?php } ?>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="form-group">
                        <a href="<?= base_url('/mahasiswa/detail-skripsi/'.$satu_seminar->smr_nim_m); ?>" class="btn btn-warning btn-sm"><i class="fa fa-chevron-circle-left" style="margin-right: 5px;"></i>Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById("myframe").height = "400";
</script>
<?= $this->endSection(); ?>
