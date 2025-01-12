<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Izin Observasi Matakuliah</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Form Pengajuan</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <!-- < ?= validation_list_errors(); ?> -->
                        <form class="form-horizontal form-label-left" method="POST" action="<?= base_url('izin-observasi-matakuliah/simpan'); ?>" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="nim_pengajuan">NIM</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input readonly type="text" name="nim_pengajuan" value="<?= $user['prf_nim_portal']; ?>" class="form-control <?= validation_show_error('nim_pengajuan') ? 'is-invalid' : null; ?>" id="nim_pengajuan" placeholder="Tuliskan NIM">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('nim_pengajuan'); ?>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="nama_pengajuan">Nama Mahasiswa</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input readonly type="text" value="<?= $user['prf_nama_portal']; ?>" class="form-control <?= validation_show_error('nama_pengajuan') ? 'is-invalid' : null; ?>" id="nama_pengajuan" name="nama_pengajuan" placeholder="Tuliskan Nama">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('nama_pengajuan'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="nama_pengajuan">Departemen</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input readonly type="text" value="<?= $user['nama_departemen_input']; ?>" class="form-control">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('nama_pengajuan'); ?>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="departemen_pengajuan" value="<?= $user['departemen_input']; ?>">
                            <div class="form-group row">
                                <label class="control-label col-lg-3 col-md-3 col-sm-3" for="jenis_kelamin">Jenis Kelamin</label>
                                <div class="col-lg-4 col-md-4 col-sm-9 ">
                                    <select required class="form-control <?= validation_show_error('jenis_kelamin') ? 'is-invalid' : null; ?>" name="jenis_kelamin" id="jenis_kelamin">
                                        <option value="">-- Jenis Kelamin --</option>
                                            <option value="L">Laki - laki</option>
                                            <option value="P">Perempuan</option>
                                    </select>
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('jenis_kelamin'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="tujuan_surat">Tujuan Surat <b>(Kepada Yth : ?)</b></label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input required type="text" value="" class="form-control <?= validation_show_error('tujuan_surat') ? 'is-invalid' : null; ?>" id="tujuan_surat" name="tujuan_surat" placeholder="Contoh: Kepala Sekolah SMA N 5 Solok Selatan/ TK Pembangunan UNP">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('tujuan_surat'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="alamat_tempat_observasi">Kabupaten / Kota <b>(?)</b></label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input required type="text" value="" class="form-control <?= validation_show_error('alamat_tempat_observasi') ? 'is-invalid' : null; ?>" id="alamat_tempat_observasi" name="alamat_tempat_observasi" placeholder="Contoh: Solok Selatan/ Padang/ Solok/ Padang Panjang">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('alamat_tempat_observasi'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="tempat_observasi">Nama Instansi / Sekolah <b>(?)</b></label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input required type="text" value="" class="form-control <?= validation_show_error('tempat_observasi') ? 'is-invalid' : null; ?>" id="tempat_observasi" name="tempat_observasi" placeholder="Contoh: SMA N 5 Solok Selatan/ TK Pembangunan UNP">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('tempat_observasi'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="tujuan_observasi">Tujuan Observasi</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input required type="text" value="" class="form-control <?= validation_show_error('tujuan_observasi') ? 'is-invalid' : null; ?>" id="tujuan_observasi" name="tujuan_observasi" placeholder="Contoh: Mengambil Data">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('tujuan_observasi'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="matakuliah">Matakuliahs</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input required type="text" value="" class="form-control <?= validation_show_error('matakuliah') ? 'is-invalid' : null; ?>" id="matakuliah" name="matakuliah" placeholder="Contoh: Pendekatan Persuasif">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('matakuliah'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="dosenPembimbing">Dosen Pembimbing</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input required type="text" value="" class="form-control <?= validation_show_error('dosenPembimbing') ? 'is-invalid' : null; ?>" id="dosenPembimbing" name="dosenPembimbing" placeholder="Contoh: Pendekatan Persuasif">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('dosenPembimbing'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3" for="tanggal_mulai">Jadwal <b>(Tanggal Mulai)</b> :</label>
                                <div class="input-group date col-md-9 col-sm-9">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                    <input required <?= validation_show_error('tanggal_mulai') ? "style='border : 1px solid red'" : null?> placeholder="tanggal mulai observasi" type="text" value="<?= old('tanggal_mulai'); ?>" class="form-control datepicker" name="tanggal_mulai">
                                    <div class="invalid-feedback" style="text-align: left; display: block;">
                                        <?= validation_show_error('tanggal_mulai'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3" for="tanggal_selesai">Jadwal <b>(Tanggal Selesai)</b> :</label>
                                <div class="input-group date col-md-9 col-sm-9">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                    <input required <?= validation_show_error('tanggal_selesai') ? "style='border : 1px solid red'" : null?> placeholder="sampai tanggal berapa" type="text" value="<?= old('tanggal_selesai'); ?>" class="form-control datepicker" name="tanggal_selesai">
                                    <div class="invalid-feedback" style="text-align: left; display: block;">
                                        <?= validation_show_error('tanggal_selesai'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-12 col-lg-12 col-sm-12" for="nama_anggota"><b>Inputkan Data Teman(jika berkelompok) ?</b></label>
                                <div class="tambah-input" style="margin-bottom: 10px;">
                                    <div class="row" style="margin-bottom: 15px; border: 1px solid grey; padding: 5px;">
                                        <div class="col-lg-4 col-md-4 col-sm-4 row">
                                            <label class="control-label col-md-1 col-lg-1 col-sm-1"><b>1</b> :</label>
                                            <input type="text" class="form-control col-md-11 col-lg-11 col-sm-11" name="data[1][nim_anggota]" placeholder="Tuliskan NIM">
                                        </div>
                                        <div class="col-lg-5 col-md-5 col-sm-5">
                                            <input type="text" class="form-control" name="data[1][nama_anggota]" placeholder="Tuliskan Nama">
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <select class="form-control" name="data[1][jenis_kelamin]">
                                            <option value="">-- Jenis Kelamin --</option>
                                            <option value="L">Laki - Laki</option>
                                            <option value="P">Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <span class="btn btn-primary btn-tambah" style="cursor: pointer;">
                                    <i class="fa fa-plus-square" style="margin-right: 10px;"></i>Klik disini jika ingin menambahkan teman anda !
                                </span>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9  offset-md-3">
                                    <a href="<?= base_url('/izin-observasi-matakuliah'); ?>" class="btn btn-warning btn-sm"><i class="fa fa-chevron-circle-left" style="margin-right: 5px;"></i>Kembali</a>
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
                    <div class="x_content" style="height: 95vh;">
                        <iframe src="/upload/contoh_surat/izin_observasi_matakuliah_pdf.pdf" frameborder="0" style="width: 100%; height: 100%; display: block;"></iframe>
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
