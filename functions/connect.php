<?php
//these are defined as constants
define('DB_HOST', 'nbcc-staff-wellness.cml7wvmpb0fw.us-east-1.rds.amazonaws.com');
define('DB_USER', 'admin');
define('DB_PASS', 'StaffNbcc001');
define('DB_NAME', 'staff');

// for testing purposes
//define('DB_HOST', 'localhost:3306');
//define('DB_USER', 'root');
//define('DB_PASS', '');
//define('DB_NAME', 'staff');
	
global $con;
$con = mysqli_connect(DB_HOST,DB_USER,DB_PASS, DB_NAME);
if (!$con)
die('Could not connect: ' .mysqli_errno($con));
?>