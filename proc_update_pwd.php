<?php
session_start();
require_once 'functions/connect.php';
require_once 'functions/staff.php';

if(isset($_POST["mail"]))
{
    $mail = $_POST["mail"];
    $pwd = $_POST["cnfpwd"];

    $result = staff::UpdatePassword($mail, $pwd);
    if($result)
    {
        header("location:login.php?message=Reset Successfull");
    }
    else{
        header("location:login.php?message=Reset unSuccessfull");
    }
}
else{
    header("location:login.php");
}
?>
