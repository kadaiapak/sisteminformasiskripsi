<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Validator Instrumen</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Form Pengajuan</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <!-- < ?= validation_list_errors(); ?> -->
                        <form class="form-horizontal form-label-left" method="POST" action="<?= base_url('validator-instrumen/simpan'); ?>" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="nim_pengajuan">NIM</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input readonly type="text" name="nim_pengajuan" value="<?= $user['prf_nim_portal']; ?>" class="form-control <?= validation_show_error('nim_pengajuan') ? 'is-invalid' : null; ?>" id="nim_pengajuan" placeholder="Tuliskan NIM">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('nim_pengajuan'); ?>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="nama_pengajuan">Nama Mahasiswa</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input readonly type="text" value="<?= $user['prf_nama_portal']; ?>" class="form-control <?= validation_show_error('nama_pengajuan') ? 'is-invalid' : null; ?>" id="nama_pengajuan" name="nama_pengajuan" placeholder="Tuliskan Nama">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('nama_pengajuan'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-lg-3 col-md-3 col-sm-3" for="departemen_pengajuan">Departemen</label>
                                <div class="col-lg-4 col-md-4 col-sm-9 ">
                                    <select class="form-control <?= validation_show_error('departemen_pengajuan') ? 'is-invalid' : null; ?>" name="departemen_pengajuan" id="departemen_pengajuan">
                                        <option value="">-- Pilih Departemen --</option>
                                        <?php foreach ($semua_departemen as $d) { ?>
                                            <option value="<?= $d['departemen_id']; ?>"><?= $d['departemen_nama']; ?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('departemen_pengajuan'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="judul">Judul Skripsi</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <textarea class="form-control <?= validation_show_error('judul') ? 'is-invalid' : null; ?>" rows="3" name="judul" id="judul" placeholder="Isikan judul skripsi"></textarea>
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('judul'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="nama_dosen_validator_satu">Dosen Validator 1</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" value="" class="form-control <?= validation_show_error('nama_dosen_validator_satu') ? 'is-invalid' : null; ?>" id="nama_dosen_validator_satu" name="nama_dosen_validator_satu" placeholder="Tuliskan nama dosen lengkap dengan gelar">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('nama_dosen_validator_satu'); ?>
                                    </div>
                                </div>
                                <label class="control-label col-md-3 col-sm-3" for="bidang_dosen_validator_satu">Bidang</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" value="" class="form-control <?= validation_show_error('bidang_dosen_validator_satu') ? 'is-invalid' : null; ?>" id="bidang_dosen_validator_satu" name="bidang_dosen_validator_satu" placeholder="Tuliskan bidang">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('bidang_dosen_validator_satu'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="nama_dosen_validator_dua">Dosen Validator 2</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" value="" class="form-control <?= validation_show_error('nama_dosen_validator_dua') ? 'is-invalid' : null; ?>" id="nama_dosen_validator_dua" name="nama_dosen_validator_dua" placeholder="Tuliskan nama dosen lengkap dengan gelar">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('nama_dosen_validator_dua'); ?>
                                    </div>
                                </div>
                                <label class="control-label col-md-3 col-sm-3" for="bidang_dosen_validator_dua">Bidang</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" value="" class="form-control <?= validation_show_error('bidang_dosen_validator_dua') ? 'is-invalid' : null; ?>" id="bidang_dosen_validator_dua" name="bidang_dosen_validator_dua" placeholder="Tuliskan bidang">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('bidang_dosen_validator_dua'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="nama_dosen_validator_tiga">Dosen Validator 3</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" value="" class="form-control <?= validation_show_error('nama_dosen_validator_tiga') ? 'is-invalid' : null; ?>" id="nama_dosen_validator_tiga" name="nama_dosen_validator_tiga" placeholder="Tuliskan nama dosen lengkap dengan gelar">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('nama_dosen_validator_tiga'); ?>
                                    </div>
                                </div>
                                <label class="control-label col-md-3 col-sm-3" for="nama_dosen_validator_tiga">Bidang</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" value="" class="form-control <?= validation_show_error('bidang_dosen_validator_tiga') ? 'is-invalid' : null; ?>" id="bidang_dosen_validator_tiga" name="bidang_dosen_validator_tiga" placeholder="Tuliskan bidang">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('bidang_dosen_validator_tiga'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9  offset-md-3">
                                    <a href="<?= base_url('/skripsi'); ?>" class="btn btn-warning btn-sm"><i class="fa fa-chevron-circle-left" style="margin-right: 5px;"></i>Kembali</a>
                                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save" style="margin-right: 5px;"></i>Simpan</button>
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
