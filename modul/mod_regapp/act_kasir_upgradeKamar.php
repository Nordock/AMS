<?php
echo "not work!"
/*require '../../../config/koneksi.php';
$module=$_GET['mod'];
function fn_dataJamaah($konek, $idJamaah){
  $sql      =     "SELECT * FROM `tbl_jamaah` WHERE `noreg_jamaah`='".$idJamaah."' ";
  $query    =     mysqli_query($konek,$sql);
  $data     =     mysqli_fetch_array($query);
  return  $data;
}
function no_kwitansi($no_jamaah){
  $date = date("md");
  $randomnum = rand(1000, 9999);
  $count = substr($no_jamaah, -3);
  $no_kwitansi = "K".$date.$count.$randomnum;
  return $no_kwitansi;
}
$metode_pembayaran = $_POST['metode_pem'];
if ($metode_pembayaran == 'CASH'){
	$ke_rekening    = 'CASH';
	$dari_rekening  = 'CASH';
	$tgl_transfer   = date('Y-m-d H:i:s');
	$referensi 		  = 'CASH';
	$beritaacara	  = 'CASH';
}elseif ($metode_pembayaran == 'DEBIT'){
	$ke_rekening    = 'DEBIT';
	$dari_rekening  = 'DEBIT';
	$tgl_transfer   = date('Y-m-d H:i:s');
	$referensi 		  = 'DEBIT';
	$beritaacara	  = 'DEBIT';
}elseif ($metode_pembayaran == 'TRANSFER'){
	$ke_rekening    = isset($_POST['kerekenig']) ? $_POST['kerekenig'] :'';
	$dari_rekening  = isset($_POST['darirekening']) ? $_POST['darirekening'] :'';
	$tgl_transfer   = isset($_POST['tgl_transfer']) ? $_POST['tgl_transfer'] :'';
	$referensi 		  = isset($_POST['referensi']) ? $_POST['referensi'] :'';
	$beritaacara	  = isset($_POST['beritaacara']) ? $_POST['beritaacara'] :'';
}

  $no_jamaah      =       $_POST['kodeJamaah'];
  $dataJamaah     =       fn_dataJamaah($konek, $no_jamaah);
  $pembayaran     =       "Upgrade Kamar";
  $ref            =       "ref";
  $atasNama       =       $_POST['atasnama'];
  $status_payment =       "1";
  $nominal        =       ($dataJamaah['harga_paket'] - $dataJamaah['oldharga_paket']);
  $noKwitansi     =       no_kwitansi($no_jamaah);
  query_bayarUpgradeKamar($konek,$dataJamaah,$no_jamaah,$pembayaran,$referensi,$atasNama,$status_payment,$nominal,$noKwitansi,$ke_rekening,$dari_rekening,$tgl_transfer,$beritaacara, $module);

  function query_UpdateDataJamaah($konek, $idJamaah,$module){
    $sql="UPDATE tbl_jamaah SET status_pembayaran='1', statuspembayaranupgrade='1' WHERE noreg_jamaah='".$idJamaah."' ";
    if(mysqli_query($konek,$sql)){
        header("location:../../dashboard.php?mod=".$module);
    }
  }
  function query_bayarUpgradeKamar($konek,$dataJamaah,$no_jamaah,$pembayaran,$referensi,$atasNama,$status_payment,$nominal,$noKwitansi,$ke_rekening,$dari_rekening,$tgl_transfer,$beritaacara,$module){
       $sql    =   "INSERT INTO tbl_pembayaran(`no_jamaah`,`id_agent`,`ke_rekening`,`dari_rekening`,`tgl_transfer`,`pembayaran`,`ref`,`atasnama`,`beritaacara`,`status_payment`,`nominal`,`no_kwitansi`) VALUES ('".$dataJamaah['noreg_jamaah']."','".$dataJamaah['kode_agen']."','".$ke_rekening."','".$dari_rekening."', '". $tgl_transfer. "', 'Upgrade','".$referensi."','".$atasNama."','".$beritaacara."','1','".$nominal."','".$noKwitansi."')";
       if(mysqli_query($konek, $sql)){
            query_UpdateDataJamaah($konek, $no_jamaah, $module);
       }
  }*/


?>
