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
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Detail Pengajuan</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <table class="table table-striped table-bordered mb-0">
                            <tr>
                                <td class="font-weight-bold">Nomor Induk Mahasiswa (NIM)</td>
                                <td><?= $satu_observasi['nim_pengajuan']; ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Nama Mahasiswa</td>
                                <td><?= $satu_observasi['nama_pengajuan']; ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Jenis Kelamin</td>
                                <td><?= $satu_observasi['jk_pengajuan'] == 'L' ? 'Laki-laki' : ($satu_observasi['jk_pengajuan'] == 'P' ? 'Perempuan' : null); ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Departemen</td>
                                <td><?= $satu_observasi['nama_departemen']; ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Tujuan Surat <b>(Kepada Yth : ?)</b></td>
                                <td><?= $satu_observasi['tujuan_surat']; ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Kabupaten / Kota <b>(?)</b></td>
                                <td><?= $satu_observasi['alamat_tempat_observasi']; ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Tempat Observasi</td>
                                <td><?= $satu_observasi['tempat_observasi']; ?></td>
                            </tr>
                            
                            <tr>
                                <td class="font-weight-bold">Tujuan Observasi</td>
                                <td><?= $satu_observasi['tujuan_observasi']; ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Matakuliah</td>
                                <td><?= $satu_observasi['matakuliah']; ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Jadwal</td>
                                <td><?= tanggal_indo($satu_observasi['tanggal_mulai']); ?> s.d <?= tanggal_indo($satu_observasi['tanggal_selesai']); ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Status</td>
                                <td><?= $satu_observasi["status"] == "1" ? "<span class='badge badge-warning'>Belum diproses Admin</span>" : ($satu_observasi["status"] == "2" ? "<span class='badge badge-danger'>Ditolak Admin</span>" : ($satu_observasi["status"] == "3" ? "<span class='badge badge-success'>Disetujui Admin, Menunggu diproses Kadep</span>" : ($satu_observasi["status"] == "4" ? "<span class='badge badge-danger'>Ditolak Kadep</span>" : ($satu_observasi["status"] == "5" ? "<span class='badge badge-success'>Disetujui Kadep</span>" : null)))) ; ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Tanggal Pengajuan</td>
                                <td><?= tanggal_indo($satu_observasi['created_at']); ?></td>
                            </tr>   
                            <?php if($satu_observasi['pesan']) { ?>
                            <tr>
                                <td class="font-weight-bold">Pesan</td>
                                <td><?= $satu_observasi['pesan'] ; ?></td>
                            </tr>    
                            <?php } ?>
                            <tr>
                                <td class="font-weight-bold">Aksi</td>
                                <td><a href="<?= base_url("izin-observasi-matakuliah/edit-pengajuan/".$satu_observasi['uuid']); ?>" class="btn btn-warning btn-sm"><i class="fa fa-pencil-square-o" style="margin-right: 5px;"></i>Edit Pengajuan</a>
                            </td>
                            </tr>
                        </table>
                        <br>
                        <button type="button" class="btn btn-success btn-md"
                            data-toggle="modal" 
                            data-target=".bs-example-modal-tambah"><i class="fa fa-plus-square" style="margin-right: 5px;"></i>Tambah Anggota
                        </button>
                        <?php if($anggota) { ?>
                        <br>
                        <table class="table table-striped table-bordered mb-0" style="width: 70%;">
                            <thead>
                                <tr>
                                    <td class="font-weight-bold text-center"  colspan="5">Daftar Nama Teman Kelompok</td>
                                </tr>
                                <tr>
                                    <th class="font-weight-bold" style="width: 5%;">No</th>
                                    <th class="font-weight-bold" style="width: 10%;">NIM</th>
                                    <th class="font-weight-bold">Nama</th>
                                    <th class="font-weight-bold">Jenis Kelamin</th>
                                    <th class="font-weight-bold">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($anggota as $a) { ?>
                                    <tr>
                                        <td><?= $no; ?></td>
                                        <td><?= $a['nim_anggota']; ?></td>
                                        <td><?= $a['nama_anggota']; ?></td>
                                        <td><?= $a['jenis_kelamin'] == 'L' ? 'Laki - laki' : 'Perempuan'; ?></td>
                                        <td>
                                            <!-- form -->
                                            <button type="button" class="btn btn-warning btn-md"
                                                data-toggle="modal" 
                                                data-target=".bs-example-modal-lg_<?= $a['anggota_observasi_matakuliah_id']; ?>"><i class="fa fa-pencil-square-o" style="margin-right: 5px;"></i>Edit
                                            </button>
                                            <form class="d-inline" method="post" action="<?= base_url('/izin-observasi-matakuliah/hapus-anggota/'.$a['anggota_observasi_matakuliah_id']); ?>">
                                                <?= csrf_field(); ?>
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="id_observasi" value="<?= $a['id_izin_observasi']; ?>">
                                                <input type="hidden" name="UUIDObservasi" value="<?= $satu_observasi['uuid']; ?>">
                                                <button type="submin" class="btn btn-danger btn-md" onclick="return confirm('apakah yakin dihapus?')"><i class="fa fa-trash-o" style="margin-right: 5px;"></i>Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php $no++ ?>
                                <?php } ?>
                                
                            </tbody>
                        </table>
                        <?php } ?>
                        <br />
                        <?php if (session()->get('username')) { ?>
                            <a href="<?= base_url("izin-observasi-matakuliah"); ?>" class="btn btn-primary btn-sm"><i class="fa fa-arrow-circle-left" style="margin-right: 5px;"></i>Kembali</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $nomor = 1; ?>
<?php foreach ($anggota as $a) { ?>
<?php  ?>
<!-- modal edit anggota-->
<div class="modal fade bs-example-modal-lg_<?= $a['anggota_observasi_matakuliah_id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Edit Anggota</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
            </div>
            <form action="<?= base_url("izin-observasi-matakuliah/simpan-pembaruan-anggota"); ?>" method="POST">
            <?= csrf_field(); ?>
            <div class="modal-body">
            <input type="hidden" name="id_anggota"  value="<?= $a['anggota_observasi_matakuliah_id']; ?>">
            <input type="hidden" name="id_observasi" value="<?= $a['id_izin_observasi']; ?>">
            <input type="hidden" name="UUIDObservasi" value="<?= $satu_observasi['uuid']; ?>">
                <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-3" for="nim_anggota">NIM</label>
                    <div class="col-md-9 col-sm-9 ">
                        <input required type="text" value="<?= $a['nim_anggota']; ?>" class="form-control" id="nim_anggota" name="nim_anggota">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-3" for="nama_anggota">Nama Anggota</label>
                    <div class="col-md-9 col-sm-9 ">
                        <input required type="text" value="<?= $a['nama_anggota']; ?>" class="form-control <?= validation_show_error('nama_anggota') ? 'is-invalid' : null; ?>" id="nama_anggota" name="nama_anggota">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-3" for="jenis_kelamin">Jenis Kelamin</label>
                    <div class="col-md-9 col-sm-9">
                        <select required class="form-control" name="jenis_kelamin">
                            <option value="">-- Jenis Kelamin --</option>
                            <option value="L" <?= $a['jenis_kelamin'] == 'L' ? 'selected' : null; ?>>Laki - Laki</option>
                            <option value="P" <?= $a['jenis_kelamin'] == 'P' ? 'selected' : null; ?>>Perempuan</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="Simpan" class="btn btn-primary">Simpan Perubahan</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- akhir modal -->

<!-- modal tambah anggota-->
<div class="modal fade bs-example-modal-tambah" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Tambah Anggota</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
            </div>
            <form action="<?= base_url("izin-observasi-matakuliah/tambah-anggota"); ?>" method="POST">
            <?= csrf_field(); ?>
            <div class="modal-body">
                <input type="hidden" name="id_observasi" value="<?= $a['id_izin_observasi']; ?>">
                <input type="hidden" name="UUIDObservasi" value="<?= $satu_observasi['uuid']; ?>">
                <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-3" for="nim_anggota">NIM</label>
                    <div class="col-md-9 col-sm-9 ">
                        <input required type="text" value="<?= old('nim_anggota'); ?>" class="form-control <?= validation_show_error('nim_anggota') ? 'is-invalid' : null; ?>" id="nim_anggota" name="nim_anggota">
                        <div class="invalid-feedback" style="display: block;">
                            <?= validation_show_error('nim_anggota'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-3" for="nama_anggota">Nama Anggota</label>
                    <div class="col-md-9 col-sm-9 ">
                        <input required type="text" value="<?= old('nama_anggota'); ?>" class="form-control <?= validation_show_error('nama_anggota') ? 'is-invalid' : null; ?>" id="nama_anggota" name="nama_anggota">
                        <div class="invalid-feedback" style="display: block;">
                            <?= validation_show_error('nama_anggota'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-3" for="jenis_kelamin">Jenis Kelamin</label>
                    <div class="col-md-9 col-sm-9">
                        <?php $style_border = "style='border: 1px solid red;'" ?>
                        <select required class="form-control" <?= validation_show_error('jenis_kelamin') ? $style_border : null ; ?>  name="jenis_kelamin">
                            <option value="">-- Jenis Kelamin --</option>
                            <option value="L" <?= old('jenis_kelamin') == 'L' ? 'selected' : null; ?>>Laki - Laki</option>
                            <option value="P" <?= old('jenis_kelamin') == 'P' ? 'selected' : null; ?>>Perempuan</option>
                        </select>
                        <div class="invalid-feedback" style="display: block;">
                            <?= validation_show_error('jenis_kelamin'); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="Simpan" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- akhir modal -->
<?php } ?>

<?= $this->endSection(); ?>
