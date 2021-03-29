<?php
session_start();
include_once("Progress.php");
if(isset($_GET["contentId"]))
{
  $user_id = $_SESSION["staff_id"]; 
  $content_id = $_GET["contentId"];
  Progress::incompleteTask($content_id, $user_id);
  header("location:../rockYourResolution.php");
}
else{
  header("location:../administrator.php");
}
?>