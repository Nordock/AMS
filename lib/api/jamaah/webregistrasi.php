<?php


// echo "hai"; die;

header('Access-Control-Allow-Origin: *');
//hit URL
//check_jamaah.php?dname=android&jamaahid=J20130100008&vkey=6401136c27e056619e90b9184c56fad2
//token_id =08c839bcbc189be749154df668660e8c

include "../../../config/pdokoneksi.php";
  include "../../../config/sendemail.php";
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, x");
header("Access-Control-Allow-Headers: Content-Type, x-xsrf-token");
/*
$data = json_decode(file_get_contents("php://input"));
$namapaket =  $data->namapaket;
$hargapaket =  $data->hargapaket;
$tokenid =  $data->tokenid;
$jskelamin= $data->jeniskelamin;
$email = $data->email;
$hp = $data->hp;
$jenisid = $data->jenisid;
$noid = $data->noid;
$nopasspor = $data->passpor;
$realname = $data->realname;
$alamat = $data->alamat;
$provinsi = $data->provinsi;
$kota = $data->kota;
$orderid = $data->orderid;
$tgllahir = $data->tgllahir;
$kode_agen = $data->kodeagen;
*/


 
$namapaket 		=  $_POST['namapaket'];
$hargapaket 	=  $_POST['hargapaket'];
$tokenid 		=  $_POST['tokenid'];
$jskelamin		=  $_POST['jeniskelamin'];
$email 			=  $_POST['email'];
$hp 			=  $_POST['hp'];
$jenisid 		=  $_POST['jenisid'];
$noid 			=  $_POST['noid'];
$nopasspor 		=  $_POST['nopasspor'];
$realname 		=  $_POST['realname'];
$alamat 		=  $_POST['alamat'];
$provinsi 		=  $_POST['provinsi'];
$kota 			=  $_POST['kota'];
$tgllahir 		=  $_POST['tgllahir'];
$kode_agen  	=  $_POST['kodeagent'];

echo $tokenid;die;

$tgl_registrasi = date("Y-m-d H:i:s");

sendingemail_regjamaahmobile("caturhidayat@firsttravel.co.id", $realname, $hargapaket,  $sql );

 $namalengkap = str_replace(array("'", "\""), " ", htmlspecialchars($realname));
 

 $sql = "SELECT * FROM tbl_authentication where token_id ='$tokenid' and status=1";
     $statement = $dbh->query($sql);
     $statement->execute();
    $row = $statement->fetch(PDO::FETCH_ASSOC);
        $tokenidDB =    $row['token_id'];
    
        
    if( $tokenidDB != $tokenid ){
        $result="Not authorized";
        
    }else if($tokenid==""){
         $result="Not authorized";
        }else{
            
    $comment = 'Via Website';//nama penginput
    $queryreg     = "SELECT max(id_jamaah) as xid_jamaah , email FROM tbl_jamaah";
        $stmt = $dbh->prepare($queryreg);
        $stmt->execute();
        $getdata = $stmt->fetchAll();
      
      foreach ($getdata as $nourutjam) {
    $noUrut = $nourutjam['xid_jamaah'];
        }
    $noUrut++;
    $char       = "J";
    $thaunbulan = date('Ym');
    $autoreg_no = $char . "6" . $thaunbulan . sprintf("%05s", $noUrut);
    
   
$sql = "INSERT INTO `tbl_jamaah`
( `tgl_reg`, `noreg_jamaah`, `nama_lengkap`, `jns_id`, `no_id`,
 `no_passpor`,`jns_kelamin`, `alamat`,`provinsi`, `kota`, `tlp_seluler`, 
`status_registrasi`,`status_jamaah`,`status_pembayaran`,`prog_umroh`,
`harga_paket`,`comment`,`inputby`,tgl_lahir,email,orderid,kode_agen)
VALUES
('$tgl_registrasi', '$autoreg_no', '$namalengkap', '$jenisid', '$noid',
'$nopasspor','$jskelamin','$alamat','$provinsi','$kota','$hp','2','1','2','$namapaket',
 '$hargapaket', '$comment','$comment','$tgllahir', '$email','$orderid','$kode_agen')";
 
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll( PDO::FETCH_ASSOC );
         //echo $sql;
         //sendingemail_regjamaahmobile($email, $namalengkap, $autoreg_no, $alamat);
         
          sendingemail_regjamaahmobile("caturhidayat@firsttravel.co.id", $namalengkap, $autoreg_no,  $sql );
     if ($sql){
			echo "BERHASIL! <br>";
			echo $sql;
			
		}else{
			echo "failed. SQL Err: ". mysqli_error();
		}    
        
     }
       
       


 ?>