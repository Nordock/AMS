<?php
header('Access-Control-Allow-Origin: *');
include "../../../config/koneksi.php";
include "../../../config/sendmail_api.php";

header('Content-Type: application/json'); 
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, x");
header("Access-Control-Allow-Headers: Content-Type, x-xsrf-token");

function get_ip_address()
{
    // check for shared internet/ISP IP
    if (!empty($_SERVER['HTTP_CLIENT_IP']) && validate_ip($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    }

    // check for IPs passing through proxies
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        // check if multiple ips exist in var
        if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',') !== false) {
            $iplist = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            foreach ($iplist as $ip) {
                if (validate_ip($ip))
                    return $ip;
            }
        } else {
            if (validate_ip($_SERVER['HTTP_X_FORWARDED_FOR']))
                return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
    }
    if (!empty($_SERVER['HTTP_X_FORWARDED']) && validate_ip($_SERVER['HTTP_X_FORWARDED']))
        return $_SERVER['HTTP_X_FORWARDED'];
    if (!empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']) && validate_ip($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
        return $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
    if (!empty($_SERVER['HTTP_FORWARDED_FOR']) && validate_ip($_SERVER['HTTP_FORWARDED_FOR']))
        return $_SERVER['HTTP_FORWARDED_FOR'];
    if (!empty($_SERVER['HTTP_FORWARDED']) && validate_ip($_SERVER['HTTP_FORWARDED']))
        return $_SERVER['HTTP_FORWARDED'];

    // return unreliable ip since all else failed
    return $_SERVER['REMOTE_ADDR'];
}
if(isset($_POST['token_id'])){
	$nama 		=  $_POST['nama'];
	$tlp        =  $_POST['tlp'];
    $email      =  $_POST['email'];
    $jnsid      =  $_POST['jnsid'];
	$noid       =  $_POST['noid'];
    $password	=  md5($_POST['password']);
    $token_id   =  $_POST['token_id'];
    $true_ip 	=  get_ip_address();
	 // print_r($_POST['nama']);die('masuk');
	//ngecek token_id
    $token = "SELECT token_id FROM tbl_authentication where token_id='$token_id' and status=1";
    $hsl_token = mysqli_query($konek, $token);
    $row = mysqli_fetch_array($hsl_token);
    
    $id = "SELECT * FROM tbl_jamaah_login where no_id='$noid' or email = '$email'";
    $hsl_id = mysqli_query($konek, $id);
    $row_id = mysqli_num_rows($hsl_id);
    
    //Ambil data token dari database
    $tokenDB = $row['token_id'];

	if($token_id=='')
	{
        $data1 ['result'] = "Not authorized";
    }
    else if ($row_id>0) {
        $data1 ['result'] = "Nomer Identitas atau email sudah terdaftar";
    }
    else if ($tokenDB != $token_id)
	{
        $data1 ['result'] = "Not authorized";
    }else 
	{
		//insert data ke tbl_jamaah_login

		$hsl = "INSERT INTO `tbl_jamaah_login`
		( `nama`, `email`, `tlp`, `password`,`tipe_id`,`no_id`,`ip`,`status`,`created_at`,`created_by`)
		VALUES
		('$nama', '$email', '$tlp', '$password', '$jnsid', '$noid', '$true_ip','0',NOW(),'This User')";
		
	    $hasilsql2 = mysqli_query($konek, $hsl);
	    sendingemail_api($email,$nama,$password);
			
		$data1 ['result'] = 'Data berhasil disimpan, silahkan cek email anda untuk konfirmasi!';
	}
    echo json_encode($data1);
}else{
	$nama 		=  $_POST['nama'];
	$email        =  $_POST['email'];
    $passwordd	=  substr($_POST['code'],5);
    $password	=  substr($passwordd,0,-5);
    $update = "UPDATE tbl_jamaah_login set status = 1 where nama='$nama' and email='$email' and password = '$password'";
    $hsl_update = mysqli_query($konek, $update);
    if($hsl_update){
    	$data1 ['result'] = 'ok';
    }else{
    	$data1 ['result'] = 'no';
    }
    echo json_encode($data1);
}

 ?>
