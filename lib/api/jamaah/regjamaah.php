<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, x-xsrf-token");
//hit URL
//check_jamaah.php?dname=android&jamaahid=J20130100008&vkey=6401136c27e056619e90b9184c56fad2
//token_id =08c839bcbc189be749154df668660e8c

include "../../../config/pdokoneksi.php";
  include "../../../config/sendemail.php";


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
$kode_agen = "Mobile App";



 //sendingemail_regjamaahmobile($email,$namalengkap,$provinsi, $tokenid);
 /*
 $namapaket =  $_POST['namapaket'];
$hargapaket =  $_POST['hargapaket'];
$tokenid =    $_POST['tokenid'];
$jskelamin= $_POST['jeniskelamin'];
$email = $_POST['email'];
$hp = $_POST['hp'];
$jenisid = $_POST['jenisid'];
$noid = $_POST['noid'];
$nopasspor = $_POST['passpor'];
$realname = $_POST['realname'];
$alamat =$_POST['alamat'];
$provinsi = $_POST['provinsi'];
$kota = $_POST['kota'];
$tgllahir = $_POST['tgllahir'];
*/
$tgl_registrasi = date("Y-m-d H:i:s");


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
            
    $comment = 'Via Mobile Apps';//nama penginput
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
    $autoreg_no = $char . "5" . $thaunbulan . sprintf("%05s", $noUrut);
    
   
$sql = "INSERT INTO `tbl_jamaah`
( `tgl_reg`, `noreg_jamaah`, `nama_lengkap`, `jns_id`, `no_id`,
 `no_passpor`,`jns_kelamin`, `alamat`,`provinsi`, `kota`, `tlp_seluler`, 
`status_registrasi`,`status_jamaah`,`status_pembayaran`,`prog_umroh`,
`harga_paket`,`jns_kelamin`,`comment`,`inputby`,tgl_lahir,email,orderid,kode_agen)
VALUES
('$tgl_registrasi', '$autoreg_no', '$namalengkap', '$jenisid', '$noid',
'$nopasspor','$jskelamin','$alamat','$provinsi','$kota','$hp','2','1','2','$namapaket',
 '$hargapaket', '$jskelamin','$comment','$comment','$tgllahir', '$email','$orderid','$kode_agen')";
 
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll( PDO::FETCH_ASSOC );
          
         //echo $sql;
         sendingemail_regjamaahmobile($email,$namalengkap,$autoreg_no, $alamat);
       
     }
       
       
$vkey           = md5 ($autoreg_no.$orderid); 
$postdata ="idJamaah=$autoreg_no&orderid=$orderid&vkey=$vkey"; 


$url="https://www.firsttravel.co.id/mobile/apie/adi_pemesanan/updateidjamaah.php";

//$url = "https://dev.molpay.co.id/MOLPay/API/VA/";


$curlHandle = curl_init(); 
curl_setopt($curlHandle, CURLOPT_URL, $url); 
curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $postdata); 
curl_setopt($curlHandle, CURLOPT_HEADER, 0); 
curl_setopt($curlHandle, CURLOPT_TIMEOUT,15); 
curl_setopt($curlHandle, CURLOPT_POST, 1); 
curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER,false);  

header('Content-type: text/xml'); 
header('Pragma: public'); 
header('Cache-control: private'); 
header('Expires: -1'); 
$server_output = curl_exec($curlHandle); 
curl_close($curlHandle); 

 ?>