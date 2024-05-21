<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Homedua::index');
$routes->get('/dashboard', 'Dashboard::index');

// ROUTE LOGIN
$routes->get('/auth/login', 'Auth::login');
$routes->get('/auth/mahasiswa', 'Auth::login_mahasiswa');
$routes->get('/auth/logout', 'Auth::logout');
// $routes->post('/auth/loginProcess', 'Auth::loginProcess');
$routes->post('/auth/login/proses', 'Auth::login_proses');
$routes->post('/auth/mahasiswa/proses', 'Auth::login_mahasiswa_proses');
// AKHIR ROUTE LOGIN

// ROUTES UNTUK Surat
    // bisa di akses oleh mahasiswa untuk melihat surat mereka
    $routes->get('/preview-surat/(:any)', 'Surat::preview/$1');
// AKHIR DARI ROUTE UNTUK Surat

// route untuk bimbingan
    // akses oleh dosen pembimbing
    // untuk melihat list siapa saja mahasiswa yang dosen tersebut bimbing
    $routes->get('/bimbingan', 'Bimbingan::index', ['filter' => 'dosenFilter']);

    // akses oleh mahasiswa
    // untuk menambahkan bimbingan baru
    $routes->get('/bimbingan/tambah-bimbingan', 'Bimbingan::tambah' , ['filter' => 'mahasiswaFilter']);

    // akses oleh mahasiswa
    // untuk menyimpan bimbingan yang baru ditambahkan
    $routes->post('/bimbingan/(:any)/simpan', 'Bimbingan::simpan/$1' , ['filter' => 'mahasiswaFilter']);
 
    // akses oleh dosen pembimbing
    // untuk menampilkan detail dari bimbingan agar dosen
    $routes->get('/bimbingan/verifikasi-dosen/(:any)', 'Bimbingan::verifikasi_dosen/$1', ['filter' => 'dosenFilter']);

    // akses oleh dosen pembimbing
    // untuk update verifikasi bimbingan oleh dosen
    $routes->post('/bimbingan/diverifikasi-dosen/(:any)', 'Bimbingan::diverifikasi_dosen/$1',  ['filter' => 'dosenFilter']);
// akhir dari route untuk bimbingan

// route untuk DOSEN
    // bisa di akses oleh kadep
    $routes->get('/dosen', 'Dosen::index', ['filter' => 'kadepFilter']);
    $routes->get('/dosen/detail/(:num)', 'Dosen::detail/$1', ['filter' => 'kadepFilter']);
// akhir route DOSEN

// route untuk MAHASISWA
    // bisa di akses oleh kadep
    $routes->get('/mahasiswa', 'Mahasiswa::index', ['filter' => 'kadepFilter']);
    $routes->get('/mahasiswa/detail-skripsi/(:num)', 'Mahasiswa::detail_skripsi/$1', ['filter' => 'kadepFilter']);
    $routes->get('/mahasiswa/detail-seminar/(:any)/(:any)', 'Mahasiswa::detail_seminar/$1/$2', ['filter' => 'kadepFilter']);
    $routes->get('/mahasiswa/detail-ujian-skripsi/(:any)', 'Mahasiswa::detail_ujian_skripsi/$1', ['filter' => 'kadepFilter']);
    // akhir dari bisa di akses oleh kadep
// akhir route MAHASISWA

    
// route untuk User Level
    // bisa di akses oleh super admin 
    $routes->get('/user_level', 'UserLevel::index', ['filter' => 'superAdminFilter']);
    // bisa di akses oleh super admin 
    $routes->get('/user_level/tambah', 'UserLevel::tambah', ['filter' => 'superAdminFilter']);
    // bisa di akses oleh super admin 
    $routes->post('/user_level/simpan', 'UserLevel::simpan', ['filter' => 'superAdminFilter']);
    // bisa di akses oleh super admin 
    $routes->get('/user_level/(:any)/edit', 'UserLevel::edit/$1', ['filter' => 'superAdminFilter']);
    // bisa di akses oleh super admin 
    $routes->post('/user_level/(:any)/update', 'UserLevel::update/$1', ['filter' => 'superAdminFilter']);
// akhir dari route untuk User 

// route untuk User
    // bisa di akses oleh super admin 
    $routes->get('/user', 'User::index', ['filter' => 'superAdminFilter']);
    // bisa di akses oleh super admin 
    $routes->get('/user/tambah', 'User::tambah', ['filter' => 'superAdminFilter']);
    // bisa di akses oleh super admin 
    $routes->post('/user/simpan', 'User::simpan', ['filter' => 'superAdminFilter']);
    // bisa di akses oleh super admin 
    $routes->get('/user/(:any)/edit', 'User::edit/$1', ['filter' => 'superAdminFilter']);
    // bisa di akses oleh super admin 
    $routes->post('/user/(:any)/update', 'User::update/$1', ['filter' => 'superAdminFilter']);
// akhir dari route untuk User

// route untuk Menu
    // bisa di akses oleh super admin 
    $routes->get('/menu', 'Menu::index', ['filter' => 'superAdminFilter']);
    // bisa di akses oleh super admin 
    $routes->get('/menu/tambah', 'Menu::tambah', ['filter' => 'superAdminFilter']);
    // bisa di akses oleh super admin 
    $routes->post('/menu/simpan', 'Menu::simpan', ['filter' => 'superAdminFilter']);
    // bisa di akses oleh super admin 
    $routes->get('/menu/(:any)/edit', 'Menu::edit/$1', ['filter' => 'superAdminFilter']);
    // bisa di akses oleh super admin 
    $routes->post('/menu/(:any)/update', 'Menu::update/$1', ['filter' => 'superAdminFilter']);
// akhir dari route untuk User

// route untuk ajukan judul
    // akses oleh mahasiswa
    // menampilkan semua proses skripsi yang bisa dilihat oleh mahasiswa
    $routes->get('/skripsi', 'Skripsi::index', ['filter' => 'mahasiswaFilter']);
    // akses oleh mahasiswa
    //  pengajuan judul oleh mahasiswa dan bisa diakhses oleh mahasiswa
    $routes->get('/skripsi/ajukan-judul', 'Skripsi::ajukan_judul', ['filter' => 'mahasiswaFilter']);
    // akses oleh mahasiswa
    // route untuk proses menyimpan judul yang diajukan di database
    $routes->post('/skripsi/simpan_judul', 'Skripsi::simpan_judul', ['filter' => 'mahasiswaFilter']);
    // akses oleh kadep
    // route melihat semua skripsi mahasiswa
    $routes->get('/skripsi/semua_skripsi', 'Skripsi::semua_skripsi', ['filter' => 'kadepFilter']);

    // akses oleh kadep
    // route melihat semua skripsi mahasiswa
    $routes->post('/skripsi/semua-skripsi/export-excel', 'Skripsi::semua_skripsi_export_excel', ['filter' => 'kadepFilter']);

    // akses oleh kadep
    // route untuk lihat detail skripsi
    $routes->get('/skripsi/verifikasi/(:any)', 'Skripsi::proses_skripsi_oleh_kadep/$1', ['filter' => 'kadepFilter']);

    // akses oleh kadep
    // route untuk memverifikasi atau menolak pengajuan judul skripsi mahasiswa oleh kadep
    $routes->post('/skripsi/(:any)/proses', 'Skripsi::update_skripsi_oleh_kadep/$1', ['filter' => 'kadepFilter'] );

    // akses oleh mahasiswa
    // route untuk perbaikan judul yang sudah di acc
    $routes->get('/skripsi/perbaikan-judul/(:any)', 'Skripsi::perbaikan_judul/$1', ['filter' => 'mahasiswaFilter'] );

    // akses oleh mahasiswa
    // route untuk simpan perbaikan judul yang sudah di acc
    $routes->post('/skripsi/simpan-perbaikan-judul/(:any)', 'Skripsi::simpan_perbaikan_judul/$1', ['filter' => 'mahasiswaFilter'] );

// $routes->get('/skripsi/edit_skripsi', 'Skripsi::edit_skripsi');
// $routes->get('/skripsi/edit_skripsi/(:num)', 'Skripsi::edit_skripsi/$1');
// $routes->post('/skripsi/simpan_edit_skripsi/(:num)', 'Skripsi::update_skripsi/$1');
// akhir dari route ajukan judul




// route untuk seminar proposal
    // diakses olej mahasiswa untuk menambah seminar
    $routes->get('/seminar/ajukan-seminar', 'Seminar::tambah', ['filter' => 'mahasiswaFilter']);
    // diakses olej mahasiswa untuk mengikuti seminar
    $routes->get('/seminar/mengikuti-seminar', 'Seminar::mengikuti_seminar', ['filter' => 'mahasiswaFilter']);

    // diakses oleh dosen untuk melihat semua seminar yang akan ia hadiri
    $routes->get('/seminar', 'Seminar::index', ['filter' => 'dosenFilter'] );// sudah di filter dengan filter dosen

    // diakses oleh kadep dan admin departemen untuk melakukan verifikasi
    $routes->get('/seminar/semua-seminar', 'Seminar::semua_seminar', ['filter' => 'adminDepartemenDanKadepFilter' ]);
   
    // diakses oleh mahasiswa untuk menyimpan seminar yang ditambah
    $routes->post('/seminar/(:any)/simpan', 'Seminar::simpan/$1' , ['filter' => 'mahasiswaFilter']);

    // diakses oleh mahasiswa untuk menyimpan mengikuti seminar yang ditambah
    $routes->post('/seminar/simpan-mengikuti-seminar', 'Seminar::simpan_mengikuti_seminar' , ['filter' => 'mahasiswaFilter']);

    $routes->get('/seminar/detail/(:any)/(:any)', 'Seminar::detail/$1/$2'); // masih belum tau siapa saja yang bisa melihat detail seminar
    // digunakan untuk melihat detail seminar lewat scan barcode
    $routes->get('/seminar/detail-seminar/(:any)', 'Seminar::detail_seminar/$1');
    // bisa di akses oleh admin departemen dan kadep
    $routes->get('/seminar/verifikasi/(:any)/(:num)', 'Seminar::verifikasi/$1/$2', ['filter' => 'adminDepartemenDanKadepFilter' ]);
    // bisa di akses oleh admin untuk menolak pengajuan seminar oleh mahasiswa
    $routes->post('/seminar/(:any)/tolak_admin', 'Seminar::tolak_admin/$1', ['filter' => 'adminDepartemenFilter']);
    // bisa di akses oleh admin untuk menyetujui pengajuan seminar oleh mahasiswa
    $routes->post('/seminar/(:any)/verifikasi_admin', 'Seminar::verifikasi_admin/$1', ['filter' => 'adminDepartemenFilter']);
    // $routes->post('/seminar/(:any)/verifikasi_admin', 'Seminar::verifikasi_admin/$1', ['filter' => 'adminDepartemenFilter']);

    // bisa di akses oleh admin untuk mengembalikan seminar mahasiswa kembali menjadi proses
    $routes->post('/seminar/(:any)/kembalikan_status', 'Seminar::kembalikan_status/$1' , ['filter' => 'adminDepartemenFilter']);
    // bisa di akses oleh kadep untuk menolak pengajuan seminar oleh mahasiswa
    $routes->post('/seminar/(:any)/tolak_kadep', 'Seminar::tolak_kadep/$1', ['filter' => 'kadepFilter']);
    // bisa di akses oleh kadep untuk menyetujui pengajuan seminar oleh mahasiswa
    $routes->post('/seminar/(:any)/verifikasi_kadep', 'Seminar::verifikasi_kadep/$1', ['filter' => 'kadepFilter']);
    // routes untuk print surat oleh mahasiswa mahasiswa
    $routes->get('/seminar/print-surat/(:any)', 'Seminar::print_surat/$1');



// akhir dari route untuk seminar proposal

// route untuk ujian skripsi
    // diakses oleh admin dan kadep untuk melakukan verifikasi
    $routes->get('/ujian-skripsi/semua-ujian', 'UjianSkripsi::semua_ujian', ['filter' => 'adminDepartemenDanKadepFilter' ]);
    // diakses olej mahasiswa untuk menambah seminar
    $routes->get('/ujian-skripsi/ajukan', 'UjianSkripsi::tambah', ['filter' => 'mahasiswaFilter']);
    // diakses oleh mahasiswa untuk menyimpan seminar yang ditambah
    $routes->post('/ujian-skripsi/(:any)/simpan', 'UjianSkripsi::simpan/$1', ['filter' => 'mahasiswaFilter']);
    // $routes->get('/ujian_skripsi/(:any)/detail', 'Seminar::detail/$1');
    // bisa di akses oleh admin dan kadep               
    $routes->get('/ujian-skripsi/verifikasi/(:any)/(:num)', 'UjianSkripsi::verifikasi/$1/$2', ['filter' => 'adminDepartemenDanKadepFilter' ]);
    // bisa di akses oleh admin untuk menyetujui pengajuan seminar oleh mahasiswa
    $routes->post('/ujian-skripsi/(:any)/verifikasi_admin', 'UjianSkripsi::verifikasi_admin/$1', ['filter' => 'adminDepartemenFilter']);
    // bisa di akses oleh admin untuk menolak pengajuan seminar oleh mahasiswa
    $routes->post('/ujian-skripsi/(:any)/tolak_admin', 'UjianSkripsi::tolak_admin/$1', ['filter' => 'adminDepartemenFilter']);
    // bisa di akses oleh admin untuk mengembalikan seminar mahasiswa kembali menjadi proses
    $routes->post('/ujian-skripsi/(:any)/kembalikan_status', 'UjianSkripsi::kembalikan_status/$1', ['filter' => 'adminDepartemenFilter']);
    // bisa di akses oleh kadep untuk menyetujui pengajuan seminar oleh mahasiswa
    $routes->post('/ujian-skripsi/(:any)/verifikasi_kadep', 'UjianSkripsi::verifikasi_kadep/$1', ['filter' => 'kadepFilter']);
    // bisa di akses oleh kadep untuk menolak pengajuan seminar oleh mahasiswa
    $routes->post('/ujian-skripsi/(:any)/tolak_kadep', 'UjianSkripsi::tolak_kadep/$1', ['filter' => 'kadepFilter']);
    
    // digunakan oleh dosen pembimbing untuk melihat list semua mahasiswa yang akan di input nilai ujian skripsi
    // $routes->get('/ujian-skripsi/penguji', 'UjianSkripsi::penguji');

    // digunakan oleh dosen pembimbing untuk melihat list semua mahasiswa yang akan di input nilai ujian skripsi
    $routes->get('/ujian-skripsi/pembimbing', 'UjianSkripsi::pembimbing', ['filter' => 'dosenFilter']);
    // digunakan untuk input nilai ujian skripsi oleh penguji dan pembimbing
    $routes->get('/ujian-skripsi/input-nilai/(:any)', 'UjianSkripsi::input_nilai/$1', ['filter' => 'dosenFilter']);
    // digunakan untuk input nilai ujian skripsi oleh penguji dan pembimbing
    $routes->get('/ujian-skripsi/edit-nilai/(:any)', 'UjianSkripsi::edit_nilai/$1', ['filter' => 'dosenFilter']);
    // digunakan untuk menyimpan inputan nilai ujian skripsi oleh penguji dan pembimbing
    $routes->post('/ujian-skripsi/(:any)/simpan-nilai', 'UjianSkripsi::simpan_nilai/$1', ['filter' => 'dosenFilter']);
    // digunakan untuk menyimpan nilai ujian skripsi yang di EDIT oleh penguji dan pembimbing
    $routes->post('/ujian-skripsi/(:any)/simpan-edit', 'UjianSkripsi::simpan_edit/$1', ['filter' => 'dosenFilter']);
    // digunakan untuk input nilai ujian skripsi oleh penguji dan pembimbing
    $routes->get('/ujian-skripsi/berita-acara/(:any)', 'UjianSkripsi::berita_acara/$1', ['filter' => 'dosenFilter']);
    // digunakan untuk simpan berita acara ujian skripsi oleh penguji dan pembimbing
    $routes->post('/ujian-skripsi/simpan-berita-acara', 'UjianSkripsi::simpan_berita_acara', ['filter' => 'dosenFilter']);
    // digunakan untuk cetak surat ujian skripsi
    $routes->get('/ujian-skripsi/print-surat/(:any)', 'UjianSkripsi::print_surat/$1');

    $routes->get('/ujian-skripsi/rekap', 'UjianSkripsi::rekap', ['filter' => 'adminDepartemenDanKadepFilter' ]);
    $routes->get('/ujian-skripsi/detail-rekap/(:any)', 'UjianSkripsi::detail_rekap/$1', ['filter' => 'adminDepartemenDanKadepFilter' ]);
    // digunakan untuk cetak surat ujian skripsi
    $routes->get('/ujian-skripsi/detail-ujian/(:any)', 'UjianSkripsi::detail_ujian/$1');
// akhir dari route untuk seminar proposal


// $routes->get('/skripsi/upload-skripsi', 'Skripsi::upload_skripsi');


// route by kadep

// ROUTE PROFIL
    // diakses oleh mahasiswa untuk meilhat detail profil mereka
    $routes->get('/profil', 'Profil::index', ['filter' => 'mahasiswaFilter']);
   // diakses mahasiswa untuk melakukan verifikasi data pertama kali saat dia menggunakan aplikasi ini
   $routes->get('/profil/verifikasi', 'Profil::verifikasi', ['filter' => 'mahasiswaFilter']);
   // diakses mahasiswa untuk melakukan verifikasi data pertama kali saat dia menggunakan aplikasi ini
   $routes->post('/profil/update_verifikasi', 'Profil::update_verifikasi', ['filter' => 'mahasiswaFilter']);
// AKHIR ROUTE PROFIL

// ROUTE PROFIL DOSEN
    // diakses oleh dosen untuk meilhat detail profil mereka
    $routes->get('/profil-dosen', 'ProfilDosen::index', ['filter' => 'dosenFilter']);
    // diakses oleh dosen untuk menambahkan data diri
    $routes->get('/profil-dosen/tambah', 'ProfilDosen::tambah', ['filter' => 'dosenFilter']);
    // diakses oleh dosen untuk menyimpan data yang sudah diisi
    $routes->post('/profil-dosen/simpan', 'ProfilDosen::simpan', ['filter' => 'dosenFilter']);
   // diakses oleh dosen untuk melakukan verifikasi data pertama kali saat dia menggunakan aplikasi ini
   $routes->get('/profil-dosen/verifikasi', 'ProfilDosen::verifikasi', ['filter' => 'dosenFilter']);
   // diakses oleh dosen untuk melakukan verifikasi data pertama kali saat dia menggunakan aplikasi ini
   $routes->post('/profil-dosen/update_verifikasi', 'ProfilDosen::update_verifikasi', ['filter' => 'dosenFilter']);
// AKHIR ROUTE PROFIL

// login

// ROUTE DEPARTEMEN
    // bisa di akses oleh admin dan super admin  untuk menampilkan semua departemen
    $routes->get('/departemen', 'Departemen::index',['filter' => 'adminDanSuperAdminFilter']);
    // bisa di akses oleh admin dan super admin menambah departemen 
    $routes->get('/departemen/tambah', 'Departemen::tambah',['filter' => 'adminDanSuperAdminFilter']);
    // bisa di akses oleh admin dan super admin meyimpan data departemen yang ditambah 
    $routes->post('/departemen/simpan', 'Departemen::simpan', ['filter' => 'adminDanSuperAdminFilter']);
    // bisa di akses oleh admin dan super admin edit data departemen 
    $routes->get('/departemen/(:any)/edit', 'Departemen::edit/$1',['filter' => 'adminDanSuperAdminFilter']);
    // bisa di akses oleh admin dan super admin untuk update departemen
    $routes->post('/departemen/(:any)/update', 'Departemen::update/$1',['filter' => 'adminDanSuperAdminFilter']);
// AKHIR ROUTE DEPARTEMEN

// ROUTE PRODI
    // bisa di akses oleh admin dan super admin  untuk menampilkan semua departemen
    $routes->get('/prodi', 'Prodi::index' ,['filter' => 'adminDanSuperAdminFilter']);
    // bisa di akses oleh admin dan super admin menambah prodi 
    $routes->get('/prodi/tambah', 'Prodi::tambah' ,['filter' => 'adminDanSuperAdminFilter']);
    // bisa di akses oleh admin dan super admin meyimpan data prodi yang ditambah 
    $routes->post('/prodi/simpan', 'Prodi::simpan' ,['filter' => 'adminDanSuperAdminFilter']);
    // bisa di akses oleh admin dan super admin edit data prodi 
    $routes->get('/prodi/(:any)/edit', 'Prodi::edit/$1' ,['filter' => 'adminDanSuperAdminFilter']);
    // bisa di akses oleh admin dan super admin untuk update data prodi
    $routes->post('/prodi/(:any)/update', 'Prodi::update/$1' ,['filter' => 'adminDanSuperAdminFilter']);
// AKHIR ROUTE PRODI

// ROUTES ruangan
    // bisa di akses oleh admin dan super admin
    $routes->get('/ruangan', 'Ruangan::index' , ['filter' => 'adminDanSuperAdminFilter']);
    // bisa di akses oleh admin dan super admin
    $routes->get('/ruangan/tambah', 'Ruangan::tambah' ,['filter' => 'adminDanSuperAdminFilter']);
    // bisa di akses oleh admin dan super admin
    $routes->post('/ruangan/simpan', 'Ruangan::simpan',['filter' => 'adminDanSuperAdminFilter']);
    // bisa di akses oleh admin dan super admin
    $routes->post('/ruangan/{:num}/aktif', 'Ruangan::aktif/$1',['filter' => 'adminDanSuperAdminFilter']);
    // bisa di akses oleh admin dan super admin
    $routes->post('/ruangan/{:num}/nonaktif', 'Ruangan::nonaktif/$1',['filter' => 'adminDanSuperAdminFilter']);
    // bisa di akses oleh admin dan super admin
    $routes->get('/ruangan/pemakaian-ruangan', 'Ruangan::pemakaian_ruangan', ['filter' => 'adminDanSuperAdminFilter']);
    // bisa di akses oleh admin dan super admin
    $routes->get('/ruangan/penjadwalan-ruangan', 'PenjadwalanRuangan::index', ['filter' => 'adminDanSuperAdminFilter']);
    // bisa di akses oleh admin dan super admin
    $routes->get('/ruangan/penjadwalan-ruangan/edit/(:any)', 'PenjadwalanRuangan::edit/$1', ['filter' => 'adminDanSuperAdminFilter']);
    // bisa di akses oleh admin dan super admin
    $routes->get('/ruangan/penjadwalan-ruangan/tambah', 'PenjadwalanRuangan::tambah', ['filter' => 'adminDanSuperAdminFilter']);
     // bisa di akses oleh admin dan super admin
     $routes->post('/ruangan/penjadwalan-ruangan/simpan', 'PenjadwalanRuangan::simpan', ['filter' => 'adminDanSuperAdminFilter']);
// AKHIR ROUTES RUANGAN

// ROUTES UNTUK LIST RUANGAN TERPAKAI
    $routes->get('/daftar-ruangan-terpakai', 'Ruangan::daftar_ruangan_terpakai');
    $routes->post('/ruangan/cari', 'Ruangan::cari');
    $routes->post('/ruangan/hapus-cari', 'Ruangan::hapus_cari');
// AKHIR DARI LIST RUANGNA TERPAKAI

// ROUTES SESI
    // bisa di akses oleh admin dan super admin
    $routes->get('/sesi', 'Sesi::index' ,['filter' => 'adminDanSuperAdminFilter']);
    // bisa di akses oleh admin dan super admin
    $routes->get('/sesi/tambah', 'Sesi::tambah',['filter' => 'adminDanSuperAdminFilter']);
    // bisa di akses oleh admin dan super admin
    $routes->post('/sesi/simpan', 'Sesi::simpan',['filter' => 'adminDanSuperAdminFilter']);
// AKHIR ROUTES SESI

// ROUTES PERSYARATAM
    // bisa di akses oleh admin dan super admin
    $routes->get('/persyaratan', 'Persyaratan::index',['filter' => 'adminDanSuperAdminFilter']);
    // bisa di akses oleh admin dan super admin
    $routes->get('/persyaratan/tambah', 'Persyaratan::tambah',['filter' => 'adminDanSuperAdminFilter']);
    // bisa di akses oleh admin dan super admin
    $routes->post('/persyaratan/simpan', 'Persyaratan::simpan',['filter' => 'adminDanSuperAdminFilter']);
// AKHIR ROUTES PERSYARATAN

// ROUTES UNTUK PERSYARATAN SEMINAR
    // bisa di akses oleh admin dan super admin
    $routes->get('/persyaratan-seminar', 'PersyaratanSeminar::index',['filter' => 'adminDanSuperAdminFilter']);
    $routes->get('/persyaratan-seminar/detail/(:any)', 'PersyaratanSeminar::detail/$1',['filter' => 'adminDanSuperAdminFilter']);
    $routes->post('/persyaratan-seminar/simpan_edit', 'PersyaratanSeminar::simpan_edit',['filter' => 'adminDanSuperAdminFilter']);
// AKHIR DARI ROUTE UNTUK PERSYARATAN SEMINAR

// ROUTES UNTUK PERSYARATAN UJIAN
    // bisa di akses oleh admin dan super admin
    $routes->get('/persyaratan-ujian', 'PersyaratanUjian::index',['filter' => 'adminDanSuperAdminFilter']);
    $routes->get('/persyaratan-ujian/detail/(:any)', 'PersyaratanUjian::detail/$1',['filter' => 'adminDanSuperAdminFilter']);
    $routes->post('/persyaratan-ujian/simpan_edit', 'PersyaratanUjian::simpan_edit',['filter' => 'adminDanSuperAdminFilter']);
// AKHIR DARI ROUTE UNTUK PERSYARATAN SEMINAR

// ROUTES UNTUK SURAT AKADEMIK
// surat izin observasi penelitian
    // bisa di akses oleh mahasiswa untuk menampilkan pengajuan surat yang telah mereka buat
    $routes->get('/izin-observasi-penelitian', 'IzinObservasiPenelitian::index', ['filter' => 'mahasiswaFilter']);
    // bisa di akses oleh mahasiswa untuk membuat surat izin observasi penelitian
    $routes->get('/izin-observasi-penelitian/tambah', 'IzinObservasiPenelitian::tambah', ['filter' => 'mahasiswaFilter']);
    // bisa di akses oleh mahasiswa untuk menyimpan surat izin observasi penelitian
    $routes->post('/izin-observasi-penelitian/simpan', 'IzinObservasiPenelitian::simpan', ['filter' => 'mahasiswaFilter']);
    // bisa di akses oleh admin departemen dan kepala departemen untuk melihat semua pengajuan surat izin observasi penelitian yang digunakan untuk verifikasi
    $routes->get('/izin-observasi-penelitian/semua', 'IzinObservasiPenelitian::semua', ['filter' => 'adminDepartemenDanKadepFilter']);
    // routes untuk detail
    $routes->get('/izin-observasi-penelitian/detail/(:any)', 'IzinObservasiPenelitian::detail/$1', ['filter' => 'mahasiswaFilter']);
    // routes untuk edit
    $routes->get('/izin-observasi-penelitian/edit/(:any)', 'IzinObservasiPenelitian::edit/$1', ['filter' => 'mahasiswaFilter']);
    // routes untuk edit oleh admin
    $routes->get('/izin-observasi-penelitian/edit-admin/(:any)', 'IzinObservasiPenelitian::edit_admin/$1', ['filter' => 'adminDepartemenDanKadepFilter']);
    // routes untuk simpan edit
    $routes->post('/izin-observasi-penelitian/update/(:any)', 'IzinObservasiPenelitian::update/$1', ['filter' => 'mahasiswaFilter']);
    // routes untuk simpan edit oleh admin
    $routes->post('/izin-observasi-penelitian/update-admin/(:any)', 'IzinObservasiPenelitian::update_admin/$1', ['filter' => 'adminDepartemenDanKadepFilter']);
    // bisa di akses oleh admin departemen dan kepala departemen untuk melihat semua pengajuan surat izin observasi penelitian yang disetujui digunakan untuk verifikasi
    $routes->get('/izin-observasi-penelitian/disetujui', 'IzinObservasiPenelitian::disetujui', ['filter' => 'adminDepartemenDanKadepFilter']);
    // bisa di akses oleh admin departemen dan kepala departemen untuk melihat semua pengajuan surat izin observasi penelitian yang ditolak digunakan untuk verifikasi
    $routes->get('/izin-observasi-penelitian/ditolak', 'IzinObservasiPenelitian::ditolak', ['filter' => 'adminDepartemenDanKadepFilter']);
    // bisa di akses oleh admin departemen dan kepala departemen untuk melihat detail pengajuan surat izin observasi penelitian yang akan digunakan untuk verifikasi
    $routes->get('/izin-observasi-penelitian/detail-verifikasi/(:any)', 'IzinObservasiPenelitian::detail_verifikasi/$1', ['filter' => 'adminDepartemenDanKadepFilter']);

    // bisa di akses oleh admin departemen dan kepala departemen untuk menyetujui semua pengajuan surat izin observasi penelitian
    $routes->post('/izin-observasi-penelitian/setujui-admin/(:any)', 'IzinObservasiPenelitian::setujui_admin/$1', ['filter' => 'adminDepartemenDanKadepFilter']);
    // bisa di akses oleh admin departemen dan kepala departemen untuk menolak semua pengajuan surat izin observasi penelitian
    $routes->post('/izin-observasi-penelitian/tolak-admin/(:any)', 'IzinObservasiPenelitian::tolak_admin/$1', ['filter' => 'adminDepartemenDanKadepFilter']);
    // bisa di akses oleh admin departemen dan kepala departemen untuk menyetujui semua pengajuan surat izin observasi penelitian
    $routes->post('/izin-observasi-penelitian/setujui-kadep/(:any)', 'IzinObservasiPenelitian::setujui_kadep/$1', ['filter' => 'adminDepartemenDanKadepFilter']);
    // bisa di akses oleh admin departemen dan kepala departemen untuk menolak semua pengajuan surat izin observasi penelitian
    $routes->post('/izin-observasi-penelitian/tolak-kadep/(:any)', 'IzinObservasiPenelitian::tolak_kadep/$1', ['filter' => 'adminDepartemenDanKadepFilter']);

    // routes untuk print surat oleh mahasiswa mahasiswa
    $routes->get('/izin-observasi-penelitian/print-surat/(:any)', 'IzinObservasiPenelitian::print_surat/$1');

    // routes untuk print surat oleh mahasiswa mahasiswa
    $routes->get('/izin-observasi-penelitian/detail-izin-observasi/(:any)', 'IzinObservasiPenelitian::detail_izin_observasi/$1');

// AKHIR ROUTES SURAT AKADEMIK
    // bisa di akses oleh mahasiswa untuk menampilkan pengajuan surat yang telah mereka buat
    $routes->get('/validator-instrumen', 'ValidatorInstrumen::index', ['filter' => 'mahasiswaFilter']);
    // bisa di akses oleh mahasiswa untuk membuat surat validator instrumen
    $routes->get('/validator-instrumen/tambah', 'ValidatorInstrumen::tambah', ['filter' => 'mahasiswaFilter']);
    // bisa di akses oleh mahasiswa untuk menyimpan surat validator instrumen
    $routes->post('/validator-instrumen/simpan', 'ValidatorInstrumen::simpan', ['filter' => 'mahasiswaFilter']);
    // bisa di akses oleh mahasiswa untuk edit surat validator instrumen
    $routes->get('/validator-instrumen/edit/(:any)', 'ValidatorInstrumen::edit/$1', ['filter' => 'mahasiswaFilter']);
     // bisa di akses oleh mahasiswa untuk memperbarui surat validator instrumen
    $routes->post('/validator-instrumen/simpan-pembaruan', 'ValidatorInstrumen::simpan_pembaruan', ['filter' => 'mahasiswaFilter']);
    // bisa di akses oleh admin departemen dan kepala departemen untuk melihat semua pengajuan validator instrumen yang digunakan untuk verifikasi
    $routes->get('/validator-instrumen/semua', 'ValidatorInstrumen::semua', ['filter' => 'adminDepartemenDanKadepFilter']);
    // bisa di akses oleh admin untuk edit validator instrumen
    $routes->get('/validator-instrumen/edit-admin/(:any)', 'ValidatorInstrumen::edit_admin/$1', ['filter' => 'adminDepartemenFilter']);
     // bisa di akses oleh mahasiswa untuk memperbarui surat validator instrumen
    $routes->post('/validator-instrumen/simpan-pembaruan-admin', 'ValidatorInstrumen::simpan_pembaruan_admin', ['filter' => 'adminDepartemenFilter']);
    // bisa di akses oleh admin departemen dan kepala departemen untuk melihat semua pengajuan surat izin validator yang disetujui digunakan untuk verifikasi
    $routes->get('/validator-instrumen/disetujui', 'ValidatorInstrumen::disetujui', ['filter' => 'adminDepartemenDanKadepFilter']);
    // bisa di akses oleh admin departemen dan kepala departemen untuk melihat semua pengajuan surat izin validator yang ditolak digunakan untuk verifikasi
    $routes->get('/validator-instrumen/ditolak', 'ValidatorInstrumen::ditolak', ['filter' => 'adminDepartemenDanKadepFilter']);
    // bisa di akses oleh admin departemen dan kepala departemen untuk melihat detail pengajuan surat izin validator instrumen yang akan digunakan untuk verifikasi
    $routes->get('/validator-instrumen/detail-verifikasi/(:any)', 'ValidatorInstrumen::detail_verifikasi/$1', ['filter' => 'adminDepartemenDanKadepFilter']);
    // bisa di akses oleh admin departemen dan kadep untuk menyetujui semua pengajuan surat validator instrumen
    $routes->post('/validator-instrumen/setujui-admin/(:any)', 'ValidatorInstrumen::setujui_admin/$1', ['filter' => 'adminDepartemenDanKadepFilter']);
    // bisa di akses oleh admin departemen dan kadep untuk menolak semua pengajuan surat validator instrumen
    $routes->post('/validator-instrumen/tolak-admin/(:any)', 'ValidatorInstrumen::tolak_admin/$1', ['filter' => 'adminDepartemenDanKadepFilter']);
    // bisa di akses oleh admin departemen dan kepala departemen untuk menyetujui semua pengajuan surat izin observasi penelitian
    $routes->post('/validator-instrumen/setujui-kadep/(:any)', 'ValidatorInstrumen::setujui_kadep/$1', ['filter' => 'adminDepartemenDanKadepFilter']);
    // bisa di akses oleh admin departemen dan kepala departemen untuk menolak semua pengajuan surat validator instrumen
    $routes->post('/validator-instrumen/tolak-kadep/(:any)', 'ValidatorInstrumen::tolak_kadep/$1', ['filter' => 'adminDepartemenDanKadepFilter']);

    // routes untuk print surat oleh mahasiswa mahasiswa
    $routes->get('/validator-instrumen/print-surat/(:any)', 'ValidatorInstrumen::print_surat/$1');

    // routes untuk print surat oleh mahasiswa mahasiswa
    $routes->get('/validator-instrumen/detail-validator-instrumen/(:any)', 'ValidatorInstrumen::detail_validator_instrumen/$1');

// ROUTES IZIN OBSERVASI MATAKULIAH
    // AKSES OLEH MAHASISWA
    // bisa di akses oleh mahasiswa untuk menampilkan pengajuan surat yang telah mereka buat
    $routes->get('/izin-observasi-matakuliah', 'IzinObservasiMatakuliah::index', ['filter' => 'mahasiswaFilter']);
    // bisa di akses oleh mahasiswa untuk membuat surat validator instrumen
    $routes->get('/izin-observasi-matakuliah/tambah', 'IzinObservasiMatakuliah::tambah', ['filter' => 'mahasiswaFilter']);
    // bisa di akses oleh mahasiswa untuk menyimpan surat validator instrumen
    $routes->post('/izin-observasi-matakuliah/simpan', 'IzinObservasiMatakuliah::simpan', ['filter' => 'mahasiswaFilter']);
    // bisa di akses oleh mahasiswa untuk menampilkan detail pengajuan surat izin observasi matakuliah yang akan di edit
    $routes->get('/izin-observasi-matakuliah/edit/(:any)', 'IzinObservasiMatakuliah::edit/$1', ['filter' => 'mahasiswaFilter']);
    // bisa di akses oleh mahasiswa untuk menampilkan form edit data izin observasi matakuliah
    $routes->get('/izin-observasi-matakuliah/edit-pengajuan/(:any)', 'IzinObservasiMatakuliah::edit_pengajuan/$1', ['filter' => 'mahasiswaFilter']);
    // bisa di akses oleh mahasiswa untuk memperbarui surat validator instrumen
    $routes->post('/izin-observasi-matakuliah/simpan-pembaruan-pengajuan', 'IzinObservasiMatakuliah::simpan_pembaruan_pengajuan', ['filter' => 'mahasiswaFilter']);
    // bisa di akses oleh mahasiswa untuk memperbarui anggota
    $routes->post('/izin-observasi-matakuliah/simpan-pembaruan-anggota', 'IzinObservasiMatakuliah::simpan_pembaruan_anggota', ['filter' => 'mahasiswaFilter']);
    //  bisa di akses oleh mahasiswa untuk menghapus anggota
    $routes->delete('/izin-observasi-matakuliah/hapus-anggota/(:num)', 'IzinObservasiMatakuliah::hapus_anggota/$1', ['filter' => 'adminDepartemenDanMahasiswaFilter']);
    // menambahkan anggota izin observasi matakulia oleh mahasiswa
    $routes->post('/izin-observasi-matakuliah/tambah-anggota', 'IzinObservasiMatakuliah::tambah_anggota', ['filter' => 'mahasiswaFilter']);
    // routes untuk print surat oleh mahasiswa mahasiswa
    $routes->get('/izin-observasi-matakuliah/print-surat/(:any)', 'IzinObservasiMatakuliah::print_surat/$1');
    // routes untuk scan barcode
    $routes->get('/izin-observasi-matakuliah/detail/(:any)', 'IzinObservasiMatakuliah::detail/$1', ['filter' => 'mahasiswaFilter']);
    // routes untuk cetak surat oleh mahasiswa versi 2
    $routes->post('/izin-observasi-matakuliah/cetak', 'IzinObservasiMatakuliah::cetak');

    // AKSES OLEH ADMIN
    // bisa di akses oleh admin departemen dan kepala departemen untuk melihat semua pengajuan validator instrumen yang digunakan untuk verifikasi
    $routes->get('/izin-observasi-matakuliah/semua', 'IzinObservasiMatakuliah::semua', ['filter' => 'adminDepartemenDanKadepFilter']);
    // bisa di akses oleh admin untuk edit validator instrumen
    $routes->get('/izin-observasi-matakuliah/edit-admin/(:any)', 'IzinObservasiMatakuliah::edit_admin/$1', ['filter' => 'adminDepartemenFilter']);
    // bisa di akses oleh mahasiswa untuk menampilkan form edit data izin observasi matakuliah
    $routes->get('/izin-observasi-matakuliah/admin-edit-pengajuan/(:any)', 'IzinObservasiMatakuliah::admin_edit_pengajuan/$1', ['filter' => 'adminDepartemenDanKadepFilter']);
    // bisa di akses oleh mahasiswa untuk memperbarui surat validator instrumen
    $routes->post('/izin-observasi-matakuliah/admin-simpan-pembaruan-pengajuan', 'IzinObservasiMatakuliah::admin_simpan_pembaruan_pengajuan', ['filter' => 'adminDepartemenDanKadepFilter']);
    // bisa di akses oleh mahasiswa untuk memperbarui anggota
    $routes->post('/izin-observasi-matakuliah/admin-simpan-pembaruan-anggota', 'IzinObservasiMatakuliah::admin_simpan_pembaruan_anggota', ['filter' => 'adminDepartemenDanKadepFilter']);
    // bisa di akses oleh admin departemen dan kepala departemen untuk melihat semua pengajuan surat izin validator yang disetujui digunakan untuk verifikasi
    $routes->get('/izin-observasi-matakuliah/disetujui', 'IzinObservasiMatakuliah::disetujui', ['filter' => 'adminDepartemenDanKadepFilter']);
    // bisa di akses oleh admin departemen dan kepala departemen untuk melihat semua pengajuan surat izin validator yang ditolak digunakan untuk verifikasi
    $routes->get('/izin-observasi-matakuliah/ditolak', 'IzinObservasiMatakuliah::ditolak', ['filter' => 'adminDepartemenDanKadepFilter']);
    // bisa di akses oleh admin departemen dan kepala departemen untuk melihat detail pengajuan surat izin validator instrumen yang akan digunakan untuk verifikasi
    $routes->get('/izin-observasi-matakuliah/detail-verifikasi/(:any)', 'IzinObservasiMatakuliah::detail_verifikasi/$1', ['filter' => 'adminDepartemenDanKadepFilter']);
    // bisa di akses oleh admin departemen dan kadep untuk menolak semua pengajuan surat validator instrumen
    $routes->post('/izin-observasi-matakuliah/tolak-admin/(:any)', 'IzinObservasiMatakuliah::tolak_admin/$1', ['filter' => 'adminDepartemenDanKadepFilter']);
    // bisa di akses oleh admin departemen dan kadep untuk menyetujui semua pengajuan surat validator instrumen
    $routes->post('/izin-observasi-matakuliah/setujui-admin/(:any)', 'IzinObservasiMatakuliah::setujui_admin/$1', ['filter' => 'adminDepartemenDanKadepFilter']);
    // bisa di akses oleh admin departemen dan kepala departemen untuk menolak semua pengajuan surat validator instrumen
    $routes->post('/izin-observasi-matakuliah/tolak-kadep/(:any)', 'IzinObservasiMatakuliah::tolak_kadep/$1', ['filter' => 'adminDepartemenDanKadepFilter']);
    // bisa di akses oleh admin departemen dan kepala departemen untuk menyetujui semua pengajuan surat izin observasi matakuliah
    $routes->post('/izin-observasi-matakuliah/setujui-kadep/(:any)', 'IzinObservasiMatakuliah::setujui_kadep/$1', ['filter' => 'adminDepartemenDanKadepFilter']);
    // routes untuk scan barcode
    $routes->get('/izin-observasi-matakuliah/scan-barcode/(:any)', 'IzinObservasiMatakuliah::scan_barcode/$1');


// ROUTES UNTUK IZIN PENELITIAN
    // AKSES OLEH MAHASISWA
    // bisa di akses oleh mahasiswa untuk menampilkan pengajuan surat yang telah mereka buat
    $routes->get('/izin-penelitian', 'IzinPenelitian::index', ['filter' => 'mahasiswaFilter']);
    // bisa di akses oleh mahasiswa untuk membuat surat validator instrumen
    $routes->get('/izin-penelitian/tambah', 'IzinPenelitian::tambah', ['filter' => 'mahasiswaFilter']);
    // bisa di akses oleh mahasiswa untuk menyimpan surat validator instrumen
    $routes->post('/izin-penelitian/simpan', 'IzinPenelitian::simpan', ['filter' => 'mahasiswaFilter']);
    // routes untuk scan barcode
    $routes->get('/izin-penelitian/detail/(:any)', 'IzinPenelitian::detail/$1', ['filter' => 'mahasiswaFilter']);
    // bisa di akses oleh mahasiswa untuk menampilkan detail pengajuan surat izin observasi matakuliah yang akan di edit
    $routes->get('/izin-penelitian/edit/(:any)', 'IzinPenelitian::edit/$1', ['filter' => 'mahasiswaFilter']);
    // bisa di akses oleh mahasiswa untuk memperbarui surat validator instrumen
    $routes->post('/izin-penelitian/simpan-pembaruan', 'IzinPenelitian::simpan_pembaruan', ['filter' => 'mahasiswaFilter']);
    // routes untuk cetak surat oleh mahasiswa versi 2
    $routes->post('/izin-penelitian/cetak', 'IzinPenelitian::cetak');
    // routes untuk scan barcode
    $routes->get('/izin-penelitian/scan-barcode/(:any)', 'IzinPenelitian::scan_barcode/$1');
    // AKHIR ROUTE USER
    // AKSES OLEH ADMIN
    // bisa di akses oleh admin departemen dan kepala departemen untuk melihat semua pengajuan
    $routes->get('/izin-penelitian/semua', 'IzinPenelitian::semua', ['filter' => 'adminDepartemenDanKadepFilter']);
    // bisa di akses oleh admin departemen dan kepala departemen untuk melihat semua pengajuan surat izin penelitian yang disetujui digunakan untuk verifikasi
    $routes->get('/izin-penelitian/disetujui', 'IzinPenelitian::disetujui', ['filter' => 'adminDepartemenDanKadepFilter']);
    // bisa di akses oleh admin departemen dan kepala departemen untuk melihat semua pengajuan surat izin penelitian yang ditolak digunakan untuk verifikasi
    $routes->get('/izin-penelitian/ditolak', 'IzinPenelitian::ditolak', ['filter' => 'adminDepartemenDanKadepFilter']);
    // bisa di akses oleh admin untuk edit validator instrumen
    $routes->get('/izin-penelitian/edit-admin/(:any)', 'IzinPenelitian::edit_admin/$1', ['filter' => 'adminDepartemenFilter']);
    // bisa di akses oleh admin untuk edit pengajuan surat izin penelitian
    $routes->post('/izin-penelitian/admin-simpan-pembaruan', 'IzinPenelitian::simpan_pembaruan_admin', ['filter' => 'adminDepartemenDanKadepFilter']);
    // bisa di akses oleh admin departemen dan kepala departemen untuk melihat detail pengajuan surat izin validator instrumen yang akan digunakan untuk verifikasi
    $routes->get('/izin-penelitian/detail-verifikasi/(:any)', 'IzinPenelitian::detail_verifikasi/$1', ['filter' => 'adminDepartemenDanKadepFilter']);
    
     // bisa di akses oleh admin departemen dan kadep untuk menolak semua pengajuan surat validator instrumen
     $routes->post('/izin-penelitian/tolak-admin/(:any)', 'IzinPenelitian::tolak_admin/$1', ['filter' => 'adminDepartemenDanKadepFilter']);
     // bisa di akses oleh admin departemen dan kadep untuk menyetujui semua pengajuan surat validator instrumen
     $routes->post('/izin-penelitian/setujui-admin/(:any)', 'IzinPenelitian::setujui_admin/$1', ['filter' => 'adminDepartemenDanKadepFilter']);
     // bisa di akses oleh admin departemen dan kepala departemen untuk menolak semua pengajuan surat validator instrumen
     $routes->post('/izin-penelitian/tolak-kadep/(:any)', 'IzinPenelitian::tolak_kadep/$1', ['filter' => 'adminDepartemenDanKadepFilter']);
     // bisa di akses oleh admin departemen dan kepala departemen untuk menyetujui semua pengajuan surat izin observasi matakuliah
     $routes->post('/izin-penelitian/setujui-kadep/(:any)', 'IzinPenelitian::setujui_kadep/$1', ['filter' => 'adminDepartemenDanKadepFilter']);
    // AKHIR ROUTE UNTUK ADMIN
// AKHIR ROUTE IZIN PENELITIAN

// ROUTES UNTUK VALIDASI INSTRUMEN
    // AKSES OLEH MAHASISWA
    // bisa di akses oleh mahasiswa untuk menampilkan pengajuan surat yang telah mereka buat
    $routes->get('/validasi-instrumen', 'ValidasiInstrumen::index', ['filter' => 'mahasiswaFilter']);
    // bisa di akses oleh mahasiswa untuk membuat surat validator instrumen
    $routes->get('/validasi-instrumen/tambah', 'ValidasiInstrumen::tambah', ['filter' => 'mahasiswaFilter']);
    // bisa di akses oleh mahasiswa untuk menyimpan surat validator instrumen
    $routes->post('/validasi-instrumen/simpan', 'ValidasiInstrumen::simpan', ['filter' => 'mahasiswaFilter']);
    // routes untuk scan barcode
    $routes->get('/validasi-instrumen/detail/(:any)', 'ValidasiInstrumen::detail/$1', ['filter' => 'mahasiswaFilter']);
    // bisa di akses oleh mahasiswa untuk menampilkan detail pengajuan surat izin observasi matakuliah yang akan di edit
    $routes->get('/validasi-instrumen/edit/(:any)', 'ValidasiInstrumen::edit/$1', ['filter' => 'mahasiswaFilter']);
    // bisa di akses oleh mahasiswa untuk memperbarui surat validator instrumen
    $routes->post('/validasi-instrumen/simpan-pembaruan', 'ValidasiInstrumen::simpan_pembaruan', ['filter' => 'mahasiswaFilter']);
    // routes untuk cetak surat oleh mahasiswa versi 2
    $routes->post('/validasi-instrumen/cetak', 'ValidasiInstrumen::cetak');
    // routes untuk scan barcode
    $routes->get('/validasi-instrumen/scan-barcode/(:any)', 'ValidasiInstrumen::scan_barcode/$1');
    // AKHIR ROUTE USER
    // AKSES OLEH ADMIN
    // bisa di akses oleh admin departemen dan kepala departemen untuk melihat semua pengajuan
    $routes->get('/validasi-instrumen/semua', 'ValidasiInstrumen::semua', ['filter' => 'adminDepartemenDanKadepFilter']);
    // bisa di akses oleh admin departemen dan kepala departemen untuk melihat semua pengajuan surat izin penelitian yang disetujui digunakan untuk verifikasi
    $routes->get('/validasi-instrumen/disetujui', 'ValidasiInstrumen::disetujui', ['filter' => 'adminDepartemenDanKadepFilter']);
    // bisa di akses oleh admin departemen dan kepala departemen untuk melihat semua pengajuan surat izin penelitian yang ditolak digunakan untuk verifikasi
    $routes->get('/validasi-instrumen/ditolak', 'ValidasiInstrumen::ditolak', ['filter' => 'adminDepartemenDanKadepFilter']);
    // bisa di akses oleh admin untuk edit validator instrumen
    $routes->get('/validasi-instrumen/edit-admin/(:any)', 'ValidasiInstrumen::edit_admin/$1', ['filter' => 'adminDepartemenFilter']);
    // bisa di akses oleh admin untuk edit pengajuan surat izin penelitian
    $routes->post('/validasi-instrumen/admin-simpan-pembaruan', 'ValidasiInstrumen::simpan_pembaruan_admin', ['filter' => 'adminDepartemenDanKadepFilter']);
    // bisa di akses oleh admin departemen dan kepala departemen untuk melihat detail pengajuan surat izin validator instrumen yang akan digunakan untuk verifikasi
    $routes->get('/validasi-instrumen/detail-verifikasi/(:any)', 'ValidasiInstrumen::detail_verifikasi/$1', ['filter' => 'adminDepartemenDanKadepFilter']);
    
     // bisa di akses oleh admin departemen dan kadep untuk menolak semua pengajuan surat validator instrumen
     $routes->post('/validasi-instrumen/tolak-admin/(:any)', 'ValidasiInstrumen::tolak_admin/$1', ['filter' => 'adminDepartemenDanKadepFilter']);
     // bisa di akses oleh admin departemen dan kadep untuk menyetujui semua pengajuan surat validator instrumen
     $routes->post('/validasi-instrumen/setujui-admin/(:any)', 'ValidasiInstrumen::setujui_admin/$1', ['filter' => 'adminDepartemenDanKadepFilter']);
     // bisa di akses oleh admin departemen dan kepala departemen untuk menolak semua pengajuan surat validator instrumen
     $routes->post('/validasi-instrumen/tolak-kadep/(:any)', 'ValidasiInstrumen::tolak_kadep/$1', ['filter' => 'adminDepartemenDanKadepFilter']);
     // bisa di akses oleh admin departemen dan kepala departemen untuk menyetujui semua pengajuan surat izin observasi matakuliah
     $routes->post('/validasi-instrumen/setujui-kadep/(:any)', 'ValidasiInstrumen::setujui_kadep/$1', ['filter' => 'adminDepartemenDanKadepFilter']);
    // AKHIR ROUTE UNTUK ADMIN
// AKHIR ROUTE VALIDASI INSTRUMEN

// ROUTE UNTUK PENGATURAN
    // diakses oleh admin departemen dan kepala departemen
    $routes->get('/jadwal-pengajuan-judul', 'JadwalPengajuanJudul::index', ['filter' => 'adminDepartemenDanKadepFilter' ]);
    $routes->get('/edit-jadwal-pengajuan-judul/(:num)', 'JadwalPengajuanJudul::edit/$1', ['filter' => 'adminDepartemenDanKadepFilter' ]);
    $routes->post('/jadwal-pengajuan-judul/simpan-pembaruan', 'JadwalPengajuanJudul::simpan_pembaruan', ['filter' => 'adminDepartemenDanKadepFilter' ]);
// AKHIR DARI ROUTE UNTUK PENGATURAN

// ROUTE UNTUK MASTER DATA MAHASISWA
    // diakses oleh admin dan super admin
    $routes->get('/master-mahasiswa', 'MasterMahasiswa::index', ['filter' => 'adminDanSuperAdminFilter' ]);
    $routes->get('/master-mahasiswa/detail/(:num)', 'MasterMahasiswa::detail/$1', ['filter' => 'adminDanSuperAdminFilter']);
    $routes->get('/master-mahasiswa/edit/(:num)', 'MasterMahasiswa::edit/$1', ['filter' => 'adminDanSuperAdminFilter']);
    $routes->post('/master-mahasiswa/update/(:num)', 'MasterMahasiswa::update/$1', ['filter' => 'adminDanSuperAdminFilter']);

    // master maahssiwa untuk yang error
    $routes->get('/master-mahasiswa/bermasalah-idpdpt', 'MasterMahasiswa::bermasalah_idpdpt', ['filter' => 'adminDanSuperAdminFilter' ]);
// AKHIR DARI ROUTE UNTUK MASTER DATA

// ROUTE UNTUK MASTER DATA DOSEN
    // diakses oleh admin dan superadmin 
    $routes->get('/master-dosen', 'MasterDosen::index', ['filter' => 'adminDanSuperAdminFilter' ]);
    $routes->get('/master-dosen/detail/(:num)', 'MasterDosen::detail/$1', ['filter' => 'adminDanSuperAdminFilter']);
    $routes->get('/master-dosen/edit/(:num)', 'MasterDosen::edit/$1', ['filter' => 'adminDanSuperAdminFilter']);
    $routes->post('/master-dosen/update/(:num)', 'MasterDosen::update/$1', ['filter' => 'adminDanSuperAdminFilter']);
    $routes->get('/master-dosen/tambah', 'MasterDosen::tambah', ['filter' => 'adminDanSuperAdminFilter']);
    $routes->post('/master-dosen/simpan', 'MasterDosen::simpan', ['filter' => 'adminDanSuperAdminFilter']);
// AKHIR DARI MASTER DATA DOSEN

// ROUTE UNTUK PENGATURAN MASTER DOSEN
    // diakses oleh admin dan superadmin 
    $routes->get('/master-dosen/pengaturan', 'MasterDosen::pengaturan', ['filter' => 'adminDanSuperAdminFilter' ]);
    $routes->get('/master-dosen/pengaturan/edit/(:num)', 'MasterDosen::pengaturan_edit/$1', ['filter' => 'adminDanSuperAdminFilter']);
    $routes->post('/master-dosen/pengaturan/update/(:num)', 'MasterDosen::pengaturan_update/$1', ['filter' => 'adminDanSuperAdminFilter']);
// AKHIR DARI MASTER DATA DOSEN

// ROUTE UNTUK MASTER DATA DOSEN
    // diakses oleh admin dan superadmin 
    $routes->get('/master-judul', 'MasterJudul::index', ['filter' => 'adminDanSuperAdminFilter' ]);
    $routes->get('/master-judul/detail/(:any)', 'MasterJudul::detail/$1', ['filter' => 'adminDanSuperAdminFilter']);
    $routes->get('/master-judul/edit/(:num)', 'MasterJudul::edit/$1', ['filter' => 'adminDanSuperAdminFilter']);
    $routes->post('/master-judul/update/(:num)', 'MasterJudul::update/$1', ['filter' => 'adminDanSuperAdminFilter']);
    $routes->get('/master-judul/tambah', 'MasterJudul::tambah', ['filter' => 'adminDanSuperAdminFilter']);
    $routes->post('/master-judul/simpan', 'MasterJudul::simpan', ['filter' => 'adminDanSuperAdminFilter']);
// AKHIR DARI MASTER DATA DOSEN

// ROUTE UNTUK JUDUL DOUBLE
    // diakses oleh admin dan superadmin 
    $routes->get('/master-judul/pengajuan-bermasalah', 'MasterJudul::pengajuan_bermasalah', ['filter' => 'adminDanSuperAdminFilter' ]);
    $routes->get('/master-judul/pengajuan-bermasalah/detail/(:num)', 'MasterJudul::detail_pengajuan_bermasalah/$1', ['filter' => 'adminDanSuperAdminFilter' ]);
    $routes->get('/master-judul/pengajuan-bermasalah/edit/(:num)', 'MasterJudul::pengaturan_edit/$1', ['filter' => 'adminDanSuperAdminFilter']);
    $routes->post('/master-judul/pengajuan-bermasalah/update/(:num)', 'MasterJudul::pengaturan_update/$1', ['filter' => 'adminDanSuperAdminFilter']);
// AKHIR DARI JUDUL DOUBLE

