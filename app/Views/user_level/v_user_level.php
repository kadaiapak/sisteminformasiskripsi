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
                        <h2>Daftar User Level</h2>
                        <div class="clearfix"></div>
                    </div>
					
                    <div class="x_content">
						<div>
							<a href="<?= base_url("user_level/tambah"); ?>" class="btn btn-success btn-sm"><i class="fa fa-plus-square" style="margin-right: 5px;"></i>Tambah User Level</a>
						</div>
                        <div class="row">
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <div class="card-box table-responsive">
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
									<!--  -->
									<table class="table table-striped jambo_table bulk_action">
										<thead>
											<tr class="headings">
												<th class="column-title" style="width: 5%;">No </th>
												<th class="column-title" style="width: 25%;">Nama User Level </th>
												<th class="column-title" style="width: 45%;">Keterangan </th>
												<th class="column-title" style="width: 5%;">Status </th>
												<th class="column-title no-link last" style="width: 20%;"><span class="nobr">Aksi</span>
												</th>
												<th class="bulk-actions" colspan="7">
													<a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
												</th>
											</tr>
										</thead>
										<tbody>
                                        	<?php $no = 1 ?>
											<?php foreach($semua_user_level as $ssl): ?>
											<tr>
												<td class=" "><?= $no; ?></td>
												<td class=" "><?= $ssl['user_level_nama']; ?></td>
												<td class=" "><?= $ssl['user_level_keterangan']; ?></td>
												<td class=" "><?= $ssl['user_level_status'] == 1 ? "<span class='badge badge-success'>Aktif</span>" : ($ssl['user_level_status'] ==  0 ? "<span class='badge badge-warning'>Tidak Aktif</span>" : null)  ?></td>
												<td class=" last">
													<a href="<?= base_url('/user_level/'.$ssl['user_level_id'].'/edit'); ?>" class="btn btn-warning">Ubah</a>
													<a href="#" class="btn btn-danger">Hapus</a>
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
        <!-- /page content -->


<?= $this->endSection(); ?>
