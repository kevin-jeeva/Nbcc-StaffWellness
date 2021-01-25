<?php
session_start();
include_once("Content.php");
if(isset($_GET["resourceId"]))
{
  $resourceId = $_GET["resourceId"];
  if(Content::DeleteResources($resourceId))
  {
    $_SESSION["message"] = "Resources Deleted Successfully";
    header("location:../administrator.php");
  }
  
}
else{
  $_SESSION["message"] = "Resources could not be deleted";
  header("location:../administrator.php");
}
?>