<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
 <!-- page content -->
 <div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Data Master Judul Skripsi</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Daftar Judul Skripsi</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div style="margin-bottom: 10px;">
							<a href="<?= base_url("master-judul/tambah"); ?>" class="btn btn-success btn-sm"><i class="fa fa-plus-square" style="margin-right: 5px;"></i>Tambah Data Judul Skripsi</a>
						</div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal Pengajuan</th>
                                                <th>NIM</th>
                                                <th>Nama</th>
                                                <th>Departemen</th>
                                                <th>Periode</th>
                                                <th>Tahun</th>
                                                <th>Judul</th>
                                                <th>Status Pengajuan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $no = 1 ?>
                                        <?php foreach($semuaJudul as $sj): ?>
                                            <tr>
                                                <td><?= $no; ?></td>
                                                <td><?= tanggal_indo($sj['created_at']); ?></td>
                                                <td><?= $sj['nim_mahasiswa']; ?></td>
                                                <td><?= $sj['nama_mahasiswa']; ?></td>
                                                <td><?= $sj['nama_departemen']; ?></td>
                                                <td><?= $sj['periode_pengajuan'] == 1 ? 'Januari - Juni' : ($sj['periode_pengajuan'] == 1 ? 'Juli Desember' : null); ?></td>
                                                <td><?= $sj['tahun_pengajuan']; ?></td>
                                                <td><?= $sj['judul_skripsi']; ?></td>
                                                <td><?= $sj['status_pengajuan_skripsi'] == 1 ? "<span class='badge badge-warning'>Proses</span>" : ($sj['status_pengajuan_skripsi'] == 2 ? "<span class='badge badge-danger'>Ditolak</span>" : ($sj['status_pengajuan_skripsi'] == 3 ? "<span class='badge badge-success'>Disetujui</span>" : null)); ?></td>
                                                <td>
                                                    <a href="<?= base_url('master-judul/detail/'.$sj['skripsi_uuid']); ?>" class="btn btn-primary btn-sm"><i class="fa fa-file-text-o" style="margin-right: 5px;"></i>Detail</a>
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
