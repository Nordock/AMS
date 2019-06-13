<?php
session_start();
require( '../../config/koneksi.php' );
$sql = mysqli_query($konek,"select * from c_saleschannel where isDelete = 0");
$json=[];

while ($data = mysqli_fetch_assoc($sql)) {
		$json[]=['id'=>$data['idSalesChannel'] ,'text' =>$data['salesChannel']];
	}

echo json_encode($json);

 ?>
