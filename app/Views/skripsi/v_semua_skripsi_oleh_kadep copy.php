<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

 <!-- page content -->
 <div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Judul Skripsi</h3>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Daftar Pengajuan Judul</h2>
                        <a href="<?= base_url('skripsi/ajukan-judul'); ?>" class="btn btn-success btn-sm" style="margin-left: 5px;" ><i class="fa fa-file-excel-o" style="margin-right: 5px;"></i>Download Excel</a>
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
                                                <th>Nama Pengusul</th>
                                                <th>NIM</th>
                                                <th>Judul Skripsi</th>
                                                <th>Nama Pembimbing</th>
                                                <th>Nama PA</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $no = 1 ?>
                                        <?php foreach($semua_skripsi as $ss): ?>
                                            <tr>
                                                <td><?= $no; ?></td>
                                                 <td><?= $ss['nama_mahasiswa'] ?></td>
                                                <td><?= $ss['nim_mahasiswa'] ?></td>
                                                <td><?= $ss['judul_skripsi']; ?></td>
                                                <td><?= $ss['d_pembimbing_peg_gel_dep']; ?> <?= $ss['d_pembimbing_peg_nama']; ?> <?= $ss['d_pembimbing_peg_gel_bel']; ?></td>
                                                <td><?= $ss['d_pa_peg_gel_dep']; ?> <?= $ss['d_pa_peg_nama']; ?> <?= $ss['d_pa_peg_gel_bel']; ?></td>
                                                <td><?= ($ss['status_pengajuan_skripsi'] == 1 ? "<span class='badge badge-warning'>Menunggu diproses</span>" : ($ss['status_pengajuan_skripsi'] == 2 ? "<span class='badge badge-danger'>Judul ditolak</span>" : ($ss['status_pengajuan_skripsi'] == 3 ? "<span class='badge badge-success'>Judul diterima</span>" : ($ss['status_pengajuan_skripsi'] == 4 ? "<span class='badge badge-success'>Proses Bimbingan</span>" : ($ss['status_pengajuan_skripsi'] == 5 ? "<span class='badge badge-success'>Seminar Proposal</span>" : ($ss['status_pengajuan_skripsi'] == 6 ? "<span class='badge badge-success'>Ujian Skripsi</span>" : null )))))); ?></td>
                                                <td>
                                                    <?php if($ss['status_pengajuan_skripsi'] == 1 ){ ?>
                                                    <a href="<?= base_url('skripsi/verifikasi/'.$ss['skripsi_uuid']); ?>" class="btn btn-primary btn-sm"><i class="fa fa-check-square-o" style="margin-right: 5px;"></i>Verifikasi</a>
                                                    <?php }else { ?>
                                                        <a href="<?= base_url('skripsi/verifikasi/'.$ss['skripsi_uuid']); ?>" class="btn btn-secondary btn-sm"><i class="fa fa-file-text-o" style="margin-right: 5px;"></i>Detail</a>
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
