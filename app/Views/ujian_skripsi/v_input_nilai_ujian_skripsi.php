<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Penilaian Ujian Skripsi</h3>
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
            <form action="<?= base_url('ujian-skripsi/'.$satu_ujian['us_uuid'].'/simpan-nilai'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Detail Ujian Skripsi</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br />
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="us_nim_m">NIM</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input readonly type="text" value="<?= $satu_ujian['us_nim_m']; ?>" name="us_nim_m" class="form-control" id="us_nim_m">
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="nama_mahasiswa">Nama Mahasiswa</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input readonly type="text" value="<?= $satu_ujian['nama_mahasiswa']; ?>" class="form-control" id="nama_mahasiswa" name="nama_mahasiswa">
                                </div>
                            </div> 
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="nohp_baru">Nama Mahasiswa</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input readonly type="text" value="<?= $satu_ujian['nohp_baru']; ?>" class="form-control" id="nohp_baru" name="nohp_baru">
                                </div>
                            </div> 
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="prodi_portal">Prodi</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input readonly type="text" value="<?= $satu_ujian['prodi_portal']; ?>" class="form-control" id="prodi_portal" name="prodi_portal">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="judul_skripsi">Judul Skripsi</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <textarea readonly class="form-control" rows="3" name="judul_skripsi" id="judul_skripsi" placeholder="Isikan judul skripsi"><?= $satu_ujian['judul_skripsi']; ?></textarea>
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="deskripsi_skripsi">Deskripsi Skripsi</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <textarea readonly class="form-control" rows="3" name="deskripsi_skripsi" id="deskripsi_skripsi" placeholder="Isikan judul skripsi"><?= $satu_ujian['deskripsi_skripsi']; ?></textarea>
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label class="control-label col-lg-3 col-md-3 col-sm-3" for="dosen_pa">Nama Dosen PA</label>
                                <div class="col-lg-5 col-md-5 col-sm-12">
                                    <input readonly type="text" value="<?= $satu_ujian['d_pa_peg_gel_dep']; ?><?= ($satu_ujian['d_pa_peg_gel_dep'] != '' ? '. ' : '' ); ?><?= $satu_ujian['d_pa_peg_nama']; ?>, <?= $satu_ujian['d_pa_peg_gel_bel']; ?>" name="dosen_pa" class="form-control" id="dosen_pa">
                                </div>
                                <div class="col-lg-1 col-md-1 col-sm-12">
                                    <label class="control-label" for="nidn_dosen_pa">NIDN</label>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <input readonly type="text" value="<?= $satu_ujian['d_pa_nidn']; ?>" name="nidn_dosen_pa" class="form-control" id="nidn_dosen_pa">
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-lg-3 col-md-3 col-sm-3" for="dosen_pembimbing">Nama Dosen Pembimbing</label>
                                <div class="col-lg-5 col-md-5 col-sm-12 ">
                                    <input readonly type="text" value="<?= $satu_ujian['d_pembimbing_peg_gel_dep']; ?><?= ($satu_ujian['d_pembimbing_peg_gel_dep'] != '' ? '. ' : '' ); ?><?= $satu_ujian['d_pembimbing_peg_nama']; ?>, <?= $satu_ujian['d_pembimbing_peg_gel_bel']; ?>" name="dosen_pembimbing" class="form-control" id="dosen_pembimbing">
                                </div>
                                <div class="col-lg-1 col-md-1 col-sm-12">
                                    <label class="control-label" for="nidn_dosen_pembimbing">NIDN</label>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <input readonly type="text" value="<?= $satu_ujian['d_pembimbing_nidn']; ?>" name="nidn_dosen_pembimbing" class="form-control" id="nidn_dosen_pembimbing">
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-lg-3 col-md-3 col-sm-3" for="penguji_satu">Penguji Satu</label>
                                <div class="col-lg-5 col-md-5 col-sm-12">
                                    <input readonly type="text" value="<?= $satu_ujian['d_penguji_satu_peg_gel_dep']; ?><?= ($satu_ujian['d_penguji_satu_peg_gel_dep'] != '' ? '. ' : '' ); ?><?= $satu_ujian['d_penguji_satu_peg_nama']; ?>, <?= $satu_ujian['d_penguji_satu_peg_gel_bel']; ?>" name="penguji_satu" class="form-control" id="penguji_satu">
                                </div>
                                <div class="col-lg-1 col-md-1 col-sm-12">
                                    <label class="control-label" for="nidn_penguji_satu">NIDN</label>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <input readonly type="text" value="<?= $satu_ujian['penguji_satu']; ?>" name="nidn_penguji_satu" class="form-control" id="nidn_penguji_satu">
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-lg-3 col-md-3 col-sm-3" for="penguji_dua">Penguji Dua</label>
                                <div class="col-lg-5 col-md-5 col-sm-12">
                                    <input readonly type="text" value="<?= $satu_ujian['d_penguji_dua_peg_gel_dep']; ?><?= ($satu_ujian['d_penguji_dua_peg_gel_dep'] != '' ? '. ' : '' ); ?><?= $satu_ujian['d_penguji_dua_peg_nama']; ?>, <?= $satu_ujian['d_penguji_dua_peg_gel_bel']; ?>" name="penguji_dua" class="form-control" id="penguji_dua">
                                </div>
                                <div class="col-lg-1 col-md-1 col-sm-12">
                                    <label class="control-label" for="nidn_penguji_dua">NIDN</label>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <input readonly type="text" value="<?= $satu_ujian['penguji_dua']; ?>" name="nidn_penguji_dua" class="form-control" id="nidn_penguji_dua">
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="us_hari">Hari</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input readonly type="text" value="<?= $satu_ujian['us_hari'] == 1 ? 'Senin' : ($satu_ujian['us_hari'] == 2 ? 'Selasa' : ($satu_ujian['us_hari'] == 3 ? 'Rabu' : ($satu_ujian['us_hari'] == 4 ? 'Kamias' : ($satu_ujian['us_hari'] == 5 ? 'Jumat' : ($satu_ujian['us_hari'] == 6 ? 'Sabtu' : ($satu_ujian['us_hari'] == 7 ? 'Minggu' : null)))))); ?>" class="form-control" id="us_hari" name="us_hari">
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="us_tanggal">Tanggal</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input readonly type="text" value="<?= $satu_ujian['us_tanggal']; ?>" name="us_tanggal" class="form-control" id="us_tanggal">
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="ujian_skripsi_sesi_alias">Sesi</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input readonly type="text" value="<?= $satu_ujian['ujian_sesi_alias']; ?>" name="ujian_sesi_alias" class="form-control" id="ujian_sesi_alias">
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="ujian_ruangan_alias">Ruangan</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input readonly type="text" value="<?= $satu_ujian['ujian_skripsi_ruangan_alias']; ?>" name="ujian_ruangan_alias" class="form-control" id="ujian_ruangan_alias">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Input Nilai</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br />
                            <div class="row" style="border-bottom: 2px solid #E6E9ED;">
                                <div class="col-lg-6 col-md-6">
                                    <h6>Aspek Nilai Yang Diuji</h6>
                                </div>
                                <div class="col-lg-2 col-md-2">
                                    <h6>Nilai 0-100</h6>
                                </div>
                                <div class="col-lg-2 col-md-2">
                                    <h6>Bobot</h6>
                                </div>
                                <div class="col-lg-2 col-md-2">
                                    <h6>NB</h6>
                                </div>
                            </div>
                            <br />
                            <h6 style="font-weight: bold;">SKRIPSI</h6>
                            <br />
                            <div class="form-group row">
                                <label class="control-label col-lg-6 col-md-6 col-sm-6" for="perumusan_masalah">Perumusan Masalah Penelitian</label>
                                <div class="col-lg-2 col-md-2 col-sm-2">
                                    <input type="number" name="perumusan_masalah" id="perumusan_masalah"  class="form-control <?= validation_show_error('perumusan_masalah') ? 'is-invalid' : null; ?>">
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('perumusan_masalah'); ?>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2">
                                    <input readonly type="number" name="perumusan_masalah_bobot" id="perumusan_masalah_bobot" value="1" class="form-control <?= validation_show_error('perumusan_masalah_bobot') ? 'is-invalid' : null; ?>">
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('perumusan_masalah_bobot'); ?>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2">
                                    <input readonly type="number" class="form-control" name="perumusan_masalah_total" id="perumusan_masalah_total">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-lg-6 col-md-6 col-sm-6" for="tinjauan_pustaka">Kedalaman dan keluasan teori keilmuan yang relevan(tinjauan pustaka)</label>
                                <div class="col-lg-2 col-md-2 col-sm-2">
                                    <input type="number" name="tinjauan_pustaka" id="tinjauan_pustaka" class="form-control <?= validation_show_error('tinjauan_pustaka') ? 'is-invalid' : null; ?>">
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('tinjauan_pustaka'); ?>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2">
                                    <input readonly type="number" name="tinjauan_pustaka_bobot" id="tinjauan_pustaka_bobot" value="0.5" class="form-control <?= validation_show_error('tinjauan_pustaka_bobot') ? 'is-invalid' : null; ?>">
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('tinjauan_pustaka_bobot'); ?>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2">
                                    <input readonly type="number" class="form-control" name="tinjauan_pustaka_total" id="tinjauan_pustaka_total">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-lg-6 col-md-6 col-sm-6" for="pengumpulan_data">Teknik Pengumpulan Data/Keabsahan Instrumen/Analisi Data</label>
                                <div class="col-lg-2 col-md-2 col-sm-2">
                                    <input type="number" name="pengumpulan_data" id="pengumpulan_data" class="form-control <?= validation_show_error('pengumpulan_data') ? 'is-invalid' : null; ?>">
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('pengumpulan_data'); ?>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2">
                                    <input readonly type="number"  name="pengumpulan_data_bobot" value="1" id="pengumpulan_data_bobot" class="form-control <?= validation_show_error('pengumpulan_data_bobot') ? 'is-invalid' : null; ?>">
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('pengumpulan_data_bobot'); ?>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2">
                                    <input readonly type="number"class="form-control" name="pengumpulan_data_total" id="pengumpulan_data_total">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-lg-6 col-md-6 col-sm-6" for="kesesuaian_desain">Kesesuaian Desain</label>
                                <div class="col-lg-2 col-md-2 col-sm-2">
                                    <input type="number" name="kesesuaian_desain" id="kesesuaian_desain" class="form-control <?= validation_show_error('kesesuaian_desain') ? 'is-invalid' : null; ?>">
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('kesesuaian_desain'); ?>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2">
                                    <input readonly type="number" value="1" name="kesesuaian_desain_bobot" id="kesesuaian_desain_bobot" class="form-control <?= validation_show_error('kesesuaian_desain_bobot') ? 'is-invalid' : null; ?>">
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('kesesuaian_desain_bobot'); ?>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2">
                                    <input readonly type="number" class="form-control" name="kesesuaian_desain_total" id="kesesuaian_desain_total">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-lg-6 col-md-6 col-sm-6" for="kerangka_konseptual">Kerangka Konseptual</label>
                                <div class="col-lg-2 col-md-2 col-sm-2">
                                    <input type="number" id="kerangka_konseptual" name="kerangka_konseptual"  id="kerangka_konseptual" class="form-control <?= validation_show_error('kerangka_konseptual') ? 'is-invalid' : null; ?>">
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('kerangka_konseptual'); ?>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2">
                                    <input readonly type="number" value="1" name="kerangka_konseptual_bobot" id="kerangka_konseptual_bobot" class="form-control <?= validation_show_error('kerangka_konseptual_bobot') ? 'is-invalid' : null; ?>">
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('kerangka_konseptual_bobot'); ?>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2">
                                    <input readonly type="number" class="form-control" name="kerangka_konseptual_total" id="kerangka_konseptual_total">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-lg-6 col-md-6 col-sm-6" for="logika_penulisan">Logika Penulisan dan Bahasa</label>
                                <div class="col-lg-2 col-md-2 col-sm-2">
                                    <input type="number" name="logika_penulisan" id="logika_penulisan" class="form-control <?= validation_show_error('logika_penulisan') ? 'is-invalid' : null; ?>">
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('logika_penulisan'); ?>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2">
                                    <input readonly type="number" value="1" name="logika_penulisan_bobot" id="logika_penulisan_bobot" class="form-control <?= validation_show_error('logika_penulisan_bobot') ? 'is-invalid' : null; ?>">
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('logika_penulisan_bobot'); ?>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2">
                                    <input readonly type="number" class="form-control" name="logika_penulisan_total" id="logika_penulisan_total">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-lg-6 col-md-6 col-sm-6" for="orisinalitas">Orisinalitas</label>
                                <div class="col-lg-2 col-md-2 col-sm-2">
                                    <input type="number" name="orisinalitas" id="orisinalitas" class="form-control <?= validation_show_error('orisinalitas') ? 'is-invalid' : null; ?>">
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('orisinalitas'); ?>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2">
                                    <input readonly type="number" value="0.5"  name="orisinalitas_bobot" id="orisinalitas_bobot" class="form-control <?= validation_show_error('orisinalitas_bobot') ? 'is-invalid' : null; ?>">
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('orisinalitas_bobot'); ?>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2">
                                    <input readonly type="number"  class="form-control" name="orisinalitas_total" id="orisinalitas_total">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-lg-6 col-md-6 col-sm-6" for="kesimpulan_dan_saran">Kesimpulan dan Saran</label>
                                <div class="col-lg-2 col-md-2 col-sm-2">
                                    <input type="number" name="kesimpulan_dan_saran" id="kesimpulan_dan_saran" class="form-control <?= validation_show_error('kesimpulan_dan_saran') ? 'is-invalid' : null; ?>">
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('kesimpulan_dan_saran '); ?>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2">
                                    <input readonly type="number" value="1"  name="kesimpulan_dan_saran_bobot" id="kesimpulan_dan_saran_bobot" class="form-control <?= validation_show_error('kesimpulan_dan_saran_bobot') ? 'is-invalid' : null; ?>">
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('kesimpulan_dan_saran _bobot'); ?>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2">
                                    <input readonly type="number" class="form-control" name="kesimpulan_dan_saran_total" id="kesimpulan_dan_saran_total">
                                </div>
                            </div>
                            <h6 style="font-weight: bold;">UJIAN SKRIPSI</h6>
                            <br />
                            <div class="form-group row">
                                <label class="control-label col-lg-6 col-md-6 col-sm-6" for="penyajian">Penyajian</label>
                                <div class="col-lg-2 col-md-2 col-sm-2">
                                    <input type="number" name="penyajian" id="penyajian" class="form-control <?= validation_show_error('penyajian') ? 'is-invalid' : null; ?>" >
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('penyajian'); ?>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2">
                                    <input readonly type="number" value="1" name="penyajian_bobot" id="penyajian_bobot" class="form-control <?= validation_show_error('penyajian_bobot') ? 'is-invalid' : null; ?>">
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('penyajian _bobot'); ?>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2">
                                    <input readonly type="number" class="form-control" name="penyajian_total" id="penyajian_total">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-lg-6 col-md-6 col-sm-6" for="mempertahankan_skripsi">Kemampuan Mempertahankan Skripsi</label>
                                <div class="col-lg-2 col-md-2 col-sm-2">
                                    <input type="number" name="mempertahankan_skripsi" id="mempertahankan_skripsi" class="form-control <?= validation_show_error('mempertahankan_skripsi') ? 'is-invalid' : null; ?>">
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('mempertahankan_skripsi'); ?>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2">
                                    <input readonly type="number" value="2" id="mempertahankan_skripsi_bobot" name="mempertahankan_skripsi_bobot" class="form-control <?= validation_show_error('mempertahankan_skripsi_bobot') ? 'is-invalid' : null; ?>" >
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('mempertahankan_skripsi_bobot'); ?>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2">
                                    <input readonly type="number" class="form-control" id="mempertahankan_skripsi_total" name="mempertahankan_skripsi_total">
                                </div>
                            </div>
                            <div class="form-group row">
                                <h6 class="control-label col-lg-6 col-md-6 col-sm-6" for="jumlah" style="font-weight: bold;">JUMLAH</h6>
                                <div class="col-lg-2 col-md-2 col-sm-2">
                                    <input readonly type="number" name="jumlah" class="form-control" id="jumlah">
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2">
                                    <input readonly type="number" class="form-control" name="jumlah_bobot" id="jumlah_bobot">
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2">
                                    <input readonly type="number" class="form-control" name="jumlah_total" id="jumlah_total">
                                </div>
                            </div>
                            <div class="form-group row" style="border-top: 2px solid #E6E9ED; padding-top: 20px;">
                                <h6 class="control-label col-lg-6 col-md-6 col-sm-6" for="jumlah" style="font-weight: bold;">NILAI AKHIR</h6>
                                <div class="col-lg-2 col-md-2 col-sm-2">
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2">
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2">
                                    <input readonly type="number" class="form-control" name="nilai_akhir" id="nilai_akhir">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <li style="list-style: none;">85 - 100 = A</li>
                                    <li style="list-style: none;">80 - 84  = A-</li>
                                    <li style="list-style: none;">75 - 79  = B+</li>
                                    <li style="list-style: none;">70 - 74  = B</li>
                                    <li style="list-style: none;">65 - 69  = B-</li>
                                    <li style="list-style: none;">   < 64  = C</li>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2">
                                    <li style="list-style: none;">NB : Nilai Bersih</li>
                                    <li style="list-style: none;">Rumus : Nilai Akhir = E (Nilai x Bobot) /10</li>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2">
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2">
                                    <h6 class="col-lg-12 col-md-12 col-sm-12" id="nilai_akhir_huruf" style="font-weight: bold; font-size: 40px; text-align: center;"></h6>
                                </div>
                            </div>
                            <br />                  
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="x_panel">
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save" style="margin-right: 5px;"></i>Simpan Nilai</button>
                        <a class="btn btn-warning btn-sm" href="<?= base_url('ujian-skripsi/pembimbing'); ?>"><i class="fa fa-chevron-circle-left" style="margin-right: 5px;"></i>Kembali</a>
                       
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $.valHooks.number = {
            get: function( elem ) {
                return elem.value * 1;
            }
        };

        $('input[type="number"]').change(function() {
            var perumusan_masalah_nilai = $('#perumusan_masalah').val();
            var perumusan_masalah_bobot = $('#perumusan_masalah_bobot').val();
            var perumusan_masalah_total = perumusan_masalah_nilai * perumusan_masalah_bobot;
            var tinjauan_pustaka_nilai = $('#tinjauan_pustaka').val();
            var tinjauan_pustaka_bobot = $('#tinjauan_pustaka_bobot').val();
            var tinjauan_pustaka_total = tinjauan_pustaka_nilai * tinjauan_pustaka_bobot;
            var pengumpulan_data_nilai = $('#pengumpulan_data').val();
            var pengumpulan_data_bobot = $('#pengumpulan_data_bobot').val();
            var pengumpulan_data_total = pengumpulan_data_nilai * pengumpulan_data_bobot;
            var kesesuaian_desain_nilai = $('#kesesuaian_desain').val();
            var kesesuaian_desain_bobot = $('#kesesuaian_desain_bobot').val();
            var kesesuaian_desain_total = kesesuaian_desain_nilai * kesesuaian_desain_bobot;
            var kerangka_konseptual_nilai = $('#kerangka_konseptual').val();
            var kerangka_konseptual_bobot = $('#kerangka_konseptual_bobot').val();
            var kerangka_konseptual_total = kerangka_konseptual_nilai * kerangka_konseptual_bobot;
            var logika_penulisan_nilai = $('#logika_penulisan').val();
            var logika_penulisan_bobot = $('#logika_penulisan_bobot').val();
            var logika_penulisan_total = logika_penulisan_nilai * logika_penulisan_bobot;
            var orisinalitas_nilai = $('#orisinalitas').val();
            var orisinalitas_bobot = $('#orisinalitas_bobot').val();
            var orisinalitas_total = orisinalitas_nilai * orisinalitas_bobot;
            var kesimpulan_dan_saran_nilai = $('#kesimpulan_dan_saran').val();
            var kesimpulan_dan_saran_bobot = $('#kesimpulan_dan_saran_bobot').val();
            var kesimpulan_dan_saran_total = kesimpulan_dan_saran_nilai * kesimpulan_dan_saran_bobot;
            var penyajian_nilai = $('#penyajian').val();
            var penyajian_bobot = $('#penyajian_bobot').val();
            var penyajian_total = penyajian_nilai * penyajian_bobot;
            var mempertahankan_skripsi_nilai = $('#mempertahankan_skripsi').val();
            var mempertahankan_skripsi_bobot = $('#mempertahankan_skripsi_bobot').val();
            var mempertahankan_skripsi_total = mempertahankan_skripsi_nilai * mempertahankan_skripsi_bobot;
            $('#perumusan_masalah_total').val(perumusan_masalah_total);
            $('#tinjauan_pustaka_total').val(tinjauan_pustaka_total);
            $('#pengumpulan_data_total').val(pengumpulan_data_total);
            $('#kesesuaian_desain_total').val(kesesuaian_desain_total);

            $('#kerangka_konseptual_total').val(kerangka_konseptual_total);
            $('#logika_penulisan_total').val(logika_penulisan_total);
            $('#orisinalitas_total').val(orisinalitas_total);
            $('#kesimpulan_dan_saran_total').val(kesimpulan_dan_saran_total);
            $('#penyajian_total').val(penyajian_total);
            $('#mempertahankan_skripsi_total').val(mempertahankan_skripsi_total);
            var jumlah_nilai = perumusan_masalah_nilai + tinjauan_pustaka_nilai + pengumpulan_data_nilai + kesesuaian_desain_nilai + kerangka_konseptual_nilai + logika_penulisan_nilai + orisinalitas_nilai + kesimpulan_dan_saran_nilai + penyajian_nilai + mempertahankan_skripsi_nilai;
            var jumlah_bobot = perumusan_masalah_bobot + tinjauan_pustaka_bobot + pengumpulan_data_bobot + kesesuaian_desain_bobot + kerangka_konseptual_bobot + logika_penulisan_bobot + orisinalitas_bobot + kesimpulan_dan_saran_bobot + penyajian_bobot + mempertahankan_skripsi_bobot;
            var jumlah_total = perumusan_masalah_total + tinjauan_pustaka_total + pengumpulan_data_total + kesesuaian_desain_total + kerangka_konseptual_total + logika_penulisan_total + orisinalitas_total + kesimpulan_dan_saran_total + penyajian_total + mempertahankan_skripsi_total;
            var nilai_akhir = jumlah_total / 10;
           
            $('#jumlah').val(jumlah_nilai);
            $('#jumlah_bobot').val(jumlah_bobot);
            $('#jumlah_total').val(jumlah_total);
            $('#nilai_akhir').val(nilai_akhir);
            var nilai_akhir_huruf = '';
            if(nilai_akhir >= 85)
            {
                nilai_akhir_huruf = 'A';
            }else if(nilai_akhir >= 80){
                nilai_akhir_huruf = 'A-';
            }else if(nilai_akhir >= 75){
                nilai_akhir_huruf = 'B+';
            }else if(nilai_akhir >= 70){
                nilai_akhir_huruf = 'B';
            }else if(nilai_akhir >= 65){
                nilai_akhir_huruf = 'B-';
            }else {
                nilai_akhir_huruf = 'C';
            }
            $('#nilai_akhir_huruf').text(nilai_akhir_huruf);
        })
    })
    
</script>

<?= $this->endSection(); ?>
