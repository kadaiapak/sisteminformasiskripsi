<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
 <!-- page content -->
 <div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Izin Observasi Penelitian</h3>
            </div>
        </div>
        <div class="clearfix"></div>
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
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Semua Pengajuan</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div style="margin-bottom: 10px;">
							<a href="<?= base_url("izin-observasi-penelitian/tambah"); ?>" class="btn btn-success btn-sm"><i class="fa fa-plus-square" style="margin-right: 5px;"></i>Ajukan Surat</a>
						</div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th width="2%">No</th>
                                                <th width="10%">NIM</th>
                                                <th width="10%">Nama Mahasiswa</th>
                                                <th width="10%">Departemen</th>
                                                <th width="23%">Judul</th>
                                                <th width="10%">Tanggal Pengajuan</th>
                                                <th width="10%">Status</th>
                                                <th width="10%">Pesan</th>
                                                <th width="15%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $no = 1 ?>
                                        <?php foreach($semua_izin_observasi_penelitian as $siop): ?>
                                            <tr>
                                                <td><?= $no; ?></td>
                                                <td><?= $siop['nim_pengajuan']; ?></td>
                                                <td><?= $siop['nama_pengajuan']; ?></td>
                                                <td><?= $siop['nama_departemen']; ?></td>
                                                <td><?= $siop['judul']; ?></td>
                                                <td><?= tanggal_indo($siop['created_at']); ?></td>
                                                <td><?= $siop["status"] == "1" ? "<span class='badge badge-warning'>Belum diproses Admin</span>" : ($siop["status"] == "2" ? "<span class='badge badge-danger'>Ditolak Admin</span>" : ($siop["status"] == "3" ? "<span class='badge badge-success'>Menunggu diproses Kadep</span>" : ($siop["status"] == "4" ? "<span class='badge badge-danger'>Ditolak Kadep</span>" : ($siop["status"] == "5" ? "<span class='badge badge-success'>Disetujui Kadep</span>" : null)))) ; ?></td>
                                                <td><?= $siop['pesan']; ?></td>
                                                <td>
                                                    <?php if($siop['status'] == 5) { ?>
                                                        <button class="btn btn-success" onclick="window.open('<?= base_url('izin-observasi-penelitian/print-surat/'.$siop['uuid']) ?>', 'blank')"><i class="fa fa-print" style="margin-right: 5px;"></i>Cetak</button>
                                                    <?php }  ?>
                                                    <a href="<?= base_url('izin-observasi-penelitian/detail/'.$siop['uuid']); ?>" class="btn btn-primary btn-sm" ><i class="fa fa-file-text-o" style="margin-right: 5px;"></i>Detail</a>
                                                    <?php if($siop['nim_pengajuan'] == session()->get('username') && $siop['status'] == 1) {  ?>
                                                        <a href="<?= base_url('izin-observasi-penelitian/edit/'.$siop['uuid']); ?>" class="btn btn-warning btn-sm" ><i class="fa fa-check-square-o" style="margin-right: 5px;"></i>Edit</a>
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
<?= $this->endSection(); ?>
