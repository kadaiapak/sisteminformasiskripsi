<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Jadwal Pengajuan Judul Skripsi</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Edit Jadwal</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <!-- < ?= validation_list_errors(); ?> -->
                        <form class="form-horizontal form-label-left" method="POST" action="<?= base_url('jadwal-pengajuan-judul/simpan-pembaruan'); ?>" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                            <div class="form-group row ">
                                <input hidden type="text" name="jadwal_id" value="<?= $satu_jadwal['jadwal_id']; ?>">
                                <input hidden type="text" name="departemen_id" value="<?= $satu_jadwal['departemen_id']; ?>">
                                <label class="control-label col-md-3 col-sm-3" for="nama_departemen">Nama Departemen</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input readonly type="text" name="nama_departemen" value="<?= $satu_jadwal['nama_departemen']; ?>" class="form-control <?= validation_show_error('nama_departemen') ? 'is-invalid' : null; ?>" id="nama_departemen" placeholder="Nama Departemen">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-lg-3 col-md-3 col-sm-3" for="apakah_buka">Apakah Pengajuan Judul dibuka</label>
                                <div class="col-lg-4 col-md-4 col-sm-9 ">
                                    <select required class="form-control <?= validation_show_error('apakah_buka') ? 'is-invalid' : null; ?>" name="apakah_buka" id="apakah_buka">
                                        <option value="">-- Pilih --</option>
                                        <option value="1" <?= $satu_jadwal['apakah_buka'] == 1 ? 'selected' : null; ?>>Ya pengajuan judul dibuka</option>
                                        <option value="0" <?= $satu_jadwal['apakah_buka'] == 0 ? 'selected' : null; ?>>Pengajuan judul ditutup</option>
                                    </select>
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('apakah_buka'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="mulai_pengajuan_judul">Tanggal Mulai dibuka<b>(*)</b> :</label>
                                <div class="input-group date col-md-9 col-sm-9">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                    <input required <?= validation_show_error('mulai_pengajuan_judul') ? "style='border : 1px solid red'" : null?> placeholder="mulai pengajuan judul" type="text" value="<?= old('mulai_pengajuan_judul') ? old('mulai_pengajuan_judul') : $satu_jadwal['mulai_pengajuan_judul']; ?>" class="form-control datepicker" name="mulai_pengajuan_judul">
                                    <div class="invalid-feedback" style="text-align: left; display: block;">
                                        <?= validation_show_error('mulai_pengajuan_judul'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="akhir_pengajuan_judul">Tanggal Ditutup pengajuan <b>(*)</b> :</label>
                                <div class="input-group date col-md-9 col-sm-9">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                    <input required <?= validation_show_error('akhir_pengajuan_judul') ? "style='border : 1px solid red'" : null?> placeholder="sampai tanggal berapa" type="text" value="<?= old('akhir_pengajuan_judul') ? old('akhir_pengajuan_judul') : $satu_jadwal['akhir_pengajuan_judul']; ?>" class="form-control datepicker" name="akhir_pengajuan_judul">
                                    <div class="invalid-feedback" style="text-align: left; display: block;">
                                        <?= validation_show_error('akhir_pengajuan_judul'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9  offset-md-3">
                                    <a href="<?= base_url('/jadwal-pengajuan-judul'); ?>" class="btn btn-warning btn-sm"><i class="fa fa-chevron-circle-left" style="margin-right: 5px;"></i>Kembali</a>
                                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save" style="margin-right: 5px;"></i>Simpan</button>
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
<script>
    $(document).ready(function(){
        var number = 1;
        $(".btn-tambah").on("click", function(){
            number ++;
            $(".tambah-input").append(`<div class='row' style='margin-bottom: 15px; border: 1px solid grey; padding: 5px;'><div class='col-lg-4 col-md-4 col-sm-4 row'>
            <label class='control-label col-md-1 col-lg-1 col-sm-1'><b>${number}</b></label><input required type='text' class='form-control col-md-11 col-lg-11 col-sm-11' name='data[${number}][nim_anggota]' placeholder='Tuliskan NIM'></div><div class='col-lg-5 col-md-5 col-sm-5'><input type='text' required class='form-control' name='data[${number}][nama_anggota]' placeholder='Tuliskan Nama'></div><div class='col-lg-3 col-md-3 col-sm-3'><select required class='form-control' name='data[${number}][jenis_kelamin]'><option value=''>-- Jenis Kelamin --</option><option value='L'>Laki - Laki</option><option value='P'>Perempuan</option></select></div></div>`);   
        })
    })
</script>
<?= $this->endSection(); ?>
