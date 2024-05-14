<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
 <!-- page content -->
 <div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Data Master Dosen</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Daftar Dosen</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div style="margin-bottom: 10px;">
							<a href="<?= base_url("master-dosen/tambah"); ?>" class="btn btn-success btn-sm"><i class="fa fa-plus-square" style="margin-right: 5px;"></i>Tambah Data Dosen</a>
						</div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>NIDN</th>
                                                <th>Nama</th>
                                                <th>Departemen</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $no = 1 ?>
                                        <?php foreach($semuaDosen as $sd): ?>
                                            <tr>
                                                <td><?= $no; ?></td>
                                                <td><?= $sd['nidn']; ?></td>
                                                <td><?= $sd['peg_gel_dep']; ?> <?= $sd['peg_nama']; ?> <?= $sd['peg_gel_bel']; ?></td>
                                                <td><?= $sd['nama_departemen']; ?></td>
                                                <td>
                                                    <a href="<?= base_url('master-dosen/detail/'.$sd['nidn']); ?>" class="btn btn-primary btn-sm"><i class="fa fa-file-text-o" style="margin-right: 5px;"></i>Detail</a>
                                                    <a href="<?= base_url('master-dosen/edit/'.$sd['nidn']); ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit" style="margin-right: 5px;"></i>Edit</a>
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
