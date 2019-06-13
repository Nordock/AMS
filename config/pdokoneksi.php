<?php
// variabel koneksi
        $db_name  = 'smartagent15';
        $hostname = 'localhost';
        $username = 'root';
        $password = '';
         
    // koneksi ke database
        $dbh = new PDO("mysql:host=$hostname;dbname=$db_name", $username, $password);
?>