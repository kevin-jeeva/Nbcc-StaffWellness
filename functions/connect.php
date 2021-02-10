<?php
//these are defined as constants
define('DB_HOST', 'staff-wellness-app.c97g5kpuab3n.us-east-1.rds.amazonaws.com:3311');
define('DB_USER', 'admin');
define('DB_PASS', 'StaffNbcc001');
define('DB_NAME', 'staff');

// for testing purposes
//git  define('DB_HOST', 'localhost:3306');
// define('DB_USER', 'root');
// define('DB_PASS', '');
// define('DB_NAME', 'staff');
	
global $con;
$con = mysqli_connect(DB_HOST,DB_USER,DB_PASS, DB_NAME);
if (!$con)
die('Could not connect: ' .mysqli_errno($con));
?>