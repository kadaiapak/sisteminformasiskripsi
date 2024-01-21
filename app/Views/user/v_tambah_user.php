<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>User</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Tambah User</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <form class="form-horizontal form-label-left" method="POST" action="<?= base_url('user/simpan'); ?>">
                            <?= csrf_field(); ?>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="nama_asli">Nama Lengkap User</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" name="nama_asli"  class="form-control <?= validation_show_error('nama_asli') ? 'is-invalid' : null; ?>" id="nama_asli">
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('nama_asli'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="namauserlogin">Username </br> (digunakan untuk login)</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" name="username" class="form-control <?= validation_show_error('username') ? 'is-invalid' : null; ?>" id="namauserlogin">
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('username'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="passworduser">Password </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="password" name="password" class="form-control <?= validation_show_error('password') ? 'is-invalid' : null; ?>" id="passworduser">
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('password'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="passwordconf">Ulangi Password </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="password" name="passwordconf" class="form-control <?= validation_show_error('passwordconf') ? 'is-invalid' : null; ?>" id="passwordconf">
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('passwordconf'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="departemen">Akses Departemen</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <?php $invalid_logo = base_url('template/src/img/invalid.svg') ?>
                                    <select style="border-radius: 3px; box-shadow :0 1px 0 #fff, 0 -2px 5px rgba(0,0,0,0.08) inset; <?= validation_show_error('departemen') ? "background-image: url(".$invalid_logo."); border: 1px solid red; background-repeat: no-repeat; padding-right: calc(1.5em + .75rem); background-position: center right calc(.375em + .1875rem); background-size: calc(.75em + .375rem) calc(.75em + .375rem)" : "border: 1px solid #c8c8c8; color :#777;"; ?>" name="departemen" class="form-control" style="box-shadow: 0 1px 0 #fff, 0 -2px 5px rgba(0,0,0,0.08) inset; border: 1px solid #c8c8c8; color: #777;">
                                        <option value="a">-- Pilih Akses Departemen--</option>
                                        <option value="0">Semua Departemen</option>
                                        <?php foreach($departemen as $d) { ?>
                                        <option value="<?= $d['departemen_id']; ?>"><?= $d['departemen_nama']; ?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="invalid-feedback" style="text-align: left; display: block;">
                                        <?= validation_show_error('departemen'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="level">Level</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <?php $invalid_logo = base_url('template/src/img/invalid.svg') ?>
                                    <select style="border-radius: 3px; box-shadow :0 1px 0 #fff, 0 -2px 5px rgba(0,0,0,0.08) inset; <?= validation_show_error('level') ? "background-image: url(".$invalid_logo."); border: 1px solid red; background-repeat: no-repeat; padding-right: calc(1.5em + .75rem); background-position: center right calc(.375em + .1875rem); background-size: calc(.75em + .375rem) calc(.75em + .375rem)" : "border: 1px solid #c8c8c8; color :#777;"; ?>" name="level" class="form-control" style="box-shadow: 0 1px 0 #fff, 0 -2px 5px rgba(0,0,0,0.08) inset; border: 1px solid #c8c8c8; color: #777;">
                                        <option value="">-- Pilih User Level--</option>
                                        <?php foreach($level as $l) { ?>
                                        <option value="<?= $l['user_level_id']; ?>"><?= $l['user_level_nama']; ?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="invalid-feedback" style="text-align: left; display: block;">
                                        <?= validation_show_error('level'); ?>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9  offset-md-3">
                                    <a href="<?= base_url('/user'); ?>" class="btn btn-warning btn-sm"><i class="fa fa-chevron-circle-left" style="margin-right: 5px;"></i>Kembali</a>
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
