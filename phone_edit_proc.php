<?php
session_start();
include_once("functions/connect.php");
include_once("functions/staff.php");

    $sessId = $_SESSION["staff_id"];
    $password = $_POST["password"];
    $newPhone = $_POST["newPhone"];
//echo $sessId." ".$curPass." ".$newPass." ".$verifyNewPass;
if(isset($_POST["submit"])){
        //call changePassword method
    staff::changePhone($sessId,$password, $newPhone);
	
}

?>