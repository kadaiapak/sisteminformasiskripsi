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
                                                <th>Judul Skripsi</th>
                                                <th>Hari</th>
                                                <th>Tanggal Seminar</th>
                                                <th>Nama Ruangan</th>
                                                <th>Sesi Ruangan</th>
                                                <th>Status</th>
                                                <th>Sebagai</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $no = 1 ?>
                                        <?php foreach($semua_seminar as $ssr): ?>
                                            <tr>
                                                <td><?= $no; ?></td>
                                                <td><?= $ssr['prf_nama_portal']; ?></td>
                                                <td><?= $ssr['smr_nim_m'] ?></td>
                                                <td><?= $ssr['judul_skripsi'] ?></td>
                                                <td><?= $ssr['smr_hari'] == 1 ? 'Senin' : ($ssr['smr_hari'] == 2 ? 'Selasa' : ($ssr['smr_hari'] == 3 ? 'Rabu' : ($ssr['smr_hari'] == 4 ? 'Kamis' : ($ssr['smr_hari'] == 5 ? 'Jumat' : ($ssr['smr_hari'] == 6 ? 'Sabtu' : ($ssr['smr_hari'] == 7 ? 'Minggu' : '')))) ))  ?></td>
                                                <td><?= date('d-m-Y', strtotime($ssr['smr_tanggal'])) ; ?></td>
                                                <td><?= $ssr['ruangan_alias'] ?></td>
                                                <td><?= $ssr['jam_alias']; ?></td>
                                                <td><?= $ssr['sudah_terlaksana'] == 0 ? "<span class='badge badge-warning'>Belum Terlaksana</span>" : ($ssr['sudah_terlaksana'] == 1 ? "<span class='badge badge-success'>Sudah Terlaksana</span>" : ""); ?></td>
                                                <td><?= $ssr['sebagai']; ?></td>
                                                <td>
                                                    <?php if(session()->get('level') == '4' || session()->get('level') == '7') { ?>
                                                    <!-- jika level adalah admin departemen atau kadep maka url nya -->
                                                    <a href="<?= base_url('seminar/'.$ssr['smr_uuid'].'/verifikasi'); ?>" class="btn btn-primary btn-sm">Detail</a>
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
