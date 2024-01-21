<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Profil</h3>
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
        <form class="form-horizontal form-label-left" method="POST" action="<?= base_url('/profil-dosen/update_verifikasi'); ?>">
        <?= csrf_field(); ?>
        <div class="row">
            
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Data sesuai Portal</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <div class="form-group row ">
                            <label class="control-label col-md-3 col-sm-3" for="nidn">NIDN</label>
                            <div class="col-md-9 col-sm-9 ">
                                <input readonly type="text" value="<?= $data_dosen['nidn']; ?>" name="nidn" class="form-control" id="nidn">
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label class="control-label col-md-3 col-sm-3" for="peg_nip">NIP</label>
                            <div class="col-md-9 col-sm-9 ">
                                <input readonly type="text" value="<?= $data_dosen['peg_nip']; ?>" name="peg_nip" class="form-control" id="peg_nip">
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label class="control-label col-md-3 col-sm-3" for="peg_nama">Nama Tanpa Gelar</label>
                            <div class="col-md-9 col-sm-9 ">
                                <input readonly type="text" value="<?= $data_dosen['peg_nama']; ?>" name="peg_nama" class="form-control" id="peg_nama">
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label class="control-label col-md-3 col-sm-3" for="prf_nama_portal">Gelar Depan</label>
                            <div class="col-md-9 col-sm-9 ">
                                <input readonly type="text" value="<?= $data_dosen['peg_gel_dep']; ?>" name="prf_nama_portal" class="form-control" id="prf_nama_portal">
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label class="control-label col-md-3 col-sm-3" for="peg_gel_bel">Gelar Belakang</label>
                            <div class="col-md-9 col-sm-9 ">
                                <input readonly type="text" value="<?= $data_dosen['peg_gel_bel']; ?>" name="peg_gel_bel" class="form-control" id="peg_gel_bel">
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label class="control-label col-md-3 col-sm-3" for="peg_status">Status</label>
                            <div class="col-md-9 col-sm-9 ">
                                <input readonly type="text" value="<?= $data_dosen['peg_status']; ?>" name="peg_status" class="form-control" id="peg_status">
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Perbaiki Data</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <div class="form-group row ">
                            <label class="control-label col-md-3 col-sm-3" for="nohp_baru">No Hp Aktif</label>
                            <div class="col-md-9 col-sm-9 ">
                                <input type="text" value=""  name="nohp_baru" class="form-control <?= validation_show_error('nohp_baru') ? 'is-invalid' : null; ?>" id="nohp_baru">
                                <div class="invalid-feedback" style="text-align: left;">
                                    <?= validation_show_error('nohp_baru'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label class="control-label col-md-3 col-sm-3" for="no_wa">No Whatsapp</label>
                            <div class="col-md-9 col-sm-9 ">
                                <input type="text" value=""  name="no_wa" class="form-control <?= validation_show_error('no_wa') ? 'is-invalid' : null; ?>" id="no_wa">
                                <div class="invalid-feedback" style="text-align: left;">
                                    <?= validation_show_error('no_wa'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label class="control-label col-md-3 col-sm-3" for="email_baru">Email</label>
                            <div class="col-md-9 col-sm-9 ">
                                <input type="text" value=""  name="email_baru" class="form-control <?= validation_show_error('email_baru') ? 'is-invalid' : null; ?>" id="email_baru">
                                <div class="invalid-feedback" style="text-align: left;">
                                    <?= validation_show_error('email_baru'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3 col-sm-3" for="alamat_baru">Alamat Lengkap <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9" >
                                <textarea class="form-control <?= validation_show_error('alamat_baru') ? 'is-invalid' : null; ?>" rows="5" cols="100%" name="alamat_baru" id="alamat_baru" placeholder="Tuliskan alamat"></textarea>
                                <div class="invalid-feedback" style="text-align: left;">
                                    <?= validation_show_error('alamat_baru'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-9 col-sm-9  offset-md-3">
                <a href="<?= base_url('/profil-dosen'); ?>" class="btn btn-warning"><i class="fa fa-chevron-circle-left" style="margin-right: 5px;"></i>Lewati</a>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save" style="margin-right: 5px;"></i>Simpan</button>
            </div>
        </div>
        </form>
    </div>
</div>
<?= $this->endSection(); ?>
