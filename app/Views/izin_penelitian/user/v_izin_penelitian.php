<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
 <!-- page content -->
 <div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Izin Penelitian</h3>
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
                        <?= validation_list_errors(); ?>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div style="margin-bottom: 10px;">
							<a href="<?= base_url("izin-penelitian/tambah"); ?>" class="btn btn-success btn-sm"><i class="fa fa-plus-square" style="margin-right: 5px;"></i>Ajukan Surat</a>
						</div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th width="1%">No</th>  
                                                <th>Tanggal Pengajuan</th>
                                                <th width="33%">Tujuan Surat</th>
                                                <th width="33%">Alamat Tujuan Surat</th>
                                                <th width="33%">Tempat Penelitian</th>
                                                <th width="10%">Jadwal</th>
                                                <th width="10%">Status</th>
                                                <th width="8%">Pesan</th>
                                                <th width="12%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $no = 1 ?>
                                        <?php foreach($semua_izin_penelitian as $sip): ?>
                                            <tr>
                                                <td><?= $no; ?></td>
                                                <td><?= tanggal_indo($sip['created_at']); ?></td>
                                                <td><?= $sip['tujuan_surat']; ?></td>
                                                <td><?= $sip['alamat_tempat_penelitian']; ?></td>
                                                <td><?= $sip['tempat_penelitian']; ?></td>
                                                <td><?= tanggal_indo($sip['tanggal_mulai']); ?> s.d <?= tanggal_indo($sip['tanggal_selesai']); ?></td>
                                                <td><?= $sip["status"] == "1" ? "<span class='badge badge-warning'>Belum diproses Admin</span>" : ($sip["status"] == "2" ? "<span class='badge badge-danger'>Ditolak Admin</span>" : ($sip["status"] == "3" ? "<span class='badge badge-success'>Menunggu diproses Kadep</span>" : ($sip["status"] == "4" ? "<span class='badge badge-danger'>Ditolak Kadep</span>" : ($sip["status"] == "5" ? "<span class='badge badge-success'>Disetujui Kadep</span>" : null)))) ; ?></td>
                                                <td><?= $sip['pesan']; ?></td>
                                                <td>
                                                    <?php if($sip['status'] == 5) { ?>
                                                        <form action="<?= base_url('/izin-penelitian/cetak'); ?>" target="_blank" method="POST">
                                                            <?= csrf_field(); ?>
                                                            <input type="hidden" name="uuid" value="<?= $sip['uuid']; ?>">
                                                            <button type="submit" class="btn btn-success"><i class="fa fa-print" style="margin-right: 5px;"></i>Cetak</button>
                                                        </form>
                                                    <?php }  ?>
                                                    <a href="<?= base_url('izin-penelitian/detail/'.$sip['uuid']); ?>" class="btn btn-primary btn-sm" ><i class="fa fa-file-text-o" style="margin-right: 5px;"></i>Detail</a>
                                                    <?php if($sip['nim_pengajuan'] == session()->get('username') && $sip['status'] == 1) {  ?>
                                                        <a href="<?= base_url('izin-penelitian/edit/'.$sip['uuid']); ?>" class="btn btn-warning btn-sm" ><i class="fa fa-edit" style="margin-right: 5px;"></i>Edit</a>
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
