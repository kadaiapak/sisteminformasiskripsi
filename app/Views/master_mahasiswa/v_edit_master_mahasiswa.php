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
                        <h2>Detail Mahasiswa <b><?= $satuMahasiswa['prf_nama_portal']; ?></b></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <?php $error = validation_errors() ?>
                        <?php foreach ($error as $e) { ?>
                            <div class="alert alert-danger alert-dismissible " role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                            </button>
                            <strong>Gagal!</strong> <?= $e; ?>.
                        </div>
                        <?php }; ?>
                        
                        <div class="col-md-3 col-sm-3  profile_left">
                            <div class="profile_img">
                                <!-- <div id="crop-avatar">
                                    <img class="img-responsive avatar-view" src="images/picture.jpg" alt="Avatar" title="Change the avatar">
                                </div> -->
                                <div id="crop-avatar">
                                    <a href="https://cdn.unp.ac.id/portal/<?= $satuMahasiswa['prf_nim_portal']; ?>.jpg" class="chocolat-image" title="Just an example">
                                        <div>
                                            <img alt="image" src="https://cdn.unp.ac.id/portal/<?= $satuMahasiswa['prf_nim_portal']; ?>.jpg" class="img-fluid">
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <!-- <h3>Samuel Doe</h3>
                            <ul class="list-unstyled user_data">
                                <li><i class="fa fa-map-marker user-profile-icon"></i> San Francisco, California, USA</li>
                                <li><i class="fa fa-briefcase user-profile-icon"></i> Software Engineer</li>
                                <li class="m-top-xs"><i class="fa fa-external-link user-profile-icon"></i><a href="http://www.kimlabs.com/profile/" target="_blank">www.kimlabs.com</a></li>
                            </ul>
                            <a class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a>
                            <br/>
                            <h4>Skills</h4>
                            <ul class="list-unstyled user_data">
                                <li>
                                    <p>Web Applications</p>
                                    <div class="progress progress_sm">
                                        <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
                                    </div>
                                </li>
                                <li>
                                    <p>Website Design</p>
                                    <div class="progress progress_sm">
                                    <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="70"></div>
                                    </div>
                                </li>
                                <li>
                                    <p>Automation & Testing</p>
                                    <div class="progress progress_sm">
                                        <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="30"></div>
                                    </div>
                                </li>
                                <li>
                                    <p>UI / UX</p>
                                    <div class="progress progress_sm">
                                        <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
                                    </div>
                                </li>
                            </ul> -->
                        </div>
                        <?= validation_list_errors(); ?>
                        <form class="form-horizontal form-label-left" method="POST" action="<?= base_url('/master-mahasiswa/update/'.$satuMahasiswa['prf_nim_portal']); ?>">
                        <?= csrf_field(); ?>
                            <div class="col-md-9 col-sm-9 ">
                                <div class="profile_title">
                                    <div class="col-md-6"><h2>Detail</h2></div>
                                </div>
                                <!-- detail mahasiswa -->
                                <table class="table table-striped table-bordered mb-0">
                                    <tr>
                                        <td class="font-weight-bold">Nomor Induk Mahasiswa (NIM) / Tahun Masuk</td>
                                        <td><?= $satuMahasiswa['prf_nim_portal']; ?> / <?= $satuMahasiswa['thn_msk_portal']; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Nama Mahasiswa</td>
                                        <td><?= $satuMahasiswa['prf_nama_portal']; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Id Prodi</td>
                                        <td><?= $satuMahasiswa['idprodi_portal']; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Prodi</td>
                                        <td><?= $satuMahasiswa['prodi_portal']; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">IDPDPT</td>
                                        <td>
                                            <input type="text" name="idpdpt" value="<?= old('idpdpt') ? old('idpdpt') : $satuMahasiswa['idpdpt']; ?>" placeholder="tuliskan id pdpt" class="form-control">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Nama Departemen</td>
                                        <td><?= $satuMahasiswa['nama_departemen']; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Kd Jurusan Portal</td>
                                        <td><?= $satuMahasiswa['kd_jurusan_portal']; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Nama Jurusan Portal</td>
                                        <td><?= $satuMahasiswa['nama_jurusan_portal']; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Id Fakultas Portal</td>
                                        <td><?= $satuMahasiswa['id_fakultas_portal']; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Fakultas</td>
                                        <td><?= $satuMahasiswa['nama_fakultas_portal']; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Jenjang Pendidikan</td>
                                        <td><?= $satuMahasiswa['jjp_portal']; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Tempat / Tgl Lahir</td>
                                        <td><?= $satuMahasiswa['tmp_lahir_portal']; ?>, <?= $satuMahasiswa['tgl_lahir_portal'] ?></td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">No Hp di Portal</td>
                                        <td><?= $satuMahasiswa['nohp_portal']; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">No Hp</td>
                                        <td><?= $satuMahasiswa['nohp_baru']; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">No WA</td>
                                        <td><?= $satuMahasiswa['nowa'] ? $satuMahasiswa['nowa'] : ''; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Email</td>
                                        <td><?= $satuMahasiswa['email']; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Jenis Kelamin</td>
                                        <td><?= $satuMahasiswa['jk'] == 'P' ? 'Perempuan' : ($satuMahasiswa['jk'] == 'L' ? 'Laki - laki' : null) ?></td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Agama</td>
                                        <td><?= $satuMahasiswa['agama']; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Alamat</td>
                                        <td><?= $satuMahasiswa['alamat_lengkap']; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Tanggal Bergabung di E-Office</td>
                                        <td><?= $satuMahasiswa['created_at']; ?></td>
                                    </tr>
                                </table>
                                <!-- akhir detail mahasiswa -->
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                        <a href="<?= base_url('/master-mahasiswa'); ?>" class="btn btn-warning btn-sm"><i class="fa fa-chevron-circle-left" style="margin-right: 5px;"></i>Kembali</a>
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
<script>
    document.getElementById("myframe").height = "400";
</script>
<?= $this->endSection(); ?>
