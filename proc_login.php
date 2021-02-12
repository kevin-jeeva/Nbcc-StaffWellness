<?php 
//verify the user's login credentials.
/*if they are valid as administrator, redirect them to administrator.php/
	if they are valid as staff user, redirect them to index.php
	if they are invalid send them back to login.php
*/

session_start();
//some session variables
$_SESSION["admin"] = "";
$_SESSION["staff_name"] ="";
$_SESSION["staff_id"] = "";
$_SESSION["message"] = "";
$_SESSION["alert_message"] = "";
$_SESSIOs["active"] = 0;
include("functions/staff.php");
include("functions/connect.php");

// Check that the login form was submitted
if (isset($_POST["email"])) {

	$input_email = trim($_POST["email"]);
	$input_password = trim($_POST['password']);
    
    //constructor: $staffId, $email, $password, $username, $admin, $dateCreated
    $staff = new staff(0, $input_email, $input_password, 0, 0, 0, 0, 0, 0, 0);    
    staff::staffLogin($staff);//check the staff credentials and take neccessary action
    
}
else
{
	header("location:login.php");
}
?>