<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Izin Observasi Matakuliah Fakultas</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Edit Pengajuan</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <!-- < ?= validation_list_errors(); ?> -->
                        <form class="form-horizontal form-label-left" method="POST" action="<?= base_url('izin-observasi-matakuliah-fakultas/simpan-pembaruan-pengajuan'); ?>" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                            <div class="form-group row ">
                                <input hidden type="text" name="uuid" value="<?= $satu_observasi['uuid']; ?>">
                                <label class="control-label col-md-3 col-sm-3" for="nim_pengajuan">NIM</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input readonly type="text" name="nim_pengajuan" value="<?= $satu_observasi['nim_pengajuan']; ?>" class="form-control <?= validation_show_error('nim_pengajuan') ? 'is-invalid' : null; ?>" id="nim_pengajuan" placeholder="Tuliskan NIM">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('nim_pengajuan'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="nama_pengajuan">Nama Mahasiswa</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input readonly type="text" value="<?= $satu_observasi['nama_pengajuan']; ?>" class="form-control <?= validation_show_error('nama_pengajuan') ? 'is-invalid' : null; ?>" id="nama_pengajuan" name="nama_pengajuan" placeholder="Tuliskan Nama">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('nama_pengajuan'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3">Departemen</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input readonly type="text" value="<?= $satu_observasi['nama_departemen']; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-lg-3 col-md-3 col-sm-3" for="jk_pengajuan">Jenis Kelamin</label>
                                <div class="col-lg-5 col-md-5 col-sm-9 ">
                                    <select required class="form-control <?= validation_show_error('jk_pengajuan') ? 'is-invalid' : null; ?>" name="jk_pengajuan" id="jk_pengajuan">
                                        <option value="">-- Jenis Kelamin --</option>
                                            <option value="L" <?= $satu_observasi['jk_pengajuan'] == 'L' ? 'selected' : null; ?>>Laki - laki</option>
                                            <option value="P" <?= $satu_observasi['jk_pengajuan'] == 'P' ? 'selected' : null; ?>>Perempuan</option>
                                    </select>
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('jk_pengajuan'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="tujuan_surat">Tujuan Surat <b>(Kepada Yth : ?)</b></label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input required type="text" value="<?= $satu_observasi['tujuan_surat']; ?>" class="form-control <?= validation_show_error('tujuan_surat') ? 'is-invalid' : null; ?>" id="tujuan_surat" name="tujuan_surat" placeholder="Contoh: Kepala Sekolah SMA N 5 Solok Selatan/ TK Pembangunan UNP">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('tujuan_surat'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="alamat_tempat_observasi">Kabupaten / Kota <b>(?)</b></label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input required type="text" value="<?= $satu_observasi['alamat_tempat_observasi']; ?>" class="form-control <?= validation_show_error('alamat_tempat_observasi') ? 'is-invalid' : null; ?>" id="alamat_tempat_observasi" name="alamat_tempat_observasi" placeholder="Contoh: Solok Selatan/ Padang/ Solok/ Padang Panjang">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('alamat_tempat_observasi'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="tempat_observasi">Nama Instansi / Sekolah <b>(?)</b></label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input required type="text" value="<?= $satu_observasi['tempat_observasi']; ?>" class="form-control <?= validation_show_error('tempat_observasi') ? 'is-invalid' : null; ?>" id="tempat_observasi" name="tempat_observasi" placeholder="Contoh: SMA N 5 Solok Selatan/ TK Pembangunan UNP">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('tempat_observasi'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="tujuan_observasi">Tujuan Observasi</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input required type="text" value="<?= $satu_observasi['tujuan_observasi']; ?>" class="form-control <?= validation_show_error('tujuan_observasi') ? 'is-invalid' : null; ?>" id="tujuan_observasi" name="tujuan_observasi" placeholder="Contoh: Mengambil Data">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('tujuan_observasi'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="matakuliah">Matakuliah</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input required type="text" value="<?= $satu_observasi['matakuliah']; ?>" class="form-control <?= validation_show_error('matakuliah') ? 'is-invalid' : null; ?>" id="matakuliah" name="matakuliah" placeholder="Contoh: Pendekatan Persuasif">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('matakuliah'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="dosen_pembimbing_lama">Dosen Pembimbing</label>
                                <div class="col-md-6 col-sm-6">
                                    <input required type="text" value="<?= $satu_observasi['d_pembimbing_peg_gel_dep']; ?> <?= $satu_observasi['d_pembimbing_peg_nama']; ?> <?= $satu_observasi['d_pembimbing_peg_gel_bel']; ?>" class="form-control <?= validation_show_error('dosen_pembimbing_lama') ? 'is-invalid' : null; ?>" id="dosen_pembimbing_lama" name="dosen_pembimbing_lama" placeholder="Contoh: Pendekatan Persuasif">
                                    <div class="invalid-feedback" style="display: block;">
                                        <?= validation_show_error('dosen_pembimbing_lama'); ?>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3">
                                    <div class="button_container">
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".ganti_dosen_pembimbing"><i class="fa fa-check-square" style="margin-right: 5px;"></i>Ganti Dosen Pembimbing</button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="tanggal_mulai">Jadwal <b>(Tanggal Mulai)</b> :</label>
                                <div class="input-group date col-md-9 col-sm-9">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                    <input required <?= validation_show_error('tanggal_mulai') ? "style='border : 1px solid red'" : null?> placeholder="tanggal mulai observasi" type="text" value="<?= old('tanggal_mulai') ? old('tanggal_mulai') : $satu_observasi['tanggal_mulai']; ?>" class="form-control datepicker" name="tanggal_mulai">
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
                                    <input required <?= validation_show_error('tanggal_selesai') ? "style='border : 1px solid red'" : null?> placeholder="sampai tanggal berapa" type="text" value="<?= old('tanggal_selesai') ? old('tanggal_selesai') : $satu_observasi['tanggal_selesai']; ?>" class="form-control datepicker" name="tanggal_selesai">
                                    <div class="invalid-feedback" style="text-align: left; display: block;">
                                        <?= validation_show_error('tanggal_selesai'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9  offset-md-3">
                                    <a href="<?= base_url('/izin-observasi-matakuliah-fakultas/edit/'.$satu_observasi['uuid']); ?>" class="btn btn-warning btn-sm"><i class="fa fa-chevron-circle-left" style="margin-right: 5px;"></i>Kembali</a>
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

<!-- form ganti dosen pembimbing -->
<div class="modal fade ganti_dosen_pembimbing" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="<?= base_url('izin-observasi-matakuliah-fakultas/edit-pengajuan/ganti-dosen-pembimbing'); ?>" method="post" id="setujui_admin">
        <input type="hidden" type="text" name="uuid" value="<?= $satu_observasi['uuid']; ?>">
            <?= csrf_field(); ?>
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3 ">Nama Pembimbing</label>
                        <div class="col-md-9 col-sm-9 has-error">
                            <select class="form-control" id="dosen_pembimbing" tabindex="-1" name="dosen_pembimbing">
                                <option value="">-- Pilih dosen pembimbing --</option>
                                <?php foreach($dosen as $d): ?>
                                <option value="<?= $d->nidn; ?>"><?= $d->peg_gel_dep; ?> <?= $d->peg_nama; ?>, <?= $d->peg_gel_bel; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <h1 style="width: 100%; margin-top: 0.25rem; font-size: 80%; color: #dc3545;">
                            <?= validation_show_error('dosen_pembimbing'); ?>
                            </h1>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="border: none; justify-content: center;">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fa fa-chevron-circle-left" style="margin-right: 5px;"></i> Batal</button>
                    <button type="submit" name="action" class="btn btn-primary" value="tolak_admin"><i class="fa fa-check-square" style="margin-right: 5px;"></i>Simpan Perubahan</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- !form ganti dosen pembimbing -->
 
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