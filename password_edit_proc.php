<?php
session_start();
include_once("functions/connect.php");
include_once("functions/staff.php");

    $sessId = $_SESSION["staff_id"];
    $curPass = trim($_POST["currentPassword"]);
    $newPass = trim($_POST["newPassword"]);
    $verifyNewPass = trim($_POST["verifyPassword"]);
//echo $sessId." ".$curPass." ".$newPass." ".$verifyNewPass;
if(isset($_POST["submit"])){
        //call changePassword method
        
    staff::changePassword($sessId,$curPass, $newPass, $verifyNewPass);
	
}

?>
