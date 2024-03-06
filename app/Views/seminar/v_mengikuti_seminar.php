<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Seminar Proposal</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Pengajuan Mengikuti Seminar Proposal Mahasiswa Lain</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <?= validation_list_errors(); ?>
                        <form class="form-horizontal form-label-left" method="POST" action="<?= base_url('seminar/simpan-mengikuti-seminar'); ?>" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="nim_pengikut">NIM</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input readonly type="text" value="<?= session()->get('username') ?>" name="nim_pengikut" class="form-control" id="nim_pengikut" placeholder="Tuliskan NIM mahasiswa yang diikuti seminarnya">
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="nim_diikuti">NIM Mahasiswa yang diikuti</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" value="<?= old('nim_diikuti'); ?>" name="nim_diikuti" class="form-control" id="nim_diikuti" placeholder="Tuliskan NIM mahasiswa yang diikuti seminarnya">
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="nama_diikuti">Nama Mahasiswa yang diikuti</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" value="<?= old('nama_diikuti'); ?>" class="form-control" id="nama_diikuti" name="nama_diikuti" placeholder="Tuliskan Nama mahasiswa yang diikuti seminarnya">
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="dosen_pembimbing_diikuti">Nama Pembimbing yang diikuti</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" value="<?= old('dosen_pembimbing_diikuti'); ?>" name="dosen_pembimbing_diikuti" class="form-control" id="dosen_pembimbing_diikuti" placeholder="Tuliskan nama pembimbing dari mahasiswa yang diikuti seminarnya">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="judul_skripsi_diikuti">Judul Skripsi yang diikuti</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <textarea class="form-control" rows="3" name="judul_skripsi_diikuti" id="judul_skripsi_diikuti" placeholder="Tuliskan judul skripsi dari mahasiswa yang diikuti seminarnya"><?= old('judul_skripsi_diikuti'); ?></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-lg-3 col-md-3 col-sm-3" for="hari_mengikuti">Hari</label>
                                <div class="col-lg-4 col-md-4 col-sm-9 ">
                                    <select class="form-control <?= validation_show_error('hari_mengikuti') ? 'is-invalid' : null; ?>" name="hari_mengikuti" id="hari_mengikuti">
                                        <option value="">-- Pilih Hari Mengikuti Seminar--</option>
                                        <?php foreach ($hari as $hr) { ?>
                                            <option value="<?= $hr['hari_id']; ?>"><?= $hr['hari_nama']; ?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('hari_mengikuti'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="tanggal_mengikuti">Tanggal Mengikuti <b>(*)</b> :</label>
                                <div class="input-group date col-md-9 col-sm-9">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                    <input required <?= validation_show_error('tanggal_mengikuti') ? "style='border : 1px solid red'" : null?> placeholder="Pilih tanggal mengikuti seminar" type="text" value="<?= old('tanggal_mengikuti'); ?>" class="form-control datepicker" name="tanggal_mengikuti">
                                    <div class="invalid-feedback" style="text-align: left; display: block;">
                                        <?= validation_show_error('tanggal_mengikuti'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-lg-3 col-md-3 col-sm-3" for="ruangan">Ruangan</label>
                                <div class="col-lg-4 col-md-4 col-sm-9">
                                    <select class="form-control <?= validation_show_error('ruangan') ? 'is-invalid' : null; ?>" name="ruangan" id="ruangan">
                                        <option value="">-- Pilih Ruangan --</option>
                                        <?php foreach($ruangan as $r): ?>
                                            <option value="<?=$r['seminar_r_id'];?>"><?= $r['ruangan_alias']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('ruangan'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-lg-3 col-md-3 col-sm-3" for="foto_selfi" class="file-label">Foto Selfi Saat Mengikuti Seminar</label>
                                <div class="col-lg-4 col-md-4 col-sm-9">
                                    <input accept="image/*" class="form-control <?= validation_show_error('foto_selfi') ? 'is-invalid' : null; ?>" type="file" id="foto_selfi" name="foto_selfi">
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('foto_selfi'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-lg-3 col-md-3 col-sm-3" for="foto_selfi">Preview Bukti</label>
                                <div class="col-lg-4 col-md-4 col-sm-9">
                                    <img id="gambar_load" src="<?= base_url('/image_manager/pattern.jpg'); ?>" alt="" style="width: 400px;" class="img-thumbnail img-preview">
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9 offset-md-3">
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
    function bacaGambar(input) {
        if(input.files && input.files[0])
        {
            var reader = new FileReader();
            reader.onload = function(e)
            {
                $('#gambar_load').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $('#foto_selfi').change(function() {
        bacaGambar(this);
    })
</script>
<?= $this->endSection(); ?>
