<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

 <!-- page content -->
 <div class="right_col" role="main">
    <div class="">
		<div class="page-title">
			<div class="title_left">	
				<h3>Ruangan</h3>
			</div>
		</div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Daftar Ruangan</h2>
                        <div class="clearfix"></div>
                    </div>
					
                    <div class="x_content">
						<div>
							<a href="<?= base_url("ruangan/tambah"); ?>" class="btn btn-success btn-sm"><i class="fa fa-plus-square" style="margin-right: 5px;"></i>Tambah Ruangan</a>
						</div>
						<hr>
                        <div class="row">
                            <div class="col-lg-10 col-sm-12 col-md-10">
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
									<table class="table table-bordered">
										<thead>
											<tr class="headings">
												<th class="column-title">No </th>
												<th class="column-title">Nama Ruangan </th>
												<th class="column-title">Keterangan </th>
												<th class="column-title">Status </th>
												<th class="column-title no-link last text-center"><span class="nobr">Aksi</span>
												</th>
												<th class="bulk-actions" colspan="7">
													<a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
												</th>
											</tr>
										</thead>
										<tbody>
                                        	<?php $no = 1 ?>
											<?php foreach($semua_ruangan as $sr): ?>
											<tr>
												<td class=" "><?= $no; ?></td>
												<td class=" "><?= $sr['ruangan_alias']; ?></td>
												<td class=" "><?= $sr['ruangan_keterangan']; ?></td>
												<td class=" "><?= $sr['ruangan_status'] == 1 ? "<span class='badge badge-success'>Aktif</span>" : ($sr['ruangan_status'] == 0 ? "<span class='badge badge-danger'>Tidak Aktif</span>" : null) ; ?></td>
												<td>
												<a href="" class="btn btn-danger btn-sm"><i class="fa fa-trash" style="margin-right: 5px;"></i>Hapus</a>
													<?php if($sr['ruangan_status'] == 1) { ?>
														<form action="<?= base_url('/ruangan/'.$sr['seminar_r_id'].'/nonaktif'); ?>" method="POST">
															<button type="submit" class="btn btn-warning btn-sm"><i class="fa fa-edit" style="margin-right: 5px;"></i>Nonaktifkan</button>	
														</form>
													<?php } elseif($sr['ruangan_status'] == 0) { ?>
														<form action="<?= base_url('/ruangan/'.$sr['seminar_r_id'].'/aktif'); ?>" method="POST">
															<button type="submit" class="btn btn-warning btn-sm"><i class="fa fa-edit" style="margin-right: 5px;"></i>Aktifkan</button>	
														</form>
													<?php } ?>
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
