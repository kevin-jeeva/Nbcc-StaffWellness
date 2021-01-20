<?php 
//verify the user's login credentials.
/*if they are valid as administrator, redirect them to administrator.php/
	if they are valid as staff user, redirect them to index.php
	if they are invalid send them back to login.php
*/

session_start();
include("functions/staff.php");
include("functions/connect.php");

// Check that the login form was submitted
if (isset($_POST["email"])) {

	$input_email = trim($_POST["email"]);
	$input_password = trim($_POST['password']);
    
    //constructor: $staffId, $email, $password, $username, $admin, $dateCreated
    $staff = new staff(0, $input_email, $input_password, 0, 0, 0);
    $result = staff::staffLogin($staff, $con);
    
    if ($result == -1){
        $msg = 'Incorrect Password. Please Try again!';
        header("location:Login.php?loginError=$msg");
    }
    else if ($result == -2){
        $msg = 'Email not found. Please Try again!';
        header("location:Login.php?loginError=$msg");
    }
    else {
        header("location:index.php?user=$result");
    }
}
?>