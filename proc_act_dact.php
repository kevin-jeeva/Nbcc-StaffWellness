<?php
require_once("functions/staff.php");
require_once("functions/connect.php");

session_start();
if(isset($_GET["staff_id"]))
{
 $staff_id = $_GET["staff_id"];
 $active = $_GET["active"];
 $message = "";
 if($active == 0)
 {
   $message = "User Deactivated Successfully";
 }
 else
 {
   $message = "User Activated Successfully";
 }
  if(staff::SetActiveAndDeactive($staff_id,$active))
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