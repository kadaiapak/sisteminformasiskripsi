<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Izin Observasi Penelitian</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Edit Pengajuan oleh Admin</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <!-- < ?= validation_list_errors(); ?> -->
                        <form class="form-horizontal form-label-left" method="POST" action="<?= base_url('izin-observasi-penelitian/update-admin/'.$singleIzinObservasiPenelitian['uuid']); ?>">
                            <?= csrf_field(); ?>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="nim_pengajuan">NIM</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input readonly value="<?= $singleIzinObservasiPenelitian['nim_pengajuan']; ?>" type="text" name="nim_pengajuan" class="form-control <?= validation_show_error('nim_pengajuan') ? 'is-invalid' : null; ?>" id="nim_pengajuan" placeholder="Tuliskan NIM">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('nim_pengajuan'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="nama_pengajuan">Nama Mahasiswa</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input readonly type="text" value="<?= $singleIzinObservasiPenelitian['nama_pengajuan']; ?>" class="form-control <?= validation_show_error('nama_pengajuan') ? 'is-invalid' : null; ?>" id="nama_pengajuan" name="nama_pengajuan" placeholder="Tuliskan Nama">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('nama_pengajuan'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3">Departemen</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input readonly type="text" value="<?= $singleIzinObservasiPenelitian['nama_departemen']; ?>" class="form-control">
                                </div>
                            </div>
                            <input type="hidden" name="departemen_pengajuan" value="<?= $singleIzinObservasiPenelitian['departemen_pengajuan']; ?>">
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="tujuan_surat">Tujuan Surat <b>(Kepada Yth : ?)</b></label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" value="<?= $singleIzinObservasiPenelitian['tujuan_surat']; ?>" class="form-control <?= validation_show_error('tujuan_surat') ? 'is-invalid' : null; ?>" id="tujuan_surat" name="tujuan_surat" placeholder="Contoh: Kepala Sekolah SMA N 5 Solok Selatan">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('tujuan_surat'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="alamat_surat">Alamat Tujuan Surat <b>(Di ?)</b></label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" value="<?= $singleIzinObservasiPenelitian['alamat_surat']; ?>" class="form-control <?= validation_show_error('alamat_surat') ? 'is-invalid' : null; ?>" id="alamat_surat" name="alamat_surat" placeholder="Contoh: Solok Selatan">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('alamat_surat'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="judul">Judul Skripsi</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <textarea class="form-control <?= validation_show_error('judul') ? 'is-invalid' : null; ?>" rows="3" name="judul" id="judul" placeholder="Isikan judul skripsi"><?= $singleIzinObservasiPenelitian['judul']; ?></textarea>
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('judul'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9  offset-md-3">
                                    <a href="<?= base_url('/izin-observasi-penelitian/semua'); ?>" class="btn btn-warning btn-sm"><i class="fa fa-chevron-circle-left" style="margin-right: 5px;"></i>Kembali</a>
                                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save" style="margin-right: 5px;"></i>Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Contoh Surat</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <img src="<?= base_url('/upload/contoh_surat/izin_observasi_penelitian.jpg'); ?>" alt="" style="width: 100%;" >
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
