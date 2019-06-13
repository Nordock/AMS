<?php
header('Access-Control-Allow-Origin: *');
//hit URL
//check_jamaah.php?dname=android&jamaahid=J20130100008&vkey=6401136c27e056619e90b9184c56fad2
//token_id =08c839bcbc189be749154df668660e8c

include "../../../config/pdokoneksi.php";
      $idjamaah = $_GET['idjamaah'];
      $tokenid = $_GET['tokenid']; 
     
      
      $sql = "SELECT * FROM tbl_authentication where token_id ='$tokenid' and status=1";
     $statement = $dbh->query($sql);
     $statement->execute();
    $row = $statement->fetch(PDO::FETCH_ASSOC);
        $tokenidDB =    $row['token_id'];
        //$vkeyDB = md5($tokenidDB.$jamaahid);
        
    if( $tokenidDB != $tokenid ){
        $result="Not authorized";
    }else if($tokenid==""){
         $result="Not authorized";
        }else{


          
          
$sql = "SELECT p.`no_jamaah`,p.`id_agent`,p.`nominal`,j.`nama_lengkap`,j.`prog_umroh`,j.`harga_paket`,j.`status_pembayaran`, SUM(j.`harga_paket` - p.`nominal` ) as sisabayar FROM tbl_pembayaran as p LEFT JOIN `tbl_jamaah` as j ON p.no_jamaah = j.`noreg_jamaah` where p.no_jamaah='$idjamaah' and p.pembayaran like '%dp%' and p.status_payment=0 and j.`status_pembayaran` IN (2,3)"; 
            
      $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll( PDO::FETCH_ASSOC );
        
        }
        
       $json = json_encode( $result );
        echo $json;
       
?>
            