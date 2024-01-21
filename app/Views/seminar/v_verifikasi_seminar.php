<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="right_col" role="main">
    <div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Seminar Proposal</h3>
        </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
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
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Verifikasi Seminar</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <div class="form-group row ">
                            <label class="control-label col-md-3 col-sm-3" for="smr_nim_m">NIM</label>
                            <div class="col-md-9 col-sm-9 ">
                                <input readonly type="text" value="<?= $satu_seminar->smr_nim_m; ?>" name="smr_nim_m" class="form-control" id="smr_nim_m">
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label class="control-label col-md-3 col-sm-3" for="nama_mahasiswa">Nama Mahasiswa</label>
                            <div class="col-md-9 col-sm-9 ">
                                <input readonly type="text" value="<?= $satu_seminar->nama_mahasiswa; ?>" class="form-control" id="nama_mahasiswa" name="nama_mahasiswa">
                            </div>
                        </div> 
                        <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="judul_skripsi">Judul Skripsi</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <textarea readonly class="form-control" rows="3" name="judul_skripsi" id="judul_skripsi" placeholder="Isikan judul skripsi"><?= $satu_seminar->judul_skripsi; ?></textarea>
                                </div>
                        </div> 
                        <div class="form-group row ">
                            <label class="control-label col-md-3 col-sm-3" for="dosen_pembimbing">Nama Dosen PA</label>
                            <div class="col-md-9 col-sm-9 ">
                                <input readonly type="text" value="<?= $satu_seminar->d_pa_peg_gel_dep; ?><?= ($satu_seminar->d_pa_peg_gel_dep != '' ? '.' : '' ); ?><?= $satu_seminar->d_pa_peg_nama; ?>, <?= $satu_seminar->d_pa_peg_gel_bel; ?>" name="dosen_pa" class="form-control" id="dosen_pa" placeholder="Tuliskan NIM">
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label class="control-label col-md-3 col-sm-3" for="dosen_pembimbing">Nama Dosen Pembimbing</label>
                            <div class="col-md-9 col-sm-9 ">
                                <input readonly type="text" value="<?= $satu_seminar->d_pembimbing_peg_gel_dep; ?><?= ($satu_seminar->d_pembimbing_peg_gel_dep != '' ? '.' : '' ); ?><?= $satu_seminar->d_pembimbing_peg_nama; ?>, <?= $satu_seminar->d_pembimbing_peg_gel_bel; ?>" name="nim_mahasiswa" class="form-control" id="nim_mahasiswa" placeholder="Tuliskan NIM">
                            </div>
                        </div>
                        <?php if(session()->get('level') == '4' && $satu_seminar->smr_status == '3') { ?>
                        <form action="<?= base_url('seminar/'.$satu_seminar->smr_uuid.'/verifikasi_kadep'); ?>" method="post" id="verifikasi_kadep">
                        <?= csrf_field(); ?>
                        <!-- jika verifikator adalah kadep maka munculkan menu pilih dosen penguji satu dan penguji dua -->
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Dosen Penguji 1</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <select class="select2_single form-control" tabindex="-1" name="penguji_satu" <?= validation_show_error('penguji_satu') ? "style='border: 1px solid red'" : null; ?>>
                                        <option value="">--Pilih Dosen Penguji 1--</option>
                                        <?php foreach($dosen as $d): ?>
                                        <option value="<?=$d->nidn;?>"><?= $d->peg_gel_dep; ?> <?= $d->peg_nama; ?>, <?= $d->peg_gel_bel; ?>(p1=<?= $d->total_menguji_satu; ?>) (p2=<?= $d->total_menguji_dua; ?>)</option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback" style="text-align: left; display: block;">
                                        <?= validation_show_error('penguji_satu'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Dosen Penguji 2</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <select class="select2_single form-control" tabindex="-1" name="penguji_dua" <?= validation_show_error('penguji_dua') ? "style='border: 1px solid red'" : null; ?>>
                                        <option value="">--Pilih Dosen Penguji 2--</option>
                                        <?php foreach($dosen as $d): ?>
                                        <option value="<?=$d->nidn;?>"><?= $d->peg_gel_dep; ?> <?= $d->peg_nama; ?>, <?= $d->peg_gel_bel; ?>(p1=<?= $d->total_menguji_satu; ?>) (p2=<?= $d->total_menguji_dua; ?>)</option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback" style="text-align: left; display: block;">
                                        <?= validation_show_error('penguji_dua'); ?>
                                    </div>
                                </div>
                            </div>
                            <!-- akhir -->
                            <button type="submit" name="action" style="display: inline-block;" value="verifikasi_kadep" class="btn btn-primary"><i class="fa fa-check-square" style="margin-right: 5px;"></i>Terima Pengajuan</button>
                        </form>
                        <?php } ?>
                        <?php if(session()->get('level') == '4' && $satu_seminar->smr_status == '3') { ?>
                        <!-- Tolak pengajuan jika status pengajuan belum di proses dan verifikator adalah kadep-->
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target=".tolak_pengajuan_kadep"><i class="fa fa-times-circle" style="margin-right: 5px;"></i>Tolak Pengajuan</button>
                        <div class="modal fade tolak_pengajuan_kadep" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-sm" style="max-width: 500px;">
                                <form action="<?= base_url('seminar/'.$satu_seminar->smr_uuid.'/tolak_kadep'); ?>" method="post" id="tolak_admin">
                                    <?= csrf_field(); ?>
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="form-group row">
                                                <div class="col-md-12 col-sm-12">
                                                    <textarea class="form-control <?= validation_show_error('smr_pesan_kadep') ? 'is-invalid' : null; ?>" rows="3" name="smr_pesan_kadep" id="smr_pesan_kadep" placeholder="Tuliskan alasan penolakan"></textarea>
                                                    <div class="invalid-feedback" style="text-align: left;">
                                                        <?= validation_show_error('smr_pesan_kadep'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer" style="border: none; justify-content: center;">
                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fa fa-chevron-circle-left" style="margin-right: 5px;"></i> Batal</button>
                                            <button type="submit" name="action" class="btn btn-danger" value="tolak_admin"><i class="fa fa-times-circle" style="margin-right: 5px;"></i>Tolak Pengajuan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- akhir tolak pengajuan -->
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Detail Seminar</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="smr_hari">Tanggal Seminar</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input readonly type="text" value="<?= date('d-m-Y', strtotime($satu_seminar->smr_tanggal)) ; ?>" name="smr_hari" class="form-control" id="smr_hari">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="smr_hari">Hari</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input readonly type="text" value="<?= $satu_seminar->smr_hari == 1 ? 'Senin' : ($satu_seminar->smr_hari == 2 ? 'Selasa' : ($satu_seminar->smr_hari == 3 ? 'Rabu' : ($satu_seminar->smr_hari == 4 ? 'Kamis' : ($satu_seminar->smr_hari == 5 ? 'Jumat' : ($satu_seminar->smr_hari == 6 ? 'Sabtu' : ($satu_seminar->smr_hari == 7 ? 'Minggu' : '')))))); ?>" name="nim_mahasiswa" class="form-control" id="nim_mahasiswa" placeholder="Tuliskan NIM">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="smr_sesi">Sesi</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input readonly type="text" value="<?= $satu_seminar->seminar_sesi_alias; ?>" name="nim_mahasiswa" class="form-control" id="nim_mahasiswa" placeholder="Tuliskan NIM">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="smr_hari">Ruangan</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input readonly type="text" value="<?= $satu_seminar->seminar_ruangan_alias; ?>" name="nim_mahasiswa" class="form-control" id="nim_mahasiswa" placeholder="Tuliskan NIM">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="smr_status">Status Pengajuan Seminar</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <?= ($satu_seminar->smr_status == 1 ? "<span class='badge badge-warning'>Belum diproses Admin</span>" : ($satu_seminar->smr_status == 2 ? "<span class='badge badge-danger'>Seminar ditolak Admin</span>" : ($satu_seminar->smr_status == 3 ? "<span class='badge badge-success'>Menunggu Proses Kadep</span>" : ($satu_seminar->smr_status == 4 ? "<span class='badge badge-danger'>Seminar ditolak Kadep</span>" : ($satu_seminar->smr_status == 5 ? "<span class='badge badge-success'>Seminar disetujui Kadep</span>" : null))))); ?>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Berkas Persyaratan Seminar</h2>
                        <div class="clearfix"></div>
                    </div>
                    <?php if($persyaratan != null) {?>
                        <div class="x_content">
                            <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                                <?php $n = 1; ?>
                                <?php foreach ($persyaratan as $ps) { ?>
                                    <li class="nav-item">
                                        <a class="nav-link <?= $n == 1 ? 'active' : ''; ?>" id="b<?= $ps['persyaratan_id'] ?>-tab" data-toggle="tab" href="#b<?= $ps['persyaratan_id'] ?>" role="tab" aria-controls="b<?= $ps['persyaratan_id'] ?>" aria-selected="true"><?= $ps['judul']; ?></a>
                                    </li>
                                    <?php $n++; ?>
                                <?php } ?>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <?php $no = 1; ?>
                                <?php foreach ($persyaratan as $ps) { ?>
                                <div class="tab-pane fade <?= $no == 1 ? 'show active' : null; ?> " id="b<?= $ps['persyaratan_id'] ?>" role="tabpanel" aria-labelledby="b<?= $ps['persyaratan_id'] ?>-tab">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 ">
                                            <!-- <div class="x_panel">
                                                <div class="x_content">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="card-box table-responsive">
                                                                    <iframe src="/upload/seminar/< ?= $ps['nama_file']; ?>" frameborder="0" style="width: 100%; height: 100%; display: block;"></iframe>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> -->
                                            <div class="card" style="margin: 0; padding: 0; overflow: hidden; height: 75%;">
                                                <div class="card-body" >
                                                    <iframe src="/upload/seminar/<?= $ps['nama_file']; ?>" id="myframe" frameborder="0" style="width: 100%; height: 500px; display: block;"></iframe>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php $no++ ?>
                                <?php } ?>
                                <!-- akhir dari tab untuk pengajuan judul skripsi -->
                            </div>
                        </div>
                        <?php }else { ?>
                        <h4>Tidak ada Persyaratan</h4>
                        <?php } ?>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="form-group" style="display: flex;">
                        <?php if(session()->get('level') == '7' && $satu_seminar->smr_status == '1') { ?>
                        <!-- Tolak pengajuan jika status pengajuan belum di proses dan verifikator adalah admin departemen-->
                        <div class="button_container">
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target=".tolak_pengajuan_admin"><i class="fa fa-times-circle" style="margin-right: 5px;"></i>Tolak Pengajuan</button>
                        </div>
                        <div class="modal fade tolak_pengajuan_admin" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-sm" style="max-width: 500px;">
                                <form action="<?= base_url('seminar/'.$satu_seminar->smr_uuid.'/tolak_admin'); ?>" method="post" id="tolak_admin">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="idSeminar" value="<?= $satu_seminar->smr_id; ?>">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="form-group row">
                                                <div class="col-md-12 col-sm-12">
                                                    <textarea class="form-control <?= validation_show_error('smr_pesan_admin') ? 'is-invalid' : null; ?>" rows="3" name="smr_pesan_admin" id="smr_pesan_admin" placeholder="Tuliskan alasan penolakan"></textarea>
                                                    <div class="invalid-feedback" style="text-align: left;">
                                                        <?= validation_show_error('smr_pesan_admin'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer" style="border: none; justify-content: center;">
                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fa fa-chevron-circle-left" style="margin-right: 5px;"></i> Batal</button>
                                            <button type="submit" name="action" class="btn btn-danger" value="tolak_admin"><i class="fa fa-times-circle" style="margin-right: 5px;"></i>Tolak Pengajuan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- akhir tolak pengajuan -->
                        <!-- terima pengajuan jika status pengajuan belum di proses dan verifikator adalah admin departemen-->
                        <div class="button_container">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".terima_pengajuan_admin"><i class="fa fa-check-square" style="margin-right: 5px;"></i>Terima Pengajuan</button>
                        </div>
                        <div class="modal fade terima_pengajuan_admin" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-sm" style="max-width: 500px;">
                                <form action="<?= base_url('seminar/'.$satu_seminar->smr_uuid.'/verifikasi_admin'); ?>" method="post" id="tolak_admin">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="idSeminar" value="<?= $satu_seminar->smr_id; ?>">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="form-group row ">
                                                <label class="control-label col-lg-12 col-md-12 col-sm-12" for="nomor_surat">Inputkan Nomor Surat (contoh: 223/UN35.4.8/KM/2023)</label>
                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <input type="text" name="nomor_surat" class="form-control <?= validation_show_error('nomor_surat') ? 'is-invalid' : null; ?>" id="nomor_surat" placeholder="223/UN35.4.8/KM/2023">
                                                    <div class="invalid-feedback" style="text-align: left; display: block;">
                                                    <?= validation_show_error('nomor_surat'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer" style="border: none; justify-content: center;">
                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fa fa-chevron-circle-left" style="margin-right: 5px;"></i> Batal</button>
                                            <button type="submit" name="action" class="btn btn-primary" value="tolak_admin"><i class="fa fa-check-square" style="margin-right: 5px;"></i>Terima Pengajuan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- akhir terima pengajuan -->
                        <?php } ?>
                        <?php if(session()->get('level') == '7' && ($satu_seminar->smr_status == '2' || $satu_seminar->smr_status == '3')){ ?>
                            <!-- jika level admin dan status pengajuan adalah ditolak admin -->
                            <form action="<?= base_url('seminar/'.$satu_seminar->smr_uuid.'/kembalikan_status'); ?>" method="post">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="idSeminar" value="<?= $satu_seminar->smr_id; ?>">
                                <button type="submit" name="action" class="btn btn-warning btn-sm"><i class="fa fa-exclamation-triangle" style="margin-right: 5px;"></i>Kembalikan ke status proses</button>
                            </form>
                        <?php } ?>
                        <a href="<?= base_url('/seminar/semua-seminar'); ?>" class="btn btn-warning btn-sm"><i class="fa fa-chevron-circle-left" style="margin-right: 5px;"></i>Kembali</a> 
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
