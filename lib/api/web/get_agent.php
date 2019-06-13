<?php
// echo "hai";die;  
header('Access-Control-Allow-Origin: *');
//hit URL
//check_jamaah.php?dname=android&jamaahid=J20130100008&vkey=6401136c27e056619e90b9184c56fad2
//token_id =08c839bcbc189be749154df668660e8c

include "../../../config/koneksi.php";

header('Content-Type: application/json'); 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, x");
header("Access-Control-Allow-Headers: Content-Type, x-xsrf-token");

if(isset($_POST['provinsi'])){

$provinsi 			=  $_POST['provinsi']; 
// echo $provinsi;die;

	$q 	 = "SELECT no_registrasiagen, namalengkap, kota, provinsi, hp FROM tbl_agent where provinsi='$provinsi' AND status= '1' AND no_registrasiagen like '%FT%'  and idtms is null AND no_registrasiagen NOT IN ('FT000005','FT000007','FT000771','Web FT','Personal') and provinsi !=''";          //query
	$hslqry = mysqli_query($konek, $q);
	while($reg = mysqli_fetch_array($hslqry)){
		
	$noregis_agent 	= $reg['no_registrasiagen'];
	$nama_agent 	= $reg['namalengkap'];
	$kota 			= $reg['kota'];
	$provinsi 		= $reg['provinsi'];
	$hp 			= $reg['hp'];
	
	$hrg[] = array($noregis_agent,$nama_agent,$kota,$provinsi,$hp);
	
	} 
	 // $hasil = array($hrg);
	// echo('jj'); 
// print_r($hrg);die;
  echo json_encode($hrg);
  
  }
  
 ?>
