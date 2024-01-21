<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
 <!-- page content -->
 <div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Daftar Dosen</h3>
            </div>
            <div class="title_right">
                <div class="col-md-5 col-sm-5 form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                            <button class="btn btn-secondary" type="button">Go!</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Data Dosen</h2>
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
                                                <th>Nama Dosen</th>
                                                <th>NIDN</th>
                                                <th>NIP</th>
                                                <th>Total Membimbing</th>
                                                <th>Total PA</th>
                                                <th>Total Penguji 1</th>
                                                <th>Total Penguji 2</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $no = 1 ?>
                                        <?php foreach($semua_dosen as $sd): ?>
                                            <tr>
                                                <td><?= $no; ?></td>
                                                <td><?= $sd->peg_gel_dep; ?> <?= $sd->peg_nama; ?> <?= $sd->peg_gel_bel; ?></td>
                                                <td><?= $sd->nidn; ?></td>
                                                <td><?= $sd->peg_nip; ?></td>
                                                <td><?= $sd->total_membimbing; ?></td>
                                                <td><?= $sd->total_menjadi_pa; ?></td>
                                                <td><?= $sd->total_menguji_satu; ?></td>
                                                <td><?= $sd->total_menguji_dua; ?></td>
                                                <td>
                                                    <a href="" class="btn btn-primary btn-sm">Detail</a>
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
