<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Validasi Instrumen</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Form Edit</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <!-- < ?= validation_list_errors(); ?> -->
                        <form class="form-horizontal form-label-left" method="POST" action="<?= base_url('validasi-instrumen/simpan-pembaruan'); ?>" enctype="multipart/form-data">
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
                            <div class="form-group row">
                                <label class="control-label col-lg-3 col-md-3 col-sm-3" for="departemen_pengajuan">Departemen</label>
                                <div class="col-lg-4 col-md-4 col-sm-9 ">
                                    <select required class="form-control <?= validation_show_error('departemen_pengajuan') ? 'is-invalid' : null; ?>" name="departemen_pengajuan" id="departemen_pengajuan">
                                        <option value="">-- Pilih Departemen --</option>
                                        <?php foreach ($semua_departemen as $d) { ?>
                                            <option value="<?= $d['departemen_id']; ?>" <?= $satu_penelitian['departemen_pengajuan'] == $d['departemen_id'] ? 'selected' : null; ?>><?= $d['departemen_nama']; ?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('departemen_pengajuan'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="judul">Judul</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input required type="text" value="<?= $satu_penelitian['judul']; ?>" class="form-control <?= validation_show_error('judul') ? 'is-invalid' : null; ?>" id="judul" name="judul" placeholder="Tulis judul">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('judul'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="tujuan_surat">Tujuan Surat</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input required type="text" value="<?= $satu_penelitian['tujuan_surat']; ?>" class="form-control <?= validation_show_error('tujuan_surat') ? 'is-invalid' : null; ?>" id="tujuan_surat" name="tujuan_surat" placeholder="Kepada Yth ?">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('tujuan_surat'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9  offset-md-3">
                                    <a href="<?= base_url('/validasi-instrumen'); ?>" class="btn btn-warning btn-sm"><i class="fa fa-chevron-circle-left" style="margin-right: 5px;"></i>Kembali</a>
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
