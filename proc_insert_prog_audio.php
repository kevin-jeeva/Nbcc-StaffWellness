<?php
session_start();
require_once("functions/Progress.php");

if(isset($_GET["mediaId"]))
{
 $media_id = $_GET["mediaId"];
 if(Progress::InsertVideoProgress($_SESSION["staff_id"], $media_id))
 {
   header("location:play_sound.php?soundId=$media_id");
 }
 else
 {
   
  header("location:play_sound.php?soundId=$media_id");
 }
}
else
{
  header("location:index.php");
}
?>