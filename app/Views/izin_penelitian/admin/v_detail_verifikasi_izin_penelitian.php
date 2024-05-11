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
        <?php if(session()->getFlashdata('sukses')) : ?>
            <div class="alert alert-success alert-dismissible " role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <strong>Sukses!</strong> <?= session()->getFlashdata('sukses'); ?>.
            </div>
        <?php endif; ?>
        <?php if(session()->getFlashdata('gagal')) : ?>
            <div class="alert alert-danger alert-dismissible " role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <strong>Gagal!</strong> <?= session()->getFlashdata('gagal'); ?>.
            </div>
        <?php endif; ?>
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
                                <td><?= $satu_penelitian['nim_pengajuan']; ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Nama Mahasiswa</td>
                                <td><?= $satu_penelitian['nama_pengajuan']; ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Departemen</td>
                                <td><?= $satu_penelitian['nama_departemen']; ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Tujuan Surat <b>(Kepada Yth : ?)</b></td>
                                <td><?= $satu_penelitian['tujuan_surat']; ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Alamat Tujuan Surat <b>(Di ?)</b></td>
                                <td><?= $satu_penelitian['alamat_tempat_penelitian']; ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Judul Skripsi</td>
                                <td><?= $satu_penelitian['judul']; ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Tempat Penelitian</td>
                                <td><?= $satu_penelitian['tempat_penelitian']; ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Jadwal Penelitian</td>
                                <td><?= tanggal_indo($satu_penelitian['tanggal_mulai']); ?> s.d <?= tanggal_indo($satu_penelitian['tanggal_selesai']); ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Objek Penelitian</td>
                                <td><?= $satu_penelitian['objek_penelitian']; ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Status</td>
                                <td><?= $satu_penelitian["status"] == "1" ? "<span class='badge badge-warning'>Belum diproses Admin</span>" : ($satu_penelitian["status"] == "2" ? "<span class='badge badge-danger'>Ditolak Admin</span>" : ($satu_penelitian["status"] == "3" ? "<span class='badge badge-success'>Disetujui Admin, Menunggu diproses Kadep</span>" : ($satu_penelitian["status"] == "4" ? "<span class='badge badge-danger'>Ditolak Kadep</span>" : ($satu_penelitian["status"] == "5" ? "<span class='badge badge-success'>Disetujui Kadep</span>" : null)))) ; ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Tanggal Pengajuan</td>
                                <td><?= tanggal_indo($satu_penelitian['created_at']); ?></td>
                            </tr>
                            <?php if($satu_penelitian['pesan']) { ?>
                            <tr>
                                <td class="font-weight-bold">Pesan</td>
                                <td><?= $satu_penelitian['pesan'] ; ?></td>
                            </tr>    
                            <?php } ?>
                        </table>
                        <br />
                        <div style="display: flex;">
                        <?php if (session()->get('username')) { ?>
                            <a href="<?= base_url("izin-penelitian/semua"); ?>" class="btn btn-warning btn-sm"><i class="fa fa-arrow-circle-left" style="margin-right: 5px;"></i>Kembali</a>
                        <?php } ?>
                        <?php if(session()->get('level') == '7' && $satu_penelitian['status'] == '1') { ?>
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
                        <?php if(session()->get('level') == '4' && $satu_penelitian['status'] == '3') { ?>
                                <!-- terima pengajuan jika status pengajuan belum di proses dan verifikator adalah kepala departemen-->
                                <form action="<?= base_url('izin-penelitian/setujui-kadep/'.$satu_penelitian['uuid']); ?>" method="post" id="setujui_kadep">
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
        <form action="<?= base_url('izin-penelitian/setujui-admin/'.$satu_penelitian['uuid']); ?>" method="post" id="setujui_admin">
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
        <form action="<?= base_url('izin-penelitian/tolak-kadep/'.$satu_penelitian['uuid']); ?>" method="post" id="tolak_kadep">
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
        <form action="<?= base_url('izin-penelitian/tolak-admin/'.$satu_penelitian['uuid']); ?>" method="post" id="tolak_admin">
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
