<?php
session_start();
include "../../config/koneksi.php";
$aksi = "modul/mod_kasir/act_dpkasir.php";
$merchant_id = $_SESSION['merchant_id'];
$qryImage = "SELECT * from tbl_merchant where merchant_id = '$merchant_id'";
$image=(mysqli_fetch_array(mysqli_query($konek,$qryImage)));
$img_encode = base64_encode($image['image_temp']);
$img_ext = $image['extantion'];
$images = "data:image/".$img_ext.";base64,".$img_encode;
$noreg = $_GET['noreg'];
$namajamaah = $_GET['namajamaah'];
$namapaket = $_GET['paket'];
$tglreg = $_GET['tglreg'];
// $noorder = $_GET['noorder'];
?>

<html>
	<head>
		<title>Bukti Pendaftaran - First Travel</title>
		<!-- Web Fonts  -->
		<link href="//fonts.googleapis.com/css?family=Open+Sans:300,200,300,300,200" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="../../assets/vendor/bootstrap/css/bootstrap.css" />

		<!-- Invoice Print Style -->
		<link rel="stylesheet" href="../../assets/stylesheets/invoice-print.css" />
		
		<style type="text/css" media="print">
.noprint{
        display:none;
}
                </style>
                
	</head>
			
			
<body>
		<div class="invoice">
			<header class="clearfix">
				<div class="row">
					<div class="col-sm-6 mt-md">
						
						<h4 class="h4 m-none text-dark text-bold">Bukti Pendaftaran Jamaah</h4>
					</div>
					<div class="col-sm-6 text-right mt-md mb-md">
						<address class="ib mr-xlg">
							<?php echo "
								$image[merchant_name] <br/>
								$image[merchant_address] <br/>
								Phone  :  $image[merchant_phone] <br/>
								Fax      :  $image[merchant_fax] <br/>
								$image[merchant_email] <br/>
							"; ?><!-- 
							First Travel Building
							<br/>
							Jl.Radar Auri No.1, Cimanggis, Depok
							<br/>
							Phone  :  +6121 8770 5858, +6221 29627111
							<br/>
							Fax      :  +6221 8770 4343
							<br/>
							info@Firsttravel.co.id -->
						</address>
						<div class="ib">
							<img src="<?php echo $images; ?>" alt="OKLER Themes" />
						</div>
						<br>
					</div>
				</div>
			</header>
			<div class="bill-info">
				<div class="row">
					<div class="col-md-6">
						
					</div>
					<div class="col-md-6">
						<div class="bill-data text-right">
							<p class="mb-none">
								<span class="text-dark">Tanggal Registrasi: 
								<?php echo $tglreg; ?></span>
							</p>
							
						</div>
					</div>
				</div>
			</div>
		
			<div class="table-responsive">
				<table class="table invoice-items">
					<thead>
						<tr class="h4 text-dark">
							<th id="cell-desc"     class="text-semibold">#No Jamaah</th>
							<th id="cell-desc"   class="text-semibold">Nama Jamaah</th>
							<th id="cell-desc"   class="text-semibold">Nama Paket</th>
							<th id="cell-desc"  class="text-center text-semibold">Tgl Registrasi</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php echo $noreg; ?></td>
							<td class="text-semibold text-dark"><?php echo $namajamaah; ?></td>
							<td><?php echo $namapaket; ?></td>
							<td class="text-center"><?php echo $tglreg; ?></td>
					
						</tr>
						
					</tbody>
				</table>
			</div>
		
			
		</div>

		<script>
			window.print();
		</script>
		<center><button type="button" class="noprint"
        onclick="window.open('', '_self', ''); window.close();">Tutup Halaman ini</button></center>
	</body>
			
</html>
