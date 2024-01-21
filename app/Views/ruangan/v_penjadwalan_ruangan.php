<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

 <!-- page content -->
 <div class="right_col" role="main">
    <div class="">
	<h2 style="font-weight: bold;">Daftar Ruangan Terpakai</h2>
	<p>Semua data ruangan yang ditampilkan disini merupakan ruangan yang status nya di booking atau terpakai dan juga sesi berapa ruangan tersebut dipakai.</br> Untuk status <span class="badge badge-warning">Pengajuan</span>, merupakan status dimana pengajuan seminar mahasiswa yang bersangkutan tersebut belum di setujui oleh admin departemen dan juga kepala departemenm, sedangkan yang status <span class="badge badge-success">Terpakai</span>, itu merupakan pengajuan seminar mahasiswa yang bersangkutan sudah disetujui. Selain data yang ditampilkan ini maka ruangannya bisa dipakai untuk seminar	</p>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
				<?php
				  $db = db_connect();
                  $query = "SELECT `seminar`.`smr_tanggal`, `seminar`.`smr_nim_m`,`seminar`.`smr_ruangan`,`seminar`.`created_at`,`seminar_sesi`.`jam_alias`,`seminar`.`smr_status` FROM `seminar` JOIN `seminar_sesi` ON `seminar_sesi`.`seminar_s_id` = `seminar`.`smr_sesi` ORDER BY `smr_id` ASC";
                  $semua_seminar= $db->query($query)->getResultArray();
              	?>
				<?php
                  $query = "SELECT `seminar_ruangan`.`seminar_r_id`, `seminar_ruangan`.`ruangan_alias`,`seminar_ruangan`.`ruangan_keterangan`,`seminar_ruangan`.`ruangan_status` FROM `seminar_ruangan` ORDER BY `seminar_r_id` ASC";
                  $semua_ruangan = $db->query($query)->getResultArray();
              	?>
				<div class="row">
			  	<?php foreach ($semua_ruangan as $sr) { ?>
					<div class="col-lg-6 col-md-6 col-sm-12">
						<div class="x_panel">
							<div class="x_title">
								<h2 style="display: flex; justify-content: center;"><?= $sr['ruangan_alias']; ?> <?= $sr['ruangan_status'] == 1 ? "<span class='badge badge-success ml-2'>Aktif</span>" : ($sr['ruangan_status'] == 0 ? "<span class='badge badge-danger ml-2'>Tidak Aktif</span>" : null) ; ?></h2>
								<div class="clearfix"></div>
							</div>
							<div class="x_content">
								<div class="row">
									<div class="col-md-12">
										<div class="card-box table-responsive">
											<table class="table table-striped jambo_table bulk_action">
												<thead>
													<tr class="headings">
														<th class="column-title">Hari/Tanggal</th>
														<th class="column-title"><span class="nobr">Sesi</span>
														<th class="column-title"><span class="nobr">Tanggal Pengajuan</span>
														<th class="column-title"><span class="nobr">Status</span>
														</th>
													</tr>
												</thead>
												<tbody>
													<?php 
													$tanggal_sekarang = date('d-m-Y');
													$tanggal_sekarang_format = new DateTime($tanggal_sekarang);
													$tanggal_akhir =  date('d-m-Y', strtotime($tanggal_sekarang.'7days'));	
													$tanggal_akhir_format = new DateTime($tanggal_akhir);
													$interval = DateInterval::createFromDateString('1 day');
													$periode = new DatePeriod($tanggal_sekarang_format, $interval, $tanggal_akhir_format);
													foreach($periode as $pd){ ?>
														<?php foreach($semua_seminar as $sse) {?>
															<?php if($sse['smr_tanggal'] == $pd->format('Y-m-d') && $sse['smr_ruangan'] == $sr['seminar_r_id'] ) { ?>
																<tr>
																	<td><?= $pd->format('d-m-Y'); ?></td>
																	<td><?= $sse['jam_alias']; ?></td>
																	<td><?= date('d-m-Y H:i:s', strtotime($sse['created_at'])) ; ?></td>
																	<?php if($sse['smr_status'] == 1) { ?>
																	<td class="badge badge-warning">Pengajuan</td>
																	<?php }elseif($sse['smr_status'] == 2 || $sse['smr_status'] == 3) {?>
																	<td class="badge badge-success">Terpakai</td>
																	<?php } ?>
																</tr>
															<?php } ?>
														<?php } ?>
													<?php } ?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
				</div>
    		</div>
        </div>
    </div>
</div>
        <!-- /page content -->


<?= $this->endSection(); ?>
