<?php
header('Access-Control-Allow-Origin: *');
include "../../../config/pdokoneksi.php";
     
	  $tokenid = $_GET['tokenid']; 
	  $limit  = $_GET['limit']; 
	  $sql = "SELECT * FROM tbl_authentication where token_id ='$tokenid' and status=1";
	
	
	$statement = $dbh->query($sql);
	 $statement->execute();
	$row = $statement->fetch(PDO::FETCH_ASSOC);
		$tokenidDB =	$row['token_id'];
		
		
	
	if( $tokenidDB != $tokenid ){
	 	$result="Not authorized";
	 }else{
		
		
    // query untuk menampilkan data
       /* $sql = 'SELECT noreg_jamaah,nama_lengkap,jns_kelamin,tempat_lahir,tgl_lahir,
  alamat,provinsi,kota,jns_id,no_id,
  no_passpor,passpor_dikeluarkan,passpor_tgldikeluarkan,passpor_masaberlaku,
  status_registrasi,status_jamaah,status_pembayaran,prog_umroh
	FROM tbl_jamaah WHERE aktif=1  ORDER BY noreg_jamaah LIMIT 10';
	    * 
	    */
	    
	  $sql = "SELECT DISTINCT noreg_jamaah,nama_lengkap,
	  		jns_kelamin,status_pernikahan,tgl_lahir,no_passpor,passpor_dikeluarkan,
	  		passpor_tgldikeluarkan,passpor_masaberlaku,prog_umroh  
	  		From tbl_jamaah where aktif=1  and status_registrasi=1 
	  		and status_pembayaran=1 GROUP BY noreg_jamaah LIMIT $limit"; 
			 
        $stmt = $dbh->prepare($sql);
    // execute the query
        $stmt->execute();
    // pecah hasilnya ke dalam bentuk array
        $result = $stmt->fetchAll( PDO::FETCH_ASSOC );
	 }
	 
    // konversi ke JSON
        $json = json_encode( $result );
        echo $json;
?>