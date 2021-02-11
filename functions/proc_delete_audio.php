<?php
session_start();
require_once("Media.php");

if(isset($_GET["audioId"]))
{
  $video_id = $_GET["audioId"];
  echo $video_id;
  if(Media::DeleteVideo($video_id))
  {
    $_SESSION["message"] = "Audio Deleted Successfully";
    header("location:../administrator.php");
  }
  else
  {
    $_SESSION["alert_message"] = "Audio not Deleted";
    header("location:../administrator.php");
  }

}
else
{
  header("location:index.php");
}

?>