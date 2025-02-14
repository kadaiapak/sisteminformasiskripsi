<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Izin Observasi Penelitian</h3>
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
                                <td class="font-weight-bold">Departemen</td>
                                <td><?= $satu_observasi['nama_departemen']; ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Tujuan Surat <b>(Kepada Yth : ?)</b></td>
                                <td><?= $satu_observasi['tujuan_surat']; ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Alamat Tujuan Surat <b>(Di ?)</b></td>
                                <td><?= $satu_observasi['alamat_surat']; ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Judul Skripsi</td>
                                <td><?= $satu_observasi['judul']; ?></td>
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
                        </table>
                        <br />
                        <?php if (session()->get('username')) { 
                            if(session()->get('level') == 7){ ?>
                            <a href="<?= base_url("izin-observasi-penelitian/selesai"); ?>" class="btn btn-warning btn-sm"><i class="fa fa-arrow-circle-left" style="margin-right: 5px;"></i>Kembali</a>
                            <?php }else { ?>
                            <a href="<?= base_url("izin-observasi-penelitian"); ?>" class="btn btn-warning btn-sm"><i class="fa fa-arrow-circle-left" style="margin-right: 5px;"></i>Kembali</a>
                        <?php } 
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
