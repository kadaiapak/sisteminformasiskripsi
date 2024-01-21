<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
 <!-- page content -->
 <div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Bimbingan Skripsi</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <h1><?= $judul_skripsi['judul_skripsi']; ?></h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>List Bimbingan</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Subjek Perbaikan</th>
                                                <th>Rincian Perbaikan</th>
                                                <th>Data Pendukung</th>
                                                <th>Apakah sudah diverikasi</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $no = 1 ?>
                                        <?php foreach($semua_bimbingan as $sb): ?>
                                            <tr>
                                                <td><?= $no; ?></td>
                                                <td><?= $sb['bb_subjek']; ?></td>
                                                <td><?= $sb['bb_isi']; ?></td>
                                                <td><?= $sb['bb_data_dukung'] != null ? "<i class='fa fa-file-pdf-o' style='text-align: center; vertical-align:middle;'></i>" : "<i class='fa fa-remove'></i>"; ?></td>
                                                <td><?= $sb['is_verifikasi'] == 0 ? "<span class='badge badge-warning'>Belum diverifikasi</span>" : ($sb['is_verifikasi'] == 1 ? "<span class='badge badge-success'>Sudah diverifikasi</span>" : "") ?></td>
                                                <td>
                                                    <form action="<?= base_url('bimbingan/diverifikasi-dosen/'.$sb['bimbingan_id']); ?>" method="POST">
                                                        <?= csrf_field(); ?>
                                                        <input type="hidden" name="UUIDSkripsi" value="<?= $UUIDSkripsi; ?>">
                                                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-check-square-o" style="margin-right: 5px;"></i>Verifikasi</button>
                                                    </form>
                                                </td>
                                            <?php $no++ ?>
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
</div>
<?= $this->endSection(); ?>
