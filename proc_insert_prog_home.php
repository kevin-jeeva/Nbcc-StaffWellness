<?php
include_once("functions/Progress.php");
session_start();

if(isset($_GET["content_id"]))
{
 $content_id = $_GET["content_id"];
 $user_id = $_SESSION["staff_id"]; 
 $progress = new Progress(0,$user_id,$content_id,100,0,0);
 Progress::InsertProgress($progress);
 echo "From here whoo";
}
else
{
  header("location:index.php");  
}
?>