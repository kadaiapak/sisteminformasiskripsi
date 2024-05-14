<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
 <!-- page content -->
 <div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Data Master Mahasiswa</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Daftar Mahasiswa Bermasalah IDPDPT</h2>
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
                                                <th>Idpdpt</th>
                                                <th>Departemen berdasarkan IDpdpt</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $no = 1 ?>
                                        <?php foreach($semuaMahasiswa as $sm): ?>
                                            <tr>
                                                <td><?= $no; ?></td>
                                                <td><?= $sm['prf_nim_portal']; ?></td>
                                                <td><?= $sm['prf_nama_portal']; ?></td>
                                                <td><?= $sm['prodi_portal']; ?></td>
                                                <td><?= $sm['idpdpt']; ?></td>
                                                <td><?= $sm['nama_departemen']; ?></td>
                                                <td>
                                                    <a href="<?= base_url('master-mahasiswa/detail/'.$sm['prf_nim_portal']); ?>" class="btn btn-primary btn-sm">Detail</a>
                                                    <a href="<?= base_url('master-mahasiswa/edit/'.$sm['prf_nim_portal']); ?>" class="btn btn-warning btn-sm">Edit</a>
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
