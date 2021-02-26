<?php
session_start();
include_once("functions/connect.php");
include_once("functions/staff.php");

    $sessId = $_SESSION["staff_id"];
    $curPass = $_POST["currentPassword"];
    $newPass = $_POST["newPassword"];
    $verifyNewPass = $_POST["verifyPassword"];
//echo $sessId." ".$curPass." ".$newPass." ".$verifyNewPass;
if(isset($_POST["submit"])){
        //call changePassword method
    staff::changePassword($sessId,$curPass, $newPass, $verifyNewPass);
	
}

?>
