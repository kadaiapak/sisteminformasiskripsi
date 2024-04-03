<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

 <!-- page content -->
 <div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Seminar Proposal</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Daftar Pengajuan Seminar</h2>
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
                                                <th>Tanggal Pengajuan</th>
                                                <th>Nama Pembimbing</th>
                                                <th>Nama Ruangan</th>
                                                <th>Sesi Ruangan</th>
                                                <th>Tanggal Seminar</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $no = 1 ?>
                                        <?php foreach($semua_seminar as $ssr): ?>
                                            <tr>
                                                <td><?= $no; ?></td>
                                                <td><?= $ssr['nama_mahasiswa'] ?></td>
                                                <td><?= $ssr['smr_nim_m'] ?></td>
                                                <td><?= date('d-m-Y', strtotime($ssr['created_at'])) ; ?></td>
                                                <td><?= $ssr['d_pembimbing_peg_gel_dep']; ?> <?= $ssr['d_pembimbing_peg_nama']; ?> <?= $ssr['d_pembimbing_peg_gel_bel']; ?></td>
                                                <td><?= $ssr['seminar_ruangan_alias']; ?></td>
                                                <td><?= $ssr['seminar_sesi_alias']; ?></td>
                                                <td><?= date('d-m-Y', strtotime($ssr['smr_tanggal'])); ?></td>
                                                <td><?= ($ssr['smr_status'] == 1 ? "<span class='badge badge-warning'>Belum diproses Admin</span>" : ($ssr['smr_status'] == 2 ? "<span class='badge badge-danger'>Seminar ditolak Admin</span>" : ($ssr['smr_status'] == 3 ? "<span class='badge badge-info'>Menunggu Proses Kadep</span>" : ($ssr['smr_status'] == 4 ? "<span class='badge badge-danger'>Seminar ditolak Kadep</span>" : ($ssr['smr_status'] == 5 ? "<span class='badge badge-success'>Disetujui</span>" : null))))); ?></td>
                                                <td>
                                                    <?php if(session()->get('level') == '4' || session()->get('level') == '7') { ?>
                                                    <!-- jika level adalah admin departemen atau kadep maka url nya -->
                                                    <a href="<?= base_url('seminar/verifikasi/'.$ssr['smr_uuid'].'/'.$ssr['smr_id']); ?>" class="btn btn-primary btn-sm" ><i class="fa fa-check-square-o" style="margin-right: 5px;"></i>Verifikasi</a>
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
