<?php 
  header('Access-Control-Allow-Origin: *');
  include "../../../config/koneksi.php";

  header('Content-Type: application/json'); 
  header('Access-Control-Allow-Origin: *');
  header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, x");
  header("Access-Control-Allow-Headers: Content-Type, x-xsrf-token");

  $id_login = $_POST['id_login'];

  $queey_jamaah = "SELECT * FROM tbl_jamaah where login_id='$id_login'";
  $jamaah = mysqli_query($konek, $queey_jamaah);
  //echo $queey_jamaah;
  ///$row_jamaah = mysqli_fetch_assoc($jamaah);
  $transaksi=array();
  while ($row_jamaah = mysqli_fetch_array($jamaah)) {
    if($row_jamaah['noreg_jamaah'] != ''){
      // echo "SELECT * from tbl_pembayaran WHERE no_jamaah = '$row_jamaah[noreg_jamaah]'";
      $query=mysqli_query($konek,"SELECT * from tbl_pembayaran WHERE no_jamaah = '$row_jamaah[noreg_jamaah]'");
      
      while($pembayaran=mysqli_fetch_array($query)){
        $tgl_transfer=$pembayaran['tgl_transfer'];
        $no_jamaah=$pembayaran['no_jamaah'];
        $id_agent=$pembayaran['id_agent'];
        $untuk_pembayaran=$pembayaran['pembayaran'];
        $nominal=$pembayaran['nominal'];
        $status=$pembayaran['status_payment'];
        $transaksi[]= array($tgl_transfer,$no_jamaah,$id_agent,$untuk_pembayaran,$nominal,$status);
      }
    }
  }
  echo json_encode($transaksi);

?>