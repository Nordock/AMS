<?php
class myconnection{
    function base_url(){
        header('location:index.php?Alamat=login');
    }
    function ft_connection(){
        $login[0]="localhost"; 
        $login[1]="root";
        $login[2]="";
        $login[3]="smartagent15";
        return $con = new mysqli($login[0], $login[1], $login[2], $login[3]);
    }
}
?>