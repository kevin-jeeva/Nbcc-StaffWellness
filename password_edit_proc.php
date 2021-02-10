<?php
session_start();
include_once("functions/connect.php");
include_once("functions/staff.php");

$sessId = $_SESSION["staff_id"];
$con =$GLOBALS["con"];

if(isset($_POST["submit"])){
        //grab user entered information
    $curPass = $_POST["currentPassword"];
    $newPass = $_POST["newPassword"];
    $verifyNewPass = $_POST["verifyPassword"];
        //pull pass from database
    $sql ="SELECT password from user WHERE staff_id = '$sessId'";
    $result = mysqli_query($con,$sql); 
    $row = mysqli_fetch_assoc($result);    
    $PASS = $row["password"];
        //if DB pass is equal to curr pass entered 
    if(password_verify($curPass,$PASS)){    
            //if user wrote new pass correct both times
        if($newPass == $verifyNewPass){
                //update
            $sql2 = "UPDATE user set password = '$newPass' WHERE staff_id = '$sessId' "; 
            $result2= mysqli_query($con, $sql2);
            echo "password updated";
            $_SESSION["message"] = "Password Updated!";    
          header("location:dashboard.php");
        } else{
            echo "passwords do not match";
            $_SESSION["message"] = "Passwords do not match!";       
         header("location:password_edit.php");
        }
    }else{
        echo "you are not entering the correct password";
        $_SESSION["message"] = "Password is not correct";    
        header("location:password_edit.php");
       // echo "<BR>". $PASS;
        //echo "<BR>". $curPass;
    }    
}//end isset 
else{
    echo "ERROR";
}
?>
