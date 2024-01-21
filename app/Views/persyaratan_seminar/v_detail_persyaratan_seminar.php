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
                        <h2 style="margin-right: 20px;">Daftar Persyaratan Seminar <?= $nama_departemen; ?></h2>
						<!-- tombol baru -->
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">Edit Persyaratan</button>
						<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
							<div class="modal-dialog modal-lg">
								<form action="<?= base_url('persyaratan-seminar/simpan_edit'); ?>" method="post" id="tolak_admin">
								<?= csrf_field(); ?>
								<input type="hidden" name="id_departemen" value="<?= $id_departemen; ?>">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title" id="myModalLabel">Ubah Persyaratan</h4>
											<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
										</div>
										<div class="modal-body">
											<table class="table table-striped jambo_table bulk_action">
												<thead>
													<tr class="headings">
														<th class="column-title">No </th>
														<th class="column-title">Persyaratan</th>
														<th class="column-title">Tipe File</th>
														<th class="column-title">Ukuran File</th>
														<!-- <th class="column-title">Wajib</th> -->
														<th class="column-title no-link last"><span class="nobr">Pakai</span>
														</th>
													</tr>
												</thead>
												<tbody>
													<?php $no = 1 ?>
													<?php foreach($persyaratan_dipakai as $pd): ?>
													<tr>
														<td class=" "><?= $no; ?></td>
														<td class=" "><?= $pd['ps_nama']; ?></td>
														<td class=" "><?= $pd['ps_tipe_file']; ?></td>
														<td class=" "><?= $pd['ps_ukuran_file']; ?></td>
														<!-- <td class=" ">
															<div class="form-check">
																<input type="hidden" name="wajib_< ?= $pd['persyaratan_id']; ?>" value="0">
																<input type="checkbox" name="wajib_< ?= $pd['persyaratan_id']; ?>" value="1" class="form-check-input" id="wajib">
																<label class="form-check-label" for="wajib">ceklis jika wajib</label>
															</div>
														</td> -->
														<td class=" ">
															<div class="form-check">
																<input type="hidden" name="dipakai_<?= $pd['persyaratan_id']; ?>" value="0">
																<input type="checkbox" name="dipakai_<?= $pd['persyaratan_id']; ?>" <?= $pd['dipakai'] != null ? 'checked' : ''; ?> value="1" class="form-check-input" id="pakai">
																<label class="form-check-label" for="pakai">ceklis jika dipakai</label>
															</div>
														</td>
														<?php $no++ ?>
													</tr>
													<?php endforeach; ?>
												</tbody>
											</table>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											<button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save" style="margin-right: 5px;"></i>Simpan</button>
										</div>
									</div>
								</form>
							</div>
						</div>
						<!-- akhir tombol baru -->
						<div class="clearfix"></div>
                    </div>
                    <div class="x_content">
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
												<th class="column-title">Persyaratan</th>
												<th class="column-title">Keterangan</th>
												<th class="column-title">Tipe File</th>
												<th class="column-title">Ukuran File</th>
												<th class="column-title">Dipakai</th>
												</th>
											</tr>
										</thead>
										<tbody>
                                        	<?php $no = 1 ?>
											<?php foreach($persyaratan_dipakai as $pd): ?>
											<tr>
												<td class=" "><?= $no; ?></td>
												<td class=" "><?= $pd['ps_nama']; ?></td>
												<td class=" "><?= $pd['ps_keterangan']; ?></td>
												<td class=" "><?= $pd['ps_tipe_file']; ?></td>
												<td class=" "><?= $pd['ps_ukuran_file']; ?></td>
												<td class=" "><?= $pd['dipakai']?></td>	
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
