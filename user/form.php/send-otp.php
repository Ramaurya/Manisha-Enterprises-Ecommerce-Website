<?php
session_start();
echo $OTP=$_SESSION['OTP'];


$API="0937fb5864ed06ffb59ae5f9b5ed67a9"; // ENTER YOUR VALID API KEY HERE
$PHONE=$_SESSION['reset_mobile'];
$_SESSION['phone']=$PHONE;
$COUNTRY='91'; // Country Code

$URL="https://whatsapp.renflair.in/V1.php?API=$API&PHONE=$PHONE&OTP=$OTP&COUNTRY=$COUNTRY";
$curl=curl_init($URL);
curl_setopt($curl, CURLOPT_URL, $URL);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$resp = curl_exec($curl);
curl_close($curl);
$data = json_decode($resp);
echo $resp;

header("location:otp.php");


?>
