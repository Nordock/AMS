<?php
session_start();
ob_start();
?>
<!doctype html>
<html class="fixed">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<meta name="keywords" content="GMS-AMS" />
		<meta name="description" content="Application Management System">
		<meta name="author" content="Global Mobility Service Indonesia">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="assets/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="assets/stylesheets/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme-custom.css">

		<!-- Head Libs -->
		<script src="assets/vendor/modernizr/modernizr.js"></script>

	</head>
	<body>

<?php
include "config/fungsi_l0g.php";
include "config/koneksi.php";
include "config/loging_cfg.php";

$usr = isset($_POST['username']) ? $_POST['username'] : '';
$pwd = isset($_POST['password']) ? $_POST['password'] : '';

// fungsi untuk menghindari injeksi dari user yang jahil
function anti_injection($data){
  $filter  = stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES)));
  return $filter;
}


$username = anti_injection($usr);
$password = anti_injection(md5($pwd));

// menghindari sql injection
$injeksi_username = mysqli_real_escape_string($konek, $username);
$injeksi_password = mysqli_real_escape_string($konek, $password);

// pastikan username dan password adalah berupa huruf atau angka.
if (!ctype_alnum($injeksi_username) OR !ctype_alnum($injeksi_password)){
	$number = " Your IP is $_SERVER[REMOTE_ADDR]";
  $pesan = "$number";
}
else{
  $query  = "SELECT * FROM tbl_admin WHERE username='$username' AND pwd='$password' AND status='1'";
  $login  = mysqli_query($konek, $query);
	//echo $query;
	//exit();
  $ketemu = mysqli_num_rows($login);
  $r      = mysqli_fetch_array($login);

  // Apabila username dan password ditemukan (benar)
  if ($ketemu > 0){
    //session_start();

    // bikin variabel session
    $_SESSION['namauser']    = $r['username'];
    $_SESSION['passuser']    = $r['pwd'];
		$_SESSION['namalengkap'] = $r['nama'];
    $_SESSION['leveluser']   = $r['level'];
		$_SESSION['iduser']   = $r['id_admin'];
		//echo $_SESSION['leveluser'];
		//exit();
    // bikin id_session yang unik dan mengupdatenya agar slalu berubah
    // agar user biasa sulit untuk mengganti password Administrator
    $sid_lama = session_id();
	  session_regenerate_id();
    $sid_baru = session_id();
    mysqli_query($konek, "UPDATE tbl_admin SET id_session='$sid_baru' WHERE username='$username'");

    //update ke Log
    $ip = $_SERVER[REMOTE_ADDR];
    $log_date = date('d/m/Y');
    $log_type = "LOGIN";
    $activity ="Accesss Login Success";
    $modul_url = "dashboard.php?mod=home";
    $comment ="Test";
    Buat_logactivity($ip,$username, $log_date,$log_type,$activity,$modul_url,$comment);
    //echo $test;

    header("location:dashboard.php?mod=home");
  }
  else{
    $pesan ="Sorry! Login failed,<br> Please input the right username & password! ";
    logToFile("config/log/loginbo.log", $username." : Login Failed!");
  }
}
?>

		<!-- start: page -->
		<section class="body-sign">
			<div class="center-sign">
				<a href="/" class="logo pull-left">
					<img src="assets/images/LogoGMSIndonesia.png" height="54" />
				</a>

				<div class="panel panel-sign">
					<div class="panel-title-sign mt-xl text-right">
						<h2 class="title text-uppercase text-bold m-none"><i class="fa fa-user mr-xs"></i>Account Validation</h2>
					</div>

					<div class="panel-body">
						<div class="alert alert-warning">
							<p class="m-none text-semibold h6"><?php echo $pesan; ?></p>


						</div>
							<p class="text-center mt-lg"><a  class="btn btn-primary btn-lg" href="index.php">Try again!</a>
					</div>
				</div>

				<p class="text-center text-muted mt-md mb-md">&copy; Copyright 2019. All Rights Reserved.</p>
			</div>
		</section>
		<!-- end: page -->

		<!-- Vendor -->
		<script src="assets/vendor/jquery/jquery.js"></script>
		<script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="assets/vendor/bootstrap/js/bootstrap.js"></script>
		<script src="assets/vendor/nanoscroller/nanoscroller.js"></script>
		<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="assets/vendor/magnific-popup/magnific-popup.js"></script>
		<script src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>

		<!-- Theme Base, Components and Settings -->
		<script src="assets/javascripts/theme.js"></script>

		<!-- Theme Custom -->
		<script src="assets/javascripts/theme.custom.js"></script>

		<!-- Theme Initialization Files -->
		<script src="assets/javascripts/theme.init.js"></script>

	</body>
</html>
