<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Izin Penelitian</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Edit Pengajuan oleh Admin</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <!-- < ?= validation_list_errors(); ?> -->
                        <form class="form-horizontal form-label-left" method="POST" action="<?= base_url('izin-penelitian/admin-simpan-pembaruan'); ?>" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <div class="form-group row ">
                                <input hidden type="text" name="uuid" value="<?= $satu_penelitian['uuid']; ?>">
                                <label class="control-label col-md-3 col-sm-3" for="nim_pengajuan">NIM</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input readonly type="text" name="nim_pengajuan" value="<?= $satu_penelitian['nim_pengajuan']; ?>" class="form-control <?= validation_show_error('nim_pengajuan') ? 'is-invalid' : null; ?>" id="nim_pengajuan" placeholder="Tuliskan NIM">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('nim_pengajuan'); ?>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="nama_pengajuan">Nama Mahasiswa</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input readonly type="text" value="<?= $satu_penelitian['nama_pengajuan']; ?>" class="form-control <?= validation_show_error('nama_pengajuan') ? 'is-invalid' : null; ?>" id="nama_pengajuan" name="nama_pengajuan" placeholder="Tuliskan Nama">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('nama_pengajuan'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="nama_pengajuan">Departemen</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input readonly type="text" value="<?= $satu_penelitian['nama_departemen']; ?>" class="form-control">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('nama_pengajuan'); ?>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="departemen_pengajuan" value="<?= $satu_penelitian['departemen_pengajuan']; ?>">
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="tujuan_surat">Tujuan Surat <b>(Kepada Yth : ?)</b></label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input required type="text" value="<?= $satu_penelitian['tujuan_surat']; ?>" class="form-control <?= validation_show_error('tujuan_surat') ? 'is-invalid' : null; ?>" id="tujuan_surat" name="tujuan_surat" placeholder="Contoh: Kepala Sekolah SMA N 5 Padang">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('tujuan_surat'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="alamat_tempat_penelitian">Alamat Tujuan Surat <b>(Di ?)</b></label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input required type="text" value="<?= $satu_penelitian['alamat_tempat_penelitian']; ?>" class="form-control <?= validation_show_error('alamat_tempat_penelitian') ? 'is-invalid' : null; ?>" id="alamat_tempat_penelitian" name="alamat_tempat_penelitian" placeholder="Contoh: Padang">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('alamat_tempat_penelitian'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="judul">Judul Skripsi <span class="required">*</span>
                                </label>
                                <div class="col-md-9 col-sm-9" >
                                    <textarea class="form-control <?= validation_show_error('judul') ? 'is-invalid' : null; ?>" rows="5" cols="100%" name="judul" id="judul" placeholder="Isikan judul skripsi"><?= $satu_penelitian['judul']; ?></textarea>
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('judul'); ?>
                                    </div>
                                </div>
                            </div>  
                     
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="tempat_penelitian">Tempat Penelitian</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input required type="text" value="<?= $satu_penelitian['tempat_penelitian']; ?>" class="form-control <?= validation_show_error('tempat_penelitian') ? 'is-invalid' : null; ?>" id="tempat_penelitian" name="tempat_penelitian" placeholder="Tuliskan tempat">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('tempat_penelitian'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="tanggal_mulai">Jadwal <b>(Tanggal Mulai)</b> :</label>
                                <div class="input-group date col-md-9 col-sm-9">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                    <input required <?= validation_show_error('tanggal_mulai') ? "style='border : 1px solid red'" : null?> placeholder="tanggal mulai penelitian" type="text" value="<?= old('tanggal_mulai') ? old('tanggal_mulai') : $satu_penelitian['tanggal_mulai']; ?>" class="form-control datepicker" name="tanggal_mulai">
                                    <div class="invalid-feedback" style="text-align: left; display: block;">
                                        <?= validation_show_error('tanggal_mulai'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="tanggal_selesai">Jadwal <b>(Tanggal Selesai)</b> :</label>
                                <div class="input-group date col-md-9 col-sm-9">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                    <input required <?= validation_show_error('tanggal_selesai') ? "style='border : 1px solid red'" : null?> placeholder="sampai tanggal berapa" type="text" value="<?= old('tanggal_selesai') ? old('tanggal_selesai') : $satu_penelitian['tanggal_selesai']; ?>" class="form-control datepicker" name="tanggal_selesai">
                                    <div class="invalid-feedback" style="text-align: left; display: block;">
                                        <?= validation_show_error('tanggal_selesai'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="objek_penelitian">Objek Penelitian</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input required type="text" value="<?= $satu_penelitian['objek_penelitian']; ?>" class="form-control <?= validation_show_error('objek_penelitian') ? 'is-invalid' : null; ?>" id="objek_penelitian" name="objek_penelitian" placeholder="Tuliskan Objek Penelitian">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('objek_penelitian'); ?>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9  offset-md-3">
                                    <a href="<?= base_url('/izin-penelitian/semua'); ?>" class="btn btn-warning btn-sm"><i class="fa fa-chevron-circle-left" style="margin-right: 5px;"></i>Kembali</a>
                                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save" style="margin-right: 5px;"></i>Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Contoh Surat</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <img src="<?= base_url('/upload/contoh_surat/izin_penelitian.jpg'); ?>" alt="" style="width: 100%;" >
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
