<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="images/favicon.ico" type="image/ico" />
	
    <title>SIPS | <?= $judul; ?></title>
    <link href="<?= base_url()?>template/src/css/customsendiri.css" rel="stylesheet" />

    <link href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <!-- Bootstrap -->
    <link href="<?= base_url()?>template/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?= base_url()?>template/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?= base_url()?>template/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?= base_url()?>template/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	
    <!-- datatables  -->
    <link href="<?= base_url()?>template/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url()?>template/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url()?>template/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url()?>template/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url()?>template/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="<?= base_url()?>template/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="<?= base_url()?>template/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="<?= base_url()?>template/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
	<link rel="stylesheet" href="<?= base_url(); ?>template/assets/datepicker/css/bootstrap-datepicker.min.css">

    <!-- Custom Theme Style -->
    <link href="<?= base_url()?>template/build/css/custom.min.css" rel="stylesheet">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:opsz,wght@6..12,300;6..12,400&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="<?= base_url()?>template/vendors/jquery/dist/jquery.min.js"></script>
	
	<style>
		body {
			font-family: 'Poppins', sans-serif;
		}
		.x_panel {
    		border-top: 2px solid green;
		}
		.btn {
			font-size: 12px;
		}
	</style>
  	</head>

	<body class="nav-md">
		<div class="container body">
			<div class="main_container">
				<div class="col-md-3 left_col">
					<div class="left_col scroll-view">
						<div class="navbar nav_title" style="border: 0; display: inline-block; display: flex; justify-content: center;">
							<img src="<?=base_url('template/');?>src/img/unpkopsuratm.jpg" alt="logo" width="50" class="shadow-light rounded-circle mb-1 mt-2" >
							<a href="index.html" class="site_title" style="width: auto;"><span>SIPS</span></a>
						</div>
						<div class="clearfix"></div>
						<!-- menu profile quick info -->
						<div class="profile clearfix">
							<!-- <div class="profile_pic">
								<img src="< ?= base_url('template/'); ?>production/images/< ?= session()->get('user_foto'); ?>" alt="" class="img-circle profile_img">
							</div> -->
							<div class="profile_info" style="width: 100%;">
								<span>Welcome, <?= session()->get('nama_asli'); ?></span>
								<h2>Level <?= session()->get('user_level_nama') != null ? session()->get('user_level_nama') : ''; ?></h2>
							</div>
						</div>
						<!-- /menu profile quick info -->

						<br />

						<!-- sidebar -->
						<?php include('sidebar.php'); ?>
						<!-- akhir sidebar -->

						<!-- /menu footer buttons -->
						<div class="sidebar-footer hidden-small">
							<a data-toggle="tooltip" data-placement="top" title="Settings">
								<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
							</a>
							<a data-toggle="tooltip" data-placement="top" title="FullScreen">
								<span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
							</a>
							<a data-toggle="tooltip" data-placement="top" title="Lock">
								<span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
							</a>
							<a href="<?= base_url('/auth/logout'); ?>" data-toggle="tooltip" data-placement="top" title="Logout">
								<span class="glyphicon glyphicon-off" aria-hidden="true"></span>
							</a>
						</div>
						<!-- /menu footer buttons -->
					</div>
				</div>

				<!-- top navigation -->
				<div class="top_nav">
					<div class="nav_menu">
						<div class="nav toggle">
							<a id="menu_toggle"><i class="fa fa-bars"></i></a>
						</div>
						<nav class="nav navbar-nav">
							<ul class=" navbar-right">
								<li class="nav-item dropdown open" style="padding-left: 15px;">
								<a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
									<img src="<?=base_url('template/');?>production/images/<?= session()->get('user_foto'); ?>" alt="foto user"><?= session()->get('nama_asli'); ?>
								</a>
								<div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
									<a class="dropdown-item"  href="javascript:;"> Profile</a>
									<a class="dropdown-item"  href="javascript:;">
										<span class="badge bg-red pull-right">50%</span>
										<span>Settings</span>
									</a>
								<a class="dropdown-item"  href="javascript:;">Help</a>
									<a class="dropdown-item" href="<?= base_url('/auth/logout'); ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
								</div>
								</li>

								<li role="presentation" class="nav-item dropdown open">
									<a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">
										<i class="fa fa-envelope-o"></i>
										<span class="badge bg-green"><?= countTotal(); ?></span>
									</a>
									<ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">
										<li class="nav-item">
											<a class="dropdown-item" href="<?= base_url('/izin-observasi-penelitian/semua'); ?>">
												<span>
													<span>Observasi Penelitian</span>
													<span class="time"><?= countObservasiPenelitian(); ?></span>
												</span>
											</a>
										</li>
										<li class="nav-item">
											<a class="dropdown-item" href="<?= base_url('/validator-instrumen/semua'); ?>">
												<span>
													<span>Validator Instrumen</span>
													<span class="time"><?= countValidatorInstrumen(); ?></span>
												</span>
											</a>
										</li>
										<li class="nav-item">
											<a class="dropdown-item" href="<?= base_url('/izin-observasi-matakuliah/semua'); ?>">
												<span>
													<span>Observasi Matakuliah</span>
													<span class="time"><?= countObservasiMatakuliah(); ?></span>
												</span>
											</a>
										</li>
										<li class="nav-item">
											<a class="dropdown-item" href="<?= base_url('/izin-penelitian/semua'); ?>">
												<span>
													<span>Izin Penelitian</span>
													<span class="time"><?= countPenelitian(); ?></span>
												</span>
											</a>
										</li>
										<li class="nav-item">
											<a class="dropdown-item" href="<?= base_url('/validasi-instrumen/semua'); ?>">
												<span>
													<span>Validasi Instrumen</span>
													<span class="time"><?= countValidasiInstrumen(); ?></span>
												</span>
											</a>
										</li>
									</ul>
								</li>
							</ul>
						</nav>
					</div>
				</div>
				<!-- /top navigation -->

				<!-- page content -->

				<!-- ini dibuat dinamis -->
			
			<!-- < ?php 
			if($page) {
				echo view($page);
			}
			?> -->

			<?= $this->renderSection('content'); ?>

				<!-- /page content -->

				<!-- footer content -->
				<footer>
					<div class="pull-right">
						Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
					</div>
					<div class="clearfix"></div>
				</footer>
				<!-- /footer content -->
			</div>
		</div>

		<!-- jQuery -->
		<!-- Bootstrap -->
		<script src="<?= base_url()?>template/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
		<!-- FastClick -->
		<script src="<?= base_url()?>template/vendors/fastclick/lib/fastclick.js"></script>
		<!-- NProgress -->
		<script src="<?= base_url()?>template/vendors/nprogress/nprogress.js"></script>
		<!-- Chart.js -->
		<script src="<?= base_url()?>template/vendors/Chart.js/dist/Chart.min.js"></script>
		<!-- gauge.js -->
		<script src="<?= base_url()?>template/vendors/gauge.js/dist/gauge.min.js"></script>
		<!-- bootstrap-progressbar -->
		<script src="<?= base_url()?>template/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
		<!-- iCheck -->
		<script src="<?= base_url()?>template/vendors/iCheck/icheck.min.js"></script>
		<!-- Skycons -->
		<script src="<?= base_url()?>template/vendors/skycons/skycons.js"></script>
		<!-- Flot -->
		<script src="<?= base_url()?>template/vendors/Flot/jquery.flot.js"></script>
		<script src="<?= base_url()?>template/vendors/Flot/jquery.flot.pie.js"></script>
		<script src="<?= base_url()?>template/vendors/Flot/jquery.flot.time.js"></script>
		<script src="<?= base_url()?>template/vendors/Flot/jquery.flot.stack.js"></script>
		<script src="<?= base_url()?>template/vendors/Flot/jquery.flot.resize.js"></script>
		<!-- Flot plugins -->
		<script src="<?= base_url()?>template/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
		<script src="<?= base_url()?>template/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
		<script src="<?= base_url()?>template/vendors/flot.curvedlines/curvedLines.js"></script>
		<!-- DateJS -->
		<script src="<?= base_url()?>template/vendors/DateJS/build/date.js"></script>
		<!-- JQVMap -->
		<script src="<?= base_url()?>template/vendors/jqvmap/dist/jquery.vmap.js"></script>
		<script src="<?= base_url()?>template/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
		<script src="<?= base_url()?>template/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
		<!-- bootstrap-daterangepicker -->
		<script src="<?= base_url()?>template/vendors/moment/min/moment.min.js"></script>
		<script src="<?= base_url()?>template/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

		<!-- Custom Theme Scripts -->
		<script src="<?= base_url()?>template/build/js/custom.min.js"></script>

		<script src="<?= base_url()?>template/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
		<script src="<?= base_url()?>template/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
		<script src="<?= base_url()?>template/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
		<script src="<?= base_url()?>template/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
		<script src="<?= base_url()?>template/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
		<script src="<?= base_url()?>template/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
		<script src="<?= base_url()?>template/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
		<script src="<?= base_url()?>template/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
		<script src="<?= base_url()?>template/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
		<script src="<?= base_url()?>template/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
		<script src="<?= base_url()?>template/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
		<script src="<?= base_url()?>template/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
		<script type="text/javascript" src="<?= base_url(); ?>template/assets/datepicker/js/bootstrap-datepicker.min.js"></script>
	</body>
</html>
