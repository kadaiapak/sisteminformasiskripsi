<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

 <!-- page content -->
 <div class="right_col" role="main">
    <div class="">
		<div class="page-title">
            <div class="title_left">
                <h3>Daftar Ruangan Terpakai</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
			<div class="x_panel">
                    <div class="x_title">
                        <h2>Data Ruangan Terpakai</h2>
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
                                                <th>Jarak dengan hari ini</th>
                                                <th>Tanggal</th>
                                                <th>Hari</th>
                                                <th>Sesi</th>
                                                <th>Ruangan</th>
                                                <th>Jenis Pemakaian</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $no = 1 ?>
                                        <?php foreach($semua_ruangan_terpakai as $srt): ?>
                                            <tr>
                                                <td><?= $no; ?></td>
                                                <td><?= perbedaan_hari($srt['smr_tanggal']); ?></td>
                                                <td><?= $srt['smr_tanggal']; ?></td>
                                                <td><?= $srt['nama_hari']; ?></td>
                                                <td><?= $srt['nama_sesi']; ?></td>
                                                <td><?= $srt['nama_ruangan']; ?></td>
                                                <td><?= $srt['jenis_pemakaian']; ?></td>
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
        <!-- /page content -->


<?= $this->endSection(); ?>
