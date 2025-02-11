<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="right_col" role="main">
    <div class="">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Detail Departemen</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <?= csrf_field(); ?>
                        <div class="form-group row ">
                            <label class="control-label col-md-3 col-sm-3">Kode Departemen</label>
                            <div class="col-md-9 col-sm-9 ">
                                <input readonly type="text" value="<?= $departemen_by_id['departemen_kd']; ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label class="control-label col-md-3 col-sm-3">Nama Departemen</label>
                            <div class="col-md-9 col-sm-9 ">
                                <input readonly type="text" value="<?= $departemen_by_id['departemen_nama']; ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label class="control-label col-md-3 col-sm-3">Email Departemen</label>
                            <div class="col-md-9 col-sm-9 ">
                                <input readonly type="text" value="<?= $departemen_by_id['departemen_email']; ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label class="control-label col-md-3 col-sm-3">Website Departemen</label>
                            <div class="col-md-9 col-sm-9 ">
                                <input readonly type="text" value="<?= $departemen_by_id['departemen_website']; ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label class="control-label col-md-3 col-sm-3">Kode Surat (ex : UN35.4.3/AK/)</label>
                            <div class="col-md-9 col-sm-9 ">
                                <input readonly type="text" value="<?= $departemen_by_id['departemen_kd_surat']; ?>"class="form-control">
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label class="control-label col-md-3 col-sm-3">Nama Kepala Departemen (Lengkap dengan gelar)</label>
                            <div class="col-md-9 col-sm-9 ">
                                <input readonly type="text" value="<?= $departemen_by_id['departemen_nm_kadep']; ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label class="control-label col-md-3 col-sm-3">NIP Kepala Departemen</label>
                            <div class="col-md-9 col-sm-9 ">
                                <input readonly value="<?= $departemen_by_id['departemen_nip_kadep']; ?>" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label class="control-label col-md-3 col-sm-3">Dosen yang muncul ketika dipilih mahasiswa dari departemen</label>
                            <div class="col-md-9 col-sm-9 ">
                                <input readonly value="<?= $departemen_by_id['departemen_dua_nama']; ?>" type="text"  class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Pengaturan Pada Surat</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <div class="form-group row">
                            <label class="control-label col-md-3 col-sm-3">Judul Kop Surat</label>
                            <div class="col-md-9 col-sm-9" >
                                <textarea readonly class="form-control" rows="5" cols="100%" placeholder="Tuliskan kop surat yang akan di pakai pada surat"><?= $departemen_by_id['judul_kop_surat']; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3 col-sm-3">Jabatan Penanda Tangan</label>
                            <div class="col-md-9 col-sm-9" >
                                <textarea readonly class="form-control" rows="5" cols="100%" placeholder="Tuliskan jabatan yang menandatangani surat"><?= $departemen_by_id['jabatan_penanda_tangan']; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3 col-sm-3">Nama Penanda Tangan</label>
                            <div class="col-md-9 col-sm-9" >
                                <textarea readonly class="form-control" rows="5" cols="100%" placeholder="Tuliskan nama pimpinan yang menandatangani surat"><?= $departemen_by_id['nama_penanda_tangan']; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label class="control-label col-md-3 col-sm-3">NIP Penandatangan</label>
                            <div class="col-md-9 col-sm-9 ">
                                <input readonly placeholder="Tuliskan nip pimpinan yang akan menandatangani surat" value="<?= $departemen_by_id['nip_penanda_tangan']; ?>" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-9 col-sm-9  offset-md-3">
                                <a href="<?= base_url('/departemen'); ?>" class="btn btn-warning btn-sm"><i class="fa fa-chevron-circle-left" style="margin-right: 5px;"></i>Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
