<?php

function sendsms($hp,$message, $module){
$username='firsttravel';
$password='travel01';

$url = 'http://103.29.214.230:82/smscenter/send.asp?username='.$username.'&password='.$password.'&hp='.$hp.'&message='.$message;
$url = str_replace(" ","%20",$url);

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_HEADER, 0);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // For HTTPS
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // For HTTPS
  curl_exec($ch);
  $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); // Returns 200 if everything went well

  echo "<script>document.location.href='../../dashboard.php?mod=$module'</script>"; //Redirecting back after successfully sent SMS

  curl_close($ch);

}

?>
