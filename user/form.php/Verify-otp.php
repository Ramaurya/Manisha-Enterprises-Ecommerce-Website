<?php
session_start();
$actual_sent_otp=$_SESSION['OTP'];
$entered_otp=$_POST['otp'];
$phone=$_SESSION['reset_mobile'];
if($actual_sent_otp==$entered_otp){
    header("location:change_password.php");
}else{
    header("location:otp.php?msg=Incorrect OTP Entered");
}

?>