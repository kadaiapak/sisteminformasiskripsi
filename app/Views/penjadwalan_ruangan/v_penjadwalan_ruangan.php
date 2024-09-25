<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

 <!-- page content -->
 <div class="right_col" role="main">
    <div class="">
		<div class="page-title">
			<div class="title_left">	
				<h3>Pembagian Ruangan Seminar dan Ujian Untuk Departemen</h3>
			</div>
		</div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Daftar Departemen Untuk Pengaturan Penjadwalan Ruangan</h2>
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
									<a href="<?= base_url('ruangan/penjadwalan-ruangan/tambah'); ?>" class="btn btn-success btn-sm"><i class="fa fa-plus-square" style="margin-right: 5px;"></i>Tambah</a>
									<hr>
									<table id="datatable" class="table table-striped table-bordered" style="width:100%">
										<thead>
											<tr class="headings">
												<th class="column-title">No </th>
												<th class="column-title">Nama Departemen </th>
												<th class="column-title">Nama Ruangan</th>
												<th class="column-title">Nama Hari</th>
												<th class="column-title">Sesi</th>
												<th class="column-title no-link last"><span class="nobr">Aksi</span></th>
											</tr>
										</thead>
										<tbody>
											<?php $nomor = 1 ?>
											<?php foreach($penjadwalan_ruangan as $pr) { ?>
												<tr>
													<td><?= $nomor; ?></td>
													<td><?= $pr['penjadwalan_ruangan_departemen_id'] == '@' ? 'Semua Departemen' : $pr['nama_departemen']; ?> </td>
													<td><?= $pr['nama_ruangan']; ?></td>
													<td><?= $pr['penjadwalan_ruangan_hari_id'] == '@' ? 'Setiap Hari' : $pr['hari']; ?></td>
													<td><?= $pr['sesi'] == null ? 'Semua Sesi' : $pr['sesi']; ?></td>
													<td><a href="<?= base_url('ruangan/penjadwalan-ruangan/edit/'.$pr['penjadwalan_ruangan_id']); ?>" class="btn btn-info btn-sm"><i class="fa fa-edit" style="margin-right: 5px;"></i>Ubah</a>
													<form class="d-inline" method="post" action="<?= base_url('ruangan/penjadwalan-ruangan/hapus/'.$pr['penjadwalan_ruangan_id']); ?>">
													<?= csrf_field(); ?>
														<input type="hidden" name="_method" value="DELETE">
														<button type="submit" class="btn btn-danger btn-md" onclick="return confirm('apakah yakin dihapus?')"><i class="fa fa-trash-o" style="margin-right: 5px;"></i>Hapus</button>
													</form>
												</tr>
												<?php $nomor++ ?>
											<?php } ?>
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
