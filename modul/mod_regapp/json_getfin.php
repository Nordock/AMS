<?php
session_start();
require( '../../config/koneksi.php' );
$sql = mysqli_query($konek,"select * from m_fincompany where isDelete = 0");
$json=[];

while ($data = mysqli_fetch_assoc($sql)) {
		$json[]=['id'=>$data['idFinCompany'] ,'text' =>$data['codeFinCompany']. " - " .$data['nameFinCompany']];
	}

echo json_encode($json);

 ?>
