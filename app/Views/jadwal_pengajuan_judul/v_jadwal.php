<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

 <!-- page content -->
 <div class="right_col" role="main">
    <div class="">
		<div class="page-title">
            <div class="title_left">
                <h3>Jadwal Pengajuan Judul Skripsi</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Semua Jadwal</h2>
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
									<table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Departemen</th>
                                                <th>Apakah Pengajuan Judul Dibuka</th>
                                                <th>Tanggal Mulai Pengajuan</th>
                                                <th>Tanggal Akhir</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $no = 1 ?>
                                        <?php foreach($semua_jadwal_departemen as $ssr): ?>
                                            <tr>
                                                <td><?= $no; ?></td>
                                                <td><?= $ssr['nama_departemen'] ?></td>
                                                <td><?= ($ssr['apakah_buka'] == 1 ? "<span class='badge badge-success'>Pengajuan judul dibuka</span>" : ($ssr['apakah_buka'] == 0 ? "<span class='badge badge-danger'>Pengajuan Ditutup</span>" : null)); ?></td>
                                                <td><?= date('d-m-Y', strtotime($ssr['mulai_pengajuan_judul'])) ; ?></td>
                                                <td><?= date('d-m-Y', strtotime($ssr['akhir_pengajuan_judul'])) ; ?></td>
                                                <td>
                                                    <?php if(session()->get('departemen') == $ssr['departemen_id']) { ?>
                                                    <!-- jika level adalah admin departemen atau kadep maka url nya -->
                                                    	<a href="<?= base_url('/edit-jadwal-pengajuan-judul/'.$ssr['jadwal_id']); ?>" class="btn btn-primary btn-sm" ><i class="fa fa-check-square-o" style="margin-right: 5px;"></i>Edit</a>
                                                    <!-- end -->
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
