<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

 <!-- page content -->
 <div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Profil</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Profil <b><?= $detail_profil['peg_gel_dep']; ?><?= $detail_profil['peg_nama']; ?><?= $detail_profil['peg_gel_bel']; ?></b></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="col-md-3 col-sm-3  profile_left">
                            <div class="profile_img">
                                <!-- <div id="crop-avatar">
                                    <img class="img-responsive avatar-view" src="images/picture.jpg" alt="Avatar" title="Change the avatar">
                                </div> -->
                                <div id="crop-avatar">
                                    <div>
                                        <img alt="image" src="<?= base_url(); ?>/no-photo.jpg" class="img-fluid">
                                    </div>
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
                        <div class="col-md-9 col-sm-9 ">
                            <div class="profile_title">
                                <div class="col-md-6"><h2>Detail</h2></div>
                            </div>
                        <!-- detail mahasiswa -->
                            <table class="table table-striped table-bordered mb-0">
                                <tr>
                                    <td class="font-weight-bold">NIDN</td>
                                    <td><?= $detail_profil['nidn']; ?></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Nama</td>
                                    <td><?= $detail_profil['peg_gel_dep']; ?><?= $detail_profil['peg_nama']; ?><?= $detail_profil['peg_gel_bel']; ?></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Status</td>
                                    <td><?= $detail_profil['peg_status']; ?></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Golongan</td>
                                    <td><?= $detail_profil['peg_pangkat']; ?></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Tempat Lahir / Tanggal Lahir</td>
                                    <td><?= $detail_profil['peg_tmp_lahir']; ?>/ <?= $detail_profil['peg_tgl_lahir']; ?></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Jenis Kelamin</td>
                                    <td><?= $detail_profil['peg_sex'] == 'P' ? 'Perempuan' : ($detail_profil['peg_sex'] == 'L' ? 'Laki - laki' : null) ?></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Agama</td>
                                    <td><?= $detail_profil['peg_agama']; ?></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Hp</td>
                                    <td><?= $detail_profil['peg_hp']; ?></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Hp Aktif Terbaru</td>
                                    <td><?= $detail_profil['nohp_baru']; ?></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">No WA</td>
                                    <td><?= $detail_profil['no_wa'] ? $detail_profil['no_wa'] : ''; ?></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Email</td>
                                    <td><?= $detail_profil['peg_email']; ?></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Email</td>
                                    <td><?= $detail_profil['peg_email']; ?></td>
                                </tr>
                            </table>
                            <!-- akhir detail mahasiswa -->
                            <div id="graph_bar" style="width:100%; height:280px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- /page content -->


<?= $this->endSection(); ?>
