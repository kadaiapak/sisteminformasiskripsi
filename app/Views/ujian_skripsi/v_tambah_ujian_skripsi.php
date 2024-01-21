<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="right_col" role="main">
    <div class="">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>+ Ujian Skripsi</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <!-- < ?= validation_list_errors(); ?> -->
                        <form class="form-horizontal form-label-left" method="POST" action="<?= base_url('ujian-skripsi/'.$UUIDSkripsi.'/simpan'); ?>" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="us_nim_m">NIM</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input readonly type="text" value="<?= $nim; ?>" name="us_nim_m" class="form-control" id="us_nim_m">
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="nama_mahasiswa">Nama Mahasiswa</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input readonly type="text" value="<?= $nama; ?>" class="form-control" id="nama_mahasiswa" name="nama_mahasiswa" placeholder="Tuliskan Nama">
                                </div>
                            </div>
                            <div class="form-group row">
                                    <label class="control-label col-md-3 col-sm-3" for="judul_skripsi">Judul Skripsi</label>
                                    <div class="col-md-9 col-sm-9 ">
                                        <textarea readonly class="form-control" rows="3" name="judul_skripsi" id="judul_skripsi" placeholder="Isikan judul skripsi"><?= $judul_diterima->judul_skripsi; ?></textarea>
                                    </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-lg-3 col-md-3 col-sm-3" for="us_hari">Hari</label>
                                <div class="col-lg-4 col-md-4 col-sm-9 ">
                                    <select class="form-control <?= validation_show_error('us_hari') ? 'is-invalid' : null; ?>" name="us_hari" id="us_hari">
                                        <option value="">-- Pilih Hari --</option>
                                        <?php foreach ($hari as $hr) { ?>
                                            <option value="<?= $hr['hari_id']; ?>"><?= $hr['hari_nama']; ?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('us_hari'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="us_tanggal">Tanggal</span>
                                </label>
                                <div class="col-md-4 col-sm-4">
                                    <input id="us_tanggal" name="us_tanggal" class="date-picker form-control <?= validation_show_error('us_tanggal') ? 'is-invalid' : null; ?>" placeholder="dd-mm-yyyy" type="text" type="text" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
                                    <script>
                                        function timeFunctionLong(input) {
                                            setTimeout(function() {
                                                input.type = 'text';
                                            }, 60000);
                                        }
                                    </script>
                                    <?php if(validation_show_error('us_tanggal')) { ?>
                                        <p style='color: #dc3545; font-size: 80%; margin-top: 0.25rem; margin-bottom: 0;'><?= validation_show_error('us_tanggal'); ?></p>
                                    <?php } ?>
                                </div>
							</div>
                            <div class="form-group row">
                                <label class="control-label col-lg-3 col-md-3 col-sm-3" for="us_sesi">Sesi</label>
                                <div class="col-lg-4 col-md-4 col-sm-9">
                                    <select class="form-control <?= validation_show_error('us_sesi') ? 'is-invalid' : null; ?>" name="us_sesi" id="us_sesi">
                                        <option value="">-- Pilih Sesi --</option>
                                        <?php foreach($sesi as $s): ?>
                                            <option value="<?=$s['seminar_s_id'];?>"><?= $s['jam_alias']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('us_sesi'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-lg-3 col-md-3 col-sm-3" for="us_ruangan">Ruangan</label>
                                <div class="col-lg-4 col-md-4 col-sm-9">
                                    <select class="form-control <?= validation_show_error('us_ruangan') ? 'is-invalid' : null; ?>" name="us_ruangan" id="us_ruangan">
                                        <option value="">-- Pilih Ruangan --</option>
                                        <?php foreach($ruangan as $r): ?>
                                            <option value="<?=$r['seminar_r_id'];?>"><?= $r['ruangan_alias']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('us_ruangan'); ?>
                                    </div>
                                </div>
                                <!-- cek ketersediaan ruangan -->
                                <div class="col-md-3 col-sm-3">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-xl">Klik untuk Cek Ruangan Terpakai</button>
                                    <div class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myModalLabel">Daftar Ruangan yang Terpakai</h4>
                                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                <?php
                                                    $db = db_connect();
                                                    $query = "SELECT `seminar`.`smr_tanggal`, `seminar`.`smr_nim_m`,`seminar`.`smr_ruangan`,`seminar`.`created_at`,`seminar_sesi`.`jam_alias`,`seminar`.`smr_status` FROM `seminar` JOIN `seminar_sesi` ON `seminar_sesi`.`seminar_s_id` = `seminar`.`smr_sesi` ORDER BY `smr_id` ASC";
                                                    $semua_seminar= $db->query($query)->getResultArray();
                                                    ?>
                                                    <?php
                                                    $query = "SELECT `seminar_ruangan`.`seminar_r_id`, `seminar_ruangan`.`ruangan_alias`,`seminar_ruangan`.`ruangan_keterangan`,`seminar_ruangan`.`ruangan_status` FROM `seminar_ruangan` ORDER BY `seminar_r_id` ASC";
                                                    $semua_ruangan = $db->query($query)->getResultArray();
                                                    ?>
                                                    <div class="row">
                                                    <?php foreach ($semua_ruangan as $sr) { ?>
                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="x_panel">
                                                                <div class="x_title">
                                                                    <h2 style="display: flex; justify-content: center;"><?= $sr['ruangan_alias']; ?> <?= $sr['ruangan_status'] == 1 ? "<span class='badge badge-success ml-2'>Aktif</span>" : ($sr['ruangan_status'] == 0 ? "<span class='badge badge-danger ml-2'>Tidak Aktif</span>" : null) ; ?></h2>
                                                                    <div class="clearfix"></div>
                                                                </div>
                                                                <div class="x_content">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="card-box table-responsive">
                                                                                <table class="table table-striped jambo_table bulk_action">
                                                                                    <thead>
                                                                                        <tr class="headings">
                                                                                            <th class="column-title">Hari/Tanggal</th>
                                                                                            <th class="column-title"><span class="nobr">Sesi</span>
                                                                                            <th class="column-title"><span class="nobr">Tanggal Pengajuan</span>
                                                                                            <th class="column-title"><span class="nobr">Status</span>
                                                                                            </th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <?php 
                                                                                        $tanggal_sekarang = date('d-m-Y');
                                                                                        $tanggal_sekarang_format = new DateTime($tanggal_sekarang);
                                                                                        $tanggal_akhir =  date('d-m-Y', strtotime($tanggal_sekarang.'7days'));	
                                                                                        $tanggal_akhir_format = new DateTime($tanggal_akhir);
                                                                                        $interval = DateInterval::createFromDateString('1 day');
                                                                                        $periode = new DatePeriod($tanggal_sekarang_format, $interval, $tanggal_akhir_format);
                                                                                        foreach($periode as $pd){ ?>
                                                                                            <?php foreach($semua_seminar as $sse) {?>
                                                                                                <?php if($sse['smr_tanggal'] == $pd->format('Y-m-d') && $sse['smr_ruangan'] == $sr['seminar_r_id'] ) { ?>
                                                                                                    <tr>
                                                                                                        <td><?= $pd->format('d-m-Y'); ?></td>
                                                                                                        <td><?= $sse['jam_alias']; ?></td>
                                                                                                        <td><?= date('d-m-Y H:i:s', strtotime($sse['created_at'])) ; ?></td>
                                                                                                        <?php if($sse['smr_status'] == 1) { ?>
                                                                                                        <td class="badge badge-warning">Pengajuan</td>
                                                                                                        <?php }elseif($sse['smr_status'] == 2 || $sse['smr_status'] == 3) {?>
                                                                                                        <td class="badge badge-success">Terpakai</td>
                                                                                                        <?php } ?>
                                                                                                    </tr>
                                                                                                <?php } ?>
                                                                                            <?php } ?>
                                                                                        <?php } ?>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- akhir dari cek ketersediaan ruangan -->
                            </div>
                            <?php foreach ($persyaratan_seminar as $ps) { ?>
                                 <div class="form-group row">
                                 <label class="control-label col-md-3 col-sm-3" for="<?= $ps['persyaratan_id']; ?>"><?= $ps['ps_nama']; ?></label>
                                 <div class="col-md-9 col-sm-9 ">
                                     <input class="form-control <?= validation_show_error($ps['persyaratan_id']) ? 'is-invalid' : null; ?>" type="file" id="<?= $ps['persyaratan_id']; ?>" name="<?= $ps['persyaratan_id']; ?>">
                                     <div class="invalid-feedback" style="text-align: left;">
                                         <?= validation_show_error($ps['persyaratan_id']); ?>
                                     </div>
                                 </div>
                             </div>
                            <?php } ?>
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
<script>
   $(document).ready(function() {
    $('#nama_pembimbing').select2();
});
$(document).ready(function() {
    $('#nama_dosen_pa').select2();
});
</script>
<?= $this->endSection(); ?>
