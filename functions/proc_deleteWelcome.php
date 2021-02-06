<?php
include_once("Welcome.php");
session_start();

if(isset($_GET["welcomeId"]))
{
  $id = $_GET["welcomeId"];
  if(Welcome::DeleteWelcomContent($id))
  {
    $_SESSION["message"] = "Welcome Content Deleted SuccesFully";
    header("location:../administrator.php");
  }
  else{
     $_SESSION["alert_message"] = "Welcome Content Deleted SuccesFully";
    header("location:../administrator.php");
  }
}
?>