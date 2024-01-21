<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="right_col" role="main">
    <div class="">
        <div class="row">
            <div class="col-md-9 col-sm-9">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>+ Menu</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
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
                        <form class="form-horizontal form-label-left" method="POST" action="<?= base_url('menu/simpan'); ?>">
                            <?= csrf_field(); ?>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="menu_nama">Nama Menu</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" name="menu_nama" class="form-control <?= validation_show_error('menu_nama') ? 'is-invalid' : null; ?>" id="menu_nama" placeholder="Tuliskan nama menu">
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('menu_nama'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="menu_icon">Icon Menu</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" name="menu_icon" class="form-control <?= validation_show_error('menu_icon') ? 'is-invalid' : null; ?>" id="menu_icon" placeholder="contoh : fa fa-edit">
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('menu_icon'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="menu_url">Route Menu</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" name="menu_url" class="form-control <?= validation_show_error('menu_url') ? 'is-invalid' : null; ?>" id="menu_url" placeholder="contoh : /departemen">
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('menu_url'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9  offset-md-3">
                                    <a href="<?= base_url('/menu'); ?>" class="btn btn-warning btn-sm"><i class="fa fa-chevron-circle-left" style="margin-right: 5px;"></i>Kembali</a>
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
