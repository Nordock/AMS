<?php
include "config/library.php";
include "config/koneksi.php";
session_start();
// Sends the user to the login-page if not logged in
if (!isset($_SESSION['namauser']) AND !isset($_SESSION['passuser'])){
   header('Location:index.php?msg=requires_login');
   exit;
}

?>

<!doctype html>
<html class="fixed">
	<head>

		<meta charset="UTF-8">

        <title>Dashboard | Application Management System</title>
        <meta name="keywords" content="GMS-AMS" />
    		<meta name="description" content="Application Management System">
    		<meta name="author" content="Global Mobility Service Indonesia">

        <!-- Mobile Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

        <!-- Web Fonts  -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

        <!-- Vendor CSS -->
        <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css" />
        <link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.css" />
        <link rel="stylesheet" href="assets/vendor/magnific-popup/magnific-popup.css" />
        <link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/css/datepicker3.css" />
        <!--<link rel="stylesheet" href="assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.css" /> -->

        <!-- Specific Page Vendor CSS -->
        <!-- <link rel="stylesheet" href="assets/vendor/select2/select2.css" /> -->
		<link rel="stylesheet" href="lib/select2-4.0.2/dist/css/select2.min.css" />
        <link rel="stylesheet" href="assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />


        <!-- Specific Page Vendor CSS -->
        <link rel="stylesheet" href="assets/vendor/pnotify/pnotify.custom.css" />
        <link rel="stylesheet" href="assets/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" />
        <link rel="stylesheet" href="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />
        <link rel="stylesheet" href="assets/vendor/morris/morris.css" />
        <link rel="stylesheet" href="assets/vendor/bootstrap-timepicker/css/bootstrap-timepicker.css" />

        <!-- Theme CSS -->
        <link rel="stylesheet" href="assets/stylesheets/theme.css" />

        <!-- Skin CSS -->
        <link rel="stylesheet" href="assets/stylesheets/skins/default.css" />

        <!-- Theme Custom CSS -->
        <link rel="stylesheet" href="assets/stylesheets/theme-custom.css">

        <!-- Head Libs -->
        <script src="assets/vendor/modernizr/modernizr.js"></script>
        <script src="assets/vendor/jquery/jquery.js"></script>
        <script src="assets/vendor/bootstrap/js/bootstrap.js"></script>
        <script src="assets/vendor/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>

	</head>
	<body>
		<section class="body">

			<!-- start: header -->
			<header class="header">
				<div class="logo-container">
					<a href="../" class="logo">
						<img src="assets/images/LogoGMSIndonesia.png" height="40" alt="GMS Indonesia" />
					</a>
					<div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
						<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
					</div>
				</div>

				<!-- start: search & user box -->
				<div class="header-right">

					<form action="pages-search-results.html" class="search nav-form">
						<div class="input-group input-search">
							<!--<input type="text" class="form-control" name="q" id="q" placeholder="Search...">
							<span class="input-group-btn">
								<button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
							</span>-->
						</div>
					</form>

					<span class="separator"></span>

					<ul class="notifications">

						<li>
							<a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
								<i class="fa fa-bell"></i>
								<!--<span class="badge">0</span> -->
							</a>

							<div class="dropdown-menu notification-menu">
								<div class="notification-title">
									<span class="pull-right label label-default">0</span>
									Alerts
								</div>

								<div class="content">
									<ul>
										<li>
											<a href="#" class="clearfix">
												<div class="image">
													<i class="fa fa-thumbs-up bg-info"></i>
												</div>
												<span class="title">Server is Ready!</span>
												<span class="message">Just now</span>
											</a>
										</li>

									</ul>

									<hr />

									<div class="text-right">
										<a href="#" class="view-more">...</a>
									</div>
								</div>
							</div>
						</li>
					</ul>

					<span class="separator"></span>

			     <!-- username profile -->
					<div id="userbox" class="userbox">
						<a href="#" data-toggle="dropdown">
							<figure class="profile-picture">
                <?php if($image['extantion']=='png'){
	  								echo '<img src="data:image/png;base64,'.base64_encode( $image['image_temp'] ).'" data-lock-picture="data:image/png;base64,'.base64_encode( $image['image_temp'] ).'" class="img-circle" height="40" alt="Joseph Doe"/>';
	  							}else{
	  								echo '<img src="data:image/jpg;base64,'.base64_encode( $image['image_temp'] ).'" data-lock-picture="data:image/jpg;base64,'.base64_encode( $image['image_temp'] ).'" class="img-circle" height="40" alt="Joseph Doe"/>';
	  							} ?>
								<!--<img src="assets/images/LogoGMSIndonesia.png" alt="GMS" class="img-circle" data-lock-picture="assets/images/LogoGMSIndonesia.png" />-->
							</figure>
							<div class="profile-info" >
                <span class="name"><?php echo $_SESSION['namalengkap']; ?></span>
								<span class="role"><?php if ($_SESSION['leveluser'] == 1){
															 $level= "Administrator";
															}
														 elseif ($_SESSION['leveluser'] == 2){
															  $level= "Finance";
														 }
														  elseif ($_SESSION['leveluser'] == 3){
															  $level= "Customer Service";
														 }
														  elseif ($_SESSION['leveluser'] == 4){
															  $level= "Admin SmartAgent";
														 }
														  elseif ($_SESSION['leveluser'] == 5){
															  $level= "Admin Back Office";
														}
														  elseif ($_SESSION['leveluser'] == 6){
															  $level= "Finnance BO";
														}
																echo $level; ?></span>
							</div>

							<i class="fa custom-caret"></i>
						</a>

						<div class="dropdown-menu">
							<ul class="list-unstyled">
								<li class="divider"></li>
								<li>
									<a role="menuitem" tabindex="-1" href="dashboard.php?mod=user"><i class="fa fa-user"></i> My Profile</a>
								</li>

								<li>
									<a role="menuitem" tabindex="-1" href="logout.php"><i class="fa fa-power-off"></i> Logout</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- end: search & user box -->
			</header>
			<!-- end: header -->

			<div class="inner-wrapper">
				<!-- start: sidebar -->
				<aside id="sidebar-left" class="sidebar-left">

					<div class="sidebar-header">
						<div class="sidebar-title">
							Navigation
						</div>
						<div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
							<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
						</div>
					</div>

					<div class="nano">
						<div class="nano-content">
							<nav id="menu" class="nav-main" role="navigation">
								<ul class="nav nav-main">
									<li class="nav-active">
										<a href="dashboard.php?mod=home">
											<i class="fa fa-home" aria-hidden="true"></i>
											<span>Dashboard</span>
										</a>
									</li>
									<?php
										include "menu.php";
									?>
									<li>
										<a href="logout.php" >
											<i class="fa fa-external-link" aria-hidden="true"></i>
											<span>Log Out <em class="not-included">(Log Out)</em></span>
										</a>
									</li>
								</ul>


					</div>

				</aside>
				<!-- end: sidebar -->
				<?

				$tgl=date("Y-m-d");
				$tanggal=tgl_indo($tgl);
				?>
				<section role="main" class="content-body">
					<header class="page-header">
						<h2>Dashboard</h2>

						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="dashboard.php?mod=home">
										<i class="fa fa-home"> </i>
									</a>
								</li><li>

								<span>  <?php

								$tgl=date("Y-m-d");
								$tanggal=tgl_indo($tgl);
								echo " ".$tanggal;
								?></span></li>
							</ol>

							<a class="sidebar-right-toggle" ><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>

					<!-- start: page -->
					<?php include "content.php"; ?>
					<!-- end: page -->
				</section>
			</div>

			<aside id="sidebar-right" class="sidebar-right">
				<div class="nano">
					<div class="nano-content">
						<a href="#" class="mobile-close visible-xs">
							Collapse <i class="fa fa-chevron-right"></i>
						</a>

						<div class="sidebar-right-wrapper">

							<div class="sidebar-widget widget-calendar">
								<h6>Upcoming Tasks</h6>
								<div data-plugin-datepicker data-plugin-skin="dark" ></div>

								<ul>
									<li>
										<time datetime="2014-04-19T00:00+00:00">04/19/2014</time>
										<span>Company Meeting</span>
									</li>
								</ul>
							</div>

							<div class="sidebar-widget widget-friends">
								<h6>Friends</h6>
								<ul>
									<li class="status-online">
										<figure class="profile-picture">
											<img src="assets/images/!sample-user.jpg" alt="Joseph Doe" class="img-circle">
										</figure>
										<div class="profile-info">
											<span class="name">Joseph Doe Junior</span>
											<span class="title">Hey, how are you?</span>
										</div>
									</li>
									<li class="status-online">
										<figure class="profile-picture">
											<img src="assets/images/!sample-user.jpg" alt="Joseph Doe" class="img-circle">
										</figure>
										<div class="profile-info">
											<span class="name">Joseph Doe Junior</span>
											<span class="title">Hey, how are you?</span>
										</div>
									</li>
									<li class="status-offline">
										<figure class="profile-picture">
											<img src="assets/images/!sample-user.jpg" alt="Joseph Doe" class="img-circle">
										</figure>
										<div class="profile-info">
											<span class="name">Joseph Doe Junior</span>
											<span class="title">Hey, how are you?</span>
										</div>
									</li>
									<li class="status-offline">
										<figure class="profile-picture">
											<img src="assets/images/!sample-user.jpg" alt="Joseph Doe" class="img-circle">
										</figure>
										<div class="profile-info">
											<span class="name">Joseph Doe Junior</span>
											<span class="title">Hey, how are you?</span>
										</div>
									</li>
								</ul>
							</div>

						</div>
					</div>
				</div>
			</aside>
		</section>

		<script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
        <script src="assets/vendor/nanoscroller/nanoscroller.js"></script>
        <script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <script src="assets/vendor/magnific-popup/magnific-popup.js"></script>
        <script src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>


        <!-- Specific Page Vendor -->
        <script src="assets/vendor/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
        <script src="assets/vendor/jquery-ui-touch-punch/jquery.ui.touch-punch.js"></script>
        <script src="assets/vendor/jquery-appear/jquery.appear.js"></script>
        <script src="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
        <script src="assets/vendor/jquery-easypiechart/jquery.easypiechart.js"></script>
        <script src="assets/vendor/flot/jquery.flot.js"></script>
        <script src="assets/vendor/flot-tooltip/jquery.flot.tooltip.js"></script>
        <script src="assets/vendor/flot/jquery.flot.pie.js"></script>
        <script src="assets/vendor/flot/jquery.flot.categories.js"></script>
        <script src="assets/vendor/flot/jquery.flot.resize.js"></script>
        <script src="assets/vendor/jquery-sparkline/jquery.sparkline.js"></script>
        <script src="assets/vendor/raphael/raphael.js"></script>
        <script src="assets/vendor/morris/morris.js"></script>
        <script src="assets/vendor/gauge/gauge.js"></script>
        <script src="assets/vendor/snap-svg/snap.svg.js"></script>
        <script src="assets/vendor/liquid-meter/liquid.meter.js"></script>
        <script src="assets/vendor/jqvmap/jquery.vmap.js"></script>
        <script src="assets/vendor/jqvmap/data/jquery.vmap.sampledata.js"></script>
        <script src="assets/vendor/jqvmap/maps/jquery.vmap.world.js"></script>
        <script src="assets/vendor/jqvmap/maps/continents/jquery.vmap.africa.js"></script>
        <script src="assets/vendor/jqvmap/maps/continents/jquery.vmap.asia.js"></script>
        <script src="assets/vendor/jqvmap/maps/continents/jquery.vmap.australia.js"></script>
        <script src="assets/vendor/jqvmap/maps/continents/jquery.vmap.europe.js"></script>
        <script src="assets/vendor/jqvmap/maps/continents/jquery.vmap.north-america.js"></script>
        <script src="assets/vendor/jqvmap/maps/continents/jquery.vmap.south-america.js"></script>

        <!-- Specific Page Vendor -->
        <!-- <script src="assets/vendor/select2/select2.js"></script> -->
		<script src="lib/select2-4.0.2/dist/js/select2.min.js"></script>
        <script src="assets/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
        <script src="assets/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js"></script>
        <script src="assets/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>




        <!-- Specific Page Vendor -->
        <script src="assets/vendor/jquery-autosize/jquery.autosize.js"></script>
        <!--<script src="assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>-->


        <!-- Theme Base, Components and Settings -->
        <script src="assets/javascripts/theme.js"></script>

        <!-- Theme Custom -->
        <script src="assets/javascripts/theme.custom.js"></script>

        <!-- Theme Initialization Files -->
        <script src="assets/javascripts/theme.init.js"></script>

        <!--<script src="assets/javascripts/ui-elements/examples.charts.js"></script>-->


        <!-- Examples -->
        <!-- Specific Page Vendor -->
        <script src="assets/vendor/jquery-validation/jquery.validate.js"></script>
        <script src="assets/vendor/bootstrap-wizard/jquery.bootstrap.wizard.js"></script>

        <script src="assets/vendor/pnotify/pnotify.custom.js"></script>

        <!--<script src="assets/javascripts/forms/examples.wizard.js"></script>-->

        <!--<script src="assets/javascripts/dashboard/examples.dashboard.js"></script>-->

        <!--- Notif -->

        <!--<script src="assets/javascripts/ui-elements/examples.notifications.js"></script>-->

        <!-- datatables Examples -->
        <!--<script src="assets/javascripts/tables/examples.datatables.default.js"></script>
        <script src="assets/javascripts/tables/examples.datatables.row.with.details.js"></script>
        <script src="assets/javascripts/tables/examples.datatables.tabletools.js"></script>-->
        <script src="assets/javascripts/ui-elements/examples.modals.js"></script>
	</body>
</html>
