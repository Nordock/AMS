<?php
session_start();
include "../../config/koneksi.php";
include "../../config/Browser.php";
include "../../config/sendemail.php";
include "../../config/sendsms.php";

$module = $_GET['mod'];
$act    = $_GET['act'];

function get_ip_address()
{
    // return unreliable ip since all else failed
    return $_SERVER['REMOTE_ADDR'];
}

if ($module=='regapp' AND $act=='registrasi'){
    $browser      = new Browser();
    $browser_info = $browser->getBrowser();
    $true_ip = get_ip_address();

	  $inputby = $_SESSION['namauser'];
    $idadmin = $_SESSION['iduser'];
    $app_status     = isset($_POST["app_status"]) ? $_POST["app_status"] : "";
    $app_action     = isset($_POST["app_action"]) ? $_POST["app_action"] : "";
    $fullname1      = isset($_POST["full_name"]) ? $_POST["full_name"] : "";
	  $fullname       = str_replace(array("'", "\""), " ", htmlspecialchars($fullname1));
    $gender         = isset($_POST["gender"]) ? $_POST["gender"] : "";
    $ktp            = isset($_POST["ktp"]) ? $_POST["ktp"] : "";
    $npwp           = isset($_POST["npwp"]) ? $_POST["npwp"] : "";
    $address        = isset($_POST["address"]) ? $_POST["address"] : "";
    $dob            = isset($_POST["dob"]) ? $_POST["dob"] : "";
    $pob            = isset($_POST["pob"]) ? $_POST["pob"] : "";
    $hp             = isset($_POST["hp"]) ? $_POST["hp"] : "";
    $online_driver  = isset($_POST["online_driver"]) ? $_POST["online_driver"] : "";
    $driver_apps    = isset($_POST["driver_apps"]) ? $_POST["driver_apps"] : "";

    $fullname2        = isset($_POST["full_name_spouse"]) ? $_POST["full_name_spouse"] : "";
	  $fullname_spouse  = str_replace(array("'", "\""), " ", htmlspecialchars($fullname2));
    $gender_spouse    = isset($_POST["gender_spouse"]) ? $_POST["gender_spouse"] : "";
    $ktp_spouse       = isset($_POST["ktp_spouse"]) ? $_POST["ktp_spouse"] : "";
    $npwp_spouse      = isset($_POST["npwp_spouse"]) ? $_POST["npwp_spouse"] : "";
    $address_spouse   = isset($_POST["address_spouse"]) ? $_POST["address_spouse"] : "";
    $dob_spouse       = isset($_POST["dob_spouse"]) ? $_POST["dob_spouse"] : "";
    $pob_spouse       = isset($_POST["pob_spouse"]) ? $_POST["pob_spouse"] : "";

    $fullname3        = isset($_POST["full_name_guarantor"]) ? $_POST["full_name_guarantor"] : "";
	  $fullname_guarantor  = str_replace(array("'", "\""), " ", htmlspecialchars($fullname3));
    $gender_guarantor    = isset($_POST["gender_guarantor"]) ? $_POST["gender_guarantor"] : "";
    $ktp_guarantor       = isset($_POST["ktp_guarantor"]) ? $_POST["ktp_guarantor"] : "";
    $npwp_guarantor      = isset($_POST["npwp_guarantor"]) ? $_POST["npwp_guarantor"] : "";
    $address_guarantor   = isset($_POST["address_guarantor"]) ? $_POST["address_guarantor"] : "";
    $dob_guarantor       = isset($_POST["dob_guarantor"]) ? $_POST["dob_guarantor"] : "";
    $pob_guarantor       = isset($_POST["pob_guarantor"]) ? $_POST["pob_guarantor"] : "";

    $fin_comp       = isset($_POST["fin_comp"]) ? $_POST["fin_comp"] : "";
    $dealer         = isset($_POST["dealer"]) ? $_POST["dealer"] : "";
    $branch         = isset($_POST["branch"]) ? $_POST["branch"] : "";
    $sales          = isset($_POST["sales_name"]) ? $_POST["sales_name"] : "";

    $fotoktp  	= $_FILES["fotoktp"]['name'];
    $fotoktp2   = $_FILES["fotoktp2"]['name'];
    $fotosim    = $_FILES["fotosim"]['name'];
    $fotonpwp   = $_FILES["fotonpwp"]['name'];
    $fotokk     = $_FILES["fotokk"]['name'];
    $fotoaeonform     = $_FILES["fotoaeonform"]['name'];
    $fotoother     = $_FILES["fotoother"]['name'];

    $createDate   = date('Y-m-d H:i:s');

    $query = mysqli_query($konek, "select MAX(idCustomer) as maxid from m_customer");
    $r     = mysqli_fetch_array($query);
    $lastID = $r['maxid']+1;

    $reg_app = "INSERT INTO m_customer(idAppStatus,idAppAction,idUser,idFinCompany,nmCust,jnsKelamin,ktp,npwp,alamat,tglLahir,tmptLahir,driverOnline,aplikasi,
                nmPas,jnsKelaminPas,ktpPas,npwpPas,almtPas,tglLahirPas,tmptLahirPas,nmJamin,jnsKelaminJamin,ktpJamin,npwpJamin,almtJamin,tglLahirJamin,tmptLahirJamin,
                fotoKTP,fotoKTP2,fotoSIM,fotoNPWP,fotoKK,fotoAEONForm,fotoAppDok,
                picName,salesName,idSalesChannel,idSalesChannelBranch,noHP,regDate,createDate) VALUES
          ('".$app_status."','".$app_action."','".$idadmin."','".$fin_comp."','".$fullname."','".$gender."','".$ktp."','".$npwp."','".$address."','".$dob."','".$pob."','".$online_driver."','".$driver_apps."',
           '".$fullname_spouse."','".$gender_spouse."','".$ktp_spouse."','".$npwp_spouse."','".$address_spouse."','".$dob_spouse."','".$pob_spouse."',
           '".$fullname_guarantor."','".$gender_guarantor."','".$ktp_guarantor."','".$npwp_guarantor."','".$address_guarantor."','".$dob_guarantor."','".$pob_guarantor."',
           '".$fullname.'-'.$ktp."','".$fullname.'-'.$ktp."','".$fullname.'-'.$ktp."','".$fullname.'-'.$ktp."','".$fullname.'-'.$ktp."','".$fullname.'-'.$ktp."','".$fullname.'-'.$ktp."',
           '".$inputby."','".$sales."','".$dealer."','".$branch."','".$hp."','".$createDate."','".$createDate."')";

    $reg_app2 = "INSERT INTO h_appstatus(idCustomer,idAppStatus,createDate)
                 VALUES ('".$lastID."','".$app_status."','".$createDate."')";
    $reg_app3 = "INSERT INTO h_appaction(idCustomer,idAppAction,createDate)
                 VALUES ('".$lastID."','".$app_action."','".$createDate."')";

    $result = mysqli_query($konek,$reg_app);
    $result2 = mysqli_query($konek,$reg_app2);
    $result3 = mysqli_query($konek,$reg_app3);

      $folder1 = "../../file/KTP/";
      $folder2 = "../../file/KTP2/";
      $folder3 = "../../file/SIM/";
      $folder4 = "../../file/NPWP/";
      $folder5 = "../../file/KK/";
      $folder6 = "../../file/AEONForm/";
      $folder7 = "../../file/Other/";

      move_uploaded_file($_FILES["fotoktp"]['tmp_name'], $folder1.$fullname.'-'.$ktp);
    	move_uploaded_file($_FILES['fotoktp2']['tmp_name'], $folder2.$fullname.'-'.$ktp);
    	move_uploaded_file($_FILES['fotosim']['tmp_name'], $folder3.$fullname.'-'.$ktp);
    	move_uploaded_file($_FILES['fotonpwp']['tmp_name'], $folder4.$fullname.'-'.$ktp);
      move_uploaded_file($_FILES['fotokk']['tmp_name'], $folder5.$fullname.'-'.$ktp);
      move_uploaded_file($_FILES['fotoaeonform']['tmp_name'], $folder6.$fullname.'-'.$ktp);
      move_uploaded_file($_FILES['fotoother']['tmp_name'], $folder7.$fullname.'-'.$ktp);

   	if(!$result){
        header("location:../../dashboard.php?mod=".$module);
        exit();
	}else{

      echo "<script>window.open('$action','_blank') </script>";
    	echo "<script>alert('Applicant data saved successfully');</script>";
    	echo "<script>document.location.href='../../dashboard.php?mod=$module'</script>"; //Redirecting back after successfully sent SMS

	}
}
