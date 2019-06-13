<?php
require '../koneksi.php';
function Buat_logactivity($ip,$user, $log_date,$log_type,$activity,$modul_url,$comment){
    $sqllog    = "insert into tbl_log_monitoring 
    (ip,user,log_date,log_rec_date,log_type,activity,modul_url,comment)
    values
     ('$ip','$user','$log_date',now(),'$log_type','$activity','$modul_url','$comment')";
    
    $query  = mysqli_query($konek, $sqllog);
   // $data   = mysqli_fetch_array($query);
    //return $data;
}
?>