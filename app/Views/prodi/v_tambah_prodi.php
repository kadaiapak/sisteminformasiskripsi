<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="right_col" role="main">
    <div class="">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>+ Prodi</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <form class="form-horizontal form-label-left" method="POST" action="<?= base_url('prodi/simpan'); ?>">
                            <?= csrf_field(); ?>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="prodi_nama">Nama Prodi</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" name="prodi_nama" class="form-control <?= validation_show_error('prodi_nama') ? 'is-invalid' : null; ?>" id="prodi_nama">
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('prodi_nama'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-lg-3 col-md-3 col-sm-3" for="prd_jp">Jenjang Pendidikan</label>
                                <div class="col-lg-4 col-md-4 col-sm-9 ">
                                    <select class="form-control <?= validation_show_error('prd_jp') ? 'is-invalid' : null; ?>" name="prd_jp" id="prd_jp">
                                        <option value="">-- Pilih Jenjang Pendidikan --</option>
                                        <option value="1">S1</option>
                                        <option value="2">S2</option>
                                        <option value="3">S3</option>
                                        <option value="4">D3</option>
                                        <option value="5">D4</option>
                                    </select>
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('prd_jp'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-lg-3 col-md-3 col-sm-3" for="dep_id">Departemen</label>
                                <div class="col-lg-4 col-md-4 col-sm-9">
                                    <select class="form-control <?= validation_show_error('dep_id') ? 'is-invalid' : null; ?>" name="dep_id" id="dep_id">
                                        <option value="">-- Pilih Departemen --</option>
                                        <?php foreach($departemen as $d): ?>
                                            <option value="<?=$d['departemen_id'];?>"><?= $d['departemen_nama']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('dep_id'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9  offset-md-3">
                                    <a href="<?= base_url('/prodi'); ?>" class="btn btn-warning btn-sm"><i class="fa fa-chevron-circle-left" style="margin-right: 5px;"></i>Kembali</a>
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
