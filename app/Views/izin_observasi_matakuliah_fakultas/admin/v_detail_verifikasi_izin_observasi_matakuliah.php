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
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Detail Verifikasi</h2>
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
                                <td class="font-weight-bold">Alamat Tujuan Surat <b>(Di ?)</b></td>
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
                            <?php if($satu_observasi['no_surat']) { ?>
                            <tr>
                                <td class="font-weight-bold">Nomor Surat</td>
                                <td><?= $satu_observasi['no_surat'] ; ?></td>
                            </tr>
                            <?php } ?>
                        </table>
                        <br>
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
                                    </tr>
                                    <?php $no++ ?>
                                <?php } ?>
                                
                            </tbody>
                        </table>
                        <?php } ?>
                        <br />
                        <div style="display: flex;">
                        <?php if (session()->get('username')) { ?>
                            <a href="<?= base_url("izin-observasi-matakuliah-fakultas/semua"); ?>" class="btn btn-warning btn-sm"><i class="fa fa-arrow-circle-left" style="margin-right: 5px;"></i>Kembali</a>
                        <?php } ?>
                        <?php if(session()->get('level') == '2' && $satu_observasi['status'] == '1') { ?>
                             <!-- terima pengajuan jika status pengajuan belum di proses dan verifikator adalah admin departemen-->
                             <div class="button_container">
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".terima_pengajuan_admin"><i class="fa fa-check-square" style="margin-right: 5px;"></i>Setujui Admin</button>
                            </div>
                            <!-- akhir terima pengajuan -->
                            <!-- Tolak pengajuan jika status pengajuan belum di proses dan verifikator adalah admin departemen-->
                            <div class="button_container">
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target=".tolak_pengajuan_admin"><i class="fa fa-times-circle" style="margin-right: 5px;"></i>Tolak Pengajuan</button>
                            </div>
                            <!-- akhir tolak pengajuan -->
                        <?php } ?>

                        <!-- jika admin verifikator adalah kadep -->
                        <?php if(session()->get('level') == '4' && $satu_observasi['status'] == '3') { ?>
                                <!-- terima pengajuan jika status pengajuan belum di proses dan verifikator adalah kepala departemen-->
                                <form action="<?= base_url('izin-observasi-matakuliah-fakultas/setujui-kadep/'.$satu_observasi['uuid']); ?>" method="post" id="setujui_kadep">
                                    <?= csrf_field(); ?>
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-check-square" style="margin-right: 5px;"></i>Setujui kadep</button>
                                </form>
                                <!-- akhir terima pengajuan -->
                                <!-- Tolak pengajuan jika status pengajuan belum di proses kadep verifikator adalah kadep-->
                                <div class="button_container">
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target=".tolak_pengajuan_kadep"><i class="fa fa-times-circle" style="margin-right: 5px;"></i>Tolak Pengajuan Oleh Kadep</button>
                                </div>
                                <!-- akhir tolak pengajuan -->
                                <?php } ?>
                                <!-- akhir dari verifikator kadep -->
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- form terima pengajuan oleh admin dan input no surat -->
<div class="modal fade terima_pengajuan_admin" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm" style="max-width: 500px;">
        <form action="<?= base_url('izin-observasi-matakuliah-fakultas/setujui-admin/'.$satu_observasi['uuid']); ?>" method="post" id="setujui_admin">
            <?= csrf_field(); ?>
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-group row ">
                        <label class="control-label col-lg-12 col-md-12 col-sm-12" for="no_surat">Inputkan Nomor Surat</label>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <input type="text" name="no_surat" class="form-control <?= validation_show_error('no_surat') ? 'is-invalid' : null; ?>" id="no_surat" placeholder="contoh: 223">
                            <div class="invalid-feedback" style="text-align: left; display: block;">
                            <?= validation_show_error('no_surat'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="border: none; justify-content: center;">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fa fa-chevron-circle-left" style="margin-right: 5px;"></i> Batal</button>
                    <button type="submit" name="action" class="btn btn-primary" value="tolak_admin"><i class="fa fa-check-square" style="margin-right: 5px;"></i>Terima Pengajuan</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!--  -->

<!-- form tolak pengajuan kadep dan inputkan pesan -->
<div class="modal fade tolak_pengajuan_kadep" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm" style="max-width: 500px;">
        <form action="<?= base_url('izin-observasi-matakuliah-fakultas/tolak-kadep/'.$satu_observasi['uuid']); ?>" method="post" id="tolak_kadep">
            <?= csrf_field(); ?>
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-md-12 col-sm-12">
                            <textarea class="form-control <?= validation_show_error('pesan') ? 'is-invalid' : null; ?>" rows="3" name="pesan" id="pesan" placeholder="Tuliskan alasan penolakan"></textarea>
                            <div class="invalid-feedback" style="text-align: left;">
                                <?= validation_show_error('pesan'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="border: none; justify-content: center;">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fa fa-chevron-circle-left" style="margin-right: 5px;"></i> Batal</button>
                    <button type="submit" name="action" class="btn btn-danger" value="tolak_kadep"><i class="fa fa-times-circle" style="margin-right: 5px;"></i>Tolak Pengajuan</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!--  -->

<!-- form tolak pengajuan admin dan inputkan pesan-->
<div class="modal fade tolak_pengajuan_admin" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm" style="max-width: 500px;">
        <form action="<?= base_url('izin-observasi-matakuliah-fakultas/tolak-admin/'.$satu_observasi['uuid']); ?>" method="post" id="tolak_admin">
            <?= csrf_field(); ?>
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-md-12 col-sm-12">
                            <textarea class="form-control <?= validation_show_error('pesan') ? 'is-invalid' : null; ?>" rows="3" name="pesan" id="pesan" placeholder="Tuliskan alasan penolakan"></textarea>
                            <div class="invalid-feedback" style="text-align: left;">
                                <?= validation_show_error('pesan'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="border: none; justify-content: center;">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fa fa-chevron-circle-left" style="margin-right: 5px;"></i> Batal</button>
                    <button type="submit" name="action" class="btn btn-danger" value="tolak_admin"><i class="fa fa-times-circle" style="margin-right: 5px;"></i>Tolak Pengajuan</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!--  -->
<?= $this->endSection(); ?>
