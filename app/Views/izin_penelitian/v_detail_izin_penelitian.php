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
                        <h2>Detail Izin Observasi Matakuliah</h2>
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
                                <td class="font-weight-bold">Tujuan Kepala Surat (Kepada Yth : ?)</td>
                                <td><?= $satu_penelitian['tujuan_surat']; ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Alamat Tempat Penelitian</td>
                                <td><?= $satu_penelitian['alamat_tempat_penelitian']; ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Judul</td>
                                <td><?= $satu_penelitian['judul']; ?></td>
                            </tr>
                          
                            <tr>
                                <td class="font-weight-bold">Tempat Penelitian</td>
                                <td><?= $satu_penelitian['tempat_penelitian']; ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Tanggal Penelitian</td>
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
                                <td><?= date('d-m-Y', strtotime($satu_penelitian['created_at'])) ; ?></td>
                            </tr>
                            <?php if($satu_penelitian['pesan']) { ?>
                            <tr>
                                <td class="font-weight-bold">Pesan</td>
                                <td><?= $satu_penelitian['pesan'] ; ?></td>
                            </tr>    
                            <?php } ?>
                        </table>
                        <?php if (session()->get('username')) { ?>
                            <a href="<?= base_url("izin-penelitian"); ?>" class="btn btn-primary btn-sm" style="margin-top: 10px;" ><i class="fa fa-arrow-circle-left" style="margin-right: 5px;"></i>Kembali</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
