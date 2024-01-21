<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="right_col" role="main">
    <div class="">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>+ Seminar Proposal</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <!-- < ?= validation_list_errors(); ?> -->
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="smr_nim_m">NIM</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input readonly type="text" value="<?= $satu_seminar->smr_nim_m; ?>" name="smr_nim_m" class="form-control" id="smr_nim_m">
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="nama_mahasiswa">Nama Mahasiswa</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input readonly type="text" value="<?= session()->get('nama'); ?>" class="form-control" id="nama_mahasiswa" name="nama_mahasiswa">
                                </div>
                            </div>  
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="dosen_pembimbing">Nama Pembimbing</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input readonly type="text" value="<?= $satu_seminar->d_pembimbing_peg_gel_dep; ?><?= ($satu_seminar->d_pembimbing_peg_gel_dep != '' ? '.' : '' ); ?><?= $satu_seminar->d_pembimbing_peg_nama; ?>, <?= $satu_seminar->d_pembimbing_peg_gel_bel; ?>" name="nim_mahasiswa" class="form-control" id="nim_mahasiswa" placeholder="Tuliskan NIM">
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="dosen_pembimbing">Nama Penguji 1</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input readonly type="text" value="<?= $satu_seminar->d_penguji_satu_peg_gel_dep; ?><?= $satu_seminar->d_penguji_satu_peg_gel_dep != '' ? '.' : ''; ?><?= $satu_seminar->d_penguji_satu_peg_nama; ?>, <?= $satu_seminar->d_penguji_satu_peg_gel_bel; ?>" name="nim_mahasiswa" class="form-control" id="nim_mahasiswa" placeholder="Tuliskan NIM">
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="dosen_pembimbing">Nama Penguji 2</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input readonly type="text" value="<?= $satu_seminar->d_penguji_dua_peg_gel_dep; ?><?= $satu_seminar->d_penguji_dua_peg_gel_dep != '' ? '.' : ''; ?><?= $satu_seminar->d_penguji_dua_peg_nama; ?>, <?= $satu_seminar->d_penguji_dua_peg_gel_bel; ?>" name="nim_mahasiswa" class="form-control" id="nim_mahasiswa" placeholder="Tuliskan NIM">
                                </div>
                            </div>
                            <div class="form-group row">
                                    <label class="control-label col-md-3 col-sm-3" for="judul_skripsi">Judul Skripsi</label>
                                    <div class="col-md-9 col-sm-9 ">
                                        <textarea readonly class="form-control" rows="3" name="judul_skripsi" id="judul_skripsi" placeholder="Isikan judul skripsi"><?= $satu_seminar->judul_skripsi; ?></textarea>
                                    </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="smr_hari">Hari</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input readonly type="text" value="<?= $satu_seminar->smr_hari == 1 ? 'Senin' : ($satu_seminar->smr_hari == 2 ? 'Selasa' : ($satu_seminar->smr_hari == 3 ? 'Rabu' : ($satu_seminar->smr_hari == 4 ? 'Kamis' : ($satu_seminar->smr_hari == 5 ? 'Jumat' : ($satu_seminar == 6 ? 'Sabtu' : ($satu_seminar == 7 ? 'Minggu' : '')))))); ?>" name="nim_mahasiswa" class="form-control" id="nim_mahasiswa" placeholder="Tuliskan NIM">
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
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9  offset-md-3">
                                    <a href="<?= base_url('/skripsi'); ?>" class="btn btn-warning btn-sm"><i class="fa fa-chevron-circle-left" style="margin-right: 5px;"></i>Kembali</a>
                                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-plus-square" style="margin-right: 5px;"></i>Tambah</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
