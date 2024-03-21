<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
 <!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Skripsi</h3>
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
                        <h2>Progress Skripsi</small></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
                        <section class="step-wizard">
                            <ul class="step-wizard-list">
                                <li class="<?= $progressAdalahJudul ? 'step-wizard-item current-item' : 'step-wizard-item'; ?>">
                                    <span class="progress-count">1</span>
                                    <span class="progress-label">Pengajuan Judul Skripsi</span>
                                </li>
                                <li class="<?= $progressAdalahBimbingan && !$progressAdalahSeminar? 'step-wizard-item current-item' : 'step-wizard-item'; ?>" >
                                    <span class="progress-count">2</span>
                                    <span class="progress-label">Bimbingan</span>
                                </li>
                                <li class="<?= $progressAdalahSeminar && $progressAdalahBimbingan && !$progressAdalahUjian? 'step-wizard-item current-item' : 'step-wizard-item'; ?>">
                                    <span class="progress-count">3</span>
                                    <span class="progress-label">Seminar Proposal</span>
                                </li>
                                <li class="<?= $progressAdalahUjian && !$progressAdalahFinal ? 'step-wizard-item current-item' : 'step-wizard-item'; ?>">
                                    <span class="progress-count">4</span>
                                    <span class="progress-label">Ujian Skripsi</span>
                                </li>
                                <li class="<?= $progressAdalahFinal ? 'step-wizard-item' : 'step-wizard-item'; ?>">
                                    <span class="progress-count">5</span>
                                    <span class="progress-label">Finalisasi</span>
                                </li>   
                            </ul>
                        </section>
                        <!-- akhir dari another custom wizard -->
                        <div class="x_panel">
                            <div class="x_content">
                                <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="progress-tab" data-toggle="tab" href="#progress" role="tab" aria-controls="progress" aria-selected="true">Pengajuan Judul</a>
                                    </li>
                                    <?php if($formBimbinganTerbuka) { ?>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Bimbingan Skripsi</a>
                                    </li>   
                                    <?php } ?>
                                    <?php if($formSeminarTerbuka) { ?>
                                    <li class="nav-item">
                                        <a class="nav-link" id="skripsi-tab" data-toggle="tab" href="#skripsi" role="tab" aria-controls="skripsi" aria-selected="false">Seminar Proposal</a>
                                    </li>
                                    <?php } ?>
                                    <?php if($formUjianTerbuka) { ?>
                                    <li class="nav-item">
                                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Ujian Skripsi</a>
                                    </li>
                                    <?php } ?>
                                    <?php if(1!=1) { ?>
                                    <li class="nav-item">
                                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#final" role="tab" aria-controls="final" aria-selected="false">Finalisasi</a>
                                    </li>
                                    <?php } ?>

                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <!-- tab untuk pengajuan judul skripsi -->
                                    <div class="tab-pane fade show active" id="progress" role="tabpanel" aria-labelledby="progress-tab">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 ">
                                                <div class="x_panel">
                                                    <div class="x_title">
                                                        <?php if($bisaTambahJudul) { ?>
                                                            <a href="<?= base_url('skripsi/ajukan-judul'); ?>" class="btn btn-success btn-sm"><i class="fa fa-plus-square" style="margin-right: 5px;"></i>Ajukan judul</a>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="x_content">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="card-box table-responsive">
                                                                    <table class="table table-striped table-bordered" style="width:100%">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Tanggal</th>
                                                                                <th>Judul Skripsi</th>
                                                                                <th>Dosen Pembimbing</th>
                                                                                <th>Dosen PA</th>
                                                                                <th>Catatan</th>
                                                                                <th>Status</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php foreach($semua_skripsi as $ss): ?>
                                                                            <tr>
                                                                                <td><?= date('d-m-Y', strtotime($ss['created_at'])) ; ?></td>
                                                                                <td><?= $ss['judul_skripsi'] ?></td>
                                                                                <td><?= $ss['d_pembimbing_peg_gel_dep']; ?> <?= $ss['d_pembimbing_peg_nama']; ?> <?= $ss['d_pembimbing_peg_gel_bel']; ?></td>
                                                                                <td><?= $ss['d_pa_peg_gel_dep']; ?> <?= $ss['d_pa_peg_nama']; ?> <?= $ss['d_pa_peg_gel_bel']; ?></td>
                                                                                <td><?= $ss['pesan']; ?></td>
                                                                                <td><?= ($ss['status_pengajuan_skripsi'] == 1 ? "<span class='badge badge-warning'>Menunggu diproses</span>" : ($ss['status_pengajuan_skripsi'] == 2 ? "<span class='badge badge-danger'>Judul ditolak</span>" : ($ss['status_pengajuan_skripsi'] == 3 ? "<span class='badge badge-success'>Judul diterima</span>" : ($ss['status_pengajuan_skripsi'] == 4 ? "<span class='badge badge-success'>Bimbingan</span>" : ($ss['status_pengajuan_skripsi'] == 5 ? "<span class='badge badge-success'>Seminar Proposal</span>" : null))))); ?></td>
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
                                    <!-- akhir dari tab untuk pengajuan judul skripsi -->
                                    <!-- tab untuk tambah bimbingan -->
                                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 ">
                                                <div class="x_panel">
                                                    <div class="x_title">
                                                    <?php if($bisaTambahBimbingan) { ?>
                                                        <a href="<?= base_url("bimbingan/tambah-bimbingan"); ?>" class="btn btn-success btn-sm"><i class="fa fa-plus-square" style="margin-right: 5px;"></i>Ajukan Bimbingan</a>
                                                    <?php } ?>
                                                        <a href="<?= base_url("seminar/mengikuti-seminar"); ?>" class="btn btn-success btn-sm"><i class="fa fa-plus-square" style="margin-right: 5px;"></i>Mengikuti Seminar Proposal</a>
                                                    </div>
                                                    <div class="x_content">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="card-box table-responsive">
                                                                    <table class="table table-striped table-bordered" style="width:100%">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Tanggal</th>
                                                                                <th>Subjek</th>
                                                                                <th>Isi</th>
                                                                                <th>Data Dukung</th>
                                                                                <th>Status</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php foreach($semua_bimbingan as $sb): ?>
                                                                            <tr>
                                                                                <td><?= date('d-m-Y', strtotime($sb['bb_waktu'])) ; ?></td>
                                                                                <td><?= $sb['bb_subjek'] ?></td>
                                                                                <td><?= $sb['bb_isi']; ?></td>
                                                                                <td><?= $sb['data_dukung']; ?></td>
                                                                                <td><?= ($sb['is_verifikasi'] == 1 ? "<span class='badge badge-success'>Sudah diverifikasi</span>" : ($sb['is_verifikasi'] == 0 ? "<span class='badge badge-danger'>Belum diverifikasi</span>" : null)); ?></td>
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
                                            <!-- timeline -->
                                            <div class="col-lg-4 col-md-4 col-sm-4">
                                                <div class="x_panel">
                                                    <div class="x_title">
                                                        <h2>Timeline Bimbingan</h2>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                    <div class="x_content">
                                                        <ul class="list-unstyled timeline">
                                                            <?php foreach($semua_bimbingan as $sb): ?>
                                                            <li>
                                                                <div class="block">
                                                                    <div class="tags">
                                                                        <a href class="tag" <?= $sb['is_verifikasi'] == 0 ? "style='background-color:red;'" : null; ?>><span><?= $sb['is_verifikasi'] == 1 ? 'Verifikasi' : 'Belum Verifikasi'; ?></span></a>
                                                                    </div>
                                                                    <div class="block_content">
                                                                        <h2 class="title"><a><?= $sb['bb_subjek'] ?></a></h2>
                                                                        <div class="byline">
                                                                            <span><?= date('d-m-Y', strtotime($sb['bb_waktu'])) ; ?></span>
                                                                        </div>
                                                                        <p class="excerpt"><?= $sb['bb_isi']; ?></p>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <?php endforeach; ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- akhir dari timeline -->
                                             <!-- timeline -->
                                             <div class="col-lg-8 col-md-8 col-sm-8">
                                                <div class="x_panel">
                                                    <div class="x_title">
                                                        <h2>Daftar Seminar Yang Diikuti</h2>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                    <div class="x_content">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="card-box table-responsive">
                                                                    <table class="table table-striped table-bordered" style="width:100%">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Tanggal Mengikuti</th>
                                                                                <th>Nim yang diikuti</th>
                                                                                <th>Nama yang diikuti</th>
                                                                                <th>Data Dukung</th>
                                                                                <th>Status</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php foreach($mengikuti_seminar as $ms): ?>
                                                                            <tr>
                                                                                <td><?= date('d-m-Y', strtotime($ms['tanggal_mengikuti'])) ; ?></td>
                                                                                <td><?= $ms['nim_diikuti'] ?></td>
                                                                                <td><?= $ms['nama_diikuti']; ?></td>
												                                <td class=" "><img style="width: 50px; height: 50px;" src="<?= base_url('/upload/mengikuti_seminar/'.$ms['foto_selfi']); ?>" alt=""></td>
                                                                                <td><?= ($ms['status'] == 1 ? "<span class='badge badge-warning'>Menunggu diproses</span>" : ($ms['status'] == 2 ? "<span class='badge badge-danger'>Ditolak</span>" : ($ms['status'] == 3 ? "<span class='badge badge-success'>Judul diterima</span>" : null))); ?></td>
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
                                            <!-- akhir dari timeline -->
                                            
                                           
                                        </div>
                                    </div>
                                    <!-- akhir dari tab untuk tambah bimbingan -->

                                    <!-- tab untuk pengajuan seminar proposal -->
                                    <div class="tab-pane fade" id="skripsi" role="tabpanel" aria-labelledby="skripsi-tab">
                                        
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 ">
                                                <div class="x_panel">
                                                <?php if($bisaTambahSeminar) { ?>
                                                    <div class="x_title">
                                                        <a href="<?= base_url("seminar/ajukan-seminar"); ?>" class="btn btn-success btn-sm"><i class="fa fa-plus-square" style="margin-right: 5px;"></i>Ajukan Seminar Proposal</a>
                                                    </div>
                                                    <?php } ?>
                                                    <div class="x_content">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="card-box table-responsive">
                                                                    <table class="table table-striped table-bordered" style="width:100%">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Tanggal Pengajuan</th>
                                                                                <th>Tanggal Seminar</th>
                                                                                <th>Judul Skripsi</th>
                                                                                <th>Dosen Pembimbing</th>
                                                                                <th>Proses</th>
                                                                                <th>Pesan Admin</th>
                                                                                <th>Pesan Kadep</th>
                                                                                <th>Aksi</th>
                                                                                </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php foreach($semua_seminar as $ssr): ?>
                                                                            <tr>
                                                                                <td><?= date('d-m-Y', strtotime($ssr['created_at'])) ; ?></td>
                                                                                <td><?= date('d-m-Y', strtotime($ssr['smr_tanggal'])) ; ?></td>
                                                                                <td><?= $ssr['judul_skripsi'] ?></td>
                                                                                <td><?= $ssr['d_pembimbing_peg_gel_dep']; ?> <?= $ssr['d_pembimbing_peg_nama']; ?> <?= $ssr['d_pembimbing_peg_gel_bel']; ?></td>
                                                                                <td><?= $ssr['smr_status'] == 1 ? "<span class='badge badge-warning'>Menunggu diproses</span>" : ($ssr['smr_status'] == 2 ? "<span class='badge badge-danger'>Pengajuan ditolak Admin</span>" : ($ssr['smr_status'] == 3 ? "<span class='badge badge-success'>Pengajuan diverifikasi Admin</span>" : ($ssr['smr_status'] == 4 ? "<span class='badge badge-danger'>Pengajuan ditolak Kadep</span>" : ($ssr['smr_status'] == 5 ? "<span class='badge badge-success'>Pengajuan disetujui Kadep</span>" : "")))); ?> </td>
                                                                                <td><?= $ssr['smr_pesan_admin']; ?></td>
                                                                                <td><?= $ssr['smr_pesan_kadep']; ?></td>
                                                                                <td>
                                                                                    <a href="<?= base_url('seminar/detail/'.$ssr['smr_uuid'].'/'.$ssr['smr_id']); ?>" class="btn btn-primary"><i class="fa fa-file-text-o" style="margin-right: 5px;"></i>Detail</a>
                                                                                    <?php if($ssr['smr_status'] == 5 || $ssr['smr_status'] == 6) { ?>
                                                                                        <button class="btn btn-success" onclick="window.open('<?= base_url('seminar/print-surat/'.$ssr['smr_uuid']) ?>', 'blank')"><i class="fa fa-print" style="margin-right: 5px;"></i>Cetak Surat</button>
                                                                                    <?php }  ?>
                                                                                    <!-- <a href="< ?= base_url('seminar/'.$ssr['smr_uuid'].'/edit'); ?>" class="btn btn-warning">Edit</a> -->
                                                                                </td>
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
                                    <!-- akhir dari tab untuk pengajuan seminar proposal -->
                                    <!-- tab untuk pengajuan ujian kompre -->
                                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                        
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 ">
                                                <div class="x_panel">
                                                    <div class="x_title">
                                                        <a href="<?= base_url("ujian-skripsi/ajukan"); ?>" class="btn btn-success"><i class="fa fa-plus-square" style="margin-right: 5px;"></i>Ajukan Ujian Akhir</a>
                                                    </div>
                                                    <div class="x_content">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="card-box table-responsive">
                                                                    <table class="table table-striped table-bordered" style="width:100%">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>No</th>
                                                                                <th>Tanggal Mengajukan</th>
                                                                                <th>Tanggal Ujian</th>
                                                                                <th>Hari</th>
                                                                                <th>Ruangan</th>
                                                                                <th>Sesi</th>
                                                                                <th>Status</th>
                                                                                <th>Pesan</th>
                                                                                <th>Aksi</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php $no = 1 ?>
                                                                            <?php foreach($semua_ujian as $su): ?>
                                                                            <tr>
                                                                                <td><?= $no; ?></td>
                                                                                <td><?= date('d-m-Y', strtotime($su['created_at'])) ; ?></td>
                                                                                <td><?= date('d-m-Y', strtotime($su['us_tanggal'])) ; ?></td>
                                                                                <td><?= $su['us_hari'] == 1 ? 'Senin' : ($su['us_hari'] == 2 ? 'Selasa' : ($su['us_hari'] == 3 ? 'Rabu' : ($su['us_hari'] == 4 ? 'Kamias' : ($su['us_hari'] == 5 ? 'Jumat' : ($su['us_hari'] == 6 ? 'Sabtu' : ($su['us_hari'] == 7 ? 'Minggu' : null))))) ) ?></td>
                                                                                <td><?= $su['ujian_ruangan_alias']; ?></td>
                                                                                <td><?= $su['ujian_sesi_alias']; ?></td>
                                                                                <td><?= $su['us_status'] == 1 ? "<span class='badge badge-warning'>Menunggu diproses</span>" : ($su['us_status'] == 2 ? "<span class='badge badge-danger'>Pengajuan ditolak Admin</span>" : ($su['us_status'] == 3 ? "<span class='badge badge-success'>Pengajuan diverifikasi Admin</span>" : ($su['us_status'] == 4 ? "<span class='badge badge-danger'>Pengajuan ditolak Kadep</span>" : ($su['us_status'] == 5 ? "<span class='badge badge-success'>Pengajuan disetujui Kadep</span>" : "")))); ?> </td>
                                                                                <td><?= $su['us_pesan_admin']; ?><?= $su['us_pesan_kadep']; ?></td>
                                                                                <td>
                                                                                    <a href="<?= base_url('ujian-skripsi/detail/'.$su['us_uuid']); ?>" class="btn btn-primary btn-sm" style="font-size: 10px;"><i class="fa fa-file-text-o" style="margin-right: 5px;"></i>Detail</a>
                                                                                    <?php if($su['us_status'] == 5 || $su['us_status'] == 6) { ?>
                                                                                        <button style="font-size: 10px;" class="btn btn-success" onclick="window.open('<?= base_url('ujian-skripsi/print-surat/'.$su['us_uuid']) ?>', 'blank')"><i class="fa fa-print" style="margin-right: 5px;"></i>Cetak Surat</button>
                                                                                    <?php }  ?>
                                                                                </td>
                                                                            </tr>
                                                                            <?php $no++ ?>
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
                                    <!-- akhir dari tab untuk pengajuan seminar proposal -->
                                </div>
                            </div>
                        </div>
                    <!-- Tabs -->
                    <!-- End SmartWizard Content -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        <!-- /page content -->
<?= $this->endSection(); ?>