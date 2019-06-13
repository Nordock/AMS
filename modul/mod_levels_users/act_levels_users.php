<?php
ini_set('display_errors', 'On');
include "../../config/koneksi.php";
include "../../config/library.php";
include "../../config/fungsi_thumbnail.php";
include "../../config/sendemailX.php";


function generate_password($length = 6){
  $chars =  'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'.
            '0123456789';
  $str = '';
  $max = strlen($chars) - 1;
  for ($i=0; $i < $length; $i++)
    $str .= $chars[mt_rand(0, $max)];
  return $str;
}
function view_levels($data){
    if($data=='admin'){
        $level="1";
    }
    else if($data=='finance'){
        $level="2";
    }

    else if($data=='cs'){
        $level="3";
    }

    else if($data=='admin agen'){
        $level="4";
    }
    else if($data == 'admin bo'){
      $level="5";
    }
	else if($data== 'finance bo'){
		$level='6';
	}
	else if($data== 'logistik'){
		$level='7';
	}
	else if($data== 'manasik'){
		$level='9';
	} else if($data== 'filecontrol'){
		$level='10';
	} else if($data== 'receptionist'){
		$level='11';
	}else if($data== 'CRO'){
		$level='12';
	}
	
	
    return $level;
}
$module = $_GET['mod'];
$act    = $_GET['act'];
  if ($module=='listuser' AND $act=='plush'){
        $username = isset($_POST['username']) ? $_POST['username'] : '';
        $pwd= isset($_POST['password']) ? $_POST['password'] : '';
        $email   = isset($_POST['email']) ? $_POST['email'] : '';
        $city   = isset($_POST['city']) ? $_POST['city'] : '';
        $lokasi=isset($_POST['lokasi']) ? $_POST['lokasi'] : '';
        $pwd    = generate_password();
	    $pwdmd5 = md5($pwd);
//
        $sql="insert into tbl_users(username, pwd, email, city, lokasi, status)values
        ('".$username."','".$pwdmd5."','".$email."','".$city."','".$lokasi."','1')";

        if($query=mysqli_query($konek, $sql)){
        GivePassBOStaff($username, $pwd, $email, $city, $lokasi);


        header("location:../../dashboard.php?mod=".$module);
}
}
    else if($module=='listuser' and $act=='delete'){
        $id_user=$_GET['no_aja'];
        $sql="delete from tbl_users where id_users='".$id_user."'";
        if($query=  mysqli_query($konek, $sql)){
            header("location:../../dashboard.php?mod=".$module);
        }
    }
    else if($module=='listuser' and $act=='update'){
        $id_user=$_POST['x_user'];
        $nm=isset($_POST['username']) ? $_POST['username'] : '';
		$pwd=isset($_POST['password']) ? $_POST['password'] : '';
        $mail=isset($_POST['email']) ? $_POST['email'] : '';
        $city   = isset($_POST['city']) ? $_POST['city'] : '';
		$lokasi   = isset($_POST['lokasi']) ? $_POST['lokasi'] : '';
        $l = isset($_POST['levels']) ? $_POST['levels'] : '';
        $levels = view_levels($l);
        $status = isset($_POST['status']) ? $_POST['status'] : '';
        $sql="update tbl_users set username='".$nm."', pwd='".$pwd."', email='".$mail."', city='".$city."', lokasi='".$lokasi."', level='".$levels."', status='".$status."' where id_users='$id_user'";
		//echo $sql;
         if($query=  mysqli_query($konek, $sql)){
			// 
            header("location:../../dashboard.php?mod=".$module);
        }
    }
