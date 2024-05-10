<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Judul Skripsi</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <?php if(validation_show_error('pesan')) : ?>
            <div class="alert alert-danger alert-dismissible " role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <strong>Gagal!</strong> <?= validation_show_error('pesan') ?>.
            </div>
        <?php endif; ?>
        <?php if(validation_show_error('dosen_pembimbing')) : ?>
            <div class="alert alert-danger alert-dismissible " role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <strong>Gagal!</strong> <?= validation_show_error('dosen_pembimbing') ?>.
            </div>
        <?php endif; ?>
        <?php if(validation_show_error('dosen_pa')) : ?>
            <div class="alert alert-danger alert-dismissible " role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <strong>Gagal!</strong> <?= validation_show_error('dosen_pa') ?>.
            </div>
        <?php endif; ?>
        <?php if(validation_show_error('penguji_satu')) : ?>
            <div class="alert alert-danger alert-dismissible " role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <strong>Gagal!</strong> <?= validation_show_error('penguji_satu') ?>.
            </div>
        <?php endif; ?>
        <?php if(validation_show_error('penguji_dua')) : ?>
            <div class="alert alert-danger alert-dismissible " role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <strong>Gagal!</strong> <?= validation_show_error('penguji_dua') ?>.
            </div>
        <?php endif; ?>
        <form class="form-horizontal form-label-left" method="POST" action="<?= base_url('skripsi/'.$single_skripsi['skripsi_uuid'].'/proses'); ?>">
        <?= csrf_field(); ?>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Verifikasi Judul Skripsi</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <input type="hidden" name="skripsi_uuid" value="<?= $single_skripsi['skripsi_uuid']; ?>">
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="nim_mahasiswa">NIM</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" readonly name="nim_mahasiswa" class="form-control" id="nim_mahasiswa" placeholder="Tuliskan NIM" value="<?= $single_skripsi['nim_mahasiswa']; ?>">
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="nama_mahasiswa">Nama Mahasiswa</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" readonly class="form-control" id="nama_mahasiswa" name="nama_mahasiswa" placeholder="Tuliskan Nama" value="<?= $single_skripsi['nama_mahasiswa']; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="periode_pengajuan">Periode Pengajuan</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <select class="form-control" name="periode_pengajuan" style="pointer-events: none; background-color: #e9ecef;" onclick="return false;" onkeydown="return false;">
                                        <option>Pilih Periode</option>
                                        <option value="1" <?= ($single_skripsi['periode_pengajuan'] == '1' ? 'selected' : 'disabled'); ?>>Januari - Juni</option>
                                        <option value="2" <?= ($single_skripsi['periode_pengajuan'] == '2' ? 'selected' : 'disabled'); ?>>Juli - Desember</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="tahun_pengajuan">Tahun Pengajuan</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input readonly type="number" class="form-control" id="tahun_pengajuan" name="tahun_pengajuan" placeholder="Masukkan tahun" value="<?= $single_skripsi['tahun_pengajuan']; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="judul_skripsi">Judul Skripsi <span class="required">*</span>
                                </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <textarea readonly class="form-control" rows="3" name="judul_skripsi" id="judul_skripsi" placeholder="Isikan judul skripsi"><?= $single_skripsi['judul_skripsi']; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="deskripsi_skripsi">Deskripsi skripsi<span class="required">*</span>
                                </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <textarea readonly class="form-control" rows="3" name="deskripsi_skripsi" placeholder="Jelaskan singkat mengenai skripsi skripsi yang dipilih"><?= $single_skripsi['deskripsi_skripsi']; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="konsentrasi_bidang">Konsentrasi Bidang <span class="required"></span>
                                </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <textarea readonly class="form-control" rows="3" placeholder="Isikan konsentrasi bidang" name="konsentrasi_bidang" id="konsentrasi_bidang"><?= $single_skripsi['konsentrasi_bidang']; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Dosen Pembimbing</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <select class="select2_single form-control" tabindex="-1" name="dosen_pembimbing" <?= validation_show_error('dosen_pembimbing') ? "style='border: 1px solid red'" : null; ?>>
                                        <option value="">--Pilih Dosen Pembimbing--</option>
                                        <?php foreach($dosen as $d): ?>
                                        <option value="<?=$d->nidn;?>" <?= ($d->nidn == $single_skripsi['dosen_pembimbing'] ? 'selected' : null) ?> ><?= $d->peg_gel_dep; ?> <?= $d->peg_nama; ?>, <?= $d->peg_gel_bel; ?> (m=<?= $d->total_membimbing; ?>)</option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback" style="text-align: left; display: block;">
                                        <?= validation_show_error('dosen_pembimbing'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Dosen PA</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <select class="select2_single form-control" tabindex="-1" name="dosen_pa" <?= validation_show_error('dosen_pa') ? "style='border: 1px solid red'" : null; ?>>
                                        <option value="">--Pilih Dosen PA--</option>
                                        <?php foreach($dosen as $d): ?>
                                        <option value="<?=$d->nidn;?>" <?= ($d->nidn == $single_skripsi['dosen_pa'] ? 'selected' : null) ?> ><?= $d->peg_gel_dep; ?> <?= $d->peg_nama; ?>, <?= $d->peg_gel_bel; ?>(m=<?= $d->total_membimbing; ?>)</option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback" style="text-align: left; display: block;">
                                        <?= validation_show_error('dosen_pa'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <?php if($single_skripsi['data_dukung'] != null) { ?>
                                <div class="card" style="margin: 0; padding: 0; overflow: hidden; height: 95vh;">
                                    <h2 class="card-header">Data dukung</h2>
                                    <div class="card-body" >
                                        <iframe src="/upload/data_dukung/<?= $single_skripsi['data_dukung']; ?>" frameborder="0" style="width: 100%; height: 100%; display: block;"></iframe>
                                    </div>
                                </div>
                                <!-- <div class="col-md-12 col-sm-12" style="">
                                </div> -->
                            <?php } else { ?>
                                <div class="card">
                                    <h2 class="card-header">Data dukung</h2>
                                    <div class="card-body">
                                        <h5 class="card-title">Tidak ada data dukung...</h5>
                                    </div>
                                </div>
                                <?php } ?>
                            <div class="ln_solid"></div>
                        </div>
                    </div>
                    <?php if($single_skripsi['status_pengajuan_skripsi'] == 1 && session()->get('level') == 4) {?>
                    <div style="display: flex;">
                        <button type="submit" class="btn btn-primary btn-sm" name="setujui_judul" value="setujui_judul"><i class="fa fa-check-square-o" style="margin-right: 5px;"></i>Setujui Judul</button>
                        <!-- button untuk penolakan -->
                        <div class="button_container">
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target=".pesan_tolak"><i class="fa fa-exclamation-triangle" style="margin-right: 5px;"></i>Tolak Judul</button>
                        </div>
                        <div class="modal fade pesan_tolak" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-sm" style="max-width: 500px;">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="form-group row">
                                            <div class="col-md-12 col-sm-12">
                                                <textarea class="form-control <?= validation_show_error('pesan') ? 'is-invalid' : null; ?>" rows="3" name="pesan" id="pesan" placeholder="Tuliskan alasan penolakan"></textarea>
                                                <div class="invalid-feedback" style="text-align: left;">
                                                    <?= validation_show_error('pesan'); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer" style="border: none; justify-content: center;">
                                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fa fa-chevron-circle-left" style="margin-right: 5px;"></i>Batal</button>
                                        <button type="submit" name="tolak_judul" class="btn btn-danger btn-sm" value="tolak_judul"><i class="fa fa-exclamation-triangle" style="margin-right: 5px;"></i>Tolak Pengajuan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="<?= base_url('/skripsi/semua_skripsi'); ?>" class="btn btn-warning btn-sm"><i class="fa fa-chevron-circle-left" style="margin-right: 5px;"></i>Kembali</a>
                    </div>
                    <?php } ?>
                    <?php if($single_skripsi['status_pengajuan_skripsi'] == 2 && session()->get('level') == 4) {?>
                    <div style="display: flex;">
                        <button type="submit" class="btn btn-danger btn-sm" name="batalkan_penolakan" value="batalkan_penolakan"><i class="fa fa-exclamation-triangle" style="margin-right: 5px;"></i>Batalkan Penolakan</button>
                        <a href="<?= base_url('/skripsi/semua_skripsi'); ?>" class="btn btn-warning btn-sm"><i class="fa fa-chevron-circle-left" style="margin-right: 5px;"></i>Kembali</a>
                    </div>
                    <?php } ?>
                    <?php if($single_skripsi['status_pengajuan_skripsi'] == 3 && session()->get('level') == 4) {?>
                    <div style="display: flex;">
                        <button type="submit" class="btn btn-danger btn-sm" name="batalkan_verifikasi" value="batalkan_verifikasi"><i class="fa fa-exclamation-triangle" style="margin-right: 5px;"></i>Batalkan Verifikasi</button>
                        <a href="<?= base_url('/skripsi/semua_skripsi'); ?>" class="btn btn-warning btn-sm"><i class="fa fa-chevron-circle-left" style="margin-right: 5px;"></i>Kembali</a>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>