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
                        <h2>Daftar Menu</h2>
                        <div class="clearfix"></div>
                    </div>
					
                    <div class="x_content">
						<div>
							<a href="<?= base_url("menu/tambah"); ?>" class="btn btn-success btn-sm"><i class="fa fa-plus-square" style="margin-right: 5px;"></i>Tambah Menu</a>
						</div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
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
												<th class="column-title">No </th>
												<th class="column-title">Nama Menu </th>
												<th class="column-title">URL Menu</th>
												<th class="column-title">Icon</th>
												<th class="column-title">Aktif</th>
												<th class="column-title">Tampil</th>
												<th class="column-title no-link last text-center"><span class="nobr">Aksi</span>
												</th>
												<th class="bulk-actions" colspan="7">
													<a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
												</th>
											</tr>
										</thead>
										<tbody>
                                        	<?php $no = 1 ?>
											<?php foreach($semua_menu as $sm): ?>
											<tr>
												<td class=" "><?= $no; ?></td>
												<td class=" "><?= $sm['menu_nama']; ?></td>
												<td class=" "><?= $sm['menu_url']; ?></td>
												<td class=" "><?= $sm['menu_icon']; ?></td>
												<td class=" "><?= $sm['is_aktif'] == 1 ? "<span class='badge badge-success'>Aktif</span>" : ($sm['is_aktif'] == 0 ? "<span class='badge badge-danger'>Tidak Aktif</span>" : null) ; ?></td>
												<td class=" "><?= $sm['is_tampil'] == 1 ? "<span class='badge badge-success'>Ditampilkan</span>" : ($sm['is_tampil'] == 0 ? "<span class='badge badge-danger'>Tidak ditampilkan</span>" : null) ; ?></td>
												<td>
													<button class="btn btn-danger">Hapus</button>
													<a href="<?= base_url('menu/'.$sm['menu_id'].'/hapus'); ?>" class="btn btn-warning">Nonaktifkan</a>
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
