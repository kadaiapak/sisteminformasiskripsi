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
                        <h2>Daftar Ruangan</h2>
                        <div class="clearfix"></div>
                    </div>
					
                    <div class="x_content">
						<div>
							<a href="<?= base_url("sesi/tambah"); ?>" class="btn btn-success btn-sm"><i class="fa fa-plus-square" style="margin-right: 5px;"></i>Tambah Sesi</a>
						</div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
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
												<th class="column-title">Jam</th>
												<th class="column-title">Status Sesi</th>
												<th class="column-title no-link last text-center"><span class="nobr">Aksi</span>
												</th>
												<th class="bulk-actions" colspan="7">
													<a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
												</th>
											</tr>
										</thead>
										<tbody>
                                        	<?php $no = 1 ?>
											<?php foreach($semua_sesi as $ss): ?>
											<tr>
												<td class=" "><?= $no; ?></td>
												<td class=" "><?= $ss['jam_alias']; ?></td>
												<td class=" "><?= $ss['status_sesi'] == 1 ? "<span class='badge badge-success'>Aktif</span>" : ($ss['status_sesi'] == 0 ? "<span class='badge badge-danger'>Tidak Aktif</span>" : null) ; ?></td>
												<td>
													<button class="btn btn-danger">Hapus</button>
													<?php if($ss['status_sesi'] == 1) { ?>
														<a href="<?= base_url('status/'.$ss['seminar_s_id'].'/nonaktif'); ?>" class="btn btn-warning">Nonaktifkan</a>
													<?php } elseif($ss['status_sesi'] == 0) { ?>
														<a href="<?= base_url('sesi/'.$ss['seminar_s_id'].'/aktif'); ?>"  class="btn btn-primary">Aktifkan</a>
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
