<?php
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  echo "<link href=\"css/style_login.css\" rel=\"stylesheet\" type=\"text/css\" />
        <div id=\"login\"><h1 class=\"fail\">Untuk mengakses modul, Anda harus login dulu.</h1>
        <p class=\"fail\"><a href=\"index.php\">LOGIN</a></p></div>";
}
// Apabila user sudah login dengan benar, maka terbentuklah session

else{
  include "config/koneksi.php";
  //include "../config/library.php";

  // Home (Beranda)
  if ($_GET['mod']=='home'){
    if ($_SESSION['leveluser']=='1' OR $_SESSION['leveluser']=='2' OR $_SESSION['leveluser']=='5'){
      include "modul/mod_home/home.php";
    }elseif ($_SESSION['leveluser']=='3' OR $_SESSION['leveluser']=='11'OR $_SESSION['leveluser']=='12'){
    	include "modul/mod_home/homecs.php";
    }elseif ($_SESSION['leveluser']=='4'){
    	include "modul/mod_home/homeagen.php";
    }elseif ($_SESSION['leveluser']=='8'){
    	include "modul/mod_home/homefinance.php";
    }
 }

  // daftar aplikan
  elseif ($_GET['mod']=='listappl'){
    if ($_SESSION['leveluser']=='1' OR $_SESSION['leveluser']=='2' OR $_SESSION['leveluser']=='5'){
      include "modul/mod_listappl/mod_listappl.php";
    }
	else{
    echo "<p>Page 404!!! Page not exists</p>";
    }
  }

  elseif ($_GET['mod']=='regapp'){
    if ($_SESSION['leveluser']=='1' or $_SESSION['leveluser']=='2' or $_SESSION['leveluser']=='5'){
      include "modul/mod_regapp/mod_regapp.php";
    } else{
    echo "<p>Page 404 halaman ini tidak ada.</p>";
    }
  }

  // Manajemen User
  elseif ($_GET['mod']=='user'){

      include "modul/mod_user/user.php";

  }

  // Manajemen Modul
  elseif ($_GET['mod']=='modul'){
    if ($_SESSION['leveluser']=='admin'){
      include "modul/mod_modul/modul.php";
    }
  }

  elseif ($_GET['mod']=='listuser'){
      include "modul/mod_levels_users/mod_levels_users.php";
      //include "modul/mod_levels_users/mod_levels_users.php";
  }



  // Apabila modul tidak ditemukan
  else{
    echo "<p>Modul tidak ada.</p>";
  }
}
?>
