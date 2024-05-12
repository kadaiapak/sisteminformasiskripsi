<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Validator Instrumen</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Detail Pengajuan</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <table class="table table-striped table-bordered mb-0">
                            <tr>
                                <td class="font-weight-bold">Nomor Induk Mahasiswa (NIM)</td>
                                <td><?= $satu_instrumen['nim_pengajuan']; ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Nama Mahasiswa</td>
                                <td><?= $satu_instrumen['nama_pengajuan']; ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Departemen</td>
                                <td><?= $satu_instrumen['nama_departemen']; ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Dosen Validator 1</td>
                                <td><?= $satu_instrumen['nama_dosen_validator_satu']; ?> /   <b>Bidang :</b> <?= $satu_instrumen['bidang_dosen_validator_satu']; ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Dosen Validator 2</td>
                                <td><?= $satu_instrumen['nama_dosen_validator_dua']; ?> /   <b>Bidang :</b> <?= $satu_instrumen['bidang_dosen_validator_dua']; ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Dosen Validator 3</td>
                                <td><?= $satu_instrumen['nama_dosen_validator_tiga']; ?> /   <b>Bidang :</b> <?= $satu_instrumen['bidang_dosen_validator_tiga']; ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Judul</td>
                                <td><?= $satu_instrumen['judul']; ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Status</td>
                                <td><?= $satu_instrumen["status"] == "1" ? "<span class='badge badge-warning'>Belum diproses Admin</span>" : ($satu_instrumen["status"] == "2" ? "<span class='badge badge-danger'>Ditolak Admin</span>" : ($satu_instrumen["status"] == "3" ? "<span class='badge badge-success'>Disetujui Admin, Menunggu diproses Kadep</span>" : ($satu_instrumen["status"] == "4" ? "<span class='badge badge-danger'>Ditolak Kadep</span>" : ($satu_instrumen["status"] == "5" ? "<span class='badge badge-success'>Disetujui Kadep</span>" : null)))) ; ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Tanggal Pengajuan</td>
                                <td><?= tanggal_indo($satu_instrumen['created_at']); ?></td>
                            </tr>
                            <?php if($satu_instrumen['pesan']) { ?>
                            <tr>
                                <td class="font-weight-bold">Pesan</td>
                                <td><?= $satu_instrumen['pesan'] ; ?></td>
                            </tr>    
                            <?php } ?>
                        </table>
                        <br />
                        <?php if (session()->get('username')) { ?>
                            <a href="<?= base_url("validator-instrumen"); ?>" class="btn btn-warning btn-sm"><i class="fa fa-arrow-circle-left" style="margin-right: 5px;"></i>Kembali</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
