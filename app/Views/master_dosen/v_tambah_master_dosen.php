<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Data Master Dosen</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Tambah Data Master Dosen</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <!-- < ?= validation_list_errors(); ?> -->
                        <form class="form-horizontal form-label-left" method="POST" action="<?= base_url('master-dosen/simpan'); ?>">
                        <?= csrf_field(); ?>
                            <div class="form-group row">
                                <label class="control-label col-md-12 col-sm-12" for="nidn">NIDN</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" name="nidn" value="<?= old('nidn') ?>" class="form-control <?= validation_show_error('nidn') ? 'is-invalid' : null; ?>" id="nidn" placeholder="Tuliskan NIDN">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('nidn'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-12 col-sm-12" for="peg_nip">NIP</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" value="<?= old('peg_nip'); ?>" class="form-control <?= validation_show_error('peg_nip') ? 'is-invalid' : null; ?>" id="peg_nip" name="peg_nip" placeholder="Tuliskan NIP">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('peg_nip'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-4 col-sm-4" for="peg_gel_bel">Gelar Depan</label>
                                <label class="control-label col-md-4 col-sm-4" for="peg_nama">Nama</label>
                                <label class="control-label col-md-4 col-sm-4" for="peg_gel_bel">Gelar Belakang</label>
                                <div class="col-md-4 col-sm-4">
                                    <input type="text" value="<?= old('peg_gel_dep'); ?>" class="form-control <?= validation_show_error('peg_gel_dep') ? 'is-invalid' : null; ?>"  id="peg_gel_dep" name="peg_gel_dep" placeholder="Tuliskan gelar depan">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('peg_gel_dep'); ?>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <input type="text" value="<?= old('peg_nama'); ?>" class="form-control <?= validation_show_error('peg_nama') ? 'is-invalid' : null; ?>" id="peg_nama" name="peg_nama" placeholder="Tuliskan Nama">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('peg_nama'); ?>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <input type="text" value="<?= old('peg_gel_bel'); ?>" class="form-control <?= validation_show_error('peg_gel_bel') ? 'is-invalid' : null; ?>" id="peg_gel_bel" name="peg_gel_bel" placeholder="Tuliskan gelar belakang">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('peg_gel_bel'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-lg-12 col-md-3 col-sm-12" for="peg_prodi">Departemen</label>
                                <div class="col-lg-4 col-md-4 col-sm-9 ">
                                    <select class="form-control <?= validation_show_error('peg_prodi') ? 'is-invalid' : null; ?>" name="peg_prodi" id="peg_prodi">
                                        <option value="">-- Pilih Departemen --</option>
                                        <?php foreach ($semuaDepartemen as $d) { ?>
                                            <option value="<?= $d['departemen_id']; ?>" <?= old('peg_prodi')  == $d['departemen_id'] ? "selected" : null; ?>><?= $d['departemen_nama']; ?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('peg_prodi'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-12 col-sm-12" for="peg_bidang">Bidang</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" value="<?= old('peg_bidang'); ?>" class="form-control <?= validation_show_error('peg_bidang') ? 'is-invalid' : null; ?>" id="peg_bidang" name="peg_bidang" placeholder="Tuliskan Bidang">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('peg_bidang'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-12 col-sm-12" for="peg_pendidikan">Pendidikan</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" value="<?= old('peg_pendidikan'); ?>" class="form-control <?= validation_show_error('peg_pendidikan') ? 'is-invalid' : null; ?>" id="peg_pendidikan" name="peg_pendidikan" placeholder="Tuliskan Pendidikan">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('peg_pendidikan'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-12 col-sm-12s" for="peg_tmt">TMT :</label>
                                <div class="input-group date col-md-9 col-sm-9">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                    <input required <?= validation_show_error('peg_tmt') ? "style='border : 1px solid red'" : null?> placeholder="Pilih Tanggal TMT" type="text" value="<?= old('peg_tmt'); ?>" class="form-control datepicker" name="peg_tmt">
                                    <div class="invalid-feedback" style="text-align: left; display: block;">
                                        <?= validation_show_error('peg_tmt'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-lg-12 col-md-3 col-sm-12" for="peg_status">Status Kepegawaian</label>
                                <div class="col-lg-4 col-md-4 col-sm-9 ">
                                    <select class="form-control <?= validation_show_error('peg_status') ? 'is-invalid' : null; ?>" name="peg_status" id="peg_status">
                                        <option value="">-- Pilih Status Kepegawaian --</option>
                                        <?php foreach ($semuaStatus as $ss) { ?>
                                            <option value="<?= $ss['peg_status']; ?>"><?= $ss['peg_status']; ?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('peg_status'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-lg-12 col-md-3 col-sm-12" for="peg_pangkat">Pangkat</label>
                                <div class="col-lg-4 col-md-4 col-sm-9 ">
                                    <select class="form-control <?= validation_show_error('peg_pangkat') ? 'is-invalid' : null; ?>" name="peg_pangkat" id="peg_pangkat">
                                        <option value="">-- Pilih Pangkat --</option>
                                        <?php foreach ($semuaPangkat as $ss) { ?>
                                            <option value="<?= $ss['peg_pangkat']; ?>"><?= $ss['peg_pangkat']; ?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('peg_pangkat'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-lg-12 col-md-3 col-sm-12" for="peg_golongan">Golongan</label>
                                <div class="col-lg-4 col-md-4 col-sm-9 ">
                                    <select class="form-control <?= validation_show_error('peg_golongan') ? 'is-invalid' : null; ?>" name="peg_golongan" id="peg_golongan">
                                        <option value="">-- Pilih Golongan --</option>
                                        <?php foreach ($semuaGolongan as $ss) { ?>
                                            <option value="<?= $ss['peg_golongan']; ?>"><?= $ss['peg_golongan']; ?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('peg_golongan'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-lg-12 col-md-3 col-sm-12" for="peg_jabatan">Jabatan</label>
                                <div class="col-lg-4 col-md-4 col-sm-9 ">
                                    <select class="form-control <?= validation_show_error('peg_jabatan') ? 'is-invalid' : null; ?>" name="peg_jabatan" id="peg_jabatan">
                                        <option value="">-- Pilih Jabatan --</option>
                                        <?php foreach ($semuaJabatan as $ss) { ?>
                                            <option value="<?= $ss['peg_jabatan']; ?>"><?= $ss['peg_jabatan']; ?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('peg_jabatan'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-12 col-sm-12" for="peg_tmp_lahir">Tempat Lahir</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" value="<?= old('peg_tmp_lahir'); ?>" class="form-control <?= validation_show_error('peg_tmp_lahir') ? 'is-invalid' : null; ?>" id="peg_tmp_lahir" name="peg_tmp_lahir" placeholder="Tuliskan Tempat Lahir">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('peg_tmp_lahir'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-12 col-sm-12s" for="peg_tgl_lahir">Tanggal Lahir :</label>
                                <div class="input-group date col-md-9 col-sm-9">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                    <input required <?= validation_show_error('peg_tgl_lahir') ? "style='border : 1px solid red'" : null?> placeholder="Pilih Tanggal Lahir" type="text" value="<?= old('peg_tgl_lahir'); ?>" class="form-control datepicker" name="peg_tgl_lahir">
                                    <div class="invalid-feedback" style="text-align: left; display: block;">
                                        <?= validation_show_error('peg_tgl_lahir'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-12 col-sm-12" for="peg_sex">Jenis Kelamin</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" value="" class="form-control <?= validation_show_error('peg_sex') ? 'is-invalid' : null; ?>" id="peg_sex" name="peg_sex" placeholder="Tuliskan Jenis Kelamin">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('peg_sex'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-12 col-sm-12" for="peg_agama">Agama</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" value="<?= old('peg_agama'); ?>" class="form-control <?= validation_show_error('peg_agama') ? 'is-invalid' : null; ?>" id="peg_agama" name="peg_agama" placeholder="Tuliskan Agama">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('peg_agama'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-12 col-sm-12" for="peg_alamat">Alamat</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" value="<?= old('peg_alamat'); ?>" class="form-control <?= validation_show_error('peg_alamat') ? 'is-invalid' : null; ?>" id="peg_alamat" name="peg_alamat" placeholder="Tuliskan Alamat">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('peg_alamat'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9  offset-md-3">
                                    <a href="<?= base_url('/master-dosen'); ?>" class="btn btn-warning btn-sm"><i class="fa fa-chevron-circle-left" style="margin-right: 5px;"></i>Kembali</a>
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
<script type="text/javascript">
 $(function(){
  $(".datepicker").datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true,
      todayHighlight: true,
  });
 });
</script>
<?= $this->endSection(); ?>
