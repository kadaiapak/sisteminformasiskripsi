<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
 <!-- page content -->
 <div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Data Master Dosen</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Daftar Dosen</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div style="margin-bottom: 10px;">
							<a href="<?= base_url("master-dosen/tambah"); ?>" class="btn btn-success btn-sm"><i class="fa fa-plus-square" style="margin-right: 5px;"></i>Tambah Data Dosen</a>
						</div>
                        <div class="row">
                            <div class="col-sm-6 col-md-6">
                                <div class="card-box table-responsive">
                                    <table class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nidn = Kosong</th>
                                                <th>NIP</th>
                                                <th>Nama</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $no = 1 ?>
                                        <?php foreach($semuaNidnKosong as $snk): ?>
                                            <tr>
                                                <td><?= $no; ?></td>
                                                <td><?= $snk['nidn']; ?></td>
                                                <td><?= $snk['peg_nip']; ?></td>
                                                <td><?= $snk['peg_gel_dep']; ?> <?= $snk['peg_nama']; ?> <?= $snk['peg_gel_bel']; ?></td>
                                                <td>
                                                    <a href="<?= base_url('master-dosen/pengaturan/edit/'.$snk['nidn']); ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit" style="margin-right: 5px;"></i>Edit</a>
                                                </td>
                                            <?php $no++ ?> 
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="card-box table-responsive">
                                    <table class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nidn</th>
                                                <th>NIP = kosong</th>
                                                <th>Nama</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $no = 1 ?>
                                        <?php foreach($semuaNipKosong as $snk): ?>
                                            <tr>
                                                <td><?= $no; ?></td>
                                                <td><?= $snk['nidn']; ?></td>
                                                <td><?= $snk['peg_nip']; ?></td>
                                                <td><?= $snk['peg_gel_dep']; ?> <?= $snk['peg_nama']; ?> <?= $snk['peg_gel_bel']; ?></td>
                                                <td>
                                                    <a href="<?= base_url('master-dosen/pengaturan/edit/'.$snk['nidn']); ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit" style="margin-right: 5px;"></i>Edit</a>
                                                </td>
                                            <?php $no++ ?> 
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="card-box table-responsive">
                                    <table class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>NIDN</th>
                                                <th>Nama</th>
                                                <th>Gelar Depan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $no = 1 ?>
                                        <?php foreach($semuaGelarDepan as $sgd): ?>
                                            <tr>
                                                <td><?= $no; ?></td>
                                                <td><?= $sgd['nidn']; ?></td>
                                                <td><?= $sgd['peg_gel_dep']; ?> <?= $sgd['peg_nama']; ?> <?= $sgd['peg_gel_bel']; ?></td>
                                                <td><?= $sgd['peg_gel_dep']; ?></td>
                                                <td>
                                                    <a href="<?= base_url('master-dosen/pengaturan/edit/'.$sgd['nidn']); ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit" style="margin-right: 5px;"></i>Edit</a>
                                                </td>
                                            <?php $no++ ?> 
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="card-box table-responsive">
                                    <table class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>NIDN</th>
                                                <th>Nama</th>
                                                <th>Gelar Belakang</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $no = 1 ?>
                                        <?php foreach($semuaGelarBelakang as $sgb): ?>
                                            <tr>
                                                <td><?= $no; ?></td>
                                                <td><?= $sgb['nidn']; ?></td>
                                                <td><?= $sgb['peg_gel_dep']; ?> <?= $sgb['peg_nama']; ?> <?= $sgb['peg_gel_bel']; ?></td>
                                                <td><?= $sgb['peg_gel_bel']; ?></td>
                                                <td>
                                                    <a href="<?= base_url('master-dosen/pengaturan/edit/'.$sgb['nidn']); ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit" style="margin-right: 5px;"></i>Edit</a>
                                                </td>
                                            <?php $no++ ?> 
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="card-box table-responsive">
                                    <table class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>NIDN</th>
                                                <th>Nama</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $no = 1 ?>
                                        <?php foreach($semuaStatus as $ss): ?>
                                            <tr>
                                                <td><?= $no; ?></td>
                                                <td><?= $ss['nidn']; ?></td>
                                                <td><?= $ss['peg_gel_dep']; ?> <?= $ss['peg_nama']; ?> <?= $ss['peg_gel_bel']; ?></td>
                                                <td><?= $ss['peg_status']; ?></td>
                                                <td>
                                                    <a href="<?= base_url('master-dosen/pengaturan/edit/'.$ss['nidn']); ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit" style="margin-right: 5px;"></i>Edit</a>
                                                </td>
                                            <?php $no++ ?> 
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="card-box table-responsive">
                                    <table class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>NIDN</th>
                                                <th>Nama</th>
                                                <th>Bidang</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $no = 1 ?>
                                        <?php foreach($semuaBidang as $sb): ?>
                                            <tr>
                                                <td><?= $no; ?></td>
                                                <td><?= $sb['nidn']; ?></td>
                                                <td><?= $sb['peg_gel_dep']; ?> <?= $sb['peg_nama']; ?> <?= $sb['peg_gel_bel']; ?></td>
                                                <td><?= $sb['peg_bidang']; ?></td>
                                                <td>
                                                    <a href="<?= base_url('master-dosen/pengaturan/edit/'.$sb['nidn']); ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit" style="margin-right: 5px;"></i>Edit</a>
                                                </td>
                                            <?php $no++ ?> 
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="card-box table-responsive">
                                    <table class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>NIDN</th>
                                                <th>Nama</th>
                                                <th>Pangkat</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $no = 1 ?>
                                        <?php foreach($semuaPangkat as $sp): ?>
                                            <tr>
                                                <td><?= $no; ?></td>
                                                <td><?= $sp['nidn']; ?></td>
                                                <td><?= $sp['peg_gel_dep']; ?> <?= $sp['peg_nama']; ?> <?= $sp['peg_gel_bel']; ?></td>
                                                <td><?= $sp['peg_pangkat']; ?></td>
                                                <td>
                                                    <a href="<?= base_url('master-dosen/pengaturan/edit/'.$sp['nidn']); ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit" style="margin-right: 5px;"></i>Edit</a>
                                                </td>
                                            <?php $no++ ?> 
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="card-box table-responsive">
                                    <table class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>NIDN</th>
                                                <th>Nama</th>
                                                <th>Golongan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $no = 1 ?>
                                        <?php foreach($semuaGolongan as $sg): ?>
                                            <tr>
                                                <td><?= $no; ?></td>
                                                <td><?= $sg['nidn']; ?></td>
                                                <td><?= $sg['peg_gel_dep']; ?> <?= $sg['peg_nama']; ?> <?= $sg['peg_gel_bel']; ?></td>
                                                <td><?= $sg['peg_golongan']; ?></td>
                                                <td>
                                                    <a href="<?= base_url('master-dosen/pengaturan/edit/'.$sg['nidn']); ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit" style="margin-right: 5px;"></i>Edit</a>
                                                </td>
                                            <?php $no++ ?> 
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="card-box table-responsive">
                                    <table class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>NIDN</th>
                                                <th>Nama</th>
                                                <th>Jabatan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $no = 1 ?>
                                        <?php foreach($semuaJabatan as $sj): ?>
                                            <tr>
                                                <td><?= $no; ?></td>
                                                <td><?= $sj['nidn']; ?></td>
                                                <td><?= $sj['peg_gel_dep']; ?> <?= $sj['peg_nama']; ?> <?= $sj['peg_gel_bel']; ?></td>
                                                <td><?= $sj['peg_jabatan']; ?></td>
                                                <td>
                                                    <a href="<?= base_url('master-dosen/pengaturan/edit/'.$sj['nidn']); ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit" style="margin-right: 5px;"></i>Edit</a>
                                                </td>
                                            <?php $no++ ?> 
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="card-box table-responsive">
                                    <table class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>NIDN</th>
                                                <th>Nama</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $no = 1 ?>
                                        <?php foreach($semuaJenisKelamin as $sjk): ?>
                                            <tr>
                                                <td><?= $no; ?></td>
                                                <td><?= $sjk['nidn']; ?></td>
                                                <td><?= $sjk['peg_gel_dep']; ?> <?= $sjk['peg_nama']; ?> <?= $sjk['peg_gel_bel']; ?></td>
                                                <td><?= $sjk['peg_sex']; ?></td>
                                                <td>
                                                    <a href="<?= base_url('master-dosen/pengaturan/edit/'.$sjk['nidn']); ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit" style="margin-right: 5px;"></i>Edit</a>
                                                </td>
                                            <?php $no++ ?> 
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="card-box table-responsive">
                                    <table class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>NIDN</th>
                                                <th>Nama</th>
                                                <th>Agama</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $no = 1 ?>
                                        <?php foreach($semuaAgama as $sa): ?>
                                            <tr>
                                                <td><?= $no; ?></td>
                                                <td><?= $sa['nidn']; ?></td>
                                                <td><?= $sa['peg_gel_dep']; ?> <?= $sa['peg_nama']; ?> <?= $sa['peg_gel_bel']; ?></td>
                                                <td><?= $sa['peg_agama']; ?></td>
                                                <td>
                                                    <a href="<?= base_url('master-dosen/pengaturan/edit/'.$sa['nidn']); ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit" style="margin-right: 5px;"></i>Edit</a>
                                                </td>
                                            <?php $no++ ?> 
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="card-box table-responsive">
                                    <table class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>NIDN</th>
                                                <th>Nama</th>
                                                <th>Pendidikan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $no = 1 ?>
                                        <?php foreach($semuaPendidikan as $sp): ?>
                                            <tr>
                                                <td><?= $no; ?></td>
                                                <td><?= $sp['nidn']; ?></td>
                                                <td><?= $sp['peg_gel_dep']; ?> <?= $sp['peg_nama']; ?> <?= $sp['peg_gel_bel']; ?></td>
                                                <td><?= $sp['peg_pendidikan']; ?></td>
                                                <td>
                                                    <a href="<?= base_url('master-dosen/pengaturan/edit/'.$sp['nidn']); ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit" style="margin-right: 5px;"></i>Edit</a>
                                                </td>
                                            <?php $no++ ?> 
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="card-box table-responsive">
                                    <table class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>NIDN</th>
                                                <th>Nama</th>
                                                <th>Status Pernikahan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $no = 1 ?>
                                        <?php foreach($semuaStatusPernikahan as $ssp): ?>
                                            <tr>
                                                <td><?= $no; ?></td>
                                                <td><?= $ssp['nidn']; ?></td>
                                                <td><?= $ssp['peg_gel_dep']; ?> <?= $ssp['peg_nama']; ?> <?= $ssp['peg_gel_bel']; ?></td>
                                                <td><?= $ssp['peg_kawin']; ?></td>
                                                <td>
                                                    <a href="<?= base_url('master-dosen/pengaturan/edit/'.$ssp['nidn']); ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit" style="margin-right: 5px;"></i>Edit</a>
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
