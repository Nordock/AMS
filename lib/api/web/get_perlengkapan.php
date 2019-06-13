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

$kode_jamaah 	=  $_POST['kode_jamaah']; 
$id_login 		=  $_POST['id_login']; 

// print_r($_POST);die;
//select P.srh_id, P.srh_tgl, P.srh_kode, J.id_jamaah, J.noreg_jamaah, J.nama_lengkap, P.srh_ket from tbl_penyerahan AS P
//join tbl_jamaah AS J on P.srh_jamaah = J.id_jamaah b.login_id='$id_login' and a.no_jamaah ='$kode_jamaah'group by J.noreg_jamaah
	$q 	 = "select * from tbl_pembayaran as a inner join tbl_jamaah as b on a.no_jamaah=b.noreg_jamaah where b.login_id='$id_login' and a.no_jamaah ='$kode_jamaah'";          //query
	$hslqry = mysqli_query($konek, $q);
	$hsl = array();
	// echo $q;die;
	while($reg = mysqli_fetch_array($hslqry)){

	$tgl_transfer 	= $reg['tgl_transfer'];
	$no_jamaah 		= $reg['no_jamaah'];
	$id_agent 		= $reg['id_agent'];
	$pembayaran 	= $reg['pembayaran'];
	$nominal 		= $reg['nominal'];
	$status_payment = $reg['status_payment'];
	$ke_rekening 	= $reg['ke_rekening'];
	$dari_rekening 	= $reg['dari_rekening'];
	$nama_lengkap 	= $reg['nama_lengkap'];
	$nominals 		= base64_encode($nominal);
	$email			= $reg['email'];
	$validate		= $reg['validate'];
	
	
	if($status_payment == '0'){
		$status_pmb ='Data Valid';
	}
	else{
		$status_pmb ='Belum Divalidasi';
	}
	$hsl[] = array($tgl_transfer,$no_jamaah,$id_agent,$pembayaran,$nominal,$status_pmb,$ke_rekening,$dari_rekening,$nama_lengkap,$nominals,$email,$validate);
	}                                                                                  
// print_r($hsl);                                                                      
	// $hasil = array($hsl);
// print_r($hasil);
  echo json_encode($hsl);
 ?>
