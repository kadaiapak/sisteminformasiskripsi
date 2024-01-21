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
                        <h2>Daftar Membimbing Mahasiswa Ujian Skripsi</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th style="width: 2%;">No</th>
                                                <th style="width: 14%;">Nama</th>
                                                <th style="width: 6%;">NIM</th>
                                                <th style="width: 20%;">Judul Skripsi</th>
                                                <th style="width: 10%;">Tanggal Ujian</th>
                                                <th style="width: 6%;">Ruangan</th>
                                                <th style="width: 8%;">Sesi</th>
                                                <th style="width: 10%;">Status</th>
                                                <th style="width: 6%;">Sebagai</th>
                                                <th style="width: 18%;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $no = 1 ?>
                                        <?php foreach($semua_ujian_skripsi as $sus): ?>
                                            <tr>
                                                <td><?= $no; ?></td>
                                                <td><?= $sus['prf_nama_portal']; ?></td>
                                                <td><?= $sus['smr_nim_m']; ?></td>
                                                <td><?= $sus['judul_skripsi']; ?></td>
                                                <td><?= date('d-m-Y', strtotime($sus['us_tanggal'])) ; ?></td>
                                                <td><?= $sus['nama_ruangan']; ?></td>
                                                <td><?= $sus['sesi']; ?></td>
                                                <td>
                                                    <?= $sus['us_status'] == 5 ? "<span class='badge badge-warning'>Belum Terlaksana</span>" : ($sus['us_status'] == 6 ? "<span class='badge badge-success'>Sudah Terlaksana</span>" : null); ?>
                                                    <?= $sus['nilai_p'] == 1 ? "<span class='badge badge-success'>Sudah Dinilai Pembimbing</span>" : null; ?>
                                                    <?= $sus['nilai_p_satu'] == 1 ? "<span class='badge badge-success'>Sudah Dinilai Penguji Satu</span>" : null; ?>
                                                    <?= $sus['nilai_p_dua'] == 1 ? "<span class='badge badge-success'>Sudah Dinilai Penguji Dua</span>" : null; ?>
                                                    <?= $sus['berita_acara'] == 1 ? "<span class='badge badge-success'>Sudah Input Berita Acara</span>" : null; ?>
                                                </td>
                                                <td><?= $sus['sebagai']; ?></td>
                                                <?php if($sus['sebagai'] == 'Pembimbing' && $sus['berita_acara'] == 0 ) { ?>
                                                <td>
                                                    <?php if($sus['nilai_p'] == 0) { ?>
                                                        <a href="<?= base_url('ujian-skripsi/input-nilai/'.$sus['us_uuid']); ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit" style="margin-right: 5px;"></i>Input Nilai Pembimbing</a>
                                                    <?php }elseif($sus['nilai_p'] == 1) { ?>
                                                        <a href="<?= base_url('ujian-skripsi/edit-nilai/'.$sus['us_uuid']); ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit" style="margin-right: 5px;"></i>Edit Nilai Pembimbing</a>
                                                    <?php } ?>
                                                    <?php if($sus['nilai_p'] == 1 && $sus['nilai_p_satu'] == 1 && $sus['nilai_p_dua'] == 1) { ?>
                                                        <a href="<?= base_url('ujian-skripsi/berita-acara/'.$sus['us_uuid']); ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit" style="margin-right: 5px;"></i>Input Berita Acara</a>
                                                    <?php } ?>
                                                </td>
                                                <?php } ?>
                                                <?php if($sus['sebagai'] == 'Penguji Satu' && $sus['berita_acara'] == 0) { ?>
                                                <td>
                                                    <?php if($sus['nilai_p_satu'] == 0) { ?>
                                                        <a href="<?= base_url('ujian-skripsi/input-nilai/'.$sus['us_uuid']); ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit" style="margin-right: 5px;"></i>Input Nilai Penguji Satu</a>
                                                    <?php }elseif($sus['nilai_p_satu'] == 1) { ?>
                                                        <a href="<?= base_url('ujian-skripsi/edit-nilai/'.$sus['us_uuid']); ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit" style="margin-right: 5px;"></i>Edit Nilai Penguji Satu</a>
                                                    <?php } ?>
                                                </td>
                                                <?php } ?>
                                                <?php if($sus['sebagai'] == 'Penguji Dua' && $sus['berita_acara'] == 0) { ?>
                                                <td>
                                                    <?php if($sus['nilai_p_dua'] == 0) { ?>
                                                        <a href="<?= base_url('ujian-skripsi/input-nilai/'.$sus['us_uuid']); ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit" style="margin-right: 5px;"></i>Input Nilai Penguji Dua</a>
                                                    <?php }elseif($sus['nilai_p_dua'] == 1) { ?>
                                                        <a href="<?= base_url('ujian-skripsi/edit-nilai/'.$sus['us_uuid']); ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit" style="margin-right: 5px;"></i>Edit Nilai Penguji Dua</a>
                                                    <?php } ?>
                                                </td>
                                                <?php } ?>
                                                <?php if($sus['berita_acara'] == 1) { ?>
                                                    <td>
                                                        <a href="<?= base_url('ujian-skripsi/detail-nilai/'.$sus['us_uuid']); ?>" class="btn btn-primary btn-sm"><i class="fa fa-file-text-o" style="margin-right: 5px;"></i>Detail Nilai</a>
                                                    </td>
                                                <?php } ?>
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
