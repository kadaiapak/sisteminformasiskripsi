<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
 <!-- page content -->
 <div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Izin Observasi Matakuliah</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Semua Pengajuan Yang disetujui Kepala Departemen</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal Pengajuan</th>
                                                <th>NIM</th>
                                                <th>Nama Mahasiswa</th>
                                                <th>Departemen</th>
                                                <th>Tempat Observasi</th>
                                                <th>Jadwal</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $no = 1 ?>
                                        <?php foreach($semuaSuratIzinObservasiMatakuliahSelesai as $siomk): ?>
                                            <tr>
                                                <td><?= $no; ?></td>
                                                <td><?= tanggal_indo($siomk['created_at']); ?></td>
                                                <td><?= $siomk['nim_pengajuan']; ?></td>
                                                <td><?= $siomk['nama_pengajuan']; ?></td>
                                                <td><?= $siomk['nama_departemen']; ?></td>
                                                <td><?= $siomk['tempat_observasi']; ?></td>
                                                <td><?= tanggal_indo($siomk['tanggal_mulai']); ?> s.d <?= tanggal_indo($siomk['tanggal_selesai']); ?></td>
                                                <td><?= $siomk["status"] == "1" ? "<span class='badge badge-warning'>Belum diproses Admin</span>" : ($siomk["status"] == "2" ? "<span class='badge badge-danger'>Ditolak Admin</span>" : ($siomk["status"] == "3" ? "<span class='badge badge-success'>Menunggu diproses Kadep</span>" : ($siomk["status"] == "4" ? "<span class='badge badge-danger'>Ditolak Kadep</span>" : ($siomk["status"] == "5" ? "<span class='badge badge-success'>Disetujui</span>" : null)))) ; ?></td>
                                                <td>
                                                    <button class="btn btn-success btn-sm" onclick="window.open('<?= base_url('izin-observasi-matakuliah/print-surat/'.$siomk['uuid']) ?>', 'blank')"><i class="fa fa-print" style="margin-right: 5px;"></i>Cetak</button>
                                                    <a href="<?= base_url('izin-observasi-matakuliah/detail/'.$siomk['uuid']); ?>" class="btn btn-primary btn-sm" ><i class="fa fa-file-text-o" style="margin-right: 5px;"></i>Detail</a>
                                                </td>
                                            <?php $no++ ?>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
