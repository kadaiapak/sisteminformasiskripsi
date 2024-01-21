<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="right_col" role="main">
    <div class="">
        <div class="row">
            <div class="col-md-9 col-sm-9">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>+ Persyaratan</h2>
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
                        <form class="form-horizontal form-label-left" method="POST" action="<?= base_url('persyaratan/simpan'); ?>">
                            <?= csrf_field(); ?>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="ps_nama">Nama Persyaratan</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" name="ps_nama" class="form-control <?= validation_show_error('ps_nama') ? 'is-invalid' : null; ?>" id="ps_nama" placeholder="Tuliskan nama persyaratan">
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('ps_nama'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="ps_keterangan">Keterangan</span>
                                </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <textarea class="form-control <?= validation_show_error('ps_keterangan') ? 'is-invalid' : null; ?>" rows="3" name="ps_keterangan" id="ps_keterangan" placeholder="Isikan judul skripsi"></textarea>
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('ps_keterangan'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="ps_tipe_file">Jenis File</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <select class="form-control <?= validation_show_error('ps_tipe_file') ? 'is-invalid' : null; ?>" name="ps_tipe_file">
                                        <option value="">-- Pilih Tipe File --</option>
                                        <option value="pdf">PDF</option>
                                        <option value="jpg/jpeg/png">Gambar</option>
                                    </select>
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('ps_tipe_file'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="ps_ukuran_file">Maksimal Ukuran File</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <select class="form-control <?= validation_show_error('ps_ukuran_file') ? 'is-invalid' : null; ?>" name="ps_ukuran_file">
                                        <option value="">-- Pilih Ukuran File --</option>
                                        <option value="1024">1 MB</option>
                                        <option value="2048">2 MB</option>
                                        <option value="3072">3 MB</option>
                                        <option value="4096">4 MB</option>
                                        <option value="5120">5 MB</option>
                                    </select>
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('ps_ukuran_file'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9  offset-md-3">
                                    <a href="<?= base_url('/persyaratan'); ?>" class="btn btn-warning btn-sm"><i class="fa fa-chevron-circle-left" style="margin-right: 5px;"></i>Kembali</a>
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
