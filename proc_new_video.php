<?php
include_once("functions/connect.php");
include_once("functions/Media.php");
session_start();
$video_name;
$allowedType = array("ogm","wmv","mp4","mpg","webm","ogv","mov","asx","mpeg","mp4","m4v","avi");
if(isset($_POST["submit"]))
{
  $video_title = $_POST["videoTitle"];
  $video_description = $_POST["video-description"];
  $format = strpos($_FILES["video"]["name"],".");
  $format = substr($_FILES["video"]["name"],$format+1);
  $media = new Media(0,$video_title,$video_description,0,0);
  $media->mediaPath = $_SESSION["staff_id"].time().".mp4";
  $_FILES["video"]["name"] = $media->mediaPath;
 
  if(in_array($format,$allowedType))
  {
    echo "true";
    if(move_uploaded_file($_FILES["video"]["tmp_name"],'includes/videos/'.$_FILES["video"]["name"]))
    {
      if(Media::InsertMedia($media))
      { 
        $_SESSION["message"] = "Video Inserted Successfully";
        header("location:administrator.php");
      }
      else
      {
        
        $_SESSION["alert_message"] = "Video is not inserted";
        header("location:administrator.php");
      }
    }
  }
  else  
  {  
    $_SESSION["alert_message"] = "Video format not supported";
    header("location:new_video.php");
  }

  
}
else
{  
  header("location:index.php");
}
?>
