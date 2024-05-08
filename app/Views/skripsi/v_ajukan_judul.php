<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<link href="<?= base_url()?>template/src/css/select2.min.css" rel="stylesheet" />
<script src="<?= base_url()?>template/src/js/select2.min.js"></script>
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Judul Skripsi</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Ajukan Judul</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <form class="form-horizontal form-label-left" method="POST" action="<?= base_url('skripsi/simpan_judul'); ?>" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="nim_mahasiswa">NIM</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input readonly type="text" value="<?= $nim; ?>" name="nim_mahasiswa" class="form-control" id="nim_mahasiswa" placeholder="Tuliskan NIM">
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="nama_mahasiswa">Nama Mahasiswa</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input readonly type="text" value="<?= $nama; ?>" class="form-control" id="nama_mahasiswa" name="nama_mahasiswa" placeholder="Tuliskan Nama">
                                </div>
                            </div>
                            <!-- <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">NIM</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" disabled="disabled" placeholder="Disabled Input">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Nama</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" readonly="readonly" placeholder="Read-Only Input">
                                </div>
                            </div> -->
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="periode_pengajuan">Periode Pengajuan</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <select class="form-control <?= validation_show_error('periode_pengajuan') ? 'is-invalid' : null; ?>" name="periode_pengajuan">
                                        <option value="">Pilih Periode</option>
                                        <option value="1">Januari - Juni</option>
                                        <option value="2">Juli - Desember</option>
                                    </select>
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('periode_pengajuan'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="tahun_pengajuan">Tahun Pengajuan</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="number" class="form-control <?= validation_show_error('tahun_pengajuan') ? 'is-invalid' : null; ?>" id="tahun_pengajuan" name="tahun_pengajuan" placeholder="Masukkan tahun">
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('tahun_pengajuan'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="judul_skripsi">Judul Skripsi <span class="required">*</span>
                                </label>
                                <div class="col-md-9 col-sm-9" >
                                    <textarea class="form-control <?= validation_show_error('judul_skripsi') ? 'is-invalid' : null; ?>" rows="5" cols="100%" name="judul_skripsi" id="judul_skripsi" placeholder="Isikan judul skripsi"></textarea>
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('judul_skripsi'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="deskripsi_skripsi">Deskripsi Judul<span class="required">*</span>
                                </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <textarea class="form-control <?= validation_show_error('deskripsi_skripsi') ? 'is-invalid' : null;; ?>" rows="3" name="deskripsi_skripsi" placeholder="Jelaskan alasan saudara memilih judul skripsi ini!"></textarea>
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('deskripsi_skripsi'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="konsentrasi_bidang">Konsentrasi Bidang <span class="required"></span>
                                </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <textarea class="form-control <?= validation_show_error('konsentrasi_bidang') ? 'is-invalid' : null; ?>" rows="3" placeholder="Isikan konsentrasi bidang" name="konsentrasi_bidang" id="konsentrasi_bidang"></textarea>
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('konsentrasi_bidang'); ?>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group row has-error">
                                <label class="control-label col-md-3 col-sm-3 ">Nama Pembimbing</label>
                                <div class="col-md-9 col-sm-9 has-error">
                                    <select class="form-control" id="nama_pembimbing" tabindex="-1" name="nama_pembimbing">
                                        <option value="">-- Pilih dosen pembimbing --</option>
                                        <?php foreach($dosen as $d): ?>
                                        <option value="<?= $d->nidn; ?>"><?= $d->peg_gel_dep; ?> <?= $d->peg_nama; ?>, <?= $d->peg_gel_bel; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <h1 style="width: 100%; margin-top: 0.25rem; font-size: 80%; color: #dc3545;">
                                    <?= validation_show_error('nama_pembimbing'); ?>
                                    </h1>
                                </div>
                            </div>
                            <h1></h1>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Nama Dosen PA</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <select class="form-control" tabindex="-1" id="nama_dosen_pa" name="nama_dosen_pa">
                                        <option value="">-- Pilih dosen PA --</option>
                                        <?php foreach($dosen as $d): ?>
                                        <option value="<?= $d->nidn; ?>"><?= $d->peg_gel_dep; ?> <?= $d->peg_nama; ?>, <?= $d->peg_gel_bel; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <h1 style="width: 100%; margin-top: 0.25rem; font-size: 80%; color: #dc3545;">
                                    <?= validation_show_error('nama_dosen_pa'); ?>
                                    </h1>
                                        
                                </div>
                            </div>
                           
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="formFile">Data Dukung</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input class="form-control <?= validation_show_error('data_dukung') ? 'is-invalid' : null; ?>" type="file" id="formFile" name="data_dukung">
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('data_dukung'); ?>
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
<script>
   $(document).ready(function() {
    $('#nama_pembimbing').select2();
});
$(document).ready(function() {
    $('#nama_dosen_pa').select2();
});
</script>
<?= $this->endSection(); ?>
