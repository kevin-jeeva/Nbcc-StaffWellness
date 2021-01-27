<?php 
include_once("functions/Resource.php");
session_start();

if(isset($_POST["resource_edit"]))
{
$resource_name = $_POST["resource_edit"];
$resource_id = $_POST["resource_id"];
  if(Resource::UpdateResourceName($resource_name,$resource_id))
  {
    $_SESSION["message"] = "Resource Edited Successfully";
    header("location:administrator.php");
  }
  else
  {
    $_SESSION["message"] = "Resource Edited Successfully";
    header("location:administrator.php");
  }
}
else{
  header("location:administrator.php");
}
?>