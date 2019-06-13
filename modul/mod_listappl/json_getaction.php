<?php
session_start();
require( '../../config/koneksi.php' );
$sql = mysqli_query($konek,"select * from c_appaction where isDelete = 0");
$json=[];

while ($data = mysqli_fetch_assoc($sql)) {
		$json[]=['id'=>$data['appAction'] ,'text' =>$data['appAction']];
	}

echo json_encode($json);

 ?>
