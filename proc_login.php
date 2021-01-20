<?php 
//verify the user's login credentials.
/*if they are valid as administrator, redirect them to administrator.php/
	if they are valid as staff user, redirect them to index.php
	if they are invalid send them back to login.php
*/
session_start();
include'functions/user.php';
user::staffLogin($_POST['password'], $_POST['email']);
?>