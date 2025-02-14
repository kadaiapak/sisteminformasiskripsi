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
                        <?php if (session()->get('username')) { ?>
                            <a href="javascript:history.back()" class="btn btn-warning btn-sm" style="margin-top: 10px;" ><i class="fa fa-arrow-circle-left" style="margin-right: 5px;"></i>Kembali</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Berkas Persyaratan Izin Penelitian</h2>
                        <div class="clearfix"></div>
                    </div>
                    <?php if($filePersyaratan != null) {?>
                        <div class="x_content">
                            <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                                <?php $n = 1; ?>
                                <?php foreach ($filePersyaratan as $ps) { ?>
                                    <li class="nav-item">
                                        <a class="nav-link <?= $n == 1 ? 'active' : ''; ?>" id="b<?= $ps['persyaratan_id'] ?>-tab" data-toggle="tab" href="#b<?= $ps['persyaratan_id'] ?>" role="tab" aria-controls="b<?= $ps['persyaratan_id'] ?>" aria-selected="true"><?= $ps['judul']; ?></a>
                                    </li>
                                    <?php $n++; ?>
                                <?php } ?>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <?php $no = 1; ?>
                                <?php foreach ($filePersyaratan as $ps) { ?>
                                <div class="tab-pane fade <?= $no == 1 ? 'show active' : null; ?> " id="b<?= $ps['persyaratan_id'] ?>" role="tabpanel" aria-labelledby="b<?= $ps['persyaratan_id'] ?>-tab">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 ">
                                            <div class="card" style="margin: 0; padding: 0; overflow: hidden; height: 75%;">
                                                <div class="card-body" >
                                                    <iframe src="/upload/surat_izin_penelitian/<?= $ps['nama_file']; ?>" id="myframe" frameborder="0" style="width: 100%; height: 500px; display: block;"></iframe>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php $no++ ?>
                                <?php } ?>
                                <!-- akhir dari tab untuk pengajuan judul skripsi -->
                            </div>
                        </div>
                        <?php }else { ?>
                        <h4>Tidak ada Persyaratan</h4>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
