<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="right_col" role="main">
    <div class="">
        <div class="row">
            <div class="col-md-9 col-sm-9">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>+ Sesi</h2>
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
                        <form class="form-horizontal form-label-left" method="POST" action="<?= base_url('sesi/simpan'); ?>">
                            <?= csrf_field(); ?>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="jam_alias">Jam Alias</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" name="jam_alias" class="form-control <?= validation_show_error('jam_alias') ? 'is-invalid' : null; ?>" id="jam_alias" placeholder="Tuliskan sesi">
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('jam_alias'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9  offset-md-3">
                                    <a href="<?= base_url('/sesi'); ?>" class="btn btn-warning btn-sm"><i class="fa fa-chevron-circle-left" style="margin-right: 5px;"></i>Kembali</a>
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
