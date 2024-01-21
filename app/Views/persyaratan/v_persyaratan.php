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
                        <h2>Daftar Persyaratan</h2>
                        <div class="clearfix"></div>
                    </div>
					
                    <div class="x_content">
						<div>
							<a href="<?= base_url("persyaratan/tambah"); ?>" class="btn btn-success btn-sm"><i class="fa fa-plus-square" style="margin-right: 5px;"></i>Tambah Persyaratan</a>
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
												<th class="column-title">Nama Persyaratan </th>
												<th class="column-title">Alias</th>
												<th class="column-title">Keterangan</th>
												<th class="column-title">Tipe File (pdf/gambar)/dokumen</th>
												<th class="column-title">Ukuran File</th>
												<th class="column-title">Ukuran File Alias (dalam Kb)</th>
												<th class="column-title">Status</th>
												<th class="column-title no-link last text-center"><span class="nobr">Aksi</span>
												</th>
												<th class="bulk-actions" colspan="7">
													<a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
												</th>
											</tr>
										</thead>
										<tbody>
                                        	<?php $no = 1 ?>
											<?php foreach($semua_persyaratan as $ps): ?>
											<tr>
												<td class=" "><?= $no; ?></td>
												<td class=" "><?= $ps['ps_nama']; ?></td>
												<td class=" "><?= $ps['ps_alias']; ?></td>
												<td class=" "><?= $ps['ps_keterangan']; ?></td>
												<td class=" "><?= ($ps['ps_tipe_file'] == 'jpg/jpeg/png' ? 'Gambar' : ($ps['ps_tipe_file'] == 'pdf' ? 'PDF' : null )) ;?></td>
												<td class=" "><?= ($ps['ps_ukuran_file'] == '1024' ? '1 MB' : ($ps['ps_ukuran_file'] == '2048' ? '2 MB' : ($ps['ps_ukuran_file'] == '3072' ? '3 MB' : ($ps['ps_ukuran_file'] == '4096' ? '4 MB' : ($ps['ps_ukuran_file'] == '5120' ? '5 MB' : null))))); ?></td>
												<td class=" "><?= $ps['ps_ukuran_file']; ?></td>
												<td class=" "><?= $ps['ps_status'] == 1 ? "<span class='badge badge-success'>Aktif</span>" : ($ps['ps_status'] == 0 ? "<span class='badge badge-danger'>Tidak Aktif</span>" : null) ; ?></td>
												<td>
													<button class="btn btn-danger">Hapus</button>
													<a href="<?= base_url('persyaratan/'.$ps['persyaratan_id'].'/hapus'); ?>" class="btn btn-warning">Nonaktifkan</a>
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
