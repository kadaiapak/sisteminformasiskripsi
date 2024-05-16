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
                        <h2>Edit Dosen</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <!-- < ?= validation_list_errors(); ?> -->
                        <form class="form-horizontal form-label-left" method="POST" action="<?= base_url('master-dosen/pengaturan/update/'.$satuDosen['nidn']); ?>">
                        <?= csrf_field(); ?>
                            <div class="form-group row">
                                <label class="control-label col-md-12 col-sm-12" for="nidn">NIDN</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input readonly type="text" name="nidn" value="<?= $satuDosen['nidn']; ?>" class="form-control <?= validation_show_error('nidn') ? 'is-invalid' : null; ?>" id="nidn" placeholder="Tuliskan NIM">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('nidn'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-12 col-sm-12" for="peg_nip">NIP</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" value="<?= $satuDosen['peg_nip']; ?>" class="form-control <?= validation_show_error('peg_nip') ? 'is-invalid' : null; ?>" id="peg_nip" name="peg_nip" placeholder="Tuliskan NIP">
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
                                    <input type="text" class="form-control <?= validation_show_error('peg_gel_dep') ? 'is-invalid' : null; ?>" value="<?= $satuDosen['peg_gel_dep']; ?>" id="peg_gel_dep" name="peg_gel_dep" placeholder="Tuliskan gelar depan">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('peg_gel_dep'); ?>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <input type="text" value="<?= $satuDosen['peg_nama']; ?>" class="form-control <?= validation_show_error('peg_nama') ? 'is-invalid' : null; ?>" id="peg_nama" name="peg_nama" placeholder="Tuliskan Nama">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('peg_nama'); ?>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <input type="text" value="<?= $satuDosen['peg_gel_bel']; ?>" class="form-control <?= validation_show_error('peg_gel_bel') ? 'is-invalid' : null; ?>" id="peg_gel_bel" name="peg_gel_bel" placeholder="Tuliskan gelar belakang">
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
                                            <option value="<?= $d['departemen_id']; ?>" <?= $satuDosen['peg_prodi'] == $d['departemen_id'] ? "selected" : null; ?>><?= $d['departemen_nama']; ?></option>
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
                                    <input type="text" value="<?= $satuDosen['peg_bidang']; ?>" class="form-control <?= validation_show_error('peg_bidang') ? 'is-invalid' : null; ?>" id="peg_bidang" name="peg_bidang" placeholder="Tuliskan Nama">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('peg_bidang'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-12 col-sm-12" for="peg_pendidikan">Pendidikan</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" value="<?= $satuDosen['peg_pendidikan']; ?>" class="form-control <?= validation_show_error('peg_pendidikan') ? 'is-invalid' : null; ?>" id="peg_pendidikan" name="peg_pendidikan" placeholder="Tuliskan Nama">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('peg_pendidikan'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-12 col-sm-12" for="peg_tmt">TMT</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input readonly type="text" value="<?= $satuDosen['peg_tmt']; ?>" class="form-control <?= validation_show_error('peg_tmt') ? 'is-invalid' : null; ?>" id="peg_tmt" name="peg_tmt" placeholder="Tuliskan Nama">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('peg_tmt'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-12 col-sm-12" for="peg_status">Status Kepegawaian</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" value="<?= $satuDosen['peg_status']; ?>" class="form-control <?= validation_show_error('peg_status') ? 'is-invalid' : null; ?>" id="peg_status" name="peg_status" placeholder="Tuliskan Nama">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('peg_status'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-12 col-sm-12" for="peg_pangkat">Pangkat</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" value="<?= $satuDosen['peg_pangkat']; ?>" class="form-control <?= validation_show_error('peg_pangkat') ? 'is-invalid' : null; ?>" id="peg_pangkat" name="peg_pangkat" placeholder="Tuliskan Nama">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('peg_pangkat'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-12 col-sm-12" for="peg_golongan">Golongan</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" value="<?= $satuDosen['peg_golongan']; ?>" class="form-control <?= validation_show_error('peg_golongan') ? 'is-invalid' : null; ?>" id="peg_golongan" name="peg_golongan" placeholder="Tuliskan Nama">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('peg_golongan'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-12 col-sm-12" for="peg_jabatan">Jabatan</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" value="<?= $satuDosen['peg_jabatan']; ?>" class="form-control <?= validation_show_error('peg_jabatan') ? 'is-invalid' : null; ?>" id="peg_jabatan" name="peg_jabatan" placeholder="Tuliskan Nama">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('peg_jabatan'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-12 col-sm-12" for="peg_tmp_lahir">Tempat Lahir</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" value="<?= $satuDosen['peg_tmp_lahir']; ?>" class="form-control <?= validation_show_error('peg_tmp_lahir') ? 'is-invalid' : null; ?>" id="peg_tmp_lahir" name="peg_tmp_lahir" placeholder="Tuliskan Nama">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('peg_tmp_lahir'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-12 col-sm-12" for="peg_tgl_lahir">Tanggal Lahir</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input readonly type="text" value="<?= $satuDosen['peg_tgl_lahir']; ?>" class="form-control <?= validation_show_error('peg_tgl_lahir') ? 'is-invalid' : null; ?>" id="peg_tgl_lahir" name="peg_tgl_lahir" placeholder="Tuliskan Nama">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('peg_tgl_lahir'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-12 col-sm-12" for="peg_sex">Jenis Kelamin</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" value="<?= $satuDosen['peg_sex'] == 'P' ? 'Perempuan' : ($satuDosen['peg_sex'] == 'L' ? 'Laki - laki' : null); ?>" class="form-control <?= validation_show_error('peg_sex') ? 'is-invalid' : null; ?>" id="peg_sex" name="peg_sex" placeholder="Tuliskan Nama">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('peg_sex'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-12 col-sm-12" for="peg_agama">Agama</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" value="<?= $satuDosen['peg_agama']; ?>" class="form-control <?= validation_show_error('peg_agama') ? 'is-invalid' : null; ?>" id="peg_agama" name="peg_agama" placeholder="Tuliskan Nama">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('peg_agama'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-12 col-sm-12" for="peg_alamat">Alamat</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" value="<?= $satuDosen['peg_alamat']; ?>" class="form-control <?= validation_show_error('peg_alamat') ? 'is-invalid' : null; ?>" id="peg_alamat" name="peg_alamat" placeholder="Tuliskan Nama">
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
<?= $this->endSection(); ?>
