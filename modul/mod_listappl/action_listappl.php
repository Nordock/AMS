<?php
session_start();
include "../../config/koneksi.php";
include "../../config/library.php";
include "../../config/fungsi_thumbnail.php";
include "../../config/sendmailaktivasi.php";

  $module = $_GET['mod'];
  $act    = $_GET['act'];

if ($module=='listappl' AND $act=='update'){

	$idCust =$_POST['idCust'];
  $fullname =$_POST['full_name'];
  $ktp =$_POST['ktp'];
  $appStatus =$_POST['app_status'];
  $appAction =$_POST['app_action'];

  $nmPas = isset($_POST["full_name_spouse"]) ? $_POST["full_name_spouse"] : "";
  $fullname_spouse  = str_replace(array("'", "\""), " ", htmlspecialchars($nmPas));
  $jnsKelaminPas = isset($_POST["gender_spouse"]) ? $_POST["gender_spouse"] : "";
  $ktpPas = isset($_POST["ktp_spouse"]) ? $_POST["ktp_spouse"] : "";
  $npwpPas = isset($_POST["npwp_spouse"]) ? $_POST["npwp_spouse"] : "";
  $almtPas = isset($_POST["address_spouse"]) ? $_POST["address_spouse"] : "";
  $tglLahirPas = isset($_POST["dob_spouse"]) ? $_POST["dob_spouse"] : "";
  $tmptLahirPas = isset($_POST["pob_spouse"]) ? $_POST["pob_spouse"] : "";

  $nmJamin = isset($_POST["full_name_guarantor"]) ? $_POST["full_name_guarantor"] : "";
  $fullname_guarantor  = str_replace(array("'", "\""), " ", htmlspecialchars($nmJamin));
  $jnsKelaminJamin = isset($_POST["gender_guarantor"]) ? $_POST["gender_guarantor"] : "";
  $ktpJamin = isset($_POST["ktp_guarantor"]) ? $_POST["ktp_guarantor"] : "";
  $npwpJamin = isset($_POST["npwp_guarantor"]) ? $_POST["npwp_guarantor"] : "";
  $almtJamin = isset($_POST["address_guarantor"]) ? $_POST["address_guarantor"] : "";
  $tglLahirJamin = isset($_POST["dob_guarantor"]) ? $_POST["dob_guarantor"] : "";
  $tmptLahirJamin = isset($_POST["pob_guarantor"]) ? $_POST["pob_guarantor"] : "";

  $finCom = isset($_POST["fin_comp"]) ? $_POST["fin_comp"] : "";
  $salesChannel = isset($_POST["dealer"]) ? $_POST["dealer"] : "";
  $salesChannelBranch = isset($_POST["branch"]) ? $_POST["branch"] : "";
  $salesName = isset($_POST["sales_name"]) ? $_POST["sales_name"] : "";

  $fotoktp  	= $_FILES["fotoktpA"]['name'];
  $fotoktp2   = $_FILES["fotoktp2A"]['name'];
  $fotosim    = $_FILES["fotosimA"]['name'];
  $fotonpwp   = $_FILES["fotonpwpA"]['name'];
  $fotokk     = $_FILES["fotokkA"]['name'];
  $fotoaeonform     = $_FILES["fotoaeonformA"]['name'];
  $fotoother     = $_FILES["fotootherA"]['name'];

  $updateDate   = date('Y-m-d H:i:s');

  $updateappl = "UPDATE m_customer SET
              	idAppStatus='$appStatus',
                idAppAction='$appAction',

                nmPas = '$fullname_spouse',
                jnsKelaminPas = '$jnsKelaminPas',
                ktpPas = '$ktpPas',
                npwpPas = '$npwpPas',
                almtPas = '$almtPas',
                tglLahirPas = '$tglLahirPas',
                tmptLahirPas = '$tmptLahirPas',

                nmJamin = '$fullname_guarantor',
                jnsKelaminJamin = '$jnsKelaminJamin',
                ktpJamin = '$ktpJamin',
                npwpJamin = '$npwpJamin',
                almtJamin = '$almtJamin',
                tglLahirJamin = '$tglLahirJamin',
                tmptLahirJamin = '$tmptLahirJamin',

                idFinCompany = '$finCom',
                idSalesChannel = '$salesChannel',
                idSalesChannelBranch = '$salesChannelBranch',
                salesName = '$salesName',
                updateDate = '$updateDate'

              	WHERE idCustomer='$idCust' ";
  $result = mysqli_query($konek, $updateappl);

  if(!empty($fotoktp))
  {
      $updateKTP = "UPDATE m_customer SET
                   fotoKTP = 'EDIT-$fullname-$ktp'
                   WHERE idCustomer='$idCust' ";
      $resultKTP = mysqli_query($konek, $updateKTP);
  }
  if(!empty($fotoktp2))
  {
      $updateKTP2 = "UPDATE m_customer SET
                   fotoKTP2 = 'EDIT-$fullname-$ktp'
                   WHERE idCustomer='$idCust' ";
      $resultKTP2 = mysqli_query($konek, $updateKTP2);
  }
  if(!empty($fotosim))
  {
      $updateSIM = "UPDATE m_customer SET
                   fotoSIM = 'EDIT-$fullname-$ktp'
                   WHERE idCustomer='$idCust' ";
      $resultSIM = mysqli_query($konek, $updateSIM);
  }
  if(!empty($fotonpwp))
  {
      $updateNPWP = "UPDATE m_customer SET
                   fotoNPWP = 'EDIT-$fullname-$ktp'
                   WHERE idCustomer='$idCust' ";
      $resultNPWP = mysqli_query($konek, $updateNPWP);
  }
  if(!empty($fotokk))
  {
      $updateKK = "UPDATE m_customer SET
                   fotoNPWP = 'EDIT-$fullname-$ktp'
                   WHERE idCustomer='$idCust' ";
      $resultKK = mysqli_query($konek, $updateKK);
  }
  if(!empty($fotoaeonform))
  {
      $updateAEONForm = "UPDATE m_customer SET
                   fotoAEONForm = 'EDIT-$fullname-$ktp'
                   WHERE idCustomer='$idCust' ";
      $resultAEONForm = mysqli_query($konek, $updateAEONForm);
  }
  if(!empty($fotoother))
  {
      $updatefotoother = "UPDATE m_customer SET
                   fotoAppDok = 'EDIT-$fullname-$ktp'
                   WHERE idCustomer='$idCust' ";
      $resultfotoother = mysqli_query($konek, $updatefotoother);
  }

  $folder1 = "../../file/KTP/";
  $folder2 = "../../file/KTP2/";
  $folder3 = "../../file/SIM/";
  $folder4 = "../../file/NPWP/";
  $folder5 = "../../file/KK/";
  $folder6 = "../../file/AEONForm/";
  $folder7 = "../../file/Other/";

  move_uploaded_file($_FILES["fotoktpA"]['tmp_name'], $folder1.'EDIT-'.$fullname.'-'.$ktp);
  move_uploaded_file($_FILES['fotoktp2A']['tmp_name'], $folder2.'EDIT-'.$fullname.'-'.$ktp);
  move_uploaded_file($_FILES['fotosimA']['tmp_name'], $folder3.'EDIT-'.$fullname.'-'.$ktp);
  move_uploaded_file($_FILES['fotonpwpA']['tmp_name'], $folder4.'EDIT-'.$fullname.'-'.$ktp);
  move_uploaded_file($_FILES['fotokkA']['tmp_name'], $folder5.'EDIT-'.$fullname.'-'.$ktp);
  move_uploaded_file($_FILES['fotoaeonformA']['tmp_name'], $folder6.'EDIT-'.$fullname.'-'.$ktp);
  move_uploaded_file($_FILES['fotootherA']['tmp_name'], $folder7.'EDIT-'.$fullname.'-'.$ktp);


	if (!$result) {
			die('Invalid query: ' . mysql_error());
	}else{
    header("location:../../dashboard.php?mod=".$module);
	}
}
