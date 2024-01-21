<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="right_col" role="main">
    <div class="">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>+ Departemen</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <form class="form-horizontal form-label-left" method="POST" action="<?= base_url('/departemen/'.$departemen_by_id['departemen_id'].'/update'); ?>">
                            <?= csrf_field(); ?>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="departemen_nama">Nama Departemen</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" value="<?= $departemen_by_id['departemen_nama']; ?>"  name="departemen_nama" class="form-control <?= validation_show_error('departemen_nama') ? 'is-invalid' : null; ?>" id="departemen_nama">
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('departemen_nama'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="departemen_email">Email Departemen</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" value="<?= $departemen_by_id['departemen_email']; ?>" name="departemen_email" class="form-control <?= validation_show_error('departemen_email') ? 'is-invalid' : null; ?>" id="departemen_email">
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('departemen_email'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="departemen_website">Website Departemen</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" value="<?= $departemen_by_id['departemen_website']; ?>" name="departemen_website" class="form-control <?= validation_show_error('departemen_website') ? 'is-invalid' : null; ?>" id="departemen_website">
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('departemen_website'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="departemen_kd_surat">Kode Surat (ex : UN35.4.3/AK/)</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" value="<?= $departemen_by_id['departemen_kd_surat']; ?>" name="departemen_kd_surat" class="form-control <?= validation_show_error('departemen_kd_surat') ? 'is-invalid' : null; ?>" id="departemen_kd_surat">
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('departemen_kd_surat'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="departemen_nm_kadep">Nama Kepala Departemen (Lengkap dengan gelar)</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" value="<?= $departemen_by_id['departemen_nm_kadep']; ?>" name="departemen_nm_kadep" class="form-control <?= validation_show_error('departemen_nm_kadep') ? 'is-invalid' : null; ?>" id="departemen_nm_kadep">
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('departemen_nm_kadep'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="departemen_nip_kadep">NIP Kepala Departemen</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input value="<?= $departemen_by_id['departemen_nip_kadep']; ?>" type="text" name="departemen_nip_kadep" class="form-control <?= validation_show_error('departemen_nip_kadep') ? 'is-invalid' : null; ?>" id="departemen_nip_kadep">
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('departemen_nip_kadep'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9  offset-md-3">
                                    <a href="<?= base_url('/departemen'); ?>" class="btn btn-warning btn-sm"><i class="fa fa-chevron-circle-left" style="margin-right: 5px;"></i>Kembali</a>
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
