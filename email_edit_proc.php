<?php
session_start();
include_once("functions/connect.php");
include_once("functions/staff.php");

    $sessId = $_SESSION["staff_id"];
    $password = $_POST["password"];
    $newEmail = $_POST["newEmail"];
//echo $sessId." ".$curPass." ".$newPass." ".$verifyNewPass;
if(isset($_POST["submit"])){
        //call changePassword method
    staff::changeEmail($sessId,$password, $newEmail);
	
}

?>