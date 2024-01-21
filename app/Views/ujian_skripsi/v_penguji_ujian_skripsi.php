<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
 <!-- page content -->
 <div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Daftar Semua Judul Skripsi di ACC</h2>
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
                                                <th>NIM</th>
                                                <th>Nama Mahasiswa</th>
                                                <th>Prodi</th>
                                                <th>Judul</th>
                                                <th>Tanggal Pengajuan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $no = 1 ?>
                                        <?php foreach($semua_skripsi as $ss): ?>
                                            <tr>
                                                <td><?= $no; ?></td>
                                                <td><?= $ss['nim_mahasiswa']; ?></td>
                                                <td><?= $ss['nama_mahasiswa']; ?></td>
                                                <td><?= $ss['prodi_portal']; ?></td>
                                                <td><?= $ss['judul_skripsi']; ?></td>
                                                <td><?= date('d-m-Y', strtotime($ss['tanggal_diproses'])) ; ?></td>
                                              
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
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Data Semua Mahasiswa Bimbingan</h2>
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
                                                <th>NIM</th>
                                                <th>Nama</th>
                                                <th>Prodi</th>
                                                <th>Total Bimbingan</th>
                                                <th>Sudah Verifikasi</th>
                                                <th>Belum Verifikasi</th>
                                                <th>Status Skripsi</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $no = 1 ?>
                                        <?php foreach($semua_bimbingan as $sb): ?>
                                            <tr>
                                                <td><?= $no; ?></td>
                                                <td><?= $sb['bb_nim']; ?></td>
                                                <td><?= $sb['prf_nama_portal']; ?></td>
                                                <td><?= $sb['prodi_portal']; ?></td>
                                                <td><?= $sb['total_bimbingan']; ?></td>
                                                <td><?= $sb['sudah_verifikasi']; ?></td>
                                                <td><?= $sb['belum_verifikasi']; ?></td>
                                                <td><?= $sb['status_pengajuan_skripsi'] == 3 ? "<span class='badge badge-success'>Sedang Bimbingan</span>" : ($sb['status_pengajuan_skripsi'] == 4 ? "<span class='badge badge-danger'>Pengajuan ditolak Kadep</span>" : ($sb['status_pengajuan_skripsi'] == 5 ? "<span class='badge badge-success'>Pengajuan disetujui Kadep</span>" : "")) ?></td>
                                                <td>
                                                    <a href="<?= base_url('bimbingan/verifikasi-dosen/'.$sb['skripsi_uuid']); ?>" class="btn btn-primary btn-sm"><i class="fa fa-check-square-o" style="margin-right: 5px;"></i>Verifikasi</a>
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
