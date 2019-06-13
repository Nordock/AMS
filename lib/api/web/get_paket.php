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

if(isset($_POST['paket'])){

$paket 			=  $_POST['paket']; 
// $no_id 			=  $_POST['no_id']; 
// $qryJamaah = mysqli_query($konek,"SELECT * from tbl_jamaah where no_id = '$no_id' ");
// $ketemu = mysqli_num_rows($qryJamaah);
// if($ketemu < 1){
// echo $paket;die;
if($paket == 'Reguler'){
	$q 	 = "SELECT harga_paket, nama_paket FROM tbl_paketumroh where jenis_paket='$paket' and status_paket='1' and paket_validate >= CURDATE()";          //query
	$hslqry = mysqli_query($konek, $q);
	while($reg = mysqli_fetch_array($hslqry)){
	$harga_paket = $reg['harga_paket'];
	$nama_paket = $reg['nama_paket'];
	
	$hrg[] = array($harga_paket,$nama_paket);
	
	} 
}else{
	$query 	 = "SELECT harga_paket, nama_paket FROM tbl_paketumroh where nama_paket='$paket' and status_paket='1' and paket_validate >= CURDATE()";          //query
	$hslqry = mysqli_query($konek, $query);
	$hrg[]= mysqli_fetch_array($hslqry);
}
  	
//ambil kordinator
$agent = array();
	$qry 	 = "select * from tbl_agent as a where a.no_registrasiagen not like '%FT%'  and idtms is not null and status = 1 order by no_registrasiagen asc";
	$hslquery = mysqli_query($konek, $qry);
  	while($kor = mysqli_fetch_array($hslquery)){
	$noreg_agent = $kor['no_registrasiagen'];
	$nama_agent = $kor['namalengkap'];
	
	$agent[] = array($noreg_agent,$nama_agent);
	} 
	
	$hasil = array($hrg, $agent);
	// echo('jj');
	// print_r($hasil);die;
  echo json_encode($hasil);
  // }else{
  	// $noreg_agent = '';
	// $nama_agent = '';
	// $hrg[]= array('0' => 'id','harga_paket' => 'id','1' => 'id','nama_paket' => 'id');
	// $agent[] = array('0' => 'N/A','1' => 'N/A');
	// $hasil = array($hrg, $agent);
// print_r($hasil);die;
  	// echo json_encode($hasil);
  // }
  }
  else if(isset($_POST['paket_2'])){
	  
		$query=mysqli_query($konek,"SELECT *from tbl_paketumroh WHERE jenis_paket NOT in ('reguler','VIP') and paket_validate >= CURDATE() and status_paket=1");
		$terserah=array();
		while($harga=mysqli_fetch_array($query)){
			$harga_paket=$harga['harga_paket'];
			$nama_paket=$harga['nama_paket'];
			$terserah[]= array($harga_paket,$nama_paket);
		}
		
	echo json_encode($terserah);
	
  }else if(isset($_POST['paket_promo'])){
		$paket=$_POST['paket_promo'];
		// echo $paket.'paket'; 
		$query=mysqli_query($konek,"SELECT *from tbl_paketumroh WHERE nama_paket='$paket'");
		// echo$_POST['paket_promo'];
		$terserah=array();
		while($harga=mysqli_fetch_array($query)){
			$harga_paket=$harga['harga_paket'];
			$nama_paket=$harga['nama_paket'];
			$terserah[]= array($harga_paket,$nama_paket);
		}
		
	echo json_encode($terserah);
	
  }else if(isset($_POST['search'])){
	  $paket=$_POST['search'];
	  $query=mysqli_query($konek,"SELECT * FROM tbl_paketumroh WHERE  (jenis_paket like '%$paket%' or nama_paket LIKE'%$paket%') and status_paket=1");
		$tampil=array();
			while($harga=mysqli_fetch_array($query)){
				$nama_paket=$harga['nama_paket'];
				$harga_paket=$harga['harga_paket'];
				$tampil[]=array($harga_paket,$nama_paket);
				
			}
		echo json_encode($tampil);
  }

 ?>
