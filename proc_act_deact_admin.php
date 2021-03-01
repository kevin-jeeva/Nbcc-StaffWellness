<?php
require_once("functions/staff.php");
require_once("functions/connect.php");

session_start();
if(isset($_GET["staff_id"]))
{
 $staff_id = $_GET["staff_id"];
 $admin = $_GET["admin"];
 $message = "";
 if($admin == 0)
 {
   $message = "User Deactivated from admin";
 }
 else
 {
   $message = "User as Admin";
 }
  if(staff::SetActiveAndDeactiveAdmin($staff_id,$admin))
  {
    echo "Success";
    // $_SESSION["message"] = $message;
    // header("location:active_users.php");
  }
  else
  {
     echo "Fail";
    // $_SESSION["message"] = "Error occured Contact administrator";
    // header("location:active_users.php");
  }

}
else
{
  header("location:index.php");
}
?>