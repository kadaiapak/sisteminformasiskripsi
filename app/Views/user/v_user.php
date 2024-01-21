<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

 <!-- page content -->
 <div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>User</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <?php if(session()->getFlashdata('sukses')) : ?>
            <div class="alert alert-success alert-dismissible " role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <strong>Sukses!</strong> <?= session()->getFlashdata('sukses'); ?>.
            </div>
        <?php endif; ?>
        <?php if(session()->getFlashdata('gagal')) : ?>
            <div class="alert alert-danger alert-dismissible " role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <strong>Gagal!</strong> <?= session()->getFlashdata('gagal'); ?>.
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Rekap User</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
						<div style="margin-bottom: 10px;">
							<a href="<?= base_url("user/tambah"); ?>" class="btn btn-success btn-sm"><i class="fa fa-plus-square" style="margin-right: 5px;"></i>Tambah User</a>
						</div>
						<div class="row">
							<?php foreach($rekap_user as $ru) { ?>
							<div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
								<div class="tile-stats">
									<div class="count"><?= $ru->total_user; ?></div>
									<h3><?= $ru->user_level_nama; ?></h3>
								</div>
							</div>
							<?php } ?>
						</div>
            		</div>
            	</div>
    		</div>
			<div class="col-lg-12 col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Daftar User</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
									<!-- table  -->
									<table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama User</th>
                                                <th>Username</th>
                                                <th>Level</th>
                                                <th>Departemen</th>
                                                <th>Status</th>
                                                <th>Login</th>
                                                <th>Terakhir Login</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $no = 1 ?>
                                        <?php foreach($semua_user as $sd): ?>
                                            <tr>
                                                <td><?= $no; ?></td>
                                                <td><?= $sd['nama_asli']; ?></td>
                                                <td><?= $sd['username']; ?></td>
                                                <td><?= $sd['user_level_nama']; ?></td>
                                                <td><?= $sd['departemen_nama'] == null ? 'Semua Departemen' : $sd['departemen_nama']; ?></td>
                                                <td><?= $sd['is_aktif'] == 1 ? "<span class='badge badge-success'>Aktif</span>" : ($sd['is_aktiv'] ==  0 ? "<span class='badge badge-warning'>Tidak Aktif</span>" : null)  ?></td>
                                                <td><?= $sd['is_login'] == 1 ? "<span class='badge badge-success'>Terhubung</span>" : ($sd['is_login'] ==  0 ? "<span class='badge badge-warning'>Terputus</span>" : null)  ?></td>
                                                <td><?= $sd['terakhir_login']; ?></td>
                                                <td>
                                                    <a href="" class="btn btn-primary btn-sm">Detail</a>
                                                </td>
                                            <?php $no++ ?>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
									<!-- akhir tabel -->
                        		</div>
                    		</div>
                		</div>
            		</div>
            	</div>
    		</div>
        </div>
    </div>
</div>
        <!-- /page content -->


<?= $this->endSection(); ?>
