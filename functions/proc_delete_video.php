<?php
session_start();
require_once("Media.php");

if(isset($_GET["videoId"]))
{
  $video_id = $_GET["videoId"];
  echo $video_id;
  if(Media::DeleteVideo($video_id))
  {
    $_SESSION["message"] = "Video Deleted Successfully";
    header("location:../administrator.php");
  }
  else
  {
    $_SESSION["alert_message"] = "Video not Deleted";
    header("location:../administrator.php");
  }

}
else
{
  header("location:index.php");
}

?>