<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
			<div class="title_left">	
				<h3>Tambah Pembagian Ruangan</h3>
			</div>
		</div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-8">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Form Tambah</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <?= validation_list_errors(); ?>
                        <form class="form-horizontal form-label-left" method="POST" action="<?= base_url('ruangan/penjadwalan-ruangan/simpan'); ?>">
                        <?= csrf_field(); ?>
                            <div class="form-group row">
                                <label class="control-label col-lg-3 col-md-3 col-sm-3" for="departemen_id">Sesi</label>
                                <div class="col-lg-6 col-md-6 col-sm-9">
                                    <select class="form-control <?= validation_show_error('departemen_id') ? 'is-invalid' : null; ?>" name="departemen_id" id="departemen_id">
                                        <option value="">-- Pilih Departemen --</option>
                                        <option value="@">Semua Departemen</option>
                                        <?php foreach($departemen as $d): ?>
                                            <option value="<?=$d['departemen_id'];?>"><?= $d['departemen_nama']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('departemen_id'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-lg-3 col-md-3 col-sm-3" for="ruangan_id">Ruangan</label>
                                <div class="col-lg-6 col-md-6 col-sm-9">
                                    <select class="form-control <?= validation_show_error('ruangan_id') ? 'is-invalid' : null; ?>" name="ruangan_id" id="ruangan_id">
                                        <option value="">-- Pilih Ruangan --</option>
                                        <?php foreach($ruangan as $r): ?>
                                            <option value="<?=$r['seminar_r_id'];?>"><?= $r['ruangan_alias']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('ruangan_id'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-lg-3 col-md-3 col-sm-3" for="hari_id">Hari</label>
                                <div class="col-lg-6 col-md-6 col-sm-9">
                                    <select class="form-control <?= validation_show_error('hari_id') ? 'is-invalid' : null; ?>" name="hari_id" id="hari_id">
                                        <option value="">-- Pilih Hari --</option>
                                        <option value="@">Setiap Hari</option>
                                        <option value="1">Senin</option>
                                        <option value="2">Selasa</option>
                                        <option value="3">Rabu</option>
                                        <option value="4">Kamis</option>
                                        <option value="5">Jumat</option>
                                        <option value="6">Sabtu</option>
                                        <option value="7">Minggu</option>
                                    </select>
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('hari_id'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-lg-3 col-md-3 col-sm-3" for="sesi_id">Ruangan</label>
                                <div class="col-lg-6 col-md-6 col-sm-9">
                                    <select class="form-control <?= validation_show_error('sesi_id') ? 'is-invalid' : null; ?>" name="sesi_id" id="sesi_id">
                                        <option value="">-- Pilih Sesi --</option>
                                        <option value="0">Semua Sesi</option>
                                        <?php foreach($sesi as $s): ?>
                                            <option value="<?=$s['seminar_s_id'];?>"><?= $s['jam_alias']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('sesi_id'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9  offset-md-3">
                                    <a href="<?= base_url('/ruangan/penjadwalan-ruangan'); ?>" class="btn btn-warning btn-sm"><i class="fa fa-chevron-circle-left" style="margin-right: 5px;"></i>Kembali</a>
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