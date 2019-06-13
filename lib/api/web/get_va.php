<?php
/*****ATM INTEGRATION****/
//$verfy_key="2d70e4bdecb4e81fc7abcd416f32fdcf"; // devlopment

$verfy_key="616548576d7994de19780c0af3fe4234";  //production

$merchantID ="firsttravel_va";  // firsttravel_va


$vamode ="1"; 
if ( $vamode == '0'){
 // generate VA sendiri
 $virtual_account = "875407-00000-51307"; 
}				   //875407-11111-51307

elseif ($vamode == '1'){
 // generate VA molpay
 $virtual_account =""; 
}  
//$due_time = date('Y-m-d H:i:s', strtotime("+3 minute"));  //Bill Due date and time expaired by default Set 2 Hour 
$amount			= $_GET['amount'];
$oid			= $_GET['oid'];
$name			= $_GET['name'];
$email			= $_GET['email'];
$mobile			= $_GET['mobile'];
$due_time = date('Y-m-d H:i:s', strtotime("+72 hour"));
$description	= $_GET['description'];
$vcode			= md5($amount.$merchantID.$oid.$verfy_key); 
$postdata ="merchantID=$merchantID&due_time=$due_time&amount=$amount&orderid=$oid&bill_name=$name&bill_email=$email&bill_mobile=$mobile&bill_desc=$description&vamode=$vamode&va=$virtual_account&vcode=$vcode"; 

// die($postdata);

$url="https://secure.molpay.co.id/MOLPay/API/va/";
//$url = "https://dev.molpay.co.id/MOLPay/API/VA/";


$curlHandle = curl_init(); 
curl_setopt($curlHandle, CURLOPT_URL, $url); 
curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $postdata); 
curl_setopt($curlHandle, CURLOPT_HEADER, 0); 
curl_setopt($curlHandle, CURLOPT_TIMEOUT,15); 
curl_setopt($curlHandle, CURLOPT_POST, 1); 
curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST,  2);  

header('Content-type: text/xml'); 
header('Pragma: public'); 
header('Cache-control: private'); 
header('Expires: -1'); 
$server_output = curl_exec($curlHandle); 
curl_close($curlHandle); 
?>