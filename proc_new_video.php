<?php
include("functions/connect.php");
include("functions/Media.php");
session_start();
$video_name;
if(isset($_POST["videoTitle"]))
{
  $video_title = $_POST["videoTitle"];
  $video_description = $_POST["video-description"];
  print_r($_FILES["video"]);
  echo $video_title."<BR>".$video_description."<BR>type:".substr($_FILES["video"]["name"],-5);
}
else
{
 // header("location:administrator.php");
}
?>
