<?php
session_start();
include_once("Content.php");
if(isset($_GET["contentId"]))
{
  $content_id = $_GET["contentId"];
  Content::DeleteContent($content_id);
  $_SESSION["message"] = "Content Deleted Successfully";
  header("location:../administrator.php");
}
else{
  header("location:../administrator.php");
}
?>