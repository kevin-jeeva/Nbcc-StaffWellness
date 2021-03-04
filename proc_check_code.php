<?php
session_start();
require_once 'functions/staff.php';
require_once 'functions/connect.php';
if(isset($_GET["code"]))
{
    $code = $_GET["code"];
    $email = $_GET["email"];
    $result = staff::CheckCode($email,$code);
    if($result == true)
    {
        echo true;
    }
    echo false;
}
else{
    header("location:login.php");
}
?>