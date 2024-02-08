<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <?php if(session()->get('level') == '1') { ?>
            <!-- menu yang bisa di akses oleh super-admin -->
        <ul class="nav side-menu">
            <h3>General</h3>
            <br />
            <li><a href="<?= base_url('/dashboard'); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
            <br />
            <h3>Pengaturan</h3>
            <br />
            <li><a><i class="fa fa-gear"></i> User <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="<?= base_url('/user_level'); ?>">User Level</a></li>
                    <li><a href="<?= base_url('/user'); ?>">User</a></li>
                    <li><a href="<?= base_url('/menu'); ?>">Menu</a></li>
                    <li><a href="<?= base_url('/akses'); ?>">Role Akses Menu</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-edit"></i> Tambahan <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="<?= base_url('/prodi'); ?>">Prodi</a></li>
                    <li><a href="<?= base_url('/departemen'); ?>">Departemen</a></li>
                    <li><a href="<?= base_url('/ruangan'); ?>">Ruangan</a></li>
                    <li><a href="<?= base_url('/sesi'); ?>">Sesi</a></li>
                    <li><a href="<?= base_url('/persyaratan'); ?>">Persyaratan</a></li>
                    <li><a href="form_advanced.html">Izin Penelitian Fakultas</a></li>
                    <li><a href="form_validation.html">Menimbang Instrumen</a></li>
                    <li><a href="form_wizards.html">Ujian Akhir</a></li>
                </ul>
            </li>
        </ul>
        <!-- akhir dari super admin -->
        <?php } ?>

        <?php if(session()->get('level') == '2') { ?>
            <!-- menu untuk admin -->
            <ul class="nav side-menu">
                <h3>General</h3>
                <br />
                <li><a href="<?= base_url('/dashboard'); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
                <br />
                <h3>Pengaturan</h3>
                <br />
                <li><a><i class="fa fa-building"></i> Ruangan <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="<?= base_url('/ruangan/pemakaian-ruangan'); ?>">Ruangan Terpakai</a></li>
                        <li><a href="<?= base_url('/ruangan/penjadwalan-ruangan'); ?>">Penjadwalan Ruangan</a></li>
                    </ul>
                </li>
                <li><a><i class="fa fa-book"></i>  Persyaratan <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="<?= base_url('/persyaratan-seminar'); ?>">Persyaratan Seminar</a></li>
                        <li><a href="<?= base_url('/persyaratan-ujian'); ?>">Persyaratan Ujian</a></li>
                    </ul>
                </li>
                <li><a><i class="fa fa-edit"></i> Tambahan <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="<?= base_url('/prodi'); ?>">Prodi</a></li>
                        <li><a href="<?= base_url('/departemen'); ?>">Departemen</a></li>
                        <li><a href="<?= base_url('/ruangan'); ?>">Ruangan</a></li>
                        <li><a href="<?= base_url('/sesi'); ?>">Sesi</a></li>
                        <li><a href="<?= base_url('/persyaratan'); ?>">Persyaratan</a></li>
                    </ul>
                </li>
            </ul>
            <!-- akhir dari admin -->
        <?php } ?>

        <?php if(session()->get('level') == '3') { ?>
            <!-- menu untuk dekan wakil dekan -->
            <ul class="nav side-menu">
                <li><a href="<?= base_url('/dashboard'); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
            </ul>
            <!-- akhir dari admin -->
        <?php } ?>

        <?php if(session()->get('level') == '4') { ?>
            <!-- menu yang bisa di akses oleh kepala departemen -->
        <ul class="nav side-menu">
            <li><a href="<?= base_url('/dashboard'); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
            <li><a href="<?= base_url('/dosen'); ?>"><i class="fa fa-graduation-cap"></i> Data Dosen</a></li>
            <li><a href="<?= base_url('/mahasiswa'); ?>"><i class="fa fa-user"></i> Data Mahasiswa</a></li>
            <li><a><i class="fa fa-book"></i> Skripsi Mahasiswa <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                <li><a href="<?= base_url('/skripsi/semua_skripsi'); ?>">Judul Skripsi</a></li>
                <li><a href="<?= base_url('/seminar/semua-seminar'); ?>">Daftar Sempro</a></li>
                <li><a href="<?= base_url('/ujian-skripsi/semua-ujian'); ?>">Daftar Ujian</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-file-text-o"></i> Pengajuan Surat <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a>Observasi Penelitian<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li class="sub_menu">
                                <a href="<?= base_url('/izin-observasi-penelitian/semua'); ?>">Belum diverifikasi</a>
                            </li>
                            <li>
                                <a href="<?= base_url('/izin-observasi-penelitian/disetujui'); ?>">Observasi Diterima</a>
                            </li>
                            <li>
                                <a href="<?= base_url('/izin-observasi-penelitian/ditolak'); ?>">Observasi Ditolak</a>
                            </li>
                        </ul>
                    </li>
                    <li><a>Validator Instrumen<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li class="sub_menu">
                                <a href="<?= base_url('/validator-instrumen/semua'); ?>">Belum diverifikasi</a>
                            </li>
                            <li>
                                <a href="<?= base_url('/validator-instrumen/disetujui'); ?>">Instrumen Diterima</a>
                            </li>
                            <li>
                                <a href="<?= base_url('/validator-instrumen/ditolak'); ?>">Instrumen Ditolak</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- akhir dari kepala departemen -->
        <?php } ?>

        <?php if(session()->get('level') == '5') { ?>
            <!-- menu yang bisa di akses oleh dosen -->
        <ul class="nav side-menu">
            <li><a href="<?= base_url('/dashboard'); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
            <li><a href="<?= base_url('/profil-dosen'); ?>"><i class="fa fa-user"></i> Profil</a></li>
            <li><a><i class="fa fa-edit"></i> Skripsi Mahasiswa <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="<?= base_url('/bimbingan'); ?>">Bimbingan</a></li>
                        <li><a href="<?= base_url('/seminar'); ?>">Seminar</a></li>
                        <li><a>Ujian Skripsi<span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li class="sub_menu"><a href="<?= base_url('/ujian-skripsi/penguji'); ?>">Penguji 1 dan 2</a></li>
                                <li><a href="<?= base_url('/ujian-skripsi/pembimbing'); ?>">Bimbingan</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
        </ul>
        <!-- akhir dari super admin -->
        <?php } ?>

        <?php if(session()->get('level') == '6') { ?>
            <!-- menu yang bisa di akses oleh mahasiswa -->
        <ul class="nav side-menu">
            <li><a href="<?= base_url('/dashboard'); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
            <li><a href="<?= base_url('/profil'); ?>"><i class="fa fa-user"></i> Profil</a></li>
            <li><a href="<?= base_url('/skripsi'); ?>"><i class="fa fa-book"></i> Skripsi</a></li>
            <li><a><i class="fa fa-file-text-o"></i> Surat Akademik <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="<?= base_url('/izin-observasi-penelitian'); ?>">Izin Observasi Penelitian</a></li>
                    <li><a href="<?= base_url('/validator-instrumen'); ?>">Validator Instrumen</a></li>
                </ul>
            </li>
        </ul>
        <!-- akhir dari mahasiswa -->
        <?php } ?>

        <?php if(session()->get('level') == '7') { ?>
            <!-- menu yang bisa di akses oleh admin departemen-->
        <ul class="nav side-menu">
            <li><a href="<?= base_url('/dashboard'); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
            <li><a><i class="fa fa-edit"></i> Skripsi Mahasiswa <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="<?= base_url('/seminar/semua-seminar'); ?>">Verifikasi Sempro</a></li>
                    <li><a href="<?= base_url('/ujian-skripsi/semua-ujian'); ?>">Verifikasi Ujian</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-file-text-o"></i> Pengajuan Surat <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a>Observasi Penelitian<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li class="sub_menu">
                                <a href="<?= base_url('/izin-observasi-penelitian/semua'); ?>">Belum diverifikasi</a>
                            </li>
                            <li>
                                <a href="<?= base_url('/izin-observasi-penelitian/disetujui'); ?>">Observasi Diterima</a>
                            </li>
                            <li>
                                <a href="<?= base_url('/izin-observasi-penelitian/ditolak'); ?>">Observasi Ditolak</a>
                            </li>
                        </ul>
                    </li>
                    <li><a>Validator Instrumen<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li class="sub_menu">
                                <a href="<?= base_url('/validator-instrumen/semua'); ?>">Belum diverifikasi</a>
                            </li>
                            <li>
                                <a href="<?= base_url('/validator-instrumen/disetujui'); ?>">Instrumen Diterima</a>
                            </li>
                            <li>
                                <a href="<?= base_url('/validator-instrumen/ditolak'); ?>">Instrumen Ditolak</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- akhir dari admin departemen -->
        <?php } ?>
    </div>
<!-- <div class="menu_section">
    <h3>Live On</h3>
    <ul class="nav side-menu">
    <li><a><i class="fa fa-bug"></i> Additional Pages <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
        <li><a href="e_commerce.html">E-commerce</a></li>
        <li><a href="projects.html">Projects</a></li>
        <li><a href="project_detail.html">Project Detail</a></li>
        <li><a href="contacts.html">Contacts</a></li>
        <li><a href="profile.html">Profile</a></li>
        </ul>
    </li>
    <li><a><i class="fa fa-windows"></i> Extras <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
        <li><a href="page_403.html">403 Error</a></li>
        <li><a href="page_404.html">404 Error</a></li>
        <li><a href="page_500.html">500 Error</a></li>
        <li><a href="plain_page.html">Plain Page</a></li>
        <li><a href="login.html">Login Page</a></li>
        <li><a href="pricing_tables.html">Pricing Tables</a></li>
        </ul>
    </li>
    <li><a><i class="fa fa-sitemap"></i> Multilevel Menu <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
            <li><a href="#level1_1">Level One</a>
            <li><a>Level One<span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
                <li class="sub_menu"><a href="level2.html">Level Two</a>
                </li>
                <li><a href="#level2_1">Level Two</a>
                </li>
                <li><a href="#level2_2">Level Two</a>
                </li>
            </ul>
            </li>
            <li><a href="#level1_2">Level One</a>
            </li>
        </ul>
    </li>                  
    <li><a href="javascript:void(0)"><i class="fa fa-laptop"></i> Landing Page <span class="label label-success pull-right">Coming Soon</span></a></li>
    </ul>
</div> -->

</div>
<!-- /sidebar menu -->