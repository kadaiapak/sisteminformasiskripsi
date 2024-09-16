<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<link href="<?= base_url()?>template/src/css/select2.min.css" rel="stylesheet" />
<script src="<?= base_url()?>template/src/js/select2.min.js"></script>
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Seminar Proposal</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Ajukan Seminar</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <!-- < ?= validation_list_errors(); ?> -->
                        <form class="form-horizontal form-label-left" method="POST" action="<?= base_url('seminar/'.$UUIDSkripsi.'/simpan'); ?>" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="smr_nim_m">NIM</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input readonly type="text" value="<?= $nim; ?>" name="smr_nim_m" class="form-control" id="smr_nim_m">
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="nama_mahasiswa">Nama Mahasiswa</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input readonly type="text" value="<?= $nama; ?>" class="form-control" id="nama_mahasiswa" name="nama_mahasiswa" placeholder="Tuliskan Nama">
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3" for="dosen_pembimbing">Nama Pembimbing</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input readonly type="text" value="<?= $judul_diterima->d_pembimbing_peg_gel_dep; ?><?= ($judul_diterima->d_pembimbing_peg_gel_dep != '' ? '.' : '' ); ?><?= $judul_diterima->d_pembimbing_peg_nama; ?>, <?= $judul_diterima->d_pembimbing_peg_gel_bel; ?>" name="nim_mahasiswa" class="form-control" id="nim_mahasiswa" placeholder="Tuliskan NIM">
                                </div>
                            </div>
                            <div class="form-group row">
                                    <label class="control-label col-md-3 col-sm-3" for="judul_skripsi">Judul Skripsi</label>
                                    <div class="col-md-9 col-sm-9 ">
                                        <textarea readonly class="form-control" rows="3" name="judul_skripsi" id="judul_skripsi" placeholder="Isikan judul skripsi"><?= $judul_diterima->judul_skripsi; ?></textarea>
                                    </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-lg-3 col-md-3 col-sm-3" for="smr_hari">Hari</label>
                                <div class="col-lg-4 col-md-4 col-sm-9 ">
                                    <select class="form-control <?= validation_show_error('smr_hari') ? 'is-invalid' : null; ?>" name="smr_hari" id="smr_hari">
                                        <option value="">-- Pilih Hari --</option>
                                    </select>
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('smr_hari'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" for="smr_tanggal">Tanggal</span>
                                </label>
                                <div class="col-md-4 col-sm-4">
                                    <input id="smr_tanggal" name="smr_tanggal" class="date-picker form-control <?= validation_show_error('smr_tanggal') ? 'is-invalid' : null; ?>" placeholder="dd/mm/yyyy" type="text" type="text" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
                                    <script>
                                        function timeFunctionLong(input) {
                                            setTimeout(function() {
                                                input.type = 'text';
                                            }, 60000);
                                        }
                                    </script>
                                    <?php if(validation_show_error('smr_tanggal')) { ?>
                                        <p style='color: #dc3545; font-size: 80%; margin-top: 0.25rem; margin-bottom: 0;'><?= validation_show_error('smr_tanggal'); ?></p>
                                    <?php } ?>
                                </div>
							</div>
                            <div class="form-group row">
                                <label class="control-label col-lg-3 col-md-3 col-sm-3" for="smr_ruangan">Ruangan</label>
                                <div class="col-lg-4 col-md-4 col-sm-9">
                                    <select class="form-control" id="smr_ruangan" name="smr_ruangan">
                                        <option value="">--Pilih Ruangan--</option>
                                    </select>
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('smr_ruangan'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-lg-3 col-md-3 col-sm-3" for="smr_sesi">Sesi</label>
                                <div class="col-lg-4 col-md-4 col-sm-9">
                                    <select class="form-control <?= validation_show_error('smr_sesi') ? 'is-invalid' : null; ?>" name="smr_sesi" id="smr_sesi">
                                        <option value="">-- Pilih Sesi --</option>
                                        <?php foreach($sesi as $s): ?>
                                            <option value="<?=$s['seminar_s_id'];?>"><?= $s['jam_alias']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback" style="text-align: left;">
                                        <?= validation_show_error('smr_sesi'); ?>
                                    </div>
                                </div>
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
                                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save" style="margin-right: 5px;"></i>Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <script type="text/javascript">
        $(document).ready(function() {
            // Inisialisasi Select2 untuk kategori
            $('#smr_hari').select2({
                placeholder: 'Pilih hari',
                ajax: {
                    url: '<?= site_url('seminar/getHari') ?>', // URL untuk mengambil data kategori
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                }
            });

            // Event listener ketika kategori dipilih
            $('#smr_hari').on('change', function() {
                var hari = $(this).val(); // Ambil ID kategori

                if (hari) {
                    // Aktifkan dropdown produk dan load produk yang sesuai dengan kategori
                    $('#smr_ruangan').prop('disabled', false);

                    // Inisialisasi Select2 untuk produk
                    $('#smr_ruangan').select2({
                        placeholder: 'Pilih Ruangan',
                        ajax: {
                            url: '<?= site_url('seminar/getRuangan') ?>', // URL untuk mengambil produk
                            dataType: 'json',
                            delay: 250,
                            data: function (params) {
                                return {
                                    hari: hari, // Kirimkan ID kategori ke server
                                    search : params.term
                                };
                            },
                            processResults: function (data) {
                                return {
                                    results: data
                                };
                            },
                            cache: true
                        }
                    });
                } else {
                    // Disable dropdown produk jika tidak ada kategori yang dipilih
                    $('#smr_ruangan').prop('disabled', true);
                }
            });
        });
    </script>
<?= $this->endSection(); ?>
