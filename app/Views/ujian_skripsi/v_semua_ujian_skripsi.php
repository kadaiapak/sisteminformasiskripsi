<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

 <!-- page content -->
 <div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Ujian Skripsi</h3>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Daftar Pengajuan Ujian Skripsi</h2>
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
                                                <th>Tanggal Ujian</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $no = 1 ?>
                                        <?php foreach($semua_ujian as $su): ?>
                                            <tr>
                                                <td><?= $no; ?></td>
                                                <td><?= $su['nama_mahasiswa'] ?></td>
                                                <td><?= $su['us_nim_m'] ?></td>
                                                <td><?= date('d-m-Y', strtotime($su['created_at'])) ; ?></td>
                                                <td><?= $su['d_pembimbing_peg_gel_dep']; ?> <?= $su['d_pembimbing_peg_nama']; ?> <?= $su['d_pembimbing_peg_gel_bel']; ?></td>
                                                <td><?= $su['ujian_ruangan_alias']; ?></td>
                                                <td><?= $su['ujian_sesi_alias']; ?></td>
                                                <td><?= date('d-m-Y', strtotime($su['us_tanggal'])); ?></td>
                                                <td><?= ($su['us_status'] == 1 ? "<span class='badge badge-warning'>Belum diproses Admin</span>" : ($su['us_status'] == 2 ? "<span class='badge badge-danger'>Seminar ditolak Admin</span>" : ($su['us_status'] == 3 ? "<span class='badge badge-success'>Menunggu Proses Kadep</span>" : ($su['us_status'] == 4 ? "<span class='badge badge-danger'>Seminar ditolak Kadep</span>" : ($su['us_status'] == 5 ? "<span class='badge badge-success'>Seminar disetujui Kadep</span>" : null))))); ?></td>
                                                <td>
                                                    <?php if(session()->get('level') == '4' || session()->get('level') == '7') { ?>
                                                    <!-- jika level adalah admin atau kadep maka url nya -->
                                                    <a href="<?= base_url('ujian-skripsi/verifikasi/'.$su['us_uuid'].'/'.$su['us_id']); ?>" class="btn btn-primary">Detail</a>
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
