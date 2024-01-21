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
        <form class="form-horizontal form-label-left" method="POST" action="<?= base_url('/profil/update_verifikasi'); ?>">
        <?= csrf_field(); ?>
        <div class="row">
            <?php if(session()->getFlashdata('sukses')) : ?>
            <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="alert alert-success alert-dismissible " role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <strong>Sukses!</strong> <?= session()->getFlashdata('sukses'); ?>.
            </div>
            </div>
            <?php endif; ?>
            <?php if(session()->getFlashdata('gagal')) : ?>
            <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="alert alert-danger alert-dismissible " role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <strong>Gagal!</strong> <?= session()->getFlashdata('gagal'); ?>.
            </div>
            </div>
            <?php endif; ?>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Data sesuai Portal</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <input type="hidden" value="<?= $mahasiswa_api['idpdpt']; ?>" name="idpdpt">
                        <input type="hidden" value="<?= $mahasiswa_api['idprodi']; ?>" name="idprodi_portal">
                        <input type="hidden" value="<?= $mahasiswa_api['id_jurusan']; ?>" name="kd_jurusan_portal">
                        <input type="hidden" value="<?= $mahasiswa_api['idfak']; ?>" name="id_fakultas_portal">
                        <div class="form-group row ">
                            <label class="control-label col-md-3 col-sm-3" for="prf_nim_portal">NIM</label>
                            <div class="col-md-9 col-sm-9 ">
                                <input readonly type="text" value="<?= $mahasiswa_api['nim']; ?>" name="prf_nim_portal" class="form-control" id="prf_nim_portal">
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label class="control-label col-md-3 col-sm-3" for="thn_msk_portal">Tahun Masuk</label>
                            <div class="col-md-9 col-sm-9 ">
                                <input readonly type="text" value="<?= $mahasiswa_api['tm_msk']; ?>" name="thn_msk_portal" class="form-control" id="thn_msk_portal">
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label class="control-label col-md-3 col-sm-3" for="prf_nama_portal">Nama</label>
                            <div class="col-md-9 col-sm-9 ">
                                <input readonly type="text" value="<?= $mahasiswa_api['nama']; ?>" name="prf_nama_portal" class="form-control" id="prf_nama_portal">
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label class="control-label col-md-3 col-sm-3" for="tmp_lahir_portal">Tempat Lahir</label>
                            <div class="col-md-9 col-sm-9 ">
                                <input readonly type="text" value="<?= $mahasiswa_api['tmp_lhr']; ?>" name="tmp_lahir_portal" class="form-control" id="tmp_lahir_portal">
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label class="control-label col-md-3 col-sm-3" for="tgl_lahir_portal">Tgl Lahir</label>
                            <div class="col-md-9 col-sm-9 ">
                                <input readonly type="text" value="<?= $mahasiswa_api['tgl_lhr']; ?>" name="tgl_lahir_portal" class="form-control" id="tgl_lahir_portal">
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label class="control-label col-md-3 col-sm-3" for="jk">Jenis Kelamin</label>
                            <div class="col-md-9 col-sm-9 ">
                                <input readonly type="text" value="<?= $mahasiswa_api['jk'];?>" name="jk" class="form-control" id="jk">
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label class="control-label col-md-3 col-sm-3" for="agama">Agama</label>
                            <div class="col-md-9 col-sm-9 ">
                                <input readonly type="text" value="<?= $mahasiswa_api['agama']; ?>" name="agama" class="form-control" id="agama">
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label class="control-label col-md-3 col-sm-3" for="nohp_portal">No Hp</label>
                            <div class="col-md-9 col-sm-9 ">
                                <input readonly type="text" value="<?= $mahasiswa_api['nohp']; ?>" name="nohp_portal" class="form-control" id="nohp_portal">
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label class="control-label col-md-3 col-sm-3" for="prodi_portal">Prodi</label>
                            <div class="col-md-9 col-sm-9 ">
                                <input readonly type="text" value="<?= $mahasiswa_api['nam_prodi']; ?>" name="prodi_portal" class="form-control" id="prodi_portal">
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label class="control-label col-md-3 col-sm-3" for="jjp_portal">Jenjang Pendidikan</label>
                            <div class="col-md-9 col-sm-9 ">
                                <input readonly type="text" value="<?= $mahasiswa_api['jjp']; ?>" name="jjp_portal" class="form-control" id="jjp_portal">
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label class="control-label col-md-3 col-sm-3" for="nama_jurusan_portal">Jurusan</label>
                            <div class="col-md-9 col-sm-9 ">
                                <input readonly type="text" value="<?= $mahasiswa_api['nam_jurusan']; ?>" name="nama_jurusan_portal" class="form-control" id="nama_jurusan_portal">
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label class="control-label col-md-3 col-sm-3" for="nama_fakultas_portal">Fakultas</label>
                            <div class="col-md-9 col-sm-9 ">
                                <input readonly type="text" value="<?= $mahasiswa_api['nam_fak']; ?>" name="nama_fakultas_portal" class="form-control" id="nama_fakultas_portal">
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Inputkan kembali</h2>
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
                            <label class="control-label col-md-3 col-sm-3" for="email">Email</label>
                            <div class="col-md-9 col-sm-9 ">
                                <input type="text" value=""  name="email" class="form-control <?= validation_show_error('email') ? 'is-invalid' : null; ?>" id="email">
                                <div class="invalid-feedback" style="text-align: left;">
                                    <?= validation_show_error('email'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3 col-sm-3" for="alamat_lengkap">Alamat Lengkap <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9" >
                                <textarea class="form-control <?= validation_show_error('alamat_lengkap') ? 'is-invalid' : null; ?>" rows="5" cols="100%" name="alamat_lengkap" id="alamat_lengkap" placeholder="Tuliskan alamat"></textarea>
                                <div class="invalid-feedback" style="text-align: left;">
                                    <?= validation_show_error('alamat_lengkap'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row has-error">
                            <label class="control-label col-md-3 col-sm-3 ">Departemen</label>
                            <div class="col-md-9 col-sm-9 has-error">
                                <select class="form-control" id="departemen_input" tabindex="-1" name="departemen_input" <?= validation_show_error('departemen_input') ? "style='border: 1px solid red;'" : null; ?>>
                                    <option value="">-- Pilih Departemen --</option>
                                    <?php foreach($departemen as $d): ?>
                                    <option value="<?= $d['departemen_id']; ?>"><?= $d['departemen_nama']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <h1 style="width: 100%; margin-top: 0.25rem; font-size: 80%; color: #dc3545;">
                                    <?= validation_show_error('departemen_input'); ?>
                                </h1>
                            </div>
                        </div>
                        <div class="form-group row has-error">
                            <label class="control-label col-md-3 col-sm-3 ">Prodi</label>
                            <div class="col-md-9 col-sm-9 has-error">
                                <select class="form-control" id="prodi_input" tabindex="-1" name="prodi_input" <?= validation_show_error('prodi_input') ? "style='border: 1px solid red;'" : null; ?>>
                                    <option value="">-- Pilih Prodi --</option>
                                    <?php foreach($prodi as $p): ?>
                                    <option value="<?= $p['prodi_id']; ?>"><?= $p['prd_nama']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <h1 style="width: 100%; margin-top: 0.25rem; font-size: 80%; color: #dc3545;">
                                    <?= validation_show_error('prodi_input'); ?>
                                </h1>
                            </div>
                        </div>
                        <div class="form-group row has-error">
                            <label class="control-label col-md-3 col-sm-3 ">Jenjang Pendidikan</label>
                            <div class="col-md-9 col-sm-9 has-error">
                                <select class="form-control" id="jjp_input" tabindex="-1" name="jjp_input" <?= validation_show_error('jjp_input') ? "style='border: 1px solid red;'" : null; ?>>
                                    <option value="">-- Pilih Jenjang Pendidikan --</option>
                                    <?php foreach($jenjang as $jp): ?>
                                    <option value="<?= $jp['jp_id']; ?>"><?= $jp['jp_nama']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <h1 style="width: 100%; margin-top: 0.25rem; font-size: 80%; color: #dc3545;">
                                    <?= validation_show_error('jjp_input'); ?>
                                </h1>
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-9 col-sm-9  offset-md-3">
                <a href="<?= base_url('/profil'); ?>" class="btn btn-warning btn-sm"><i class="fa fa-chevron-circle-left" style="margin-right: 5px;"></i>Kembali</a>
                <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save" style="margin-right: 5px;"></i>Simpan</button>
            </div>
        </div>
        </form>
    </div>
</div>
<?= $this->endSection(); ?>
