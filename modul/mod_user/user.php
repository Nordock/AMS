<?php
if (!isset($_SESSION['namauser']) AND !isset($_SESSION['passuser'])){
   header('Location:index.php?msg=requires_login');
   exit;
}
  $aksi = "modul/mod_user/aksi_user.php";

  // mengatasi variabel yang belum di definisikan (notice undefined index)
  $act = isset($_GET['act']) ? $_GET['act'] : ''; 

  switch($act){
    // Tampil User
    default:
      $query = "SELECT * FROM tbl_admin WHERE username='$_SESSION[namauser]'";
      $hasil = mysqli_query($konek, $query);
      $r     = mysqli_fetch_array($hasil);

    
        echo "<h2>Profile User</h2>
		<div class='form-group'>
          <form method=\"POST\" action=\"$aksi?mod=user&act=update\">
          <input type=\"hidden\" name=\"id\" value=\"$r[id_admin]\">
          <table>
          <tr><td>Username</td>     <td> : <input type=\"text\" name=\"username\" value=\"$r[username]\" disabled> **)</td></tr>
          <tr><td>Password</td>     <td> : <input type=\"text\" name=\"password\"> *) </td></tr>
          <tr><td>Nama Lengkap</td> <td> : <input type=\"text\" name=\"nama_lengkap\" value=\"$r[nama]\"></td></tr>
          <tr><td>E-mail</td>       <td> : <input type=\"text\" name=\"email\" value=\"$r[email]\"></td></tr>";
        echo "<tr><td colspan=\"2\">*) Apabila password tidak diubah, dikosongkan saja.<br />
                                **) Username tidak bisa diubah.</td></tr>
          <tr><td colspan=\"2\"><input type=\"submit\" value=\"Update\">
                                <input type=\"button\" value=\"Batal\" onclick=\"self.history.back()\"></td></tr>
          </table>
          </form></div>";     
      
    break;
  
   
}    
?>
