<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="right_col" role="main">
    <div class="">
        <div class="row">
            <div class="col-md-9 col-sm-9">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>+ Ruangan</h2>
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
                        <form class="form-horizontal form-label-left" method="POST" action="<?= base_url('ruangan/simpan'); ?>">
                            <?= csrf_field(); ?>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="ruangan_alias">Nama Ruangan</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" name="ruangan_alias" class="form-control <?= validation_show_error('ruangan_alias') ? 'is-invalid' : null; ?>" id="ruangan_alias" placeholder="Tuliskan nama ruangan">
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('ruangan_alias'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="ruangan_keterangan">Keterangan / Lokasi Ruangan</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <textarea class="form-control <?= validation_show_error('ruangan_keterangan') ? 'is-invalid' : null; ?>" rows="3" placeholder="Jelaskan lokasi ruangan" name="ruangan_keterangan" id="ruangan_keterangan"></textarea>
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('ruangan_keterangan'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9  offset-md-3">
                                    <a href="<?= base_url('/ruangan'); ?>" class="btn btn-warning btn-sm"><i class="fa fa-chevron-circle-left" style="margin-right: 5px;"></i>Kembali</a>
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
