<?php
session_start();
require( '../../config/koneksi.php' );
$sql = mysqli_query($konek,"select * from c_saleschannelbranch where isDelete = 0");
$json=[];

while ($data = mysqli_fetch_assoc($sql)) {
		$json[]=['id'=>$data['idSalesChannelBranch'] ,'text' =>$data['salesChannelBranch']];
	}

echo json_encode($json);

 ?>
