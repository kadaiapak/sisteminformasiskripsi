<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
 <!-- page content -->
 <div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Validator Instrumen</h3>
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
                        <h2>Semua Pengajuan Belum Verifikasi</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal Pengajuan</th>
                                                <th>NIM</th>
                                                <th>Nama Mahasiswa</th>
                                                <th>Departemen</th>
                                                <th>Judul</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $no = 1 ?>
                                        <?php foreach($semua_validator_instrumen as $svi): ?>
                                            <tr>
                                                <td><?= $no; ?></td>
                                                <td><?= tanggal_indo($svi['created_at']); ?></td>
                                                <td><?= $svi['nim_pengajuan']; ?></td>
                                                <td><?= $svi['nama_pengajuan']; ?></td>
                                                <td><?= $svi['nama_departemen']; ?></td>
                                                <td><?= $svi['judul']; ?></td>
                                                <td><?= $svi["status"] == "1" ? "<span class='badge badge-warning'>Belum diproses Admin</span>" : ($svi["status"] == "2" ? "<span class='badge badge-danger'>Ditolak Admin</span>" : ($svi["status"] == "3" ? "<span class='badge badge-success'>Menunggu diproses Kadep</span>" : ($svi["status"] == "4" ? "<span class='badge badge-danger'>Ditolak Kadep</span>" : ($svi["status"] == "5" ? "<span class='badge badge-success'>Disetujui Kadep</span>" : null)))) ; ?></td>
                                                <td>
                                                    <?php if(session()->get('level') == '7') { ?>
                                                        <!-- jika level adalah admin departemen atau kadep maka url nya -->
                                                        <a href="<?= base_url('validator-instrumen/edit-admin/'.$svi['uuid']); ?>" class="btn btn-warning btn-sm" ><i class="fa fa-edit" style="margin-right: 5px;"></i>Edit</a>
                                                        <!-- end -->
                                                    <?php } ?>
                                                    <?php if(session()->get('level') == '7' || session()->get('level') == '4') { ?>
                                                        <!-- jika level adalah admin departemen atau kadep maka url nya -->
                                                        <a href="<?= base_url('validator-instrumen/detail-verifikasi/'.$svi['uuid']); ?>" class="btn btn-primary btn-sm" ><i class="fa fa-check-square-o" style="margin-right: 5px;"></i>Verifikasi</a>
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
<?= $this->endSection(); ?>
