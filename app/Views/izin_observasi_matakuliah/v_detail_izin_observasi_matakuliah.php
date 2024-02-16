<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Izin Observasi Matakuliah</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Detail Izin Observasi Matakuliah</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <table class="table table-striped table-bordered mb-0">
                            <tr>
                                <td class="font-weight-bold">Nomor Induk Mahasiswa (NIM)</td>
                                <td><?= $satu_observasi['nim_pengajuan']; ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Nama Mahasiswa</td>
                                <td><?= $satu_observasi['nama_pengajuan']; ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Jenis Kelamin</td>
                                <td><?= $satu_observasi['jk_pengajuan'] == 'L' ? 'Laki-laki' : ($satu_observasi['jk_pengajuan'] == 'P' ? 'Perempuan' : null); ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Departemen</td>
                                <td><?= $satu_observasi['nama_departemen']; ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Tujuan Kepala Surat (Kepada Yth : ?)</td>
                                <td><?= $satu_observasi['tujuan_surat']; ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Tempat Observasi</td>
                                <td><?= $satu_observasi['tempat_observasi']; ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Alamat Tempat Observasi</td>
                                <td><?= $satu_observasi['alamat_tempat_observasi']; ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Tujuan Observasi</td>
                                <td><?= $satu_observasi['tujuan_observasi']; ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Matakuliah</td>
                                <td><?= $satu_observasi['matakuliah']; ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Tanggal Mulai Observasi</td>
                                <td><?= date('d-m-Y', strtotime($satu_observasi['tanggal_mulai'])) ; ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Tanggal Selesai Observasi</td>
                                <td><?= date('d-m-Y', strtotime($satu_observasi['tanggal_selesai'])) ; ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Status</td>
                                <td><?= $satu_observasi["status"] == "1" ? "<span class='badge badge-warning'>Belum diproses Admin</span>" : ($satu_observasi["status"] == "2" ? "<span class='badge badge-danger'>Ditolak Admin</span>" : ($satu_observasi["status"] == "3" ? "<span class='badge badge-success'>Disetujui Admin, Menunggu diproses Kadep</span>" : ($satu_observasi["status"] == "4" ? "<span class='badge badge-danger'>Ditolak Kadep</span>" : ($satu_observasi["status"] == "5" ? "<span class='badge badge-success'>Disetujui Kadep</span>" : null)))) ; ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Tanggal Pengajuan</td>
                                <td><?= date('d-m-Y', strtotime($satu_observasi['created_at'])) ; ?></td>
                            </tr>
                            <?php if($satu_observasi['pesan']) { ?>
                            <tr>
                                <td class="font-weight-bold">Pesan</td>
                                <td><?= $satu_observasi['pesan'] ; ?></td>
                            </tr>    
                            <?php } ?>
                        </table>
                            <?php if($anggota) { ?>
                            <br>
                            <table class="table table-striped table-bordered mb-0" style="width: 70%;">
                                <thead>
                                    <tr>
                                        <td class="font-weight-bold text-center"  colspan="4">Daftar Nama Teman Kelompok</td>
                                    </tr>
                                    <tr>
                                        <th class="font-weight-bold" style="width: 5%;">No</th>
                                        <th class="font-weight-bold" style="width: 10%;">NIM</th>
                                        <th class="font-weight-bold">Nama</th>
                                        <th class="font-weight-bold">Jenis Kelamin</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($anggota as $a) { ?>
                                        <tr>
                                            <td><?= $no; ?></td>
                                            <td><?= $a['nim_anggota']; ?></td>
                                            <td><?= $a['nama_anggota']; ?></td>
                                            <td><?= $a['jenis_kelamin'] == 'L' ? 'Laki - laki' : 'Perempuan'; ?></td>
                                        </tr>
                                        <?php $no++ ?>
                                    <?php } ?>
                                    
                                </tbody>
                            </table>
                            <?php } ?>
                        <br />
                        <?php if (session()->get('username')) { ?>
                            <a href="<?= base_url("izin-observasi-matakuliah"); ?>" class="btn btn-primary btn-sm"><i class="fa fa-arrow-circle-left" style="margin-right: 5px;"></i>Kembali</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
