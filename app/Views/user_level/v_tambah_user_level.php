<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="right_col" role="main">
    <div class="">
        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>+ User Level</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <form class="form-horizontal form-label-left" method="POST" action="<?= base_url('user_level/simpan'); ?>">
                            <?= csrf_field(); ?>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="user_level_nama">Nama User Level</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" name="user_level_nama" class="form-control <?= validation_show_error('user_level_nama') ? 'is-invalid' : null; ?>" id="user_level_nama">
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('user_level_nama'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="user_level_keterangan">Keterangan Level </br><small>(Jelaskan fungsi user level)</small></label>
                                <div class="col-md-9 col-sm-9 ">
                                    <textarea class="form-control <?= validation_show_error('user_level_keterangan') ? 'is-invalid' : null; ?>" rows="3" placeholder="Jelaskan fungsi user level" name="user_level_keterangan" id="user_level_keterangan"></textarea>
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('user_level_keterangan'); ?>
                                    </div>
                                </div>
                            </div>
                          
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9  offset-md-3">
                                    <a href="<?= base_url('/user_level'); ?>" class="btn btn-warning btn-sm"><i class="fa fa-chevron-circle-left" style="margin-right: 5px;"></i>Kembali</a>
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
