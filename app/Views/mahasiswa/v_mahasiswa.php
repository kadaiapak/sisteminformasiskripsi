<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
 <!-- page content -->
 <div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Data Mahasiswa</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Daftar Mahasiswa</h2>
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
                                                <th>Departemen</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $no = 1 ?>
                                        <?php foreach($semua_mahasiswa as $sm): ?>
                                            <tr>
                                                <td><?= $no; ?></td>
                                                <td><?= $sm['nim']; ?></td>
                                                <td><?= $sm['nama']; ?></td>
                                                <td><?= $sm['prodi']; ?></td>
                                                <td><?= ($sm['status'] == 1 ? "<span class='badge badge-danger'>Belum ada progres</span>" : ($sm['status'] == 2 ? "<span class='badge badge-warning'>Pengajuan Judul</span>" : ($sm['status'] == 3 ? "<span class='badge badge-success'>Judul diterima</span>" : ($sm['status'] == 4 ? "<span class='badge badge-info'>Bimbingan</span>" : ($sm['status'] == 5 ? "<span class='badge badge-primary'>Pengajuan Seminar Proposal</span>" : ($sm['status'] == 6 ? "<span class='badge badge-primary'>Seminar disetujui admin</span>" : ($sm['status'] == 7 ? "<span class='badge badge-success'>Seminar disetujui kadep</span>" : ($sm['status'] == 8 ? "<span class='badge badge-info'>Ujian Skripsi</span>" : ($sm['status'] == 9 ? "<span class='badge badge-info'>Ujian Skripsi Disetujui Admin</span>" : ($sm['status'] == 10 ? "<span class='badge badge-info'>Ujian Skripsi Disetujui Kadep</span>" : null)))))))))); ?></td>
                                                <td>
                                                    <a href="<?= base_url('mahasiswa/detail-skripsi/'.$sm['nim']); ?>" class="btn btn-primary btn-sm">Detail</a>
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
