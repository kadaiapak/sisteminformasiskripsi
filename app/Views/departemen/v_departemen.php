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
                        <h2>Daftar Departemen</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
						<div>
							<a href="<?= base_url("departemen/tambah"); ?>" class="btn btn-success btn-sm"><i class="fa fa-plus-square" style="margin-right: 5px;"></i>Tambah Departemen</a>
						</div>
                        <div class="row">
                            <div class="col-sm-12">
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
												<th class="column-title">Kode Departemen </th>
												<th class="column-title">Nama Departemen </th>
												<th class="column-title">Email Departemen</th>
												<th class="column-title">Website Departemen</th>
												<th class="column-title">Kode Surat</th>
												<th class="column-title">Kadep</th>
												<th class="column-title">Status </th>
												<th class="column-title no-link last"><span class="nobr">Aksi</span>
												</th>
												<th class="bulk-actions" colspan="7">
													<a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
												</th>
											</tr>
										</thead>
										<tbody>
                                        	<?php $no = 1 ?>
											<?php foreach($semua_departemen as $sd): ?>
											<tr>
												<td class=" "><?= $no; ?></td>
												<td class=" "><?= $sd['departemen_kd']; ?></td>
												<td class=" "><?= $sd['departemen_nama']; ?></td>
												<td class=" "><?= $sd['departemen_email']; ?></td>
												<td class=" "><?= $sd['departemen_website']; ?></td>
												<td class=" "><?= $sd['departemen_kd_surat']; ?></td>
												<td class=" "><?= $sd['departemen_nm_kadep']; ?></br><?= $sd['departemen_nip_kadep']; ?> </td>
												<td class=" "><?= $sd['departemen_status'] == 1 ? "<span class='badge badge-success'>Aktif</span>" : ($sd['departemen_status'] ==  0 ? "<span class='badge badge-warning'>Tidak Aktif</span>" : null)  ?></td>
												<td class=" last">
													<a href="<?= base_url('/departemen/'.$sd['departemen_id'].'/edit'); ?>" class="btn btn-warning">Ubah</a>
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
