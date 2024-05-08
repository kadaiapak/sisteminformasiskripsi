<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Profil Dosen</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Tambah Data</h2>
                        <div class="clearfix"></div>
                    </div>
                    <?= validation_list_errors(); ?>
                    <div class="x_content">
                        <br />
                        <!-- < ?= validation_list_errors(); ?> -->
                        <form class="form-horizontal form-label-left" method="POST" action="<?= base_url('profil-dosen/simpan'); ?>" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="nidn">NIDN <b>(*)</b></label>
                                <div class="col-md-9 col-sm-9">
                                    <input type="text" name="nidn" class="form-control <?= validation_show_error('nidn') ? 'is-invalid' : null; ?>" id="nidn" placeholder="Tuliskan NIDN">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('nidn'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="nip">NIP <b>(boleh dikosongkan)</b></label>
                                <div class="col-md-9 col-sm-9">
                                    <input type="text" name="nip" class="form-control <?= validation_show_error('nip') ? 'is-invalid' : null; ?>" id="nip" placeholder="Tuliskan NIP">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('nip'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="gelar_depan">Gelar Depan</label>
                                <div class="col-md-9 col-sm-9">
                                    <input type="text" class="form-control <?= validation_show_error('gelar_depan') ? 'is-invalid' : null; ?>" id="gelar_depan" name="gelar_depan" placeholder="Tuliskan gelar depan">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('gelar_depan'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="nama_lengkap">Nama Lengkap Tanpa Gelar <b>(*)</b></label>
                                <div class="col-md-9 col-sm-9">
                                    <input type="text" class="form-control <?= validation_show_error('nama_lengkap') ? 'is-invalid' : null; ?>" id="nama_lengkap" name="nama_lengkap" placeholder="Tuliskan nama lengkap tanpa gelar">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('nama_lengkap'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="gelar_belakang">Gelar Belakang</label>
                                <div class="col-md-9 col-sm-9">
                                    <input type="text" class="form-control <?= validation_show_error('gelar_belakang') ? 'is-invalid' : null; ?>" id="gelar_belakang" name="gelar_belakang" placeholder="Tuliskan gelar belakang">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('gelar_belakang'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-lg-3 col-md-3 col-sm-3" for="peg_status">Status Kepegawaian <b>(*)</b></label>
                                <div class="col-lg-4 col-md-4 col-sm-9">
                                    <select class="form-control <?= validation_show_error('peg_status') ? 'is-invalid' : null; ?>" name="peg_status" id="peg_status">
                                        <option value="">-- Pilih Status Kepegawaian --</option>
                                        <option value="ASN">ASN</option>
                                        <option value="NONASN">NON ASN</option>
                                    </select>
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('peg_status'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="peg_bidang">Bidang</label>
                                <div class="col-md-9 col-sm-9">
                                    <input type="text" class="form-control <?= validation_show_error('peg_bidang') ? 'is-invalid' : null; ?>" id="peg_bidang" name="peg_bidang" placeholder="Tuliskan bidang">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('peg_bidang'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="peg_pangkat">Pangkat</label>
                                <div class="col-md-9 col-sm-9">
                                    <input type="text" class="form-control <?= validation_show_error('peg_pangkat') ? 'is-invalid' : null; ?>" id="peg_pangkat" name="peg_pangkat" placeholder="Tuliskan pangkat">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('peg_pangkat'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-lg-3 col-md-3 col-sm-3" for="peg_golongan">Golongan</label>
                                <div class="col-lg-4 col-md-4 col-sm-9">
                                    <select class="form-control <?= validation_show_error('peg_golongan') ? 'is-invalid' : null; ?>" name="peg_golongan" id="peg_golongan">
                                        <option value="">-- Pilih Golongan --</option>
                                        <option value="III/a">III/a</option>
                                        <option value="III/b">III/b</option>
                                        <option value="III/c">III/c</option>
                                        <option value="III/d">III/d</option>
                                        <option value="IV/a">IV/a</option>
                                        <option value="IV/b">IV/b</option>
                                        <option value="IV/c">IV/c</option>
                                        <option value="IV/d">IV/d</option>
                                        <option value="IV/e">IV/e</option>
                                        <option value="">Tidak tahu</option>
                                    </select>
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('peg_golongan'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="peg_jabatan">Jabatan</label>
                                <div class="col-md-9 col-sm-9">
                                    <input type="text" class="form-control <?= validation_show_error('peg_jabatan') ? 'is-invalid' : null; ?>" id="peg_jabatan" name="peg_jabatan" placeholder="Tuliskan jabatan">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('peg_jabatan'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="peg_tmp_lahir">Tempat Lahir</label>
                                <div class="col-md-9 col-sm-9">
                                    <input type="text" class="form-control <?= validation_show_error('peg_tmp_lahir') ? 'is-invalid' : null; ?>" id="peg_tmp_lahir" name="peg_tmp_lahir" placeholder="Tuliskan tempat lahir">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('peg_tmp_lahir'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="peg_tgl_lahir">Tangal Lahir</label>
                                <div class="col-md-9 col-sm-9">
                                    <input type="text" class="form-control <?= validation_show_error('peg_tgl_lahir') ? 'is-invalid' : null; ?>" id="peg_tgl_lahir" name="peg_tgl_lahir" placeholder="Tuliskan tanggal lahir">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('peg_tgl_lahir'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-lg-3 col-md-3 col-sm-3" for="peg_sex">Jenis Kelamin <b>(*)</b></label>
                                <div class="col-lg-4 col-md-4 col-sm-9">
                                    <select class="form-control <?= validation_show_error('peg_sex') ? 'is-invalid' : null; ?>" name="peg_sex" id="peg_sex">
                                        <option value="">-- Pilih Jenis Kelamin --</option>
                                        <option value="L">Laki - laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('peg_sex'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-lg-3 col-md-3 col-sm-3" for="peg_agama">Agama <b>(boleh dikosongkan)</b></label>
                                <div class="col-lg-4 col-md-4 col-sm-9">
                                    <select class="form-control <?= validation_show_error('peg_agama') ? 'is-invalid' : null; ?>" name="peg_agama" id="peg_agama">
                                        <option value="">-- Pilih Agama --</option>
                                        <option value="Islam">Islam</option>
                                        <option value="Kristen">Kristen</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Buda">Buda</option>
                                        <option value="Buda">Tidak tahu</option>
                                    </select>
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('peg_agama'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-lg-3 col-md-3 col-sm-3" for="peg_prodi">Departemen</label>
                                <div class="col-lg-4 col-md-4 col-sm-9">
                                    <select class="form-control <?= validation_show_error('peg_prodi') ? 'is-invalid' : null; ?>" name="peg_prodi" id="peg_prodi">
                                        <option value="">-- Pilih Departemen --</option>
                                        <option value="">Semua Departemen</option>
                                        <?php foreach ($semua_departemen as $d) { ?>
                                            <option value="<?= $d['departemen_id']; ?>"><?= $d['departemen_nama']; ?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('peg_prodi'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-lg-3 col-md-3 col-sm-3" for="peg_pendidikan">Pendidikan <b>(boleh dikosongkan)</b></label>
                                <div class="col-lg-4 col-md-4 col-sm-9">
                                    <select class="form-control <?= validation_show_error('peg_pendidikan') ? 'is-invalid' : null; ?>" name="peg_pendidikan" id="peg_pendidikan">
                                        <option value="">-- Pilih Pendidikan --</option>
                                        <option value="S1">S1</option>
                                        <option value="S2">S2</option>
                                        <option value="S3">S3</option>
                                    </select>
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('peg_pendidikan'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="peg_tmt">TMT <b>(boleh dikosongkan)</b></label>
                                <div class="col-md-9 col-sm-9">
                                    <input type="text" class="form-control <?= validation_show_error('peg_tmt') ? 'is-invalid' : null; ?>" id="peg_tmt" name="peg_tmt" placeholder="Tuliskan tmt">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('peg_tmt'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="peg_no_sk">Nomor SK <b>(boleh dikosongkan)</b></label>
                                <div class="col-md-9 col-sm-9">
                                    <input type="text" class="form-control <?= validation_show_error('peg_no_sk') ? 'is-invalid' : null; ?>" id="peg_no_sk" name="peg_no_sk" placeholder="Tuliskan Nomor SK pengangkatan">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('peg_no_sk'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="peg_kota">Kota<b>(boleh dikosongkan)</b></label>
                                <div class="col-md-9 col-sm-9">
                                    <input type="text" class="form-control <?= validation_show_error('peg_kota') ? 'is-invalid' : null; ?>" id="peg_kota" name="peg_kota" placeholder="Tuliskan Kota">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('peg_kota'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="peg_prop">Provinsi<b>(boleh dikosongkan)</b></label>
                                <div class="col-md-9 col-sm-9">
                                    <input type="text" class="form-control <?= validation_show_error('peg_prop') ? 'is-invalid' : null; ?>" id="peg_prop" name="peg_prop" placeholder="Tuliskan Provinsi">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('peg_prop'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-lg-3 col-md-3 col-sm-3" for="peg_kawin">Status Perkawinan <b>(boleh dikosongkan)</b></label>
                                <div class="col-lg-4 col-md-4 col-sm-9">
                                    <select class="form-control <?= validation_show_error('peg_kawin') ? 'is-invalid' : null; ?>" name="peg_kawin" id="peg_kawin">
                                        <option value="">-- Pilih Status --</option>
                                        <option value="Lajang">Lajang</option>
                                        <option value="Menikah">Menikah</option>
                                        <option value="Janda">Janda</option>
                                        <option value="Duda">Duda</option>
                                    </select>
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('peg_kawin'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="peg_telp">No Telp<b>(boleh dikosongkan)</b></label>
                                <div class="col-md-9 col-sm-9">
                                    <input type="text" class="form-control <?= validation_show_error('peg_telp') ? 'is-invalid' : null; ?>" id="peg_telp" name="peg_telp" placeholder="Tuliskan No Telfon">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('peg_telp'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="peg_hp">No Hp<b>(*)</b></label>
                                <div class="col-md-9 col-sm-9">
                                    <input type="text" class="form-control <?= validation_show_error('peg_hp') ? 'is-invalid' : null; ?>" id="peg_hp" name="peg_hp" placeholder="Tuliskan No Handphone">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('peg_hp'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="no_wa">No Whatsapp<b>(*)</b></label>
                                <div class="col-md-9 col-sm-9">
                                    <input type="text" class="form-control <?= validation_show_error('no_wa') ? 'is-invalid' : null; ?>" id="no_wa" name="no_wa" placeholder="Tuliskan No Whatsapp">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('no_wa'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="peg_email">Email<b>(boleh dikosongkan)</b></label>
                                <div class="col-md-9 col-sm-9">
                                    <input type="text" class="form-control <?= validation_show_error('peg_email') ? 'is-invalid' : null; ?>" id="peg_email" name="peg_email" placeholder="Tuliskan Email">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('peg_email'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="peg_alamat">Alamat<b>(boleh dikosongkan)</b></label>
                                <div class="col-md-9 col-sm-9">
                                    <input type="text" class="form-control <?= validation_show_error('peg_alamat') ? 'is-invalid' : null; ?>" id="peg_alamat" name="peg_alamat" placeholder="Tuliskan Alamat">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('peg_alamat'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9  offset-md-3">
                                    <a href="<?= base_url('/skripsi'); ?>" class="btn btn-warning btn-sm"><i class="fa fa-chevron-circle-left" style="margin-right: 5px;"></i>Kembali</a>
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
