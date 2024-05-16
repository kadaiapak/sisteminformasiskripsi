<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Data Master Mahasiswa</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
            <div class="x_panel">
                    <div class="x_title">
                        <h2>Detail Judul</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="col-md-6 col-sm-6">
                            <!-- detail mahasiswa -->
                            <table class="table table-striped table-bordered mb-0">
                                <tr>
                                    <td class="font-weight-bold">Tanggal Pengajuan</td>
                                    <td><?= tanggal_indo($satuJudul['created_at']); ?></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Nomor Induk Mahasiswa (NIM)</td>
                                    <td><?= $satuJudul['nim_mahasiswa']; ?></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Nama Mahasiswa</td>
                                    <td><?= $satuJudul['nama_mahasiswa']; ?></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Departemen</td>
                                    <td><?= $satuJudul['nama_departemen']; ?></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Periode Pengajuan</td>
                                    <td><?= $satuJudul['periode_pengajuan'] == 1 ? 'Januari - Juni' : ($satuJudul['periode_pengajuan'] == 2 ? 'Juli - Desember' : null); ?></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Tahun Pengajuan</td>
                                    <td><?= $satuJudul['tahun_pengajuan']; ?></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Judul Skripsi</td>
                                    <td><?= $satuJudul['judul_skripsi']; ?></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Deskripsi Skripsi</td>
                                    <td><?= $satuJudul['deskripsi_skripsi']; ?></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Konsentrasi Bidang</td>
                                    <td><?= $satuJudul['konsentrasi_bidang']; ?></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Dosen Pembimbing</td>
                                    <td><?= $satuJudul['d_pembimbing_peg_gel_dep']; ?> <?= $satuJudul['d_pembimbing_peg_nama']; ?> <?= $satuJudul['d_pembimbing_peg_gel_bel']; ?></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Dosen Pa</td>
                                    <td><?= $satuJudul['d_pa_peg_gel_dep']; ?> <?= $satuJudul['d_pa_peg_nama']; ?> <?= $satuJudul['d_pa_peg_gel_bel']; ?></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Status Pengajuan</td>
                                    <td><?= $satuJudul['status_pengajuan_skripsi'] == 1 ? "<span class='badge badge-warning'>Proses</span>" : ($satuJudul['status_pengajuan_skripsi'] == 2 ? "<span class='badge badge-danger'>Ditolak</span>" : ($satuJudul['status_pengajuan_skripsi'] == 3 ? "<span class='badge badge-success'>Disetujui</span>" : null)); ?></td>
                                </tr>
                            </table>
                            <!-- akhir detail mahasiswa -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="form-group">
                        <a href="<?= base_url('/master-judul'); ?>" class="btn btn-warning btn-sm"><i class="fa fa-chevron-circle-left" style="margin-right: 5px;"></i>Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById("myframe").height = "400";
</script>
<?= $this->endSection(); ?>
