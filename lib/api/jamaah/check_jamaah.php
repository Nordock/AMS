<?php
header('Access-Control-Allow-Origin: *');
//hit URL
//check_jamaah.php?dname=android&jamaahid=J20130100008&vkey=6401136c27e056619e90b9184c56fad2
//token_id =08c839bcbc189be749154df668660e8c

include "../../../config/pdokoneksi.php";
      $jamaahid = $_GET['jamaahid'];
	  $tgllahir = $_GET['tgllahir']; 
	  $dname = $_GET['dname']; 
      $tokendb = $_GET['tokendb']; 
      
	  $sql = "SELECT * FROM tbl_authentication where token_id ='$tokendb' and status=1";
	 $statement = $dbh->query($sql);
	 $statement->execute();
	$row = $statement->fetch(PDO::FETCH_ASSOC);
		$tokenidDB =	$row['token_id'];
		//$vkeyDB = md5($tokenidDB.$jamaahid);
		
	if( $tokenidDB != $tokendb ){
	 	$result="Not authorized";
	}else if($tokendb==""){
         $result="Not authorized";
        }else{

        //note : status_pembayaran = 0 / 5 apa ya?
        //note : status_registrasi = 0 apa ya?
	  $sql = "SELECT noreg_jamaah,nama_lengkap,
            jns_kelamin,provinsi,kota,
    CASE 
    WHEN status_pembayaran = 2 then 'Belum Pembayaran'
    WHEN status_pembayaran = 1 then 'Lunas'
    WHEN status_pembayaran = 3 then 'DP'
    WHEN status_pembayaran = 0 then 'Refund'
    WHEN status_pembayaran = 5 then 'Refund'
    END
    AS statuspembayaran,
    CASE 
    WHEN status_registrasi = 1 then 'Terverifikasi'
    WHEN status_registrasi = 2 then 'Belum Terverifikasi'
    WHEN status_registrasi = 3 then 'Rejected'
    WHEN status_registrasi = 0 then 'Refund'
    WHEN status_registrasi = '' then 'Belum Terverifikasi'
    END
    AS statusregistrasi
    ,photo34,photo46,passport,bukukuning,bukunikah,akte,
    copyktp,copykk,copyakte,jamaahgroup,
    kode_agen,prog_umroh From tbl_jamaah where noreg_jamaah='$jamaahid' and no_id ='$tgllahir'
    and aktif=1  "; 
			
			
			 
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll( PDO::FETCH_ASSOC );
	 }
	 
        $json = json_encode( $result );
        echo $json;
?>