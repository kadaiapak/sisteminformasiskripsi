<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="right_col" role="main">
    <div class="">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Edit Profil</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <form class="form-horizontal form-label-left" method="POST" action="<?= base_url('/profil/'.$profil_by_id['profil_id'].'/update'); ?>">
                            <?= csrf_field(); ?>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="prf_nim">NIM</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input readonly type="text" value="<?= $profil_by_id['prf_nim']; ?>" name="prf_nim" class="form-control" id="prf_nim">
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="prf_nim">NIM</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" value="<?= $profil_by_id['prf_nim']; ?>"  name="prf_nim" class="form-control <?= validation_show_error('prf_nim') ? 'is-invalid' : null; ?>" id="prf_nim">
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('prf_nim'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="prf_nama">Nama Lengkap</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" value="<?= $profil_by_id['prf_nama']; ?>"  name="prf_nama" class="form-control <?= validation_show_error('prf_nama') ? 'is-invalid' : null; ?>" id="prf_nama">
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('prf_nama'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="profil_email">Email Departemen</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" value="<?= $profil_by_id['profil_email']; ?>" name="profil_email" class="form-control <?= validation_show_error('profil_email') ? 'is-invalid' : null; ?>" id="profil_email">
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('profil_email'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="profil_website">Website Departemen</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" value="<?= $profil_by_id['profil_website']; ?>" name="profil_website" class="form-control <?= validation_show_error('profil_website') ? 'is-invalid' : null; ?>" id="profil_website">
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('profil_website'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="profil_kd_surat">Kode Surat (ex : UN35.4.3/AK/)</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" value="<?= $profil_by_id['profil_kd_surat']; ?>" name="profil_kd_surat" class="form-control <?= validation_show_error('profil_kd_surat') ? 'is-invalid' : null; ?>" id="profil_kd_surat">
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('profil_kd_surat'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="profil_nm_kadep">Nama Kepala Departemen (Lengkap dengan gelar)</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" value="<?= $profil_by_id['profil_nm_kadep']; ?>" name="profil_nm_kadep" class="form-control <?= validation_show_error('profil_nm_kadep') ? 'is-invalid' : null; ?>" id="profil_nm_kadep">
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('profil_nm_kadep'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="profil_nip_kadep">NIP Kepala Departemen</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input value="<?= $profil_by_id['profil_nip_kadep']; ?>" type="text" name="profil_nip_kadep" class="form-control <?= validation_show_error('profil_nip_kadep') ? 'is-invalid' : null; ?>" id="profil_nip_kadep">
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('profil_nip_kadep'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9  offset-md-3">
                                    <a href="<?= base_url('/profil'); ?>" class="btn btn-warning btn-sm"><i class="fa fa-chevron-circle-left" style="margin-right: 5px;"></i>Kembali</a>
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
