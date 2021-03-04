<?php
session_start();
include_once("functions/connect.php");
include_once("functions/staff.php");

    $sessId = $_SESSION["staff_id"];
    $on = $_POST["onoff"];
   // $sms = $_POST["sms"];
   // $email = $_POST["email"];

if(isset($_POST["submit"])){
   // staff::changeNotifications($sessId, $sms, $email);
	staff::notifsOn($on);
}

?>