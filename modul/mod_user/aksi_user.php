<?php
session_start();
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  echo "<link href=\"../../css/style_login.css\" rel=\"stylesheet\" type=\"text/css\" />
        <div id=\"login\"><h1 class=\"fail\">Untuk mengakses modul, Anda harus login dulu.</h1>
        <p class=\"fail\"><a href=\"../../index.php\">LOGIN</a></p></div>";  
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
  include "../../../config/koneksi.php";

  $module = $_GET['mod'];
  $act    = $_GET['act'];

 

  // Update user
  if ($module=='user' AND $act=='update'){
    $id           = $_POST['id'];
    $nama_lengkap = $_POST['nama_lengkap']; 
    $email        = $_POST['email'];

 
    // Apabila password tidak diubah (kosong)
    if (empty($_POST['password'])) {
      $update = "UPDATE tbl_admin SET nama = '$nama_lengkap',
                                         email = '$email'   
                              WHERE id_admin = $id";

      mysqli_query($konek, $update);
    }
    // Apabila password diubah
    else{
      $password = md5($_POST['password']);
      $update = "UPDATE tbl_admin SET nama = '$nama_lengkap',
                                        email  = '$email',
                                      pwd = '$password'    
                              WHERE id_admin = $id";
      mysqli_query($konek, $update);

    }
    header("location:../../dashboard.php?mod=".$module);
  }
}
?>
