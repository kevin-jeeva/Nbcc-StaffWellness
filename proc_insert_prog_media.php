<?php
session_start();
require_once("functions/Progress.php");

if(isset($_GET["mediaId"]))
{
 $media_id = $_GET["mediaId"];
 if(Progress::InsertVideoProgress($_SESSION["staff_id"], $media_id))
 {
   header("location:watch_video.php?video_id=$media_id");
 }
 else
 {
   
  header("location:watch_video.php?video_id=$media_id");
 }
}
else
{
  header("location:index.php");
}
?>