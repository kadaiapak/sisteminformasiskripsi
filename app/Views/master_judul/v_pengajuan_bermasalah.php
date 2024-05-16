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
                        <h2>Daftar Pengajuan Judul Lebih dari satu</h2>
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
                                                <th>Total Pengajuan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $no = 1 ?>
                                        <?php foreach($semuaJudulDouble as $sj): ?>
                                            <tr>
                                                <td><?= $no; ?></td>
                                                <td><?= $sj['nim_mahasiswa']; ?></td>
                                                <td><?= $sj['nama_mahasiswa']; ?></td>
                                                <td><?= $sj['nama_departemen']; ?></td>
                                                <td><?= $sj['total_pengajuan']; ?></td>
                                                <td>
                                                    <a href="<?= base_url('master-judul/pengajuan-bermasalah/detail/'.$sj['nim_mahasiswa']); ?>" class="btn btn-primary btn-sm"><i class="fa fa-file-text-o" style="margin-right: 5px;"></i>Detail</a>
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
