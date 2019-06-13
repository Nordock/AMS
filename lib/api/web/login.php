<?php 
header('Access-Control-Allow-Origin: *');
include "../../../config/koneksi.php";

header('Content-Type: application/json'); 
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, x");
header("Access-Control-Allow-Headers: Content-Type, x-xsrf-token");

$username = $_POST['username'];
$password = $_POST['password'];
$token_id 			= $_POST['token_id'];

	//ngecek token_id
	$token = "SELECT token_id FROM tbl_authentication where token_id='$token_id' and status=1";
	$hsl_token = mysqli_query($konek, $token);
	$row = mysqli_fetch_array($hsl_token);

	//Ambil data token dari database
	$tokenDB = $row['token_id'];
	if($token_id=='')
	{
	    $pesan = "Not authorized";
	}else if ($tokenDB != $token_id){
	    $pesan = "Not authorized";
	}else {
		$query  = "SELECT * FROM tbl_jamaah_login WHERE email='$username' AND password='$password' AND status='1'";
		// echo ($query.'my');
		$login  = mysqli_query($konek, $query);
		$ketemu = mysqli_num_rows($login);
		$r      = mysqli_fetch_array($login);

		// Apabila username dan password ditemukan (benar)
		if ($ketemu > 0){
		    $nama   = $r['nama'];
		    $email    = $r['email'];
		    $tlp = $r['tlp'];
		    $id_login = $r['id_login'];
		    $no_id = $r['no_id'];
		    $tipe_id = $r['tipe_id'];
			
		    $pesan =  array('nama' =>$nama , 
		    							'email' => $email,
		    							'tlp' => $tlp,
		    							'no_id' =>$no_id,
		    							'id_login' =>$id_login,
		    							'tipe_id' => $tipe_id
		    							);
		}else{
		    $pesan ="Maaf! Login tidak berhasil, Silahkan masukan username & password anda dengan benar! ";
		    //logToFile("config/log/loginbo.log", $username." : Login tidak berhasil");
		}
	}
	echo json_encode($pesan);

?>