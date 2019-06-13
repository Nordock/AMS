<?php
session_start();
// Sends the user to the login-page if not logged in
if (!isset($_SESSION['namauser']) AND !isset($_SESSION['passuser'])){
   header('Location:index.php?msg=requires_login');
   exit;
}
?>